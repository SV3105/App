<?php
require_once 'app/blocks/core/Template.php';
class Block_Module_Edit extends Block_Core_Template{
    public function __construct()
    {
        $this->setTemplate('module/edit');
    }
}

?>