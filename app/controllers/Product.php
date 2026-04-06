<?php
require_once 'app/Models/Product.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Product extends Controller_Core_Base
{

    public function listAction()
    {
        $productModel = new Model_Product();
        $sql = "SELECT * FROM product";
        $products = $productModel->fetchAll($sql);
          $this->renderTemplate('products/list.phtml', [
            'products' => $products
        ]);
    }

    public function saveAction()
    {
        $productModel = new Model_Product();
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
        }
        $data = $this->getRequest()->post('product');
        foreach ($data as $key => $value) {
            $productModel->$key = $value;
        }
        $productModel->save();
        $this->redirect('list', 'product');
    }

    public function editAction()
    {
        $productModel = new Model_Product();
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
        }
         $this->renderTemplate('products/edit.phtml', [
            'products' => $productModel
        ]);
    }

    public function deleteAction()
    {
        $productModel = new Model_Product();
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
            $productModel->delete();
        }
        $this->redirect('list', 'product');
    }
}

?>