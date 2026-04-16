<?php
require_once 'app/blocks/core/Template.php';
class Block_Layout extends Block_Core_Template{
    public function __construct()
    {       
        $this->setTemplate('layout');
        $header = Mage::getBlock('layout/header');
        $footer = Mage::getBlock('layout/footer');
        $content = Mage::getBlock('layout/content');
       

        $this->addChild('header', $header);
        $this->addChild('content', $content);
        $this->addChild('footer', $footer);
        
        
    }

}
?>