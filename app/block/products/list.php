<?php
require_once "app/block/Core/template.php";
class Block_Products_List extends Block_Core_template{
    public function __construct(){
        $this->setTemplate('products/list');
    }
}
?>
 
