<?php 
require_once 'app/controllers/Core/Base.php';
require_once 'app/controllers/Product.php';
require_once 'app/models/Request.php';

class Boot{
  public static function init(){
    require_once 'app/models/Core/Session.php';
    $session = new Model_Core_Session();
    $session->startSession();

    $request = Mage::getModel('request');
   $controller = Mage::getController($request->get('c', 'admin'));
    if ($controller) {
        $controller->dispatch();
    } else {
        die("Error: Controller not found.");
    }

}

}


?>