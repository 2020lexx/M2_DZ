<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ConfigRepositoryInterface
{


    /**
     * Save config
     * @param \Pablo\DeliveryZones\Api\Data\ConfigInterface $config
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Pablo\DeliveryZones\Api\Data\ConfigInterface $config
    );

    /**
     * Retrieve config
     * @param string $configId
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($configId);

    /**
     * Retrieve config matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Pablo\DeliveryZones\Api\Data\ConfigSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete config
     * @param \Pablo\DeliveryZones\Api\Data\ConfigInterface $config
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Pablo\DeliveryZones\Api\Data\ConfigInterface $config
    );

    /**
     * Delete config by ID
     * @param string $configId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($configId);
}
