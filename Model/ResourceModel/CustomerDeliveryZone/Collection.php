<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Pablo\DeliveryZones\Model\CustomerDeliveryZone',
            'Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone'
        );
    }
}
