<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface ZonesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get zones list.
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface[]
     */
    
    public function getItems();

    /**
     * Set store_id list.
     * @param \Pablo\DeliveryZones\Api\Data\ZonesInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
