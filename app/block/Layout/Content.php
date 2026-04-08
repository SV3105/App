<?php 
    class Block_Layout_Content extends Block_Core_Template{
        
        public function __construct()
        {
            
            $this->setTemplate('content');
            $this->getChild('list');
            $this->getChild('edit');
        }
    }

?>