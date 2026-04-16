<?php 
require_once 'app/blocks/core/Template.php';
class Block_Core_Text extends Block_Core_Template {
    public function __construct()
    {
      $this->setTemplate('template');
    }
}
?>