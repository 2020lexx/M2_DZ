<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Pablo\DeliveryZones\Api\Data\SectionsInterface;

class Sections extends \Magento\Framework\Model\AbstractModel implements SectionsInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pablo\DeliveryZones\Model\ResourceModel\Sections');
    }

    /**
     * Get sections_id
     * @return string
     */
    public function getSectionsId()
    {
        return $this->getData(self::SECTIONS_ID);
    }

    /**
     * Set sections_id
     * @param string $sectionsId
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionsId($sectionsId)
    {
        return $this->setData(self::SECTIONS_ID, $sectionsId);
    }

    /**
     * Get store_id
     * @return string
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Set store_id
     * @param string $store_id
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setStoreId($store_id)
    {
        return $this->setData(self::STORE_ID, $store_id);
    }

    /**
     * Get website_id
     * @return string
     */
    public function getWebsiteId()
    {
        return $this->getData(self::WEBSITE_ID);
    }

    /**
     * Set website_id
     * @param string $website_id
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setWebsiteId($website_id)
    {
        return $this->setData(self::WEBSITE_ID, $website_id);
    }

    /**
     * Get zone_code
     * @return string
     */
    public function getZoneCode()
    {
        return $this->getData(self::ZONE_CODE);
    }

    /**
     * Set zone_code
     * @param string $zone_code
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setZoneCode($zone_code)
    {
        return $this->setData(self::ZONE_CODE, $zone_code);
    }

    /**
     * Get section_code
     * @return string
     */
    public function getSectionCode()
    {
        return $this->getData(self::SECTION_CODE);
    }

    /**
     * Set section_code
     * @param string $section_code
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionCode($section_code)
    {
        return $this->setData(self::SECTION_CODE, $section_code);
    }

    /**
     * Get section_name
     * @return string
     */
    public function getSectionName()
    {
        return $this->getData(self::SECTION_NAME);
    }

    /**
     * Set section_name
     * @param string $section_name
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionName($section_name)
    {
        return $this->setData(self::SECTION_NAME, $section_name);
    }

    /**
     * Get section_min_dist_to_server
     * @return string
     */
    public function getSectionMinDistToServer()
    {
        return $this->getData(self::SECTION_MIN_DIST_TO_SERVER);
    }

    /**
     * Set section_min_dist_to_server
     * @param string $section_min_dist_to_server
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionMinDistToServer($section_min_dist_to_server)
    {
        return $this->setData(self::SECTION_MIN_DIST_TO_SERVER, $section_min_dist_to_server);
    }

    /**
     * Get section_max_dist_to_server
     * @return string
     */
    public function getSectionMaxDistToServer()
    {
        return $this->getData(self::SECTION_MAX_DIST_TO_SERVER);
    }

    /**
     * Set section_max_dist_to_server
     * @param string $section_max_dist_to_server
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionMaxDistToServer($section_max_dist_to_server)
    {
        return $this->setData(self::SECTION_MAX_DIST_TO_SERVER, $section_max_dist_to_server);
    }

    /**
     * Get section_delivery_days
     * @return string
     */
    public function getSectionDeliveryDays()
    {
        return $this->getData(self::SECTION_DELIVERY_DAYS);
    }

    /**
     * Set section_delivery_days
     * @param string $section_delivery_days
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionDeliveryDays($section_delivery_days)
    {
        return $this->setData(self::SECTION_DELIVERY_DAYS, $section_delivery_days);
    }

    /**
     * Get section_delivery_time
     * @return string
     */
    public function getSectionDeliveryTime()
    {
        return $this->getData(self::SECTION_DELIVERY_TIME);
    }

    /**
     * Set section_delivery_time
     * @param string $section_delivery_time
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionDeliveryTime($section_delivery_time)
    {
        return $this->setData(self::SECTION_DELIVERY_TIME, $section_delivery_time);
    }

    /**
     * Get section_enable
     * @return string
     */
    public function getSectionEnable()
    {
        return $this->getData(self::SECTION_ENABLE);
    }

    /**
     * Set section_enable
     * @param string $section_enable
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionEnable($section_enable)
    {
        return $this->setData(self::SECTION_ENABLE, $section_enable);
    }

    /**
     * Get section_attr
     * @return string
     */
    public function getSectionAttr()
    {
        return $this->getData(self::SECTION_ATTR);
    }

    /**
     * Set section_attr
     * @param string $section_attr
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionAttr($section_attr)
    {
        return $this->setData(self::SECTION_ATTR, $section_attr);
    }

    /**
     * Get section_dly_cost
     * @return string
     */
    public function getSectionDlyCost()
    {
        return $this->getData(self::SECTION_DLY_COST);
    }

    /**
     * Set section_dly_cost
     * @param string $section_dly_cost
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionDlyCost($section_dly_cost)
    {
        return $this->setData(self::SECTION_DLY_COST, $section_dly_cost);
    }

    /**
     * Get section_timestamp
     * @return string
     */
    public function getSectionTimestamp()
    {
        return $this->getData(self::SECTION_TIMESTAMP);
    }

    /**
     * Set section_timestamp
     * @param string $section_timestamp
     * @return \Pablo\DeliveryZones\Api\Data\SectionsInterface
     */
    public function setSectionTimestamp($section_timestamp)
    {
        return $this->setData(self::SECTION_TIMESTAMP, $section_timestamp);
    }
}
