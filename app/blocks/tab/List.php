<?php 
require_once 'app/blocks/core/Template.php';
class Block_Tab_List extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('tab/list');
    }
}
?>