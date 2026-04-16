<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', getcwd());
define('APP_PATH', ROOT_PATH . DS . 'app');


require_once "app/Boot.php";
class Mage
{

    public static function init()
    {
        // echo "111";
        Boot::init();

    }

    public static function getController($controllerName)
    {
        $controllerName = str_replace(['/', '\\'], '_', $controllerName);
        $parts = explode('_', $controllerName);
        $parts = array_map('ucfirst', $parts);

        $controllerClass = 'Controller_' . implode('_', $parts);
        $controllerFile = APP_PATH . DS . 'controllers' . DS . implode(DS, $parts) . '.php';

        if (!file_exists($controllerFile)) {
            return false;
        }
 
        require_once $controllerFile;
 
        if (!class_exists($controllerClass)) {
            return false;
        }
 
        return new $controllerClass();
    }
 
    public static function getModel($modelName)
    {
        $modelName = str_replace(['/', '\\'], '_', $modelName);
        $parts = explode('_', $modelName);
        $parts = array_map('ucfirst', $parts);

        $modelClass = 'Model_' . implode('_', $parts);
        $modelFile = APP_PATH . DS . 'models' . DS . implode(DS, $parts) . '.php';

        if (!file_exists($modelFile)) {
            return false;
        }
 
        require_once $modelFile;
 
        if (!class_exists($modelClass)) {
            return false;
        }
 
        return new $modelClass();
    }

    public static function getBlock($blockName)
    {

        $classNameRaw = str_replace('/', '_', $blockName);
        $parts = explode('_', $classNameRaw);
        $parts = array_map('ucfirst', $parts);


        $blockClass = 'Block_' . implode('_', $parts);


        $blockFile = APP_PATH . DS . 'blocks' . DS . implode(DS, $parts) . '.php';

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