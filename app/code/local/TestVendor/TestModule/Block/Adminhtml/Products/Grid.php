<?php

class TestVendor_TestModule_Block_Adminhtml_Products_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('testmoduleProductsGrid');
        $this->setDefaultSort('product_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        /** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('name');
        $collection->addAttributeToSelect('image');

        $collection->joinTable(
            array('notes' => 'TestModule/notes'),
            'product_id = entity_id',
            array(
                'value' => 'value'),
            null,
            'left'
        );

        if (Mage::getConfig()->getModuleConfig('Ess_M2ePro')->is('active', 'true')) {
            $collection->joinTable(
                array('lp' => 'M2ePro/Listing_Product'),
                'product_id = entity_id',
                array(
                    'M2ePro' => 'IF(`lp`.`product_id` IS NOT NULL, \'Yes\', \'\')'),
                null,
                'left'
            );
        }

//        Zend_Debug::dump($collection->getSelect()->__toString());

        Mage::register('testmodule_products_collection', $collection);

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('id', array(
            'type' => 'number',
            'index' => 'entity_id',
            'width' => '60px',
            'header' => Mage::helper('TestModule')->__('Id'),
        ));

        $this->addColumn('image', array(
            'type' => 'text',
            'index' => 'image',
            'width' => '160px',
            'header' => Mage::helper('TestModule')->__('Base image'),
        ));

        $this->addColumn('name', array(
            'type' => 'text',
            'index' => 'name',
            'width' => '250px',
            'header' => Mage::helper('TestModule')->__('Name/Title'),
        ));

        $this->addColumn('type', array(
            'type' => 'text',
            'index' => 'type_id',
            'width' => '120px',
            'header' => Mage::helper('TestModule')->__('Type'),
        ));

        if (Mage::getConfig()->getModuleConfig('Ess_M2ePro')->is('active', 'true')) {
            $this->addColumn('M2ePro', array(
                'type' => 'text',
                'index' => 'M2ePro',
                'width' => '60px',
                'header' => Mage::helper('TestModule')->__('M2ePro'),
                'sortable' => false,
                'filter' => false,
            ));
        }

        $this->addColumn('value', array(
            'type' => 'text',
            'index' => 'value',
            'header' => Mage::helper('TestModule')->__('Notes'),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}