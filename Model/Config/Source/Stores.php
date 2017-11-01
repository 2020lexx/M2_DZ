<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\Config\Source;

use Magento\Store\Model\StoreRepository;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Stores implements \Magento\Framework\Option\ArrayInterface
{

    const CONFIG_SINGLE_STORE = 'Pablo_deliveryzones/general/single_store_mode';

    protected $_storeRepository;
    protected $_scopeConfig;

    /**
     * @param StoreRepository      $storeRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_storeRepository = $storeRepository;
        $this->_scopeConfig =  $scopeConfig;

    }

    public function toOptionArray()
    {

        if ($this->_scopeConfig->getValue(self::CONFIG_SINGLE_STORE)) {

            $response[] = ['value' => 999, 'label' => 'Single Store Mode'];

        } else {

            $stores = $this->_storeRepository->getList();

            $response = [];

            foreach ($stores as $store) {

                $response[] = ['value' => $store['store_id'], 'label' => '[ ' . $store['store_id'] . ' ] ' . $store['name']];

            }
        }

        return $response;
    }

}