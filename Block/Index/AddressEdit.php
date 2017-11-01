<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Index;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Pablo\DeliveryZones\Helper\Functions;
use Pablo\DeliveryZones\Helper\Data;

/**
 * Class AddressEdit
 * @package Pablo\DeliveryZones\Block\Index
 */
class AddressEdit extends Template
{

    /**
     * AddressEdit constructor.
     * @param Data $helper
     * @param Functions $functions
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Data $helper,
        Functions $functions,

        Context $context,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->functions = $functions;

        parent::__construct($context, $data);

    }

    /**
     *
     */
    public function getDeliverZonesMapView(){


     }

     
 
}
