<?php 
require_once 'app/blocks/core/Template.php';

    class Block_Layout_Footer extends Block_Core_Template{
        
        public function __construct()
        {
            $this->setTemplate('layout/footer');
        }
    }

?>