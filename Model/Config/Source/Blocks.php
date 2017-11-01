<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Cms\Model\BlockFactory;

class Blocks implements ArrayInterface
{

    private $_blockFactory;

    public function __construct(

        BlockFactory $blockFactory

    ) {

        $this->_blockFactory= $blockFactory;

    }
    /**
     * @return array
     */
    public function toOptionArray()
    {

        // get block Data
        $block = $this->_blockFactory->create()->getCollection();

        $response[] = ['value' => '','label' => ''];

        foreach ($block as $blockRow) {

            $response[] = ['value' => $blockRow['block_id'],'label' => $blockRow['title']];

        }

        return $response;


    }


}