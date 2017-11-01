<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Magento\Framework\Api\DataObjectHelper;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone as ResourceCustomerDeliveryZone;
use Magento\Store\Model\StoreManagerInterface;
use Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneSearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Pablo\DeliveryZones\Api\CustomerDeliveryZoneRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Pablo\DeliveryZones\Model\ResourceModel\CustomerDeliveryZone\CollectionFactory as CustomerDeliveryZoneCollectionFactory;
use Magento\Framework\Api\SortOrder;

class CustomerDeliveryZoneRepository implements CustomerDeliveryZoneRepositoryInterface
{

    protected $searchResultsFactory;

    protected $resource;

    protected $dataObjectProcessor;

    private $storeManager;

    protected $customerDeliveryZoneFactory;

    protected $dataObjectHelper;

    protected $customerDeliveryZoneCollectionFactory;

    protected $dataCustomerDeliveryZoneFactory;


    /**
     * @param ResourceCustomerDeliveryZone $resource
     * @param CustomerDeliveryZoneFactory $customerDeliveryZoneFactory
     * @param CustomerDeliveryZoneInterfaceFactory $dataCustomerDeliveryZoneFactory
     * @param CustomerDeliveryZoneCollectionFactory $customerDeliveryZoneCollectionFactory
     * @param CustomerDeliveryZoneSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceCustomerDeliveryZone $resource,
        CustomerDeliveryZoneFactory $customerDeliveryZoneFactory,
        CustomerDeliveryZoneInterfaceFactory $dataCustomerDeliveryZoneFactory,
        CustomerDeliveryZoneCollectionFactory $customerDeliveryZoneCollectionFactory,
        CustomerDeliveryZoneSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->customerDeliveryZoneFactory = $customerDeliveryZoneFactory;
        $this->customerDeliveryZoneCollectionFactory = $customerDeliveryZoneCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomerDeliveryZoneFactory = $dataCustomerDeliveryZoneFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface $customerDeliveryZone
    ) {
        /* if (empty($customerDeliveryZone->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customerDeliveryZone->setStoreId($storeId);
        } */
        try {
            $customerDeliveryZone->getResource()->save($customerDeliveryZone);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerDeliveryZone: %1',
                $exception->getMessage()
            ));
        }
        return $customerDeliveryZone;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($customerDeliveryZoneId)
    {
        $customerDeliveryZone = $this->customerDeliveryZoneFactory->create();
        $customerDeliveryZone->getResource()->load($customerDeliveryZone, $customerDeliveryZoneId);
        if (!$customerDeliveryZone->getId()) {
            throw new NoSuchEntityException(__('CustomerDeliveryZone with id "%1" does not exist.', $customerDeliveryZoneId));
        }
        return $customerDeliveryZone;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerDeliveryZoneCollectionFactory->create();
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
        \Pablo\DeliveryZones\Api\Data\CustomerDeliveryZoneInterface $customerDeliveryZone
    ) {
        try {
            $customerDeliveryZone->getResource()->delete($customerDeliveryZone);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomerDeliveryZone: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customerDeliveryZoneId)
    {
        return $this->delete($this->getById($customerDeliveryZoneId));
    }
}
