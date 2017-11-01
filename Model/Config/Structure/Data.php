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
 * Time: 10:46
 */
namespace Pablo\DeliveryZones\Model\Config\Structure;

//use Magento\Config\Model\Config\Structure\Reader;

class Data extends \Magento\Config\Model\Config\Structure\Data
{
    /**
     * Data constructor.
     * @param Reader $reader
     * @param \Magento\Framework\Config\ScopeInterface $configScope
     * @param \Magento\Framework\Config\CacheInterface $cache
     * @param string $cacheId
     */
    public function __construct(
        Reader $reader,
        \Magento\Framework\Config\ScopeInterface $configScope,
        \Magento\Framework\Config\CacheInterface $cache,
        $cacheId)
    {
        parent::__construct($reader, $configScope, $cache, $cacheId);
    }
}