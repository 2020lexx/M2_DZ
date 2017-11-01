<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */



namespace Pablo\DeliveryZones\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

use Pablo\DeliveryZones\Helper\Data;

/**
 * Class CustomerAccount
 * @package Pablo\DeliveryZones\Controller\Index
 */
Class CustomerAccount extends Action
{

    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $request;
    /**
     * @var
     */
    protected $jsonResultFactory;
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $_zxData;

    /**
     * Status constructor.
     * @param Context $context
     * @param JsonFactory $jsonResultFactory
     */

    public function __construct(
        Data $zxData,

        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->_zxData = $zxData;

        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $this->_zxData->redirectIfUserIsNotLogged();

        return $this->resultPageFactory->create();
    }

}



