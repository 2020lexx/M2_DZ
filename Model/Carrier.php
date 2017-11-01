<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Config;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Psr\Log\LoggerInterface;

use Pablo\DeliveryZones\Helper\Data;
use Pablo\DeliveryZones\Helper\Functions;


class Carrier extends AbstractCarrier implements CarrierInterface
{
    const CODE = 'zxshipping';

    protected $_code = self::CODE;
    protected $_request;
    protected $_result;
    protected $_baseCurrencyRate;
    protected $_xmlAccessRequest;
    protected $_localeFormat;
    protected $_logger;
    protected $configHelper;
    protected $_errors = [];
    protected $_isFixed = true;
    protected $_customerSession;
    protected $_customerRepository;
    protected $_functions;

    protected $_zxData;
    /**
     * @var ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var MethodFactory
     */
    protected $_rateMethodFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,

        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        Functions $functions,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository,

        Data $zxData,

        Config $configHelper,
        array $data = []
    ) {
        $this->_functions = $functions;
        $this->_customerSession = $customerSession;
        $this->_customerRepository = $customerRepository;
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->_zxData = $zxData;
        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $data
        );
    }


    public function getAllowedMethods()
    {

       return [$this->getCarrierCode() => __($this->getConfigData('name'))];
    }

    public function collectRates(RateRequest $request)
    {

        /**
         * Make sure that Shipping method is enabled
         */
        // todo: check if shipping is enable
        if (!$this->isActive()) {
           return false;
        }

        $result = $this->_rateResultFactory->create();
        // Get Address ID
        $addressData = json_decode(file_get_contents('php://input'), true);

        if(is_null($addressData)){

            // get default shipping address ID
            $addressData['addressId'] = $this->_customerRepository->getById($this->_customerSession->getCustomer()->getId())->getDefaultShipping();
        }
        // get customer data
        if(array_key_exists('addressId',$addressData )) {

            $customerZoneData = $this->_functions->getZonesSectionFromAddressId($addressData['addressId']);
            $this->_logger->debug('rates->get for addressID');

        } elseif(array_key_exists('addressInformation',$addressData)) {

            // check if customer id
            if(!array_key_exists('customerAddressId',$addressData['addressInformation']['shipping_address'])){
             //***   $this->_logger->debug('exit');

                return;
            }
            // select
            $customerZoneData = $this->_functions->getZonesSectionFromAddressId($addressData['addressInformation']['shipping_address']['customerAddressId']);
             $this->_customerSession->unsZXcustomerZoneData ();
            $this->_customerSession->setZXcustomerZoneData ($customerZoneData);


        } else {
            // place
             $customerZoneData = $this->_customerSession->getZXcustomerZoneData();

        }

        if(!empty($customerZoneData)){

            /*store shipping session*/
            $rateResultMethod = $this->_rateMethodFactory->create();
            $rateResultMethod->setData('carrier',$this->_code);
            $rateResultMethod->setData('carrier_title',  $this->getConfigData('title'));
            /* Use method name */
            $rateResultMethod->setData('method', $this->_code);
            $rateResultMethod->setData('method_title', __('Estimated Delivery Day: ').($this->_zxData->getSectionNextDeliveryDay($customerZoneData['section']['section_delivery_days'],$customerZoneData['section']['section_delivery_time'])));
            $rateResultMethod->setData('cost', floatval($customerZoneData['section']['section_dly_cost']));
            $rateResultMethod->setPrice(floatval($customerZoneData['section']['section_dly_cost']));
            $result->append($rateResultMethod);
            return $result;

      }
    }


}