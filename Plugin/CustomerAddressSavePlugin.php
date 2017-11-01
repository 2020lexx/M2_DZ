<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */


namespace Pablo\DeliveryZones\Plugin;

use Magento\Customer\Api\Data\AddressInterface;
use Magento\Customer\Model\Address;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\UrlInterface;
use Psr\Log\LoggerInterface;

use Magento\Framework\App\RequestInterface;

use Pablo\DeliveryZones\Helper\Functions;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone\CollectionFactory as CustomerCollectionFactory;
use Pablo\DeliveryZones\Helper\Data;

/**
 * Class CustomerAddressAfterObserver
 * @package Pablo\DeliveryZones\Observer
 */
class CustomerAddressSavePlugin {

    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;
    /**
     * @var ManagerInterface
     */
    protected $_messageManager;
    /**
     * @var UrlInterface
     */
    protected $_url;
    /**
     * @var Data
     */
    protected $_zxData;
    /**
     * @var CustomerCollectionFactory
     */
    protected $_customerCollectionFactory;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $_customerRepository;

    protected $_zxFunctions;


    protected $request;


    public function __construct(
        Data $zxData,
        Functions $zxFunctions,
        CustomerCollectionFactory $customerCollectionFactory,
        LoggerInterface $loggerInterface,
        ObjectManagerInterface $objectManager,
        UrlInterface $url,
        ManagerInterface $messageManager,
        CustomerRepositoryInterface $customerRepository,

        RequestInterface $request
    ) {
        $this->_zxData = $zxData;
        $this->_zxFunctions = $zxFunctions;
        $this->_customerCollectionFactory = $customerCollectionFactory;

        $this->_customerRepository = $customerRepository;
        $this->logger = $loggerInterface;
        $this->_objectManager = $objectManager;
        $this->_url = $url;
        $this->_messageManager = $messageManager;

        $this->request = $request;
    }

    /**
     * @param Address $subject
     * @param \Closure $proceed
     * @param AddressInterface $address
     * @return mixed
     */
    public function beforeDispatch( ActionInterface $subject, RequestInterface $request ){


       // 2nd stage add address_id
       if(count($this->request->getPost())==0){

           $customerId = $this->_zxFunctions->getCustomerIdFromSession();

            // get the customer address without address_id so [99999]
           $model = $this->_objectManager->create('Pablo\DeliveryZones\Model\CustomerDeliveryZone');

           $customerDeliveryZoneRow = $this->_zxData->getCustomerDeliveryZoneDataModel()->addFieldToFilter('address_id',9999)->addFieldToFilter('customer_id',$customerId)->getData();

           // return if all is fill
           if(!$customerDeliveryZoneRow){
               //***   $this->_messageManager->addSuccessMessage("no need to fill");
               return;
           }

           $model->load($customerDeliveryZoneRow[0]['customerdeliveryzone_id']);

           // todo: check this method .. if is an insert address_id is null so I search on API Address :-(
           // get address list to get last insert id
           $addressList = $this->_customerRepository->getById($this->_zxFunctions->getCustomerIdFromSession())->getAddresses();
           // get the higher id cos' is the last inserted for this user
           $addressListIds = array();
           foreach ($addressList as $singleCustomerAddress){
               $addressListIds[] = $singleCustomerAddress->getId();
           }
           // set the last id on customer addresses table with temporary id 9999
           $model->setData('address_id',max($addressListIds));
           $model->save();


        }
        return;
    }


}