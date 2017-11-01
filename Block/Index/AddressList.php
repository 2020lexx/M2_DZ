<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

/**
 * ************* DISCONTINUED ****************
 */

namespace Pablo\DeliveryZones\Block\Index;

use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\AddressInterface;
use Magento\Customer\Model\Address\Config;
use Magento\Customer\Model\Address\Mapper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Block\Address\Book;
use Magento\Customer\Model\Session;

use Pablo\DeliveryZones\Model\ResourceModel\Zones\CollectionFactory as ZonesCollectionFactory;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone\CollectionFactory as CustomerCollectionFactory;
use Pablo\DeliveryZones\Helper\Functions;
use Pablo\DeliveryZones\Helper\Data;

/**
 * Class AddressList
 * @package Pablo\DeliveryZones\Block\Index
 */
class AddressList extends Template
{


    /**
     * @var CustomerCollectionFactory
     */
    protected $_customerCollectionFactory;
    /**
     * @var Session
     */
    protected $_customerSession;
    /**
     * @var Magento\Customer\Api\Data\AddressInterface
     */
    protected $_addressAttr;
    /**
     * @var AddressRepositoryInterface
     */
    protected $_addressRepository;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $_customerRepository;
    /**
     * @var
     */
    protected $_addressSearchResults;
    /**
     * @var Config
     */
    protected $_addressConfig;
    /**
     * @var Mapper
     */
    protected $_addressMapper;
    /**
     * @var
     */
    protected $_storeManagerInterface;


    /**
     * AddressList constructor.
     * @param Context $context
     * @param ZonesCollectionFactory $zonesCollectionFactory
     * @param CustomerCollectionFactory $customerCollectionFactory
     * @param Data $helper
     * @param Book $book
     * @param Functions $functions
     * @param Session $customerSession
     * @param Magento\Customer\Api\Data\AddressInterface $addressAttr
     * @param AddressRepositoryInterface $addressRepository
     * @param CustomerRepositoryInterface $customerRepository
     * @param Config $addressConfig
     * @param Mapper $addressMapper
     * @param array $data
     */
    public function __construct(
        ZonesCollectionFactory $zonesCollectionFactory,
        CustomerCollectionFactory $customerCollectionFactory,
        Data $helper,
        Functions $functions,

        AddressRepositoryInterface $addressRepository,
        CustomerRepositoryInterface $customerRepository,
        Book $book,
        Context $context,
        Session $customerSession,
        AddressInterface $addressAttr,
        Config $addressConfig,
        Mapper $addressMapper,
        array $data = []
    ) {

        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->helper = $helper;
        $this->book = $book;

        $this->functions = $functions;
        $this->_customerSession = $customerSession;
        $this->_addressAttr = $addressAttr;
        $this->_addressRepository = $addressRepository;
        $this->_customerRepository = $customerRepository;
        $this->_addressConfig = $addressConfig;
        $this->_addressMapper = $addressMapper;
        parent::__construct($context, $data);
        $this->_storeManagerInterface = $context->getStoreManager();
      }


    /**
     *
     */
    public function getAddress(){

      $customer_id = $this->_customerSession->getCustomer()->getId();

        $addresses = $this->_customerRepository->getById($customer_id)->getAddresses();

        // get zone data from customer id
        // todo: add current store and website filter

        foreach ($addresses as $address) {

             $renderer = $this->_addressConfig->getFormatByCode('html')->getRenderer();
             echo $renderer->renderArray($this->_addressMapper->toFlatArray($address));
             echo $this->_functions->getZonesSectionViewA($address->getId());
        }


       $currentStore = $this->_storeManagerInterface->getStore();
            $currentWebSite = $this->_storeManagerInterface->getWebsite();

         return;
      }


    /**
     * @return mixed
     */
    public function getZones()
    {
        /** @var PostCollection $zonesCollection */
        $zonesCollection = $this->_zonesCollectionFactory->create();
        $zonesCollection->addFieldToSelect('*')->load();
        return $zonesCollection->getItems();
    }



}
