<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Controller\Adminhtml\CustomerDeliveryZone;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('customerdeliveryzone_id');
        
            $model = $this->_objectManager->create('Pablo\DeliveryZones\Model\CustomerDeliveryZone')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Customerdeliveryzone no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Customerdeliveryzone.'));
                $this->dataPersistor->clear('Pablo_deliveryzones_customerdeliveryzone');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['customerdeliveryzone_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Customerdeliveryzone.'));
            }
        
            $this->dataPersistor->set('Pablo_deliveryzones_customerdeliveryzone', $data);
            return $resultRedirect->setPath('*/*/edit', ['customerdeliveryzone_id' => $this->getRequest()->getParam('customerdeliveryzone_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
