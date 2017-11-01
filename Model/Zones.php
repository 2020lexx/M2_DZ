<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Pablo\DeliveryZones\Api\Data\ZonesInterface;

class Zones extends \Magento\Framework\Model\AbstractModel implements ZonesInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pablo\DeliveryZones\Model\ResourceModel\Zones');
    }

    /**
     * Get zones_id
     * @return string
     */
    public function getZonesId()
    {
        return $this->getData(self::ZONES_ID);
    }

    /**
     * Set zones_id
     * @param string $zonesId
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZonesId($zonesId)
    {
        return $this->setData(self::ZONES_ID, $zonesId);
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
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneCode($zone_code)
    {
        return $this->setData(self::ZONE_CODE, $zone_code);
    }

    /**
     * Get zone_server_code
     * @return string
     */
    public function getZoneServerCode()
    {
        return $this->getData(self::ZONE_SERVER_CODE);
    }

    /**
     * Set zone_server_code
     * @param string $zone_server_code
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneServerCode($zone_server_code)
    {
        return $this->setData(self::ZONE_SERVER_CODE, $zone_server_code);
    }

    /**
     * Get zone_server_name
     * @return string
     */
    public function getZoneServerName()
    {
        return $this->getData(self::ZONE_SERVER_NAME);
    }

    /**
     * Set zone_server_name
     * @param string $zone_server_name
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneServerName($zone_server_name)
    {
        return $this->setData(self::ZONE_SERVER_NAME, $zone_server_name);
    }

    /**
     * Get zone_server_coords_lat
     * @return string
     */
    public function getZoneServerCoordsLat()
    {
        return $this->getData(self::ZONE_SERVER_COORDS_LAT);
    }

    /**
     * Set zone_server_coords_lat
     * @param string $zone_server_coords_lat
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneServerCoordsLat($zone_server_coords_lat)
    {
        return $this->setData(self::ZONE_SERVER_COORDS_LAT, $zone_server_coords_lat);
    }

    /**
     * Get zone_server_coords_long
     * @return string
     */
    public function getZoneServerCoordsLong()
    {
        return $this->getData(self::ZONE_SERVER_COORDS_LONG);
    }

    /**
     * Set zone_server_coords_long
     * @param string $zone_server_coords_long
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneServerCoordsLong($zone_server_coords_long)
    {
        return $this->setData(self::ZONE_SERVER_COORDS_LONG, $zone_server_coords_long);
    }

    /**
     * Get zone_boundary
     * @return string
     */
    public function getZoneBoundary()
    {
        return $this->getData(self::ZONE_BOUNDARY);
    }

    /**
     * Set zone_boundary
     * @param string $zone_boundary
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneBoundary($zone_boundary)
    {
        return $this->setData(self::ZONE_BOUNDARY, $zone_boundary);
    }

    /**
     * Get zone_pre_boundary
     * @return string
     */
    public function getZonePreBoundary()
    {
        return $this->getData(self::ZONE_PRE_BOUNDARY);
    }

    /**
     * Set zone_pre_boundary
     * @param string $zone_pre_boundary
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZonePreBoundary($zone_pre_boundary)
    {
        return $this->setData(self::ZONE_PRE_BOUNDARY, $zone_pre_boundary);
    }

    /**
     * Get zone_attr
     * @return string
     */
    public function getZoneAttr()
    {
        return $this->getData(self::ZONE_ATTR);
    }

    /**
     * Set zone_attr
     * @param string $zone_attr
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneAttr($zone_attr)
    {
        return $this->setData(self::ZONE_ATTR, $zone_attr);
    }

    /**
     * Get zone_enable
     * @return string
     */
    public function getZoneEnable()
    {
        return $this->getData(self::ZONE_ENABLE);
    }

    /**
     * Set zone_enable
     * @param string $zone_enable
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneEnable($zone_enable)
    {
        return $this->setData(self::ZONE_ENABLE, $zone_enable);
    }

    /**
     * Get zone_timestamp
     * @return string
     */
    public function getZoneTimestamp()
    {
        return $this->getData(self::ZONE_TIMESTAMP);
    }

    /**
     * Set zone_timestamp
     * @param string $zone_timestamp
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneTimestamp($zone_timestamp)
    {
        return $this->setData(self::ZONE_TIMESTAMP, $zone_timestamp);
    }

    /**
     * Get zone_name
     * @return string
     */
    public function getZoneName()
    {
        return $this->getData(self::ZONE_NAME);
    }

    /**
     * Set zone_name
     * @param string $zone_name
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    public function setZoneName($zone_name)
    {
        return $this->setData(self::ZONE_NAME, $zone_name);
    }
}
