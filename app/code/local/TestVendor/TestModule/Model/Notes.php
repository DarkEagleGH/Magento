<?php

class TestVendor_TestModule_Model_Notes extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('TestModule/notes');
        parent::_construct();
    }
}