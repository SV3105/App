<?php 
require_once 'app/controllers/Core/Base.php';
require_once 'app/controllers/Product.php';
require_once 'app/Models/Request.php';

class Boot{
  public static function init(){
    $request = Mage::getModel('request');
   $controller = Mage::getController($request->get('c', 'product'));
    if ($controller) {
        $controller->dispatch();
    } else {
        die("Error: Controller not found.");
    }

}

}


?>