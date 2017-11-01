<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Adminhtml\Index\Configuration\Tabs;

class Form extends \Magento\Config\Block\System\Config\Form
{
    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Config\Model\Config\Factory $configFactory
     * @param \Pablo\DeliveryZones\Model\Config\Structure $configStructure
     * @param \Magento\Config\Block\System\Config\Form\Fieldset\Factory $fieldsetFactory
     * @param \Magento\Config\Block\System\Config\Form\Field\Factory $fieldFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Config\Model\Config\Factory $configFactory,
        \Pablo\DeliveryZones\Model\Config\Structure $configStructure,
        \Magento\Config\Block\System\Config\Form\Fieldset\Factory $fieldsetFactory,
        \Magento\Config\Block\System\Config\Form\Field\Factory $fieldFactory,
        array $data = [])
    {
        parent::__construct($context, $registry, $formFactory, $configFactory, $configStructure, $fieldsetFactory, $fieldFactory, $data);
    }
}