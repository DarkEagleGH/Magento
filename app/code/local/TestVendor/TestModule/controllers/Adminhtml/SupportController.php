<?php

class TestVendor_TestModule_Adminhtml_SupportController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('TestModuleMenu/support');
        $this->_addContent($this->getLayout()->createBlock('TestModule/adminhtml_support_edit'));
        $this->renderLayout();
    }

    public function sendAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $mail = Mage::getModel('core/email');
                $mail->setToName($data['lastname']." ".$data['firstname']);
                $mail->setToEmail($data['email']);
                $mail->setBody($data['message']);
                $mail->setSubject('Support form');
                $mail->setFromEmail(Mage::getStoreConfig('trans_email/ident_general/email'));
                $mail->setFromName(Mage::getStoreConfig('trans_email/ident_general/name'));
                $mail->setType('html');
                $mail->send();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Message sent successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/', $data);
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Some error during sending'));
        $this->_redirect('*/*/');
    }

}