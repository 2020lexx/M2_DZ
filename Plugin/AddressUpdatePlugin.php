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
use Magento\Framework\Message\ManagerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\UrlInterface;
use Psr\Log\LoggerInterface;

use Pablo\DeliveryZones\Helper\Functions;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone\CollectionFactory as CustomerCollectionFactory;
use Pablo\DeliveryZones\Helper\Data;

/**
 * Class CustomerAddressAfterObserver
 * @package Pablo\DeliveryZones\Observer
 */
class AddressUpdatePlugin {

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

    public function __construct(
        Data $zxData,
        Functions $zxFunctions,
        CustomerCollectionFactory $customerCollectionFactory,
        LoggerInterface $loggerInterface,
        ObjectManagerInterface $objectManager,
        UrlInterface $url,
        ManagerInterface $messageManager,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->_zxData = $zxData;
        $this->_zxFunctions = $zxFunctions;
        $this->_customerCollectionFactory = $customerCollectionFactory;

        $this->_customerRepository = $customerRepository;
        $this->logger = $loggerInterface;
        $this->_objectManager = $objectManager;
        $this->_url = $url;
        $this->_messageManager = $messageManager;
    }

    /**
     * @param Address $subject
     * @param \Closure $proceed
     * @param AddressInterface $address
     * @return mixed
     */
    public function afterUpdateData(Address $customerAddress){



        $addressData['address'] = implode(' ',$customerAddress->getStreet());
        $addressData['pobox'] =$customerAddress->getPostcode();
        $addressData['city'] = $customerAddress->getCity();
        $addressData['state'] = $customerAddress->getRegion();
        $addressData['country'] = $customerAddress->getCountryId();


      //*** $this->_messageManager->addSuccessMessage(json_encode($customerAddress->getId()));

        $procedureResponse = json_decode($this->_zxData->mainProcedure($addressData));

        $model = $this->_objectManager->create('Pablo\DeliveryZones\Model\CustomerDeliveryZone');

        // get row from address_id from customer table if this is not an update
        if($customerAddress){

            $customerDeliveryZoneRow = $this->_zxData->getCustomerDeliveryZoneDataModel()->addFieldToFilter('address_id',$customerAddress['id'])->addFieldToFilter('customer_id',$customerAddress['customer_id'])->getData();

            if($customerDeliveryZoneRow){ $model->load($customerDeliveryZoneRow[0]['customerdeliveryzone_id']); }
       }


        $model->setData('store_id',$this->_zxData->getStoreId());
        $model->setData('website_id', $this->_zxData->getWebsiteId());
        $model->setData('customer_id',$customerAddress['customer_id']);
        $model->setData('address_id',(!is_null($customerAddress['id']))?$customerAddress['id']:9999);
        $model->setData('customer_email',$this->_customerRepository->getById($customerAddress['customer_id'])->getEmail());
        $model->setData('enable',1);

         // check if geocoding is OK
        if($procedureResponse->customerCoords->status =='ok'){
            $model_address_lat = $procedureResponse->customerCoords->lat;
            $model_address_long =$procedureResponse->customerCoords->long;

            if($procedureResponse->Zone->status == 'in'){
                $model_delivery_zone_id = $procedureResponse->Zone->zones_id;
                $model_delivery_section_id = $procedureResponse->Section->section_id;
                $model_distance_to_delivery_server = $procedureResponse->Section->distanceText;
                $model_extra_data = 'in';
            } else {
                $model_delivery_zone_id = 0;
                $model_delivery_section_id = 0;
                $model_distance_to_delivery_server = 0;
                $model_extra_data = 'out';
            }

        } else {
            // todo: set default coords when geocoding fail
            $model_address_lat = 0;
            $model_address_long =0;
            $model_delivery_zone_id=0;
            $model_delivery_section_id=0;
            $model_distance_to_delivery_server=0;
            $model_extra_data='geocoding error';
        }

        $model->setData('address_lat',$model_address_lat);
        $model->setData('address_long',$model_address_long);
        $model->setData('delivery_zone_id',$model_delivery_zone_id);
        $model->setData('delivery_section_id',$model_delivery_section_id);
        $model->setData('distance_to_delivery_server',$model_distance_to_delivery_server);
        $model->setData('extra_data',$model_extra_data);

        try {
            $model->save();
         //  $this->_messageManager->addSuccessMessage(__('You saved the Customer Deliveryzone.'));
        } catch (LocalizedException $e) {

            $this->_messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
                $this->_messageManager->addExceptionMessage($e, __('Something went wrong while saving the Customer DeliveryZone.'));
        }

        return;
    }

}