<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 15/07/2017
 * Time: 10:41
 */

namespace Pablo\DeliveryZones\Model\Config;

use Magento\Config\Model\Config\ScopeDefiner;

class Structure extends \Magento\Config\Model\Config\Structure
{

    /**
     * Structure constructor.
     * @param Structure\Data $structureData
     * @param \Magento\Config\Model\Config\Structure\Element\Iterator\Tab $tabIterator
     * @param \Magento\Config\Model\Config\Structure\Element\FlyweightFactory $flyweightFactory
     * @param ScopeDefiner $scopeDefiner
     */
    public function __construct(
        \Pablo\DeliveryZones\Model\Config\Structure\Data $structureData,
        \Magento\Config\Model\Config\Structure\Element\Iterator\Tab $tabIterator,
        \Magento\Config\Model\Config\Structure\Element\FlyweightFactory $flyweightFactory, ScopeDefiner $scopeDefiner)
    {
        parent::__construct($structureData, $tabIterator, $flyweightFactory, $scopeDefiner);
    }
}