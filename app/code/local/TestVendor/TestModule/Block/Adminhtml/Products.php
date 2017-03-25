<?php

class TestVendor_TestModule_Block_Adminhtml_Products extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {
        $this->_blockGroup = 'TestModule';
        $this->_controller = 'adminhtml_products';
        $this->_headerText = Mage::helper('TestModule')->__('Products');
        parent::__construct();
        $this->_removeButton('add');
    }
}