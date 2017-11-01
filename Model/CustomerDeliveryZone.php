<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface;

class CustomerDeliveryZone extends \Magento\Framework\Model\AbstractModel implements CustomerDeliveryZoneInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone');
    }

    /**
     * Get customerdeliveryzone_id
     * @return string
     */
    public function getCustomerdeliveryzoneId()
    {
        return $this->getData(self::CUSTOMERDELIVERYZONE_ID);
    }

    /**
     * Set customerdeliveryzone_id
     * @param string $customerdeliveryzoneId
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setCustomerdeliveryzoneId($customerdeliveryzoneId)
    {
        return $this->setData(self::CUSTOMERDELIVERYZONE_ID, $customerdeliveryzoneId);
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
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setWebsiteId($website_id)
    {
        return $this->setData(self::WEBSITE_ID, $website_id);
    }

    /**
     * Get customer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customer_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    /**
     * Get customer_email
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * Set customer_email
     * @param string $customer_email
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setCustomerEmail($customer_email)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customer_email);
    }

    /**
     * Get address_id
     * @return string
     */
    public function getAddressId()
    {
        return $this->getData(self::ADDRESS_ID);
    }

    /**
     * Set address_id
     * @param string $address_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setAddressId($address_id)
    {
        return $this->setData(self::ADDRESS_ID, $address_id);
    }

    /**
     * Get address_long
     * @return string
     */
    public function getAddressLong()
    {
        return $this->getData(self::ADDRESS_LONG);
    }

    /**
     * Set address_long
     * @param string $address_long
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setAddressLong($address_long)
    {
        return $this->setData(self::ADDRESS_LONG, $address_long);
    }

    /**
     * Get address_lat
     * @return string
     */
    public function getAddressLat()
    {
        return $this->getData(self::ADDRESS_LAT);
    }

    /**
     * Set address_lat
     * @param string $address_lat
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setAddressLat($address_lat)
    {
        return $this->setData(self::ADDRESS_LAT, $address_lat);
    }

    /**
     * Get delivery_zone_id
     * @return string
     */
    public function getDeliveryZoneId()
    {
        return $this->getData(self::DELIVERY_ZONE_ID);
    }

    /**
     * Set delivery_zone_id
     * @param string $delivery_zone_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setDeliveryZoneId($delivery_zone_id)
    {
        return $this->setData(self::DELIVERY_ZONE_ID, $delivery_zone_id);
    }

    /**
     * Get delivery_section_id
     * @return string
     */
    public function getDeliverySectionId()
    {
        return $this->getData(self::DELIVERY_SECTION_ID);
    }

    /**
     * Set delivery_section_id
     * @param string $delivery_section_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setDeliverySectionId($delivery_section_id)
    {
        return $this->setData(self::DELIVERY_SECTION_ID, $delivery_section_id);
    }

    /**
     * Get distance_to_delivery_server
     * @return string
     */
    public function getDistanceToDeliveryServer()
    {
        return $this->getData(self::DISTANCE_TO_DELIVERY_SERVER);
    }

    /**
     * Set distance_to_delivery_server
     * @param string $distance_to_delivery_server
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setDistanceToDeliveryServer($distance_to_delivery_server)
    {
        return $this->setData(self::DISTANCE_TO_DELIVERY_SERVER, $distance_to_delivery_server);
    }

    /**
     * Get extra_data
     * @return string
     */
    public function getExtraData()
    {
        return $this->getData(self::EXTRA_DATA);
    }

    /**
     * Set extra_data
     * @param string $extra_data
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setExtraData($extra_data)
    {
        return $this->setData(self::EXTRA_DATA, $extra_data);
    }

    /**
     * Get enable
     * @return string
     */
    public function getEnable()
    {
        return $this->getData(self::ENABLE);
    }

    /**
     * Set enable
     * @param string $enable
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setEnable($enable)
    {
        return $this->setData(self::ENABLE, $enable);
    }

    /**
     * Get timestamp
     * @return string
     */
    public function getTimestamp()
    {
        return $this->getData(self::TIMESTAMP);
    }

    /**
     * Set timestamp
     * @param string $timestamp
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    public function setTimestamp($timestamp)
    {
        return $this->setData(self::TIMESTAMP, $timestamp);
    }
}
