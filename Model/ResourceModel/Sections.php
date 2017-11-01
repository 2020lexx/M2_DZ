<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\ResourceModel;

class Sections extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pablo_sections', 'sections_id');
    }
}
