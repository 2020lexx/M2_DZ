<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Adminhtml\Index\Configuration;

class Tabs extends \Magento\Backend\Block\Widget\Tabs {

    /**
     *  Internal Constructor, that is called from real constructor
     * @return  void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('config_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Configuration'));
    }

    /**
     *  Prepare Layout Content
     *
     * @return $this
     * @SuppressWarnings (PHPCMD.CyclomaticComplexity)
     */
    protected function _prepareLayout()
    {
        $this->addTab(
            'behavior', [
                'label' => __('Configuration'),
            ]
        );
    }
}
