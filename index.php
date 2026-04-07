<?php

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
        $classNameRaw = str_replace('/', '_', $controllerName);
        $parts = explode('_', $classNameRaw);
        $parts = array_map('ucfirst', $parts);
        $controllerClass = 'Controller_' . implode('_', $parts);
        $controllerFile = 'app/controllers/' . implode('/', $parts) . '.php';
        if (!file_exists($controllerFile)) {
            die("Controller file not found: " . $controllerFile);
        }
        require_once $controllerFile;
        if (!class_exists($controllerClass)) {
            die("Controller class not found: " . $controllerClass);
        }
        return new $controllerClass();
    }

    public static function getModel($modelName)
    {
        $classNameRaw = str_replace('/', '_', $modelName);
        $parts = explode('_', $classNameRaw);
        $parts = array_map('ucfirst', $parts);
        $modelClass = 'Model_' . implode('_', $parts);
        $modelFile = 'app/Models/' . implode('/', $parts) . '.php';
        if (!file_exists($modelFile)) {
            die("Model file not found: " . $modelFile);
        }
        require_once $modelFile;
        if (!class_exists($modelClass)) {
            die("Model class not found: " . $modelClass);
        }
        return new $modelClass();
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