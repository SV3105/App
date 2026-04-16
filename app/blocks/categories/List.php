<?php
require_once "app/blocks/core/Template.php";
class Block_Categories_List extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('categories/list');
    }
}
?>
