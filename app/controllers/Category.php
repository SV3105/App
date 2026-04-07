<?php
require_once 'app/Models/Category.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Category extends Controller_Core_Base
{

    public function listAction()
    {
        $categoryModel = new Model_Category();
        $sql = "SELECT * FROM category";
        $categories = $categoryModel->fetchAll($sql);
        $this->renderTemplate('categories/list.phtml', [
            'categories' => $categories
        ]);
    }

    public function saveAction()
    {
        $categoryModel = new Model_Category();
        if ($id = $this->getRequest()->get('id')) {
            $categoryModel->load($id);
        }
        $data = $this->getRequest()->post('category');
        foreach ($data as $key => $value) {
            $categoryModel->$key = $value;
        }
        $categoryModel->save();
        $this->redirect('list', 'category');
    }

    public function editAction()
    {
        $categoryModel = new Model_Category();
        if ($id = $this->getRequest()->get('id')) {
            $categoryModel->load($id);
        }
        $this->renderTemplate('categories/edit.phtml', [
            'categories' => $categoryModel
        ]);
    }

    public function deleteAction()
    {
        $categoryModel = new Model_Category();
        if ($id = $this->getRequest()->get('id')) {
            $categoryModel->load($id);
            $categoryModel->delete();
        }
        $this->redirect('list', 'category');
    }
}

?>