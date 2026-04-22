<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', getcwd());
define('APP_PATH', ROOT_PATH . DS . 'app');

require_once "app/Boot.php";
class Mage
{
    public static function init()
    {
        Boot::init();
    }

    public static function getBaseUrl($subpath = null)
    {
        // $fullurl = $_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
        $fullurl = $_SERVER['SCRIPT_NAME'];

        $url = str_replace('index.php', '', $fullurl);
        // $url = "https://localhost/project-php/App/";
        if (!$subpath) {
            return $url;
        }
        $url .= $subpath;
        return $url;
    }

    public static function getController($controllerName)
    {
        $controllerName = str_replace(['/', '\\'], '_', $controllerName);
        $ucName = ucwords($controllerName, '_');

        $controllerClass = 'Controller_' . $ucName;
        $controllerFile = APP_PATH . DS . 'controllers' . DS . str_replace('_', DS, $ucName) . '.php';

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
        $modelName = ucwords($modelName, '_');

        $modelClass = 'Model_' . $modelName;
        $modelFile = APP_PATH . DS . 'models' . DS . str_replace('_', DS, $modelName) . '.php';

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
        $ucName = ucwords($classNameRaw, '_');


        $blockClass = 'Block_' . $ucName;


        $blockFile = APP_PATH . DS . 'blocks' . DS . str_replace('_', DS, $ucName) . '.php';

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