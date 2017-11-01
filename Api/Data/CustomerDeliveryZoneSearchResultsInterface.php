<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface CustomerDeliveryZoneSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get CustomerDeliveryZone list.
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface[]
     */
    
    public function getItems();

    /**
     * Set store_id list.
     * @param \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
