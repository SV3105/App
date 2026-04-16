<?php 
require_once 'app/blocks/core/Template.php';

    class Block_Layout_Header extends Block_Core_Template{
        
        public function __construct()
        {
            $this->setTemplate('layout/header');
            $menu = Mage::getBlock('layout/header/menu');
            $this->addChild('menu', $menu);
        }
        
    }

    

?>