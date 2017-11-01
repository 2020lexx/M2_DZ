<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface SectionsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get sections list.
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface[]
     */
    
    public function getItems();

    /**
     * Set store_id list.
     * @param \Pablo\DeliveryZones\Api\Data\SectionsInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
