<?php 

class Controller_Core_Base{
 
    protected $request = null;

    public function setRequest($request){
        $this->request = $request;
        return $this->request;     
    }

    public function getRequest(){
        if($this->request) {
            return $this->request;
        }
        $request = new Model_Request();
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

     public function renderTemplate($template, $data = [])
    {
        extract($data);
        
        $templatePath = 'app/templates/' . $template;

        if (!file_exists($templatePath)) {
            die("Template not found: " . $templatePath);
        }

        include $templatePath;
    }

}

?>