<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Helper;

use Magento\Framework\Module\ModuleListInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\UrlInterface;

use Pablo\DeliveryZones\Model\AlertSend;
use Pablo\DeliveryZones\Model\ResourceModel\Zones\CollectionFactory as ZonesCollectionFactory;
use Pablo\DeliveryZones\Model\ResourceModel\Sections\CollectionFactory as SectionsCollectionFactory;
use Pablo\DeliveryZones\Model\ResourceModel\Config\CollectionFactory as ConfigCollectionFactory;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone\CollectionFactory as CustomerCollectionFactory;





/**
 * Class Data
 * @package Pablo\DeliveryZones\Helper
 */
class Data extends AbstractHelper
{


    /**
     *
     */
    const GOOGLE_ROUTING_API_KEY = 'googleRoutingAPIKey';
    /**
     *
     */
    const GOOGLE_GEOCODING_API_KEY = 'googleGeocodingAPIKey';

    const CONFIG_SHIPPING_HOLIDAYS = 'Pablo_deliveryzones/shipping/shipping_holidays';
    const CONFIG_SINGLE_STORE_MODE = 'Pablo_deliveryzones/general/single_store_mode';

    /**
     * @var array
     */
    protected $WeekDay;
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_zonesCollectionFactory;
    protected $_sectionsCollectionFactory;
    protected $_configCollectionFactory;
    protected $_customerCollectionFactory;
    protected $_alertSend;
    protected $_datetime;
    protected $_moduleList;


    /**
     * @var Curl
     */
    protected $_curl;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $_storeManagerInterface;


    protected $logger;
    private $mainProcedureData;

    protected $_customerSession;
    /**
     * @var UrlInterface
     */
    private $_urlInterface;
    /**
     * Constructor
     *
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
      */
    public function __construct(
        Context $context,
        ManagerInterface $messageManager,
        ModuleListInterface $moduleList,

        DateTime $datetime,
        ZonesCollectionFactory $zonesCollectionFactory,
        SectionsCollectionFactory $sectionsCollectionFactory,
        ConfigCollectionFactory $configCollectionFactory,
        CustomerCollectionFactory $customerCollectionFactory,
        AlertSend $alertSend,
        Curl $curl,
        StoreManagerInterface $storeManager,
        Session $customerSession
       ) {

        $this->logger = $context->getLogger();
        $this->_urlInterface = $context->getUrlBuilder();

        $this->_curl = $curl;
        $this->_zonesCollectionFactory = $zonesCollectionFactory;
        $this->_sectionsCollectionFactory = $sectionsCollectionFactory;
        $this->_configCollectionFactory = $configCollectionFactory;
        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_alertSend = $alertSend;
        $this->_datetime = $datetime;
        $this->_storeManagerInterface = $storeManager;
        parent::__construct( $context);
        $this->_messageManager = $messageManager;
        $this->_customerSession = $customerSession;
        $this->_moduleList      = $moduleList;

        $this->WeekDay = [__('Sunday'),
                          __('Monday'),
                          __('Tuesday'),
                          __('Wednesday'),
                          __('Thursday'),
                          __('Friday'),
                          __('Saturday')];
    }

    /**
     * @param $addressData
     */
    public function mainProcedure($addressData)
    {

            $this->mainProcedureData['customerAddress'] = $addressData;

            $this->_customerSession->unsZXCustomerZoneStatus();

          //  Call geocoding function
            if($this->geocodingAddress()){
                // geocoding error
                $this->_alertSend->alertSend(
                        'Pablo_DF - Geocoding Error',
                    'Helper/Data/mainProcedure($addressData)/$this->geocodingAddress()',
                        'Error geocoding address',
                        '$this->mainProcedureData :'.json_encode($this->mainProcedureData));

                $this->_customerSession->setZXCustomerZoneStatus($this->mainProcedureData['CustomerZoneStatus']);

                return json_encode($this->mainProcedureData);
            }

            //  Check Delivery Zone
            if($this->locateDeliveryZone()){
                // no zone
                $this->_alertSend->alertSend(
                    'Pablo_DF - No Match Zone',
                    'Helper/Data/mainProcedure($addressData)/$this->locateDeliveryZone()',
                    'Error on locate Delivery Zone',
                    '$this->mainProcedureData :'.json_encode($this->mainProcedureData));

                $this->_customerSession->setZXCustomerZoneStatus($this->mainProcedureData['CustomerZoneStatus']);

                return json_encode($this->mainProcedureData);
           }

            // Call distance function
          if($this->locateDeliverySection()){
            // no zone
            $this->_alertSend->alertSend(
                'Pablo_DF - No Section ',
                'Helper/Data/mainProcedure($addressData)/$this->locateDeliverySection()',
                'Error on locate Delivery Section',
                '$this->mainProcedureData :'.json_encode($this->mainProcedureData));

             $this->_customerSession->setZXCustomerZoneStatus($this->mainProcedureData['CustomerZoneStatus']);

              return json_encode($this->mainProcedureData);
            }

            // Set Session Var
            /*
               in
               out
               geocoding error
               routing error
            */
            $this->_customerSession->setZXCustomerZoneStatus($this->mainProcedureData['CustomerZoneStatus']);

             return json_encode($this->mainProcedureData);
       }


