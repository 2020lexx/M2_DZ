<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerDeliveryZoneRepositoryInterface
{


    /**
     * Save CustomerDeliveryZone
     * @param \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface $customerDeliveryZone
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface $customerDeliveryZone
    );

    /**
     * Retrieve CustomerDeliveryZone
     * @param string $customerdeliveryzoneId
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($customerdeliveryzoneId);

    /**
     * Retrieve CustomerDeliveryZone matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CustomerDeliveryZone
     * @param \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface $customerDeliveryZone
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface $customerDeliveryZone
    );

    /**
     * Delete CustomerDeliveryZone by ID
     * @param string $customerdeliveryzoneId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($customerdeliveryzoneId);
}
