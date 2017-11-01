<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template\Context;

use Pablo\DeliveryZones\Helper\Data;

/**
 * Class ModuleVersion
 * @package Pablo\DeliveryZones\Block\System\Config\Form\Field
 */
class ModuleVersion extends Field
{
    /**
     *
     */
    const M2_URL = 'http://www.0xsystems.it/Pablo_developments/M2';
    /**
     *
     */
    const Module_URL = 'delivery-zones';

    /**
     * @var
     */
    protected $_zxData;


    /**
     * ModuleVersion constructor.
     * @param Context $context
     * @param Data $zxData
     */
    public function __construct(
        Context $context,
        Data $zxData
    ) {
        $this->_zxData = $zxData;
        parent::__construct($context);
    }


    /**
     * @param AbstractElement $element
     * @return mixed
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $extensionVersion   = $this->_zxData->getModuleVersion();
        $extensionTitle     = 'Delivery Zones';
        $versionLabel       = sprintf(
            '<a href="%s" title="%s" target="_blank">%s</a>',
            self::M2_URL.'/'.self::Module_URL,
            $extensionTitle,
            $extensionVersion
        );
        $element->setValue($versionLabel);

        return $element->getValue();
    }
}