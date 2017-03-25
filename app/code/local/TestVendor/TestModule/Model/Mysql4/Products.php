<?php

class TestVendor_TestModule_Model_Mysql4_Products extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('TestModule/products', 'entity_id');
    }
}