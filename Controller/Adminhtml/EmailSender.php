<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Controller\Adminhtml\EmailSender;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;

use Pablo\DeliveryZones\Model\AlertSend;

class Index extends Action{

    protected $_alertSend;

    public function __construct(
        AlertSend $alertSend,

        Context $context
    ) {
        $this->_alertSend = $alertSend;

        parent::__construct($context);
    }

    public function execute() {
        // todo: to set
        $this->_alertSend->alertSend('test email','test email','test email','test email');
        echo 'Email sent!';
    }
}