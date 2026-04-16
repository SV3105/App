<?php
require_once "app/blocks/core/Template.php";
class Block_Customer_Group_List extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('customer/group/list');
    }
}
?>