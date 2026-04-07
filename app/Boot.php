<?php 
require_once 'app/controllers/Core/Base.php';
require_once 'app/controllers/Product.php';
require_once 'app/Models/Request.php';

class Boot{
  public static function init(){
    $request = new Model_Request();
    $controllerName = $request->get('c', 'product');

    $normalizedName = str_replace('_', '', $controllerName);
    $normalizedName = ucfirst($normalizedName);

    $controllerFile = 'app/controllers/' . $normalizedName . '.php';

    if (!file_exists($controllerFile)) {
        die("Controller file not found: " . $controllerFile);
    }

    require_once $controllerFile;

    $controllerClass = 'Controller_' . $normalizedName;

    if (!class_exists($controllerClass)) {
        die("Controller class not found: " . $controllerClass);
    }

    $controller = new $controllerClass();
    $controller->dispatch();
}

}


?>