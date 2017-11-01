<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface ZonesInterface
{

    const ZONE_NAME = 'zone_name';
    const ZONE_SERVER_COORDS_LAT = 'zone_server_coords_lat';
    const ZONE_CODE = 'zone_code';
    const ZONE_SERVER_CODE = 'zone_server_code';
    const ZONE_BOUNDARY = 'zone_boundary';
    const ZONE_SERVER_COORDS_LONG = 'zone_server_coords_long';
    const WEBSITE_ID = 'website_id';
    const ZONE_ATTR = 'zone_attr';
    const ZONE_TIMESTAMP = 'zone_timestamp';
    const ZONE_ENABLE = 'zone_enable';
    const ZONES_ID = 'zones_id';
    const ZONE_SERVER_NAME = 'zone_server_name';
    const ZONE_PRE_BOUNDARY = 'zone_pre_boundary';
    const STORE_ID = 'store_id';


    /**
     * Get zones_id
     * @return string|null
     */
    
    public function getZonesId();

    /**
     * Set zones_id
     * @param string $zones_id
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZonesId($zonesId);

    /**
     * Get store_id
     * @return string|null
     */
    
    public function getStoreId();

    /**
     * Set store_id
     * @param string $store_id
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneCode($zone_code);

    /**
     * Get zone_server_code
     * @return string|null
     */
    
    public function getZoneServerCode();

    /**
     * Set zone_server_code
     * @param string $zone_server_code
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneServerCode($zone_server_code);

    /**
     * Get zone_server_name
     * @return string|null
     */
    
    public function getZoneServerName();

    /**
     * Set zone_server_name
     * @param string $zone_server_name
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneServerName($zone_server_name);

    /**
     * Get zone_server_coords_lat
     * @return string|null
     */
    
    public function getZoneServerCoordsLat();

    /**
     * Set zone_server_coords_lat
     * @param string $zone_server_coords_lat
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneServerCoordsLat($zone_server_coords_lat);

    /**
     * Get zone_server_coords_long
     * @return string|null
     */
    
    public function getZoneServerCoordsLong();

    /**
     * Set zone_server_coords_long
     * @param string $zone_server_coords_long
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneServerCoordsLong($zone_server_coords_long);

    /**
     * Get zone_boundary
     * @return string|null
     */
    
    public function getZoneBoundary();

    /**
     * Set zone_boundary
     * @param string $zone_boundary
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneBoundary($zone_boundary);

    /**
     * Get zone_pre_boundary
     * @return string|null
     */
    
    public function getZonePreBoundary();

    /**
     * Set zone_pre_boundary
     * @param string $zone_pre_boundary
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZonePreBoundary($zone_pre_boundary);

    /**
     * Get zone_attr
     * @return string|null
     */
    
    public function getZoneAttr();

    /**
     * Set zone_attr
     * @param string $zone_attr
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneAttr($zone_attr);

    /**
     * Get zone_enable
     * @return string|null
     */
    
    public function getZoneEnable();

    /**
     * Set zone_enable
     * @param string $zone_enable
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneEnable($zone_enable);

    /**
     * Get zone_timestamp
     * @return string|null
     */
    
    public function getZoneTimestamp();

    /**
     * Set zone_timestamp
     * @param string $zone_timestamp
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneTimestamp($zone_timestamp);

    /**
     * Get zone_name
     * @return string|null
     */
    
    public function getZoneName();

    /**
     * Set zone_name
     * @param string $zone_name
     * @return \Pablo\DeliveryZones\Api\Data\ZonesInterface
     */
    
    public function setZoneName($zone_name);
}
