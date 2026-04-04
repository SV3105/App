<?php 
require_once 'app/Models/Product.php';
require_once 'app/controllers/Core/Front.php';

class Controller_Product extends Controller_Core_Front {
    public function indexAction(){
        echo __CLASS__ . '::' . __FUNCTION__ ;
    }

    public function listAction(){
        echo __CLASS__ . '::' . __FUNCTION__ ;
    }

    public function addAction(){
       echo __CLASS__ . '::' . __FUNCTION__ ;
        
    }

     public function editAction(){
        echo __CLASS__ . '::' . __FUNCTION__ ;
    }

     public function deleteAction(){
        echo __CLASS__ . '::' . __FUNCTION__ ;
    }
}

?>