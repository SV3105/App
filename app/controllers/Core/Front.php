<?php 

class Controller_Core_Front{
 
    protected $request = null;

    public function setRequest($request){
        $this->request = $request;
        return $this->request;     
    }

    public function getRequest(){
        if($this->request) {
            return $this->request;
        }
        $request = new Request();
        $this->request = $request;
        return $this->request;
    }

    public function redirect($a=null, $c=null){
         if(!$a){
            $a = $this->getRequest()->get("a");
         }
         if(!$c){
            $c = $this->getRequest()->get("c");
         }

        header("Location: index.php?a=$a&c=$c");
        exit();
    }

    public function dispatch(){
        $action = $this->getRequest()->get("a", "index");
        $action = $action . "Action";
        $this->$action();
        
    }

}

?>