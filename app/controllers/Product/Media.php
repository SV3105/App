<?php
require_once 'app/models/Product/Media.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Product_Media extends Controller_Core_Base
{

    public function saveAction()
    {
        $items = $this->getRequest()->post('item');
        $productId = $this->getRequest()->get('id');

        $base = $this->getRequest()->post('base');
        $thumb = $this->getRequest()->post('thumb');
        $small = $this->getRequest()->post('small');

        $mediaModel = Mage::getModel('product/media');

       
        if ($productId) {
            $sql = "UPDATE product_media SET base = 0, thumb = 0, small = 0 WHERE product_id = '$productId'";
            $mediaModel->db->update($sql);
        }

        if ($items) {
            foreach ($items as $mediaId => $data) {
                $mediaModel = Mage::getModel('product/media');
                $mediaModel->load($mediaId);
                
               
                foreach ($data as $key => $value) {
                    $mediaModel->$key = $value;
                }

                $mediaModel->base = ($mediaId == $base) ? 1 : 0;
                $mediaModel->thumb = ($mediaId == $thumb) ? 1 : 0;
                $mediaModel->small = ($mediaId == $small) ? 1 : 0;
                
                $mediaModel->save();
            }
        }
        $this->redirect('edit', 'product_media', ['id' => $productId]);
    }

    public function editAction()
    {
        $productId = $this->getRequest()->get('id');
        $mediaModel = Mage::getModel('product/media');
        $sql = "SELECT * FROM product_media WHERE product_id = '$productId'";
        $medias = $mediaModel->fetchAll($sql);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $edit = Mage::getBlock('product/media/edit');
        $content->addChild('edit', $edit);
        $edit->setData(['media' => $medias, 'product_id' => $productId]);
        $layout->render();
    }

    public function deleteAction()
    {
        $productMediaModel = Mage::getModel('product_media');
        if ($id = $this->getRequest()->get('id')) {
            $productMediaModel->load($id);
            $productId = $productMediaModel->product_id;

            $filePath = APP_PATH . DS . 'media' . DS . $productMediaModel->file_path;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $productMediaModel->delete();
            $this->redirect('edit', 'product_media', ['id' => $productId]);
        }
    }

    public function uploadAction()
    {
        $productId = $this->getRequest()->post('product_id') ?: $this->getRequest()->get('id');

        if (!empty($_FILES['file_path']['name'])) {
            $fileName = basename($_FILES['file_path']['name']);
            $destination = APP_PATH . DS . 'media' . DS . $fileName;
            if (move_uploaded_file($_FILES['file_path']['tmp_name'], $destination)) {
                $productMediaModel = Mage::getModel('product/media');
                $productMediaModel->product_id = $productId;
                $productMediaModel->file_path = $fileName;
                $productMediaModel->save();
            }
        }
        $this->redirect('edit', 'product_media', ['id' => $productId]);
    }
}

?>