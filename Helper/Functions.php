<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */



namespace Pablo\DeliveryZones\Helper;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Address\Config;
use Magento\Customer\Model\Address\Mapper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\AbstractHelper;

use Pablo\DeliveryZones\Model\ResourceModel\Zones\CollectionFactory as ZonesCollectionFactory;
use Pablo\DeliveryZones\Model\ResourceModel\Sections\CollectionFactory as SectionsCollectionFactory;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone\CollectionFactory as CustomerCollectionFactory;




class Functions  extends AbstractHelper
{

    /**
     *
     */
    const MAP_MARKER_DIV_COLOR = ['','#ea4e39','#f79931','#90c627','#3aaee2','#d85cbc','#ae3d41','#0067a3'];

    protected $_zonesCollectionFactory;
    protected $_sectionsCollectionFactory;
    protected $_customerCollectionFactory;
    protected $_storeManagerInterface;
    protected $_customerSession;
    protected $_customerRepository;
    protected $_addressConfig;
    protected $_addressMapper;
    protected $_logger;

    protected $_zxData;

    /**
     * @var Context
     */
    private $context;

    public function __construct(
        Context $context,

        ZonesCollectionFactory $zonesCollectionFactory,
        SectionsCollectionFactory $sectionsCollectionFactory,
        CustomerCollectionFactory $customerCollectionFactory,

        Data $zxData,
        CustomerRepositoryInterface $customerRepository,
        StoreManagerInterface $storeManager,
        Session $customerSession,
        Config $addressConfig,
        Mapper $addressMapper,

        array $data = []
    ) {
        $this->_logger = $context->getLogger();
        $this->_customerRepository = $customerRepository;
        $this->_zonesCollectionFactory = $zonesCollectionFactory;
        $this->_sectionsCollectionFactory = $sectionsCollectionFactory;
        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_customerSession = $customerSession;
        $this->_storeManagerInterface = $storeManager;
        $this->_addressConfig = $addressConfig;
        $this->_addressMapper = $addressMapper;

       $this->_zxData = $zxData;

        parent::__construct($context);

    }
public function getCustomerIdFromSession(){

        return $this->_customerSession->getCustomer()->getId();

}
    public function getAddressIdFromCustomerId(){

        $customer_id = $this->_customerSession->getCustomer()->getId();

        $addresses = $this->_customerRepository->getById($customer_id)->getAddresses();

        return $addresses;


    }
    public function getListAddressIdFromCustomerId($customer_id){

        $addresses = $this->_customerRepository->getById($customer_id)->getAddresses();

        return $addresses;


    }
    public function getZonesSectionFromAddressId($addressId){

        // get from address_id the zone_id and section_id
        $customerZone = $this->_zxData->getCustomerDataModel()->addFieldToFilter('address_id',$addressId)->getColumnValues('delivery_zone_id');
        $customerSection = $this->_zxData->getCustomerDataModel()->addFieldToFilter('address_id',$addressId)->getColumnValues('delivery_section_id');


        // check if customer has no zone data on customerdelivery table
        if(empty($customerZone)||empty($customerSection)){

            return;
        }
        // check if customer is off zone
        if(($customerZone[0] == 0)||($customerSection[0] == 0)){

            return;

        } else {

            // get data from zone model
            $zoneModel = $this->_zxData->getZoneDataModel()->addFieldToFilter('zones_id',$customerZone[0])->getData();
            $sectionModel = $this->_zxData->getSectionDataModel()->addFieldToFilter('sections_id',$customerSection[0])->getData();

             return ['zone' => $zoneModel[0],'section'=> $sectionModel[0]];
        }
    }


    // address list view

    public function getZonesSectionViewA($addressId){

        $viewA = $this->getZonesSectionFromAddressId($addressId);

        // check if customer is off zone or has no data
        if(empty($viewA)){

            $viewData = __('Only Standard Shipping is Available');

        } else {

            $viewData = __('Zone: ').$viewA['zone']['zone_name'].'<br>'.
                        __('Section:').$viewA['section']['section_name'].'<br>'.
                        __('Delivery :').'<br> '.$this->_zxData->getSectionDelivery($viewA['section']['section_delivery_days'] ,$viewA['section']['section_delivery_time']) . '<br>'.
                        __('Delivery Cost: €').$viewA['section']['section_dly_cost'];

         }

         return $viewData;

    }

    // delivery information view

    public function getZoneSectionViewB(){

        $viewB = "";
        $markersB = [];
        $count = 1;
        // get addresses from customer id
        $addresses = $this->getAddressIdFromCustomerId();

        if(!empty($addresses)) {

            // div color is get from /css/images/markers-matte.png
            $div_color = self::MAP_MARKER_DIV_COLOR;

            foreach ($addresses as $address) {

                $customer_address_lat = $this->_zxData->getCustomerDataModel()->addFieldToFilter('address_id', $address->getId())->getColumnValues('address_lat');
                $customer_address_long = $this->_zxData->getCustomerDataModel()->addFieldToFilter('address_id', $address->getId())->getColumnValues('address_long');

                // check if zone is configured
                if (!empty($customer_address_lat)) {

                    $renderer = $this->_addressConfig->getFormatByCode('html')->getRenderer();

                    $address_data = $renderer->renderArray($this->_addressMapper->toFlatArray($address));
                    $zone_data = $this->getZonesSectionViewA($address->getId());

                    $center_map = "<button  class='action save primary Pablo_deliveryzones_center_map' data-center-map='[".$customer_address_lat[0].",".$customer_address_long[0]."]'><span>".__('View On Map')."</span></button>";

                    $viewB = $viewB . "<div class='field block zx-col-md-4'> <div style='background-color: " . $div_color[$count] . " ' class='block-title'> </div> <div class='block-content'><address>" . $address_data . "</address> <hr> <div class='zone_data'>" . $zone_data . "</div><hr>".$center_map."</div> </div>";

                    $markersB[] = [
                        'id' => strval($count),
                        'coords' => [$customer_address_lat[0], $customer_address_long[0]]
                    ];
                    $count++;
                }
            }

        }

        return [
                'html_data' => $viewB,
                'markers_data' => json_encode($markersB)
                ];
    }

    // **** by now this is not used ****

    public function getZoneSectionViewC(){

        $customer_id = $this->_customerSession->getCustomer()->getId();

        $addresses = $this->_customerRepository->getById($customer_id)->getAddresses();

        $viewC = [];

        foreach ($addresses as $address) {

            $viewC[] = [ 'addr_id' => $address->getId(),
                         'href' => urlencode($this->_storeManagerInterface->getStore()->getBaseUrl().'customer/address/edit/id/'.$address->getId().'/'),
                         'zone_data' =>  rawurlencode($this->getZonesSectionViewA($address->getId()))];
         }
         return json_encode($viewC);
    }
}

