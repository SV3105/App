<?php
require_once 'app/Models/Product.php';
require_once 'app/controllers/Core/Base.php';


class Controller_Product extends Controller_Core_Base
{

    public function listAction()
    {
        try{
        $productModel = Mage::getModel('product');
        $sql = "SELECT * FROM product";
        $product = $productModel->fetchAll($sql);
        $layout = Mage::getBlock('layout');
        $layout->setTemplate('layout');
        
        $content = $layout->getChild('content');
        $list = Mage::getBlock('products/list');
        $content->addChild('list', $list);
        $content->getChild('list');
        $list->setData($product);
        $layout->render();
        
        // echo('<pre>');
        // print_r($list);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveAction()
    {   try{
        $productModel = Mage::getModel('product');
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
        }
        $data = $this->getRequest()->post('product');
        if ($data) {
            foreach ($data as $key => $value) {
                $productModel->$key = $value;
            }
            $productModel->save();
        }
        $this->redirect('list', 'product');
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    }

    public function editAction()
    {
        try{
        $productModel = Mage::getModel('product');
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
        }
        $layout = Mage::getBlock('layout');
        $layout->setTemplate('layout');
        $edit = Mage::getBlock('products/edit');
        $content = $layout->getChild('content');
        $content->addChild('edit', $edit);
        $edit->setData(['product' => $productModel]);
        $layout->render();
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    }

    public function deleteAction()
    {
        try{
        $productModel = Mage::getModel('product');
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
            $productModel->delete();
        }
        $this->redirect('list', 'product');
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    }

    public function sampleAction(){
       $layout = Mage::getBlock('layout');
        $layout->setTemplate('layout');
        $layout->render();
        $footer = $layout->getChild('footer');
        $data = ['abc' => 123];
        $footer->setData($data);
        $footer->getData();
       
        $content = $layout->getChild('content');
        
        $content->addChild('footer', $footer);


       echo("<pre>");
        print_r($layout);
       


    }
}

?>