    /**
     * @return bool|void
     */
    public function geocodingAddress()
       {

           // Convert POST data to address string
           $prepAddr = str_replace(' ','+',implode('+',$this->mainProcedureData['customerAddress']));

           $GoogleApiGeocodingKey = $this->getGoogleGeocodingAPIKey();

           $this->_curl->get('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key='.$GoogleApiGeocodingKey);

           if ($this->_curl->getStatus() !== 200){
                // TODO: error management
                $this->_alertSend->alertSend(
                    'Pablo_DF - Geocoding Error',
                    'Helper/Data/geocodingAddress()',
                    'Geocoding HTTP Request Error',
                    'this->_curl->getStatus():'.$this->_curl->getStatus());

                $this->mainProcedureData['customerCoords']['status'] = 'geocoding error';
                $this->mainProcedureData['CustomerZoneStatus'] = 'geocoding error';
               return;

            }

            $output = json_decode($this->_curl->getBody());

            if($output->status === 'OK') {

                $this->mainProcedureData['customerCoords']['lat'] = $output->results[0]->geometry->location->lat;
                $this->mainProcedureData['customerCoords']['long'] = $output->results[0]->geometry->location->lng;
                $this->mainProcedureData['customerCoords']['status'] = 'ok';

            } else {

                $this->mainProcedureData['customerCoords']['status'] = 'no geocoding result';
                $this->mainProcedureData['CustomerZoneStatus'] = 'geocoding error';

                /** @noinspection PhpInconsistentReturnPointsInspection */
                return true;

            }
       }


       public function locateDeliveryZone()
       {

           // get Zones Data
           $zonesData = $this->getZoneDataModel()->getData();

           // in
           $checkPointX = $this->mainProcedureData['customerCoords']['lat'];
           $checkPointY = $this->mainProcedureData['customerCoords']['long'];

           foreach ($zonesData as $zoneRow) {

                 $zonePoly = json_decode($zoneRow['zone_boundary']);

                 // Precal
                 $constantValues= array();
                 $multipleValues = array();

                 $polyCorners = count($zonePoly);

                 $j = $polyCorners - 1;

                 for ($i = 0; $i < $polyCorners; $i++){

                     if($zonePoly[$j][0]==$zonePoly[$i][0]) {
                         $constantValues[$i] = $zonePoly[$i][1];
                         $multipleValues[$i] = 0;
                     }else{
                         $constantValues[$i]=$zonePoly[$i][1]-($zonePoly[$i][0]*$zonePoly[$j][1])/($zonePoly[$j][0]-$zonePoly[$i][0])+($zonePoly[$i][0]*$zonePoly[$i][1])/($zonePoly[$j][0]-$zonePoly[$i][0]);
                         $multipleValues[$i]=($zonePoly[$j][1]-$zonePoly[$i][1])/($zonePoly[$j][0]-$zonePoly[$i][0]);
                     }
                    $j = $i;
             }

           // check zone
           $inZone =  false;

             for ($i = 0; $i < $polyCorners; $i++){

                     if(($zonePoly[$i][0] < $checkPointX && $zonePoly[$j][0] >= $checkPointX || $zonePoly[$j][0] < $checkPointX && $zonePoly[$i][0] >= $checkPointX)){

                         if($checkPointX*$multipleValues[$i]+$constantValues[$i] < $checkPointY){
                             $inZone = !$inZone;
                         }

                     }
                     $j = $i;
                 }


               if($inZone){
                   $this->mainProcedureData['Zone'] = $zoneRow;
                   $this->mainProcedureData['Zone']['status'] = 'in';
                   $this->mainProcedureData['CustomerZoneStatus'] = 'in';
                   return;
               }

           }

           // todo: management off zone get default server coords
           $this->mainProcedureData['Zone']['status'] = 'off zone';
           $this->mainProcedureData['CustomerZoneStatus'] = 'off zone';

           $this->mainProcedureData['Zone']['zone_server_coords_lat'] = $this->getConfigDataModel()->getColumnValues('map_center_lat')[0];
           $this->mainProcedureData['Zone']['zone_server_coords_long'] = $this->getConfigDataModel()->getColumnValues('map_center_long')[0];

           return true;


        }

