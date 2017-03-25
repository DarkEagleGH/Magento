<?php

class TestVendor_TestModule_Block_Adminhtml_Products_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'TestModule';
        $this->_controller = 'adminhtml_products';
    }

    public function getHeaderText()
    {
        return Mage::helper('TestModule')->__("Edit product notes");
    }

    protected function _prepareLayout()
    {
        $this->_removeButton('delete');
        return parent::_prepareLayout();
    }
}
