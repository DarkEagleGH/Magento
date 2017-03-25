<?php

class TestVendor_TestModule_Model_Mysql4_Notes extends Mage_Core_Model_Mysql4_Abstract
{
    protected $_isPkAutoIncrement = false;

    public function _construct()
    {
        $this->_isPkAutoIncrement = false;
        $this->_init('TestModule/notes', 'product_id');
    }
}