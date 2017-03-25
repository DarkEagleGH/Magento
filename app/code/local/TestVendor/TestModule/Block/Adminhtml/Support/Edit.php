<?php

class TestVendor_TestModule_Block_Adminhtml_Support_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'TestModule';
        $this->_controller = 'adminhtml_support';
        $this->_headerText = Mage::helper('TestModule')->__('Support');
        parent::__construct();
    }

    public function getHeaderText()
    {
        return Mage::helper('TestModule')->__('Send message');
    }

    protected function _prepareLayout()
    {
        $this->_updateButton('save', 'label', Mage::helper('TestModule')->__('Send'));
        $this->_removeButton('delete');
        $this->_removeButton('back');
        return parent::_prepareLayout();
    }
}