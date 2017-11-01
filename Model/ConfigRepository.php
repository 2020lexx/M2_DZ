<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Magento\Framework\Api\DataObjectHelper;
use Pablo\DeliveryZones\Model\ResourceModel\Config\CollectionFactory as ConfigCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Pablo\DeliveryZones\Model\ResourceModel\Config as ResourceConfig;
use Magento\Framework\Reflection\DataObjectProcessor;
use Pablo\DeliveryZones\Api\ConfigRepositoryInterface;
use Pablo\DeliveryZones\Api\Data\ConfigSearchResultsInterfaceFactory;
use Pablo\DeliveryZones\Api\Data\ConfigInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SortOrder;

class ConfigRepository implements configRepositoryInterface
{

    protected $searchResultsFactory;

    protected $dataConfigFactory;

    protected $resource;

    protected $configCollectionFactory;

    protected $dataObjectProcessor;

    private $storeManager;

    protected $dataObjectHelper;

    protected $configFactory;


    /**
     * @param ResourceConfig $resource
     * @param ConfigFactory $configFactory
     * @param ConfigInterfaceFactory $dataConfigFactory
     * @param ConfigCollectionFactory $configCollectionFactory
     * @param ConfigSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceConfig $resource,
        ConfigFactory $configFactory,
        ConfigInterfaceFactory $dataConfigFactory,
        ConfigCollectionFactory $configCollectionFactory,
        ConfigSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->configFactory = $configFactory;
        $this->configCollectionFactory = $configCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataConfigFactory = $dataConfigFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Pablo\DeliveryZones\Api\Data\ConfigInterface $config
    ) {
        /* if (empty($config->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $config->setStoreId($storeId);
        } */
        try {
            $config->getResource()->save($config);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the config: %1',
                $exception->getMessage()
            ));
        }
        return $config;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($configId)
    {
        $config = $this->configFactory->create();
        $config->getResource()->load($config, $configId);
        if (!$config->getId()) {
            throw new NoSuchEntityException(__('config with id "%1" does not exist.', $configId));
        }
        return $config;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->configCollectionFactory->create();
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
        \Pablo\DeliveryZones\Api\Data\ConfigInterface $config
    ) {
        try {
            $config->getResource()->delete($config);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the config: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($configId)
    {
        return $this->delete($this->getById($configId));
    }
}
