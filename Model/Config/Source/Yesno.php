<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\Config\Source;


use Magento\Framework\Option\ArrayInterface;

class Yesno implements ArrayInterface
{


    /**
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => 1, 'label' => __('Yes')],
            ['value' => 0, 'label' => __('No')]
        ];


    }


}

