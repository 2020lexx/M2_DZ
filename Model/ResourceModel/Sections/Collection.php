<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\ResourceModel\Sections;

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
            'Pablo\DeliveryZones\Model\Sections',
            'Pablo\DeliveryZones\Model\ResourceModel\Sections'
        );
    }
}
