<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SectionsRepositoryInterface
{


    /**
     * Save sections
     * @param \Pablo\DeliveryZones\Api\Data\SectionsInterface $sections
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Pablo\DeliveryZones\Api\Data\SectionsInterface $sections
    );

    /**
     * Retrieve sections
     * @param string $sectionsId
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($sectionsId);

    /**
     * Retrieve sections matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Pablo\DeliveryZones\Api\Data\SectionsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete sections
     * @param \Pablo\DeliveryZones\Api\Data\SectionsInterface $sections
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Pablo\DeliveryZones\Api\Data\SectionsInterface $sections
    );

    /**
     * Delete sections by ID
     * @param string $sectionsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($sectionsId);
}
