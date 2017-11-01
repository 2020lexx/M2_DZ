<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ZonesRepositoryInterface
{


    /**
     * Save zones
     * @param \Pablo\DeliveryZones\Api\Data\ZonesInterface $zones
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Pablo\DeliveryZones\Api\Data\ZonesInterface $zones
    );

    /**
     * Retrieve zones
     * @param string $zonesId
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($zonesId);

    /**
     * Retrieve zones matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Pablo\DeliveryZones\Api\Data\ZonesSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete zones
     * @param \Pablo\DeliveryZones\Api\Data\ZonesInterface $zones
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Pablo\DeliveryZones\Api\Data\ZonesInterface $zones
    );

    /**
     * Delete zones by ID
     * @param string $zonesId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($zonesId);
}
