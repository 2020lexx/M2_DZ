<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

/**
 * Interface ConfigInterface
 * @package Pablo\DeliveryZones\Api\Data
 */
interface ConfigInterface
{

    const MAP_CUSTOMER_ZOOM = 'map_customer_zoom';
    const MAP_TIMESTAMP = 'map_timestamp';
    const MAP_HEIGHT = 'map_height';
    const MAP_ZOOM = 'map_zoom';
    const MAP_EXTRA = 'map_extra';
    const MAP_ATTR = 'map_attr';
    const WEBSITE_ID = 'website_id';
    const MAP_ENABLE = 'map_enable';
    const MAP_CENTER_LONG = 'map_center_long';
    const CONFIG_ID = 'config_id';
    const MAP_CENTER_LAT = 'map_center_lat';
    const STORE_ID = 'store_id';
    const MAP_SERVICES_KEYS = 'map_services_keys';


    /**
     * Get config_id
     * @return string|null
     */
    
    public function getConfigId();

    /**
     * Set config_id
     * @param string $config_id
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setConfigId($configId);

    /**
     * Get store_id
     * @return string|null
     */
    
    public function getStoreId();

    /**
     * Set store_id
     * @param string $store_id
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setWebsiteId($website_id);

    /**
     * Get map_center_lat
     * @return string|null
     */
    
    public function getMapCenterLat();

    /**
     * Set map_center_lat
     * @param string $map_center_lat
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapCenterLat($map_center_lat);

    /**
     * Get map_center_long
     * @return string|null
     */
    
    public function getMapCenterLong();

    /**
     * Set map_center_long
     * @param string $map_center_long
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapCenterLong($map_center_long);

    /**
     * Get map_zoom
     * @return string|null
     */
    
    public function getMapZoom();

    /**
     * Set map_zoom
     * @param string $map_zoom
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapZoom($map_zoom);

    /**
     * Get map_customer_zoom
     * @return string|null
     */
    
    public function getMapCustomerZoom();

    /**
     * Set map_customer_zoom
     * @param string $map_customer_zoom
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapCustomerZoom($map_customer_zoom);

    /**
     * Get map_height
     * @return string|null
     */
    
    public function getMapHeight();

    /**
     * Set map_height
     * @param string $map_height
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapHeight($map_height);

    /**
     * Get map_services_keys
     * @return string|null
     */
    
    public function getMapServicesKeys();

    /**
     * Set map_services_keys
     * @param string $map_services_keys
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapServicesKeys($map_services_keys);

    /**
     * Get map_attr
     * @return string|null
     */
    
    public function getMapAttr();

    /**
     * Set map_attr
     * @param string $map_attr
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapAttr($map_attr);

    /**
     * Get map_extra
     * @return string|null
     */
    
    public function getMapExtra();

    /**
     * Set map_extra
     * @param string $map_extra
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapExtra($map_extra);

    /**
     * Get map_enable
     * @return string|null
     */
    
    public function getMapEnable();

    /**
     * Set map_enable
     * @param string $map_enable
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapEnable($map_enable);

    /**
     * Get map_timestamp
     * @return string|null
     */
    
    public function getMapTimestamp();

    /**
     * Set map_timestamp
     * @param string $map_timestamp
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    
    public function setMapTimestamp($map_timestamp);
}
