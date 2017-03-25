<?php

class TestVendor_TestModule_Adminhtml_ProductsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('TestModuleMenu/products');
        $this->_addContent(
            $this->getLayout()->createBlock('TestModule/adminhtml_products')
        );

        return $this->renderLayout();
    }

    public function editAction()
    {
        Mage::register('testmodule_product_id', (int)$this->getRequest()->getParam('id'));
        $this->loadLayout()->_setActiveMenu('TestModuleMenu/products');
        $this->_addContent($this->getLayout()->createBlock('TestModule/adminhtml_products_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('TestModule/notes');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'entity_id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

}