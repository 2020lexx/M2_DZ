<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Magento\Framework\DataObject;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface;


/**
 * Class AlertSend
 * @package Pablo\DeliveryZones\Model
 */
class AlertSend {

    /**
     *
     */
    const CONFIG_ALERT_EMAIL_SENDER = 'Pablo_deliveryzones/alerts/email_sender_email';
    /**
     *
     */
    const CONFIG_ALERT_EMAIL_NAME = 'Pablo_deliveryzones/alerts/email_sender_name';
    /**
     *
     */
    const CONFIG_ALERT_ENABLE = 'Pablo_deliveryzones/alerts/alert_enable';
    /**
     *
     */
    const CONFIG_ALERT_EMAIL_SENDTO = 'Pablo_deliveryzones/alerts/email_send_to';

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var
     */
    protected $_logger;

    protected $_transportBuilder;
    /**
     * AlertSend constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param LoggerInterface $logger
     * @param TransportBuilder $transportBuilder
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger,
        TransportBuilder $transportBuilder
    ){
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        $this->_logger = $logger;
    }

    /**
     * @param $subject
     * @param $brief
     * @param $main
     */
    public function alertSend($subject,$filename,$brief, $main) {

        $this->_logger->debug('Pablo_ DeliveryZones Alert - Subject: '.$subject.' Filename:'.$filename.' Brief Mess:'.$brief.'Main Mes: '.$main);

        if($this->_scopeConfig->getValue(self::CONFIG_ALERT_ENABLE)){

            $postObject = new DataObject();
            $postObject->setData(['brief' => $brief, 'subject' => $subject,'main' => $main,'filename'=>$filename]);

            $transport = $this->_transportBuilder
                ->setTemplateIdentifier('email_alert_template')
                ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_ADMINHTML, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
                ->setTemplateVars(['data' => $postObject])
                ->setFrom(['name' => $this->_scopeConfig->getValue(self::CONFIG_ALERT_EMAIL_NAME),'email' => $this->_scopeConfig->getValue(self::CONFIG_ALERT_EMAIL_SENDER)])
                ->addTo(json_decode($this->_scopeConfig->getValue(self::CONFIG_ALERT_EMAIL_SENDTO)))
                ->getTransport();
            $transport->sendMessage();
        }

    }
}