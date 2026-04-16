<?php
require_once "app/blocks/core/Template.php";
class Block_Products_List extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('products/list');
    }
}
?>
 
