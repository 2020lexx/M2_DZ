<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

namespace Pablo\DeliveryZones\Controller\Adminhtml\CustomerDeliveryZone;

class Delete extends \Pablo\DeliveryZones\Controller\Adminhtml\CustomerDeliveryZone
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('customerdeliveryzone_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Pablo\DeliveryZones\Model\CustomerDeliveryZone');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Customerdeliveryzone.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['customerdeliveryzone_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Customerdeliveryzone to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
