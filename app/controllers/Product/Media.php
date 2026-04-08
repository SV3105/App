<?php
require_once 'app/Models/Product/Media.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Product_Media extends Controller_Core_Base
{

    public function listAction()
    {
        $productMediaModel = new Model_Product_Media();
        $sql = "SELECT * FROM product_media";
        $product_medias = $productMediaModel->fetchAll($sql);
        $layout = Mage::getBlock("layout");
        $layout->setTemplate("layout");
        $list = Mage::getBlock("product/media/list");
        $content = $layout->getChild("content");
        $content->addChild("list", $list);
        $list->setData($product_medias);
        $layout->render();
    }

    public function saveAction()
    {
        $productMediaModel = new Model_Product_Media();
        if ($id = $this->getRequest()->get('id')) {
            $productMediaModel->load($id);
        }
        $data = $this->getRequest()->post('product_media');
        if ($data) {
            foreach ($data as $key => $value) {
                $productMediaModel->$key = $value;
            }
            $productMediaModel->save();
        }
        $this->redirect('list', 'product_media');
    }

    public function editAction()
    {
        $productMediaModel = new Model_Product_Media();
        if ($id = $this->getRequest()->get('id')) {
            $productMediaModel->load($id);
        }
        $layout = Mage::getBlock("layout");
        $layout->setTemplate("layout");
        $edit = Mage::getBlock("product/media/edit");
        $content = $layout->getChild("content");
        $content->addChild("edit", $edit);
        $edit->setData(['media' => $productMediaModel]);
        $layout->render();
    }

    public function deleteAction()
    {
        $productMediaModel = new Model_Product_Media();
        if ($id = $this->getRequest()->get('id')) {
            $productMediaModel->load($id);
            $productMediaModel->delete();
        }
        $this->redirect('list', 'product_media');
    }
}

?>