       public function locateDeliverySection()
       {

           // Route Distance
           $origins =  trim($this->mainProcedureData['Zone']['zone_server_coords_lat']).','. trim($this->mainProcedureData['Zone']['zone_server_coords_long']);
           $destinations = $this->mainProcedureData['customerCoords']['lat'].','.$this->mainProcedureData['customerCoords']['long'];
           $mode = 'driving';
           $units = 'metric';
           $GoogleApiRoutingKey = $this->getGoogleRoutingAPIKey();

           $url = 'https://maps.google.com/maps/api/distancematrix/json?origins='.$origins.'&destinations='.$destinations.'&mode='.$mode.'&units='.$units.'&key='.$GoogleApiRoutingKey;
          // todo: add api key
         //  $url = 'http://maps.google.com/maps/api/distancematrix/json?origins='.$origins.'&destinations='.$destinations.'&mode='.$mode.'&units='.$units;

           $this->_curl->get(str_replace(' ','',$url));

           if ($this->_curl->getStatus() !== 200){

               // TODO: error management
               $this->_alertSend->alertSend(
                   'Pablo_DF - Map Routing Error',
                   'Helper/Data/mainProcedure($addressData)/$this->locateDeliverySection()',
                   "Local delivery Section - Map Routing Error",
                   "this->_curl->getStatus() status:".$this->_curl->getStatus());

               $this->mainProcedureData['customerCoords']['status'] = 'routing error';
               $this->mainProcedureData['CustomerZoneStatus'] = 'routing error';

               return true;

           }

           $outputRouting = json_decode($this->_curl->getBody());

            if($outputRouting->status!="OK"){

                $this->_alertSend->alertSend(
                    'Pablo_DF - Map Routing Error',
                    'Helper/Data/mainProcedure($addressData)/$this->locateDeliverySection()',
                    "Local delivery Section - Map Routing Error on query",
                    "this->_curl->getStatus() status:".$this->_curl->getStatus());
                    $this->mainProcedureData['customerCoords']['status'] = 'routing error';

                $this->mainProcedureData['CustomerZoneStatus'] = 'routing error';

                return true;
           }

           // Get Section
           // todo: optimize this method
           // $sectionData = $this->_sectionCollectionFactory->create()->getColumnValues('zone_code');
           $sectionRows = $this->getSectionDataModel()->getData();

           $sectionFromZone = [];

           foreach ($sectionRows as $value){

               // check if this zone has a own sections
               if($value['zone_code']==$this->mainProcedureData['Zone']['zone_code']){
                   // add to working array
                   $sectionFromZone[] = $value;
               } elseif ($value['zone_code']==0) {
                   // make a universal working array if exists
                   $sectionUniversal[] = $value;
               }

           }
           // if section from zone is empty get universal
           $sectionData = (count($sectionFromZone)==0)?$sectionUniversal:$sectionFromZone;

           // check Section Data for this Zone
           foreach ($sectionData as $sectionRow){

               if(floatval($sectionRow['section_min_dist_to_server'])*1000 < floatval($outputRouting->rows[0]->elements[0]->distance->value) &&
                   floatval($outputRouting->rows[0]->elements[0]->distance->value) < floatval($sectionRow['section_max_dist_to_server'])*1000){

                   $this->mainProcedureData['Section']['section_id'] = $sectionRow['sections_id'];

                   $this->mainProcedureData['Section']['section_name'] = $sectionRow['section_name'];
                   $this->mainProcedureData['Section']['section_dly_cost'] = $sectionRow['section_dly_cost'] ;
                   $this->mainProcedureData['Section']['section_delivery_data']=$this->getSectionDelivery($sectionRow['section_delivery_days'],$sectionRow['section_delivery_time']);
                  
                   $this->mainProcedureData['Section']['distanceText']=$outputRouting->rows[0]->elements[0]->distance->text;
                   $this->mainProcedureData['Section']['distanceValue']=$outputRouting->rows[0]->elements[0]->distance->value;

                   $this->mainProcedureData['Section']['durationText']=$outputRouting->rows[0]->elements[0]->duration->text;
                   $this->mainProcedureData['Section']['durationValue']=$outputRouting->rows[0]->elements[0]->duration->value;

                   return;
               }

           }
           // if arrives here doesn't match section
           $this->_alertSend->alertSend(
                    'Pablo_DF - Section Match Error',
               'Helper/Data/mainProcedure($addressData)/$this->locateDeliverySection()',
               'Local delivery Section - Section match fail!',
                        '$this->mainProcedureData :'.json_encode($this->mainProcedureData));

           $this->mainProcedureData['CustomerZoneStatus'] = 'section match error';

           return true;
       }




