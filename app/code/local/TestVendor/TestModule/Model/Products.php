<?php

class TestVendor_TestModule_Model_Products extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('TestModule/products');
        parent::_construct();
    }
}