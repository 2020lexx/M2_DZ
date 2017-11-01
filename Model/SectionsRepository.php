<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Model;

use Magento\Framework\Api\DataObjectHelper;
use Pablo\DeliveryZones\Api\Data\SectionsInterfaceFactory;
use Pablo\DeliveryZones\Api\Data\SectionsSearchResultsInterfaceFactory;
use Pablo\DeliveryZones\Model\ResourceModel\Sections\CollectionFactory as SectionsCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Pablo\DeliveryZones\Api\SectionsRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Pablo\DeliveryZones\Model\ResourceModel\Sections as ResourceSections;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SortOrder;

class SectionsRepository implements sectionsRepositoryInterface
{

    protected $searchResultsFactory;

    protected $resource;

    protected $sectionsCollectionFactory;

    protected $dataObjectProcessor;

    private $storeManager;

    protected $dataObjectHelper;

    protected $sectionsFactory;

    protected $dataSectionsFactory;


    /**
     * @param ResourceSections $resource
     * @param SectionsFactory $sectionsFactory
     * @param SectionsInterfaceFactory $dataSectionsFactory
     * @param SectionsCollectionFactory $sectionsCollectionFactory
     * @param SectionsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceSections $resource,
        SectionsFactory $sectionsFactory,
        SectionsInterfaceFactory $dataSectionsFactory,
        SectionsCollectionFactory $sectionsCollectionFactory,
        SectionsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->sectionsFactory = $sectionsFactory;
        $this->sectionsCollectionFactory = $sectionsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSectionsFactory = $dataSectionsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Pablo\DeliveryZones\Api\Data\SectionsInterface $sections
    ) {
        /* if (empty($sections->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $sections->setStoreId($storeId);
        } */
        try {
            $sections->getResource()->save($sections);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sections: %1',
                $exception->getMessage()
            ));
        }
        return $sections;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($sectionsId)
    {
        $sections = $this->sectionsFactory->create();
        $sections->getResource()->load($sections, $sectionsId);
        if (!$sections->getId()) {
            throw new NoSuchEntityException(__('sections with id "%1" does not exist.', $sectionsId));
        }
        return $sections;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sectionsCollectionFactory->create();
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
        \Pablo\DeliveryZones\Api\Data\SectionsInterface $sections
    ) {
        try {
            $sections->getResource()->delete($sections);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the sections: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sectionsId)
    {
        return $this->delete($this->getById($sectionsId));
    }
}
