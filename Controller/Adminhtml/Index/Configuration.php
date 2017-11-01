<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 15/07/2017
 * Time: 09:55
 */
namespace  Pablo\DeliveryZones\Controller\Adminhtml\Index;


class Configuration extends \Magento\Backend\App\Action
{


    protected $resultPageFactory;

    /**
     * Configuration constructor.
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }


    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->getRequest()->setParam('section','Pablo_deliveryzones');
        $resultPage->setActiveMenu('Pablo_DeliveryZones::Configuration');
        $resultPage->addBreadcrumb(__('Main Configuration'),__('Main Configuration'));
        $resultPage->getConfig()->getTitle()->prepend(__('Main Configuration'));
        return $resultPage;

    }
}

