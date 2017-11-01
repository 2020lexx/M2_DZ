<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Index;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Pablo\DeliveryZones\Model\ResourceModel\Zones\CollectionFactory as ZonesCollectionFactory;
use Pablo\DeliveryZones\Helper\Data;

class Index extends Template
{
   /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
     protected $_zonesCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        ZonesCollectionFactory $zonesCollectionFactory,
        Data $helper,

        Context $context,
        array $data = []
    ) {
        $this->_zonesCollectionFactory = $zonesCollectionFactory;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }





    /**
     * @return Post[]
     */
    public function getZones()
    {
        /** @var PostCollection $zonesCollection */
        $zonesCollection = $this->_zonesCollectionFactory->create();
        $zonesCollection->addFieldToSelect('*')->load();
        return $zonesCollection->getItems();
    }

     
 
}
