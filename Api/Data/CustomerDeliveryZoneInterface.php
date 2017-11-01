<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Api\Data;

interface CustomerDeliveryZoneInterface
{

    const ADDRESS_ID = 'address_id';
    const DELIVERY_SECTION_ID = 'delivery_section_id';
    const CUSTOMERDELIVERYZONE_ID = 'customerdeliveryzone_id';
    const CUSTOMER_EMAIL = 'customer_email';
    const DELIVERY_ZONE_ID = 'delivery_zone_id';
    const WEBSITE_ID = 'website_id';
    const ENABLE = 'enable';
    const ADDRESS_LONG = 'address_long';
    const EXTRA_DATA = 'extra_data';
    const CUSTOMER_ID = 'customer_id';
    const ADDRESS_LAT = 'address_lat';
    const TIMESTAMP = 'timestamp';
    const STORE_ID = 'store_id';
    const DISTANCE_TO_DELIVERY_SERVER = 'distance_to_delivery_server';


    /**
     * Get customerdeliveryzone_id
     * @return string|null
     */
    
    public function getCustomerdeliveryzoneId();

    /**
     * Set customerdeliveryzone_id
     * @param string $customerdeliveryzone_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setCustomerdeliveryzoneId($customerdeliveryzoneId);

    /**
     * Get store_id
     * @return string|null
     */
    
    public function getStoreId();

    /**
     * Set store_id
     * @param string $store_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
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
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setWebsiteId($website_id);

    /**
     * Get customer_id
     * @return string|null
     */
    
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customer_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setCustomerId($customer_id);

    /**
     * Get customer_email
     * @return string|null
     */
    
    public function getCustomerEmail();

    /**
     * Set customer_email
     * @param string $customer_email
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setCustomerEmail($customer_email);

    /**
     * Get address_id
     * @return string|null
     */
    
    public function getAddressId();

    /**
     * Set address_id
     * @param string $address_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setAddressId($address_id);

    /**
     * Get address_long
     * @return string|null
     */
    
    public function getAddressLong();

    /**
     * Set address_long
     * @param string $address_long
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setAddressLong($address_long);

    /**
     * Get address_lat
     * @return string|null
     */
    
    public function getAddressLat();

    /**
     * Set address_lat
     * @param string $address_lat
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setAddressLat($address_lat);

    /**
     * Get delivery_zone_id
     * @return string|null
     */
    
    public function getDeliveryZoneId();

    /**
     * Set delivery_zone_id
     * @param string $delivery_zone_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setDeliveryZoneId($delivery_zone_id);

    /**
     * Get delivery_section_id
     * @return string|null
     */
    
    public function getDeliverySectionId();

    /**
     * Set delivery_section_id
     * @param string $delivery_section_id
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setDeliverySectionId($delivery_section_id);

    /**
     * Get distance_to_delivery_server
     * @return string|null
     */
    
    public function getDistanceToDeliveryServer();

    /**
     * Set distance_to_delivery_server
     * @param string $distance_to_delivery_server
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setDistanceToDeliveryServer($distance_to_delivery_server);

    /**
     * Get extra_data
     * @return string|null
     */
    
    public function getExtraData();

    /**
     * Set extra_data
     * @param string $extra_data
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setExtraData($extra_data);

    /**
     * Get enable
     * @return string|null
     */
    
    public function getEnable();

    /**
     * Set enable
     * @param string $enable
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setEnable($enable);

    /**
     * Get timestamp
     * @return string|null
     */
    
    public function getTimestamp();

    /**
     * Set timestamp
     * @param string $timestamp
     * @return \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface
     */
    
    public function setTimestamp($timestamp);
}
