<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface ConfigSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get config list.
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface[]
     */
    
    public function getItems();

    /**
     * Set store_id list.
     * @param \Pablo\DeliveryZones\Api\Data\ConfigInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
