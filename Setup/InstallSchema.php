<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_Pablo_config = $setup->getConnection()->newTable($setup->getTable('Pablo_config'));

        
        $table_Pablo_config->addColumn(
            'config_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_Pablo_config->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'store_id'
        );
        

        
        $table_Pablo_config->addColumn(
            'website_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'website_id'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_center_lat',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_center_lat'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_center_long',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_center_long'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_zoom',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_zoom'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_customer_zoom',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_customer_zoom'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_height',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_height'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_services_keys',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_services_keys'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_attr',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_attr'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_extra',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'map_extra'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_enable',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'map_enable'
        );
        

        
        $table_Pablo_config->addColumn(
            'map_timestamp',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'map_timestamp'
        );
        

        $setup->getConnection()->createTable($table_Pablo_config);


        $table_Pablo_zones = $setup->getConnection()->newTable($setup->getTable('Pablo_zones'));


        $table_Pablo_zones->addColumn(
            'zones_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );



        $table_Pablo_zones->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'store_id'
        );



        $table_Pablo_zones->addColumn(
            'website_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'website_id'
        );



        $table_Pablo_zones->addColumn(
            'zone_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_code'
        );



        $table_Pablo_zones->addColumn(
            'zone_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_name'
        );

        $table_Pablo_zones->addColumn(
            'zone_server_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_server_code'
        );



        $table_Pablo_zones->addColumn(
            'zone_server_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_server_name'
        );



        $table_Pablo_zones->addColumn(
            'zone_server_coords_lat',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_server_coords_lat'
        );



        $table_Pablo_zones->addColumn(
            'zone_server_coords_long',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_server_coords_long'
        );



        $table_Pablo_zones->addColumn(
            'zone_boundary',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_boundary'
        );



        $table_Pablo_zones->addColumn(
            'zone_pre_boundary',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_pre_boundary'
        );



        $table_Pablo_zones->addColumn(
            'zone_attr',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_attr'
        );



        $table_Pablo_zones->addColumn(
            'zone_enable',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'zone_enable'
        );



        $table_Pablo_zones->addColumn(
            'zone_timestamp',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'zone_timestamp'
        );


        $setup->getConnection()->createTable($table_Pablo_zones);

        $table_Pablo_sections = $setup->getConnection()->newTable($setup->getTable('Pablo_sections'));


        $table_Pablo_sections->addColumn(
            'sections_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );



        $table_Pablo_sections->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'store_id'
        );



        $table_Pablo_sections->addColumn(
            'website_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'website_id'
        );



        $table_Pablo_sections->addColumn(
            'zone_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'zone_code'
        );



        $table_Pablo_sections->addColumn(
            'section_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_code'
        );



        $table_Pablo_sections->addColumn(
            'section_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_name'
        );



        $table_Pablo_sections->addColumn(
            'section_min_dist_to_server',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_min_dist_to_server'
        );



        $table_Pablo_sections->addColumn(
            'section_max_dist_to_server',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_max_dist_to_server'
        );



        $table_Pablo_sections->addColumn(
            'section_delivery_days',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_delivery_days'
        );



        $table_Pablo_sections->addColumn(
            'section_delivery_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_delivery_time'
        );



        $table_Pablo_sections->addColumn(
            'section_enable',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'section_enable'
        );



        $table_Pablo_sections->addColumn(
            'section_attr',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_attr'
        );



        $table_Pablo_sections->addColumn(
            'section_dly_cost',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'section_dly_cost'
        );



        $table_Pablo_sections->addColumn(
            'section_timestamp',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'section_timestamp'
        );


        $setup->getConnection()->createTable($table_Pablo_sections);


        $table_Pablo_customerdeliveryzone = $setup->getConnection()->newTable($setup->getTable('Pablo_customerdeliveryzone'));


        $table_Pablo_customerdeliveryzone->addColumn(
            'customerdeliveryzone_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'store_id'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'website_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'website_id'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'customer_id'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'customer_email'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'address_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'address_id'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'address_long',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'address_long'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'address_lat',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'address_lat'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'delivery_zone_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'delivery_zone_id'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'delivery_section_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'delivery_section_id'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'distance_to_delivery_server',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'distance_to_delivery_server'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'extra_data',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'extra_data'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'enable',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'enable'
        );



        $table_Pablo_customerdeliveryzone->addColumn(
            'timestamp',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'timestamp'
        );



        $setup->getConnection()->createTable($table_Pablo_customerdeliveryzone);

        $setup->endSetup();
    }
}
