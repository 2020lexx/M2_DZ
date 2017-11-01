<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Pablo\DeliveryZones\Helper\Data;

class Sections implements ArrayInterface
{

    protected $_zxData;

    public function __construct(

        Data $zxData

      ) {

        $this->_zxData = $zxData;

    }
    /**
        * @return array
        */
        public function toOptionArray()
        {

            // get Zones Data
            $zonesData = $this->_zxData->getZoneDataModel()->getData();

            $response[] = ['value' => 0,'label' => 'All Zones'];

            foreach ($zonesData as $zoneRow) {

                $response[] = ['value' => $zoneRow['zones_id'],'label' => $zoneRow['zone_name']];

            }

            return $response;


        }


}