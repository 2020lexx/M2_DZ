<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Block\Index;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;


use Pablo\DeliveryZones\Helper\Data;

/**
 * Class ModalOverlay
 * @package Pablo\DeliveryZones\Block\Index
 */
class ModalOverlay extends Template
{

    /**
     *
     */
    const CONFIG_MODAL_ENABLE = 'Pablo_deliveryzones/modal/modal_enable';
    /**
     *
     */
    const CONFIG_MODAL_ONE_VIEW = 'Pablo_deliveryzones/modal/modal_one_view';
    /**
     *
     */
    const CONFIG_MODAL_HEADER = 'Pablo_deliveryzones/modal/modal_header';
    /**
     *
     */
    const CONFIG_MODAL_CENTER = 'Pablo_deliveryzones/modal/modal_center';
    /**
     *
     */
    const CONFIG_MODAL_FOOTER = 'Pablo_deliveryzones/modal/modal_footer';
    /**
     *
     */
    const CONFIG_MODAL_IN_ZONE = 'Pablo_deliveryzones/modal/modal_inzone';
    /**
     *
     */
    const CONFIG_MODAL_OUT_ZONE = 'Pablo_deliveryzones/modal/modal_outzone';
    /**
     *
     */
    const CONFIG_MODAL_GEOCODING_ERROR = 'Pablo_deliveryzones/modal/modal_failzone';
    /**
     *
     */
    const CONFIG_MODAL_DLY_DATA_VIEW = 'Pablo_deliveryzones/modal/modal_dly_data_view';

    /**
     * @var
     */
    protected $_scopeConfig;
    /**
     * @var BlockRepositoryInterface
     */
    private $_blockRepository;

    /**
     * ModalOverlay constructor.
     *
     * @param BlockRepositoryInterface $blockRepository
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        BlockRepositoryInterface $blockRepository,
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->_blockRepository = $blockRepository;
        $this->_scopeConfig =  $context->getScopeConfig();
        $this->helper = $helper;
        parent::__construct($context, $data);
    }


    /**
     * @return bool
     */
    public function modalEnable(){

        return ($this->_scopeConfig->getValue(self::CONFIG_MODAL_ENABLE))?true:false;

    }

    /**
     * @return bool
     */
    public function modalOneView(){

        return ($this->_scopeConfig->getValue(self::CONFIG_MODAL_ONE_VIEW))?true:false;

    }

    /**
     * @return bool
     */
    public function modalDlyDataView(){

        return ($this->_scopeConfig->getValue(self::CONFIG_MODAL_DLY_DATA_VIEW))?true:false;

    }
    /**
     * Retrieve Header modal overlay content
     *
     * @param $identifier
     * @return bool|string
     */
    public function getHeaderContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_MODAL_HEADER));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Modal Header Content');
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getCenterContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_MODAL_CENTER));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Modal Center Content');
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getFooterContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_MODAL_FOOTER));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Modal Footer Content');
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getInZoneContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_MODAL_IN_ZONE));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Modal In Zone Content');
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getOutZoneContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_MODAL_OUT_ZONE));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Modal Out Zone Content');
        }

        return $content;
    }

    /**
     * @return mixed
     */
    public function getFailZoneContent()
    {
        try {
            /** @var BlockInterface $block */
            $block = $this->_blockRepository->getById($this->_scopeConfig->getValue(self::CONFIG_MODAL_GEOCODING_ERROR));
            $content = $block->getContent();
        } catch (LocalizedException $e) {
            $content = __('Geocoding Fail Content');
        }

        return $content;
    }
}
