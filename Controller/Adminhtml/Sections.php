<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Controller\Adminhtml;

abstract class Sections extends \Magento\Backend\App\Action
{

    protected $_coreRegistry;
    const ADMIN_RESOURCE = 'Pablo_DeliveryZones::top_level';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Pablo'), __('Pablo'))
            ->addBreadcrumb(__('Sections'), __('Sections'));
        return $resultPage;
    }
}
