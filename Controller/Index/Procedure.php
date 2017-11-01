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
use Magento\Framework\App\Request\Http;

use Pablo\DeliveryZones\Helper\Data;


Class Procedure extends Action
{

    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $request;
    protected $jsonResultFactory;
    protected $resultPageFactory;

    /**
     * Status constructor.
     * @param Context $context
     * @param JsonFactory $jsonResultFactory
     */
    public function __construct(
        Data $helper,

        Context $context,
        Http $request,
        JsonFactory $jsonResultFactory
    ) {
        $this->helper = $helper;

        parent::__construct($context);
        $this->request = $request;
        $this->jsonResultFactory = $jsonResultFactory;
     }


    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute(){


        // get $_Post data
        $postData = $this->request->getPostValue();

        if(empty($postData)) {

            return;
        }

        // Remove session_id element
        unset($postData['session_id']);

        // verify data source and format to procedure
        if(array_key_exists('form_key',$postData)){

            $addressEditData = $postData;

            $postData = [
                        'address' => $addressEditData['street'][0],
                        'address_number' => '',
                        'pobox' => $addressEditData['postcode'],
                        'city' => $addressEditData['city'],
                        'state' => $addressEditData['region'],
                        'country' => $addressEditData['country_id']
                        ];
        }

        // Call main procedure
// todo: verify php warings on response
// this is used to avoid PHP warnings on response
       echo 'L@@'.$this->helper->mainProcedure($postData).'@@H';
    }
}



