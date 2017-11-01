<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Pablo\DeliveryZones\Api\Data\ConfigInterface;

class Config extends \Magento\Framework\Model\AbstractModel implements ConfigInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pablo\DeliveryZones\Model\ResourceModel\Config');
    }

    /**
     * Get config_id
     * @return string
     */
    public function getConfigId()
    {
        return $this->getData(self::CONFIG_ID);
    }

    /**
     * Set config_id
     * @param string $configId
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setConfigId($configId)
    {
        return $this->setData(self::CONFIG_ID, $configId);
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
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setWebsiteId($website_id)
    {
        return $this->setData(self::WEBSITE_ID, $website_id);
    }

    /**
     * Get map_center_lat
     * @return string
     */
    public function getMapCenterLat()
    {
        return $this->getData(self::MAP_CENTER_LAT);
    }

    /**
     * Set map_center_lat
     * @param string $map_center_lat
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapCenterLat($map_center_lat)
    {
        return $this->setData(self::MAP_CENTER_LAT, $map_center_lat);
    }

    /**
     * Get map_center_long
     * @return string
     */
    public function getMapCenterLong()
    {
        return $this->getData(self::MAP_CENTER_LONG);
    }

    /**
     * Set map_center_long
     * @param string $map_center_long
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapCenterLong($map_center_long)
    {
        return $this->setData(self::MAP_CENTER_LONG, $map_center_long);
    }

    /**
     * Get map_zoom
     * @return string
     */
    public function getMapZoom()
    {
        return $this->getData(self::MAP_ZOOM);
    }

    /**
     * Set map_zoom
     * @param string $map_zoom
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapZoom($map_zoom)
    {
        return $this->setData(self::MAP_ZOOM, $map_zoom);
    }

    /**
     * Get map_customer_zoom
     * @return string
     */
    public function getMapCustomerZoom()
    {
        return $this->getData(self::MAP_CUSTOMER_ZOOM);
    }

    /**
     * Set map_customer_zoom
     * @param string $map_customer_zoom
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapCustomerZoom($map_customer_zoom)
    {
        return $this->setData(self::MAP_CUSTOMER_ZOOM, $map_customer_zoom);
    }

    /**
     * Get map_height
     * @return string
     */
    public function getMapHeight()
    {
        return $this->getData(self::MAP_HEIGHT);
    }

    /**
     * Set map_height
     * @param string $map_height
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapHeight($map_height)
    {
        return $this->setData(self::MAP_HEIGHT, $map_height);
    }

    /**
     * Get map_services_keys
     * @return string
     */
    public function getMapServicesKeys()
    {
        return $this->getData(self::MAP_SERVICES_KEYS);
    }

    /**
     * Set map_services_keys
     * @param string $map_services_keys
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapServicesKeys($map_services_keys)
    {
        return $this->setData(self::MAP_SERVICES_KEYS, $map_services_keys);
    }

    /**
     * Get map_attr
     * @return string
     */
    public function getMapAttr()
    {
        return $this->getData(self::MAP_ATTR);
    }

    /**
     * Set map_attr
     * @param string $map_attr
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapAttr($map_attr)
    {
        return $this->setData(self::MAP_ATTR, $map_attr);
    }

    /**
     * Get map_extra
     * @return string
     */
    public function getMapExtra()
    {
        return $this->getData(self::MAP_EXTRA);
    }

    /**
     * Set map_extra
     * @param string $map_extra
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapExtra($map_extra)
    {
        return $this->setData(self::MAP_EXTRA, $map_extra);
    }

    /**
     * Get map_enable
     * @return string
     */
    public function getMapEnable()
    {
        return $this->getData(self::MAP_ENABLE);
    }

    /**
     * Set map_enable
     * @param string $map_enable
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapEnable($map_enable)
    {
        return $this->setData(self::MAP_ENABLE, $map_enable);
    }

    /**
     * Get map_timestamp
     * @return string
     */
    public function getMapTimestamp()
    {
        return $this->getData(self::MAP_TIMESTAMP);
    }

    /**
     * Set map_timestamp
     * @param string $map_timestamp
     * @return \Pablo\DeliveryZones\Api\Data\ConfigInterface
     */
    public function setMapTimestamp($map_timestamp)
    {
        return $this->setData(self::MAP_TIMESTAMP, $map_timestamp);
    }
}
