<?php 
require_once 'app/controllers/Core/Base.php';
require_once 'app/controllers/Product.php';
require_once 'app/Models/Request.php';

class Boot{
    public static function init(){
        // echo "222";
       
       if($_GET['c']){
              $controllerName = $_GET['c'];
              $controllerName = "Controller_" . ucfirst($controllerName);
              $controller = new $controllerName();
              $controller->dispatch();
       } 
    }
}


?>