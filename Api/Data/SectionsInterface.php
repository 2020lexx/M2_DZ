<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface SectionsInterface
{

    const SECTION_NAME = 'section_name';
    const SECTION_ATTR = 'section_attr';
    const ZONE_CODE = 'zone_code';
    const SECTION_ENABLE = 'section_enable';
    const SECTIONS_ID = 'sections_id';
    const SECTION_MIN_DIST_TO_SERVER = 'section_min_dist_to_server';
    const SECTION_DELIVERY_TIME = 'section_delivery_time';
    const WEBSITE_ID = 'website_id';
    const SECTION_DLY_COST = 'section_dly_cost';
    const SECTION_TIMESTAMP = 'section_timestamp';
    const SECTION_DELIVERY_DAYS = 'section_delivery_days';
    const SECTION_CODE = 'section_code';
    const STORE_ID = 'store_id';
    const SECTION_MAX_DIST_TO_SERVER = 'section_max_dist_to_server';


    /**
     * Get sections_id
     * @return string|null
     */
    
    public function getSectionsId();

    /**
     * Set sections_id
     * @param string $sections_id
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionsId($sectionsId);

    /**
     * Get store_id
     * @return string|null
     */
    
    public function getStoreId();

    /**
     * Set store_id
     * @param string $store_id
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setStoreId($store_id);

    /**
     * Get website_id
     * @return string|null
     */
    
    public function getWebsiteId();

    /**
     * Set website_id
     * @param string $website_id
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setWebsiteId($website_id);

    /**
     * Get zone_code
     * @return string|null
     */
    
    public function getZoneCode();

    /**
     * Set zone_code
     * @param string $zone_code
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setZoneCode($zone_code);

    /**
     * Get section_code
     * @return string|null
     */
    
    public function getSectionCode();

    /**
     * Set section_code
     * @param string $section_code
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionCode($section_code);

    /**
     * Get section_name
     * @return string|null
     */
    
    public function getSectionName();

    /**
     * Set section_name
     * @param string $section_name
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionName($section_name);

    /**
     * Get section_min_dist_to_server
     * @return string|null
     */
    
    public function getSectionMinDistToServer();

    /**
     * Set section_min_dist_to_server
     * @param string $section_min_dist_to_server
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionMinDistToServer($section_min_dist_to_server);

    /**
     * Get section_max_dist_to_server
     * @return string|null
     */
    
    public function getSectionMaxDistToServer();

    /**
     * Set section_max_dist_to_server
     * @param string $section_max_dist_to_server
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionMaxDistToServer($section_max_dist_to_server);

    /**
     * Get section_delivery_days
     * @return string|null
     */
    
    public function getSectionDeliveryDays();

    /**
     * Set section_delivery_days
     * @param string $section_delivery_days
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionDeliveryDays($section_delivery_days);

    /**
     * Get section_delivery_time
     * @return string|null
     */
    
    public function getSectionDeliveryTime();

    /**
     * Set section_delivery_time
     * @param string $section_delivery_time
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionDeliveryTime($section_delivery_time);

    /**
     * Get section_enable
     * @return string|null
     */
    
    public function getSectionEnable();

    /**
     * Set section_enable
     * @param string $section_enable
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionEnable($section_enable);

    /**
     * Get section_attr
     * @return string|null
     */
    
    public function getSectionAttr();

    /**
     * Set section_attr
     * @param string $section_attr
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionAttr($section_attr);

    /**
     * Get section_dly_cost
     * @return string|null
     */
    
    public function getSectionDlyCost();

    /**
     * Set section_dly_cost
     * @param string $section_dly_cost
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionDlyCost($section_dly_cost);

    /**
     * Get section_timestamp
     * @return string|null
     */
    
    public function getSectionTimestamp();

    /**
     * Set section_timestamp
     * @param string $section_timestamp
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    
    public function setSectionTimestamp($section_timestamp);
}
