<?php 
class Block_Admin_Edit1 extends Block_Core_Template{
    protected $_module;
    public function __construct() {
        $this->setTemplate("admin/edit1");
        $this->prepareTabs();
        $this->setModule('admin');
    }

    public function prepareTabs(){
        $tabs = Mage::getBlock('admin/edit1/tabs');
        $this->addChild('tabs', $tabs);
        return $this;
    }

    public function setModule($_module){
        $this->_module = $_module;
        return $this;
    }

    public function getModule() {
        return $this->_module;
    }

    public function setRow($row){
        $this->_row = $row;
        return $this;
    }

    public function getRow() {
        return $this->_row;
    }
}
?>