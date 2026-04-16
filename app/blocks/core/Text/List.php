<?php 
require_once 'app/blocks/core/Template.php';
class Block_Core_Text_List extends Block_Core_Template{
    public function __construct()
    {
        $this->setTemplate('Core/Text/List');
    
    }
}
?>