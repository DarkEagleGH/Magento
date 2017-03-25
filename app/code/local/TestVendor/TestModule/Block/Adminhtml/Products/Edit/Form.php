<?php

class TestVendor_TestModule_Block_Adminhtml_Products_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('TestModule');
        $id = Mage::registry('testmodule_product_id');
        $model = Mage::getModel('TestModule/notes')->load($id);
        if (is_null($model->_getData('product_id'))){
            $model->addData(array('product_id' => (string)$id));
        }

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save',
                array('id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('products_form', array('legend' => $helper->__('Product notes')));

        $fieldset->addField('product_id', 'label', array(
            'label' => $helper->__('Id'),
            'required' => true,
            'name' => 'product_id',
        ));

        $fieldset->addField('value', 'editor', array(
            'label' => $helper->__('Notes'),
            'required' => false,
            'name' => 'value',
        ));

        $form->setUseContainer(true);

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        $this->setForm($form);
        return parent::_prepareForm();
    }

}
