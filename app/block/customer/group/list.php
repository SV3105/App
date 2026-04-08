<?php
require_once "app/block/Core/template.php";
class Block_Customer_Group_List extends Block_Core_template{
    public function __construct(){
        $this->setTemplate('customer/group/list');
    }
}
?>