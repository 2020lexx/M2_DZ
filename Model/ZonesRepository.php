<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Pablo\DeliveryZones\Api\Data\ZonesSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Pablo\DeliveryZones\Model\ResourceModel\Zones\CollectionFactory as ZonesCollectionFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Pablo\DeliveryZones\Model\ResourceModel\Zones as ResourceZones;
use Pablo\DeliveryZones\Api\Data\ZonesInterfaceFactory;
use Pablo\DeliveryZones\Api\ZonesRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SortOrder;

class ZonesRepository implements zonesRepositoryInterface
{

    protected $searchResultsFactory;

    protected $resource;

    protected $dataObjectProcessor;

    protected $zonesFactory;

    private $storeManager;

    protected $zonesCollectionFactory;

    protected $dataObjectHelper;

    protected $dataZonesFactory;


    /**
     * @param ResourceZones $resource
     * @param ZonesFactory $zonesFactory
     * @param ZonesInterfaceFactory $dataZonesFactory
     * @param ZonesCollectionFactory $zonesCollectionFactory
     * @param ZonesSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceZones $resource,
        ZonesFactory $zonesFactory,
        ZonesInterfaceFactory $dataZonesFactory,
        ZonesCollectionFactory $zonesCollectionFactory,
        ZonesSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->zonesFactory = $zonesFactory;
        $this->zonesCollectionFactory = $zonesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataZonesFactory = $dataZonesFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Pablo\DeliveryZones\Api\Data\ZonesInterface $zones
    ) {
        /* if (empty($zones->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $zones->setStoreId($storeId);
        } */
        try {
            $zones->getResource()->save($zones);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the zones: %1',
                $exception->getMessage()
            ));
        }
        return $zones;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($zonesId)
    {
        $zones = $this->zonesFactory->create();
        $zones->getResource()->load($zones, $zonesId);
        if (!$zones->getId()) {
            throw new NoSuchEntityException(__('zones with id "%1" does not exist.', $zonesId));
        }
        return $zones;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->zonesCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Pablo\DeliveryZones\Api\Data\ZonesInterface $zones
    ) {
        try {
            $zones->getResource()->delete($zones);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the zones: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($zonesId)
    {
        return $this->delete($this->getById($zonesId));
    }
}
