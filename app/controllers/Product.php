<?php
require_once 'app/Models/Product.php';
require_once 'app/controllers/Core/Base.php';


class Controller_Product extends Controller_Core_Base
{

    public function listAction()
    {

        $productModel = Mage::getModel('product');
        $sql = "SELECT * FROM product";
        $products = $productModel->fetchAll($sql);
        $block = Mage::getBlock('product/list');
        $layout = $this->getLayout();
        $layout->addChild('product/list', $block);
        $block->products = $products;
        $layout->toHtml();
        // $this->renderTemplate('products/list.phtml', [
        //     'products' => $products
        // ]);
    }

    public function saveAction()
    {
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

    public function editAction()
    {
        $productModel = Mage::getModel('product');
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
        }
        $this->renderTemplate('products/edit.phtml', [
            'product' => $productModel
        ]);
    }

    public function deleteAction()
    {
        $productModel = Mage::getModel('product');
        if ($id = $this->getRequest()->get('id')) {
            $productModel->load($id);
            $productModel->delete();
        }
        $this->redirect('list', 'product');
    }
}

?>