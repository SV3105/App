<?php
require_once "app/blocks/core/Template.php";
class Block_Products_Edit extends Block_Core_Template{
    protected $product;

    public function __construct(){
        $this->setTemplate('products/edit');
    }

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    public function getProduct(){
        return $this->product;
    }

    public function getCategories(){
        $category = $this->getProduct()->getParent('category');
        $categories = $category->fetchAll('select * from category');
        return $categories;
    }
}
?>
 
