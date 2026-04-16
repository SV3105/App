<?php 
require_once "app/blocks/core/Template.php";
class Block_Layout_Header_Menu extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('layout/header/menu');
        
    }

    public function getMenu()
    {
        $menuModel = Mage::getModel('menu');
        $sql = "SELECT * FROM {$menuModel->tableName} WHERE status = 1 ORDER BY position ASC";
        $menus = $menuModel->fetchAll($sql);
        return $menus;
    }
}
?>