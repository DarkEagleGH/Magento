<?php

class  TestVendor_TestModule_Block_Adminhtml_Support_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $helper = Mage::helper('TestModule');
        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/send'),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );
        $fieldset = $form->addFieldset('support_form', array('legend' => $helper->__('Message')));

        $fieldset->addField('firstname', 'text', array(
            'label' => $helper->__('First name'),
            'required' => true,
            'name' => 'firstname',
        ));

        $fieldset->addField('lastname', 'text', array(
            'label' => $helper->__('Last name'),
            'required' => true,
            'name' => 'lastname',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => $helper->__('E-mail'),
            'required' => true,
            'value' => Mage::getConfig()->getNode('global/TestModule/email'),
            'name' => 'email',
        ));

        $fieldset->addField('message', 'editor', array(
            'label' => $helper->__('Message'),
            'required' => true,
            'name' => 'message',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}