<?php
require_once 'app/models/Product.php';
require_once 'app/controllers/Core/Base.php';


class Controller_Product extends Controller_Core_Base
{

    public function listAction()
    {
        try{
        $productModel = Mage::getModel('product');
        $sql = "SELECT p.*, c.name as category_name, (SELECT COUNT(*) FROM product_media WHERE product_id = p.product_id) as media_count FROM product p LEFT JOIN category c ON p.category_id = c.category_id";
        $product = $productModel->fetchAll($sql);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $list = Mage::getBlock('products/list');
        $content->addChild('list', $list);
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
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $edit = Mage::getBlock('products/edit');
        $content->addChild('edit', $edit);
        $edit->setProduct($productModel);
        $layout->render();
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    }

    public function deleteAction()
    {
        try {
            $productModel = Mage::getModel('product');
            if ($id = $this->getRequest()->get('id')) {
                $productModel->load($id);

                // Delete related media
                $mediaModel = Mage::getModel('product/media');
                $sql = "SELECT * FROM product_media WHERE product_id = $id";
                $medias = $mediaModel->fetchAll($sql);
                if ($medias) {
                    foreach ($medias as $media) {
                        $filePath = APP_PATH . DS . 'media' . DS . $media->file_path;
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                        $media->delete();
                    }
                }

                $productModel->delete();
            }
            $this->redirect('list', 'product');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>