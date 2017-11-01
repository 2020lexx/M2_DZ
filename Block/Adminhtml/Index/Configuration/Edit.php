<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Adminhtml\Index\Configuration;

class Edit extends \Magento\Config\Block\System\Config\Edit{

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Pablo\DeliveryZones\Model\Config\Structure $configStructure,
        array $data = [])
    {
        parent::__construct($context, $configStructure, $data);
    }


    /**
     *  Prepare Layout Object
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {

    /*    $this->getToolbar()->addChild(
            'Pablo_save_button',
            'Magento\Backend\Block\Widget\Button',
            [
                'id' => 'save',
                'label' => __('Save Config'),
                'class' => 'save_primary',
                'data_attributes' => [
                    'mage-init' => ['button' => ['event' => 'save','target'=>'#config-edit-form']],
                ]
            ]
        ); */
        $block = $this->getLayout()->createBlock('Pablo\DeliveryZones\Block\Adminhtml\Index\Configuration\Tabs\Form');
        $this->setChild('form',$block);
          return parent::_prepareLayout();
    }

    /**
     * Retrieve config save url
     *
     * @return string
     */
     public function getSaveUrl()
    {
        return $this->getUrl('*/system_config/save', ['_current' => true]);
     //   return $this->getUrl('admin/system_config/save', ['_current' => true]);
    }

}