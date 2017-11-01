<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Index;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Pablo\DeliveryZones\Helper\Functions;
use Pablo\DeliveryZones\Helper\Data;

/**
 * Class CustomerAccount
 * @package Pablo\DeliveryZones\Block\Index
 */
class CustomerAccount extends Template
{
     /**
     *
     */
    const CONFIG_ADDRESS_OUT_ZONE = 'Pablo_deliveryzones/customer_address/address_outzone';
    /**
     *
     */
    const CONFIG_ADDRESS_GEOCODING_ERROR = 'Pablo_deliveryzones/customer_address/address_failzone';


    /**
     * @var
     */
    protected $_scopeConfig;
    /**
     * @var BlockRepositoryInterface
     */
    private $_blockRepository;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Data $helper,
        Functions $functions,

        Context $context,
        BlockRepositoryInterface $blockRepository,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->functions = $functions;

        $this->_blockRepository = $blockRepository;
        $this->_scopeConfig =  $context->getScopeConfig();
        parent::__construct($context, $data);

    }


    /**
     * @return mixed
     */
    public function getOutZoneContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_ADDRESS_OUT));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Modal Out Zone Content');
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getFailZoneContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_ADDRESS_GEOCODING_ERROR));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Geocoding Fail Content');
        }

        return $content;
    }


    /**
     *
     */
    public function getDeliverZonesMapView(){


     }

     
 
}