   public function  getStoreId(){

        if($this->scopeConfig->getValue(self::CONFIG_SINGLE_STORE_MODE)){

            return ['like' => '%'];

        } else {

            $response = $this->_storeManagerInterface->getStore()->getId();

            return $response[0];

        }

   }


    public function getWebsiteId(){

        if($this->scopeConfig->getValue(self::CONFIG_SINGLE_STORE_MODE)){

            return ['like' => '%'];

        } else {

            $response = $this->_storeManagerInterface->getStore()->getWebsiteId();

            return $response[0];
        }
    }


    /**
     * @return mixed
     */
    public function getZoneDataModel(){

     $zonesDataModel = $this->_zonesCollectionFactory->create()->addFieldToFilter('store_id',$this->getStoreId())->addFieldToFilter('website_id',$this->getWebsiteId())->addFieldToFilter('zone_enable',true);

     return  $zonesDataModel;

     }

     public function getSectionDataModel(){

        $sectionDataModel = $this->_sectionsCollectionFactory->create()->addFieldToFilter('store_id',$this->getStoreId())->addFieldToFilter('website_id',$this->getWebsiteId())->addFieldToFilter('section_enable',true);

        return  $sectionDataModel;

    }

    public function getCustomerDeliveryZoneDataModel(){

        $customerDeliveryZoneDataModel = $this->_customerCollectionFactory->create()->addFieldToFilter('store_id',$this->getStoreId())->addFieldToFilter('website_id',$this->getWebsiteId());

        return  $customerDeliveryZoneDataModel;

    }

    public function getConfigDataModel(){

        $configDataModel = $this->_configCollectionFactory->create()->addFieldToFilter('store_id',$this->getStoreId())->addFieldToFilter('website_id',$this->getWebsiteId())->addFieldToFilter('map_enable',true);

        return  $configDataModel;

    }

    public function getGoogleRoutingAPIKey(){

         $key = $this->getValueFromArray($this->getConfigDataModel()->getColumnValues('map_services_keys'),self::GOOGLE_ROUTING_API_KEY);

         return ($this->checkInsertedData($key,'\helper\data\getGoogleRoutingAPIKey()'))?$key:false;
    }

    public function getGoogleGeocodingAPIKey(){

        $key = $this->getValueFromArray($this->getConfigDataModel()->getColumnValues('map_services_keys'),self::GOOGLE_GEOCODING_API_KEY);

        return ($this->checkInsertedData($key,'\helper\data\getGoogleGeocodingAPIKey()'))?$key:false;;
    }

