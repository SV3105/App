<?php 
require_once 'app/Models/Productmedia.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Productmedia extends Controller_Core_Base
{

    public function listAction()
    {
        $productMediaModel = new Model_Productmedia();
        $sql = "SELECT * FROM product_media";
        $productMedias = $productMediaModel->fetchAll($sql);
        
        $this->renderTemplate('product_medias/list.phtml', [
            'productMedias' => $productMedias
        ]);
    }

    public function saveAction()
    {
        $productMediaModel = new Model_Productmedia();
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
        $productMediaModel = new Model_Productmedia();
        if ($id = $this->getRequest()->get('id')) {
            $productMediaModel->load($id);
        }
         $this->renderTemplate('product_medias/edit.phtml', [
            'media' => $productMediaModel
        ]);
    }

    public function deleteAction()
    {
        $productMediaModel = new Model_Productmedia();
        if ($id = $this->getRequest()->get('id')) {
            $productMediaModel->load($id);
            $productMediaModel->delete();
        }
        $this->redirect('list', 'product_media');
    }
}

?>