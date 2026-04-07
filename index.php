<?php 

require_once "app/Boot.php";
    class Mage {

        public static function init(){
            
            // echo "111";
            Boot::init();
            
        }

        public static function getBlock($blockName)
    {
   
        $classNameRaw = str_replace('/', '_', $blockName);
        $parts = explode('_', $classNameRaw);
        $parts = array_map('ucfirst', $parts);
       
   
        $blockClass = 'Block_' . implode('_', $parts);
 
       
        $blockFile = 'app/block/' . implode('/', $parts) . '.php';
 
        if (!file_exists($blockFile)) {
            die("Block file not found: " . $blockFile);
        }
       
        require_once $blockFile;
       
        if (!class_exists($blockClass)) {
            die("Block class not found: " . $blockClass);
        }
       
        return new $blockClass();
    }

    }


    Mage::init();
    
   
?>