    public function checkInsertedData($data,$function){


        if(empty($data)){

             $this->_alertSend->alertSend(
                'Pablo_DF - No data Error',
                $function,
                'No data response for this function',
                '');

            return false;

        } else {

            return true;

        }
    }
    // todo: modifiy this
    public function getValueFromArray($array,$key){

        $value = (array) json_decode($array[0]);

        return $value[$key];

    }
    public function getCustomerDataModel(){

        $customer_id = $this->_customerSession->getCustomer()->getId();

        // get zone data from customer id
        $customerDataModel = $this->_customerCollectionFactory->create()->addFieldToFilter('store_id',$this->getStoreId())->addFieldToFilter('website_id',$this->getWebsiteId())->addFieldToFilter('customer_id',$customer_id);

        return $customerDataModel;

    }
    public function mapInit(){

        $mapInit = [
                     'DrawData' => $this->getZoneDataModel()->getColumnValues('zone_boundary'),
                     'NameData' => $this->getZoneDataModel()->getColumnValues('zone_name'),
                     'AttrData' => $this->getZoneDataModel()->getColumnValues('zone_attr'),
                     'MapAttrData' => $this->getConfigDataModel()->getColumnValues('map_attr'),
                     'MapCenterLat' => $this->getConfigDataModel()->getColumnValues('map_center_lat'),
                     'MapCenterLong' => $this->getConfigDataModel()->getColumnValues('map_center_long'),
                     'MapZoom' => $this->getConfigDataModel()->getColumnValues('map_zoom'),
                     'MapHeight' => $this->getConfigDataModel()->getColumnValues('map_height'),
                     'ProcUrl' => $this->_storeManagerInterface->getStore()->getBaseUrl().'deliveryzones/index/procedure',
                     'CustomerMapZoom' => $this->getConfigDataModel()->getColumnValues('map_customer_zoom')
                    ];

         return json_encode($mapInit);

    }

    public function redirectIfUserIsNotLogged(){

        if (!$this->_customerSession->isLoggedIn()) {
            $this->_customerSession->setAfterAuthUrl($this->_urlInterface->getCurrentUrl());
            $this->_customerSession->authenticate();
        }
    }

    /**
     * Get Map Marker Image Icon
     *
     * @return URL
     */
    public function getMapMarker()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).
            "/marker/" . $this->scopeConfig->getValue(self::MAP_MARKER);
    }

    public function getSectionDeliveryDates($sectionDeliveryDates){

        $result = '';

         foreach (json_decode($sectionDeliveryDates) as $key => $value){

            if($value == true){
                $result = $result.((empty($result))?'':' - ').$this->WeekDay[$key];
            }
        }
        return $result;
    }

    public function getSectionDeliveryHours($sectionDeliveryHours){

        $result = '';

        foreach (json_decode($sectionDeliveryHours) as $key => $value){

        //    $result = $result.((empty($result))?'':' | ').$value;

        }
        return $result;

    }

    public function getSectionDelivery($sectionDeliveryDates,$sectionDeliveryHours){

        $deliveryHours = json_decode($sectionDeliveryHours);
        $result = '';

        foreach (json_decode($sectionDeliveryDates) as $key => $value){

            if($value == true){

                $result = $result.((empty($result))?'':'<br>').$this->WeekDay[$key].' / '.$deliveryHours[$key][0];

            }
        }
       return $result;
    }

    public function getSectionNextDeliveryDay($sectionDeliveryDates,$sectionDeliveryHours){

        $deliveryHours = json_decode($sectionDeliveryHours);
        $deliveryDays = json_decode($sectionDeliveryDates);

        $dates = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

        // get today's day of the week as index [0-6]
        $date = $this->_datetime->gmtDate();
        $dayofweek = date('w', strtotime($date));
        $count = $dayofweek;

        while (true){
            $count++;
            $count=($count>6)?0:$count;
            // check if next day is for delivery
            if($deliveryDays[$count]){
                // get weekday name and get date number
                $delivery_date = date('d/m/Y', strtotime('next '.$dates[$count]));
                $delivery_date_check = date('Y-m-d', strtotime('next '.$dates[$count]));
                // check if it's a holiday
                 if(!in_array($delivery_date_check,$this->getShippingHolidays())){
                    break;
                }
            }
        }

        $delivery_data = $this->WeekDay[$count].' '.$delivery_date;

        return $delivery_data;
    }

    /**
     * @return array|mixed
     */
    public function getShippingHolidays()
    {
        $holidays_array = json_decode($this->scopeConfig->getValue(self::CONFIG_SHIPPING_HOLIDAYS));

        return (is_null($holidays_array))?[]:$holidays_array;
    }


    public function sendToDebug($mess){

        $this->_logger->debug('Pablo_ - '.$mess);

    }

    public function getModuleVersion()
    {
        $moduleCode = 'Pablo_DeliveryZones';
        $moduleInfo = $this->_moduleList->getOne($moduleCode);
        return $moduleInfo['setup_version'];
    }

    public function customExceptionHandler($exception) {

        echo "custom exception handler fired\n";

    }
}