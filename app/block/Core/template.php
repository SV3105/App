<?php
class Block_Core_Template
{
    protected $template;
    protected $children = [];
    protected $data = [];
    protected $layout;
    protected $parent = null;

    public function setParent($parent){
        $this->parent = $parent;
        return $this;
    }

    public function getParent(){
        return $this->parent;
    }

    public function setData(array $data) {
        $this->data = $data;
    }

    public function getData()  {
        return $this->data;
    }
    public function setTemplate(string $template){
        $this->template = $template;
    }
    public function getTemplate(){
        return $this->template;
    }
    public function setLayout(string $layout){
        $this->layout  = $layout;
    }
    public function getLayout(){
        return $this->layout;
    }
    public function addChild($key, $value){

        $this->children[$key] = $value;
        $parent = $value->setParent($this);
        return $parent;

    }
    public function removeChild($key){
        unset($this->children[$key]);
    }
    public function getChild($key){
        return $this->children[$key] ?? null;
    }

    public function getRequest()
    {
        return new Model_Request();
    }

    public function toHtml(){
       $file = APP_PATH . DS . 'templates' . DS . $this->getTemplate() . '.phtml';
       if(!file_exists($file)){
            throw new Exception("$file not existed");
       }
        extract($this->data);
        require_once $file;
       
    }

    public function render(){
        return $this->toHtml();
    }

}

?>