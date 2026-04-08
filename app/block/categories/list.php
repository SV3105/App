<?php
require_once "app/block/Core/template.php";
class Block_Categories_List extends Block_Core_template{
    public function __construct(){
        $this->setTemplate('categories/list');
    }
}
?>
