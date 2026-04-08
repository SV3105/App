<?php
require_once 'app/Models/Category.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Category extends Controller_Core_Base
{

    public function listAction()
    {
        $categoryModel = Mage::getModel('category');
        $sql = "SELECT * FROM category";
        $categories = $categoryModel->fetchAll($sql);
        $layout = Mage::getBlock('layout');
        $layout->setTemplate('layout');
        $content = $layout->getChild('content');
        $list = Mage::getBlock('categories/list');
        $content->addChild('list', $list);
        $list->setData($categories);
        $layout->render();
    }

    public function saveAction()
    {
        $categoryModel = Mage::getModel('category');
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
        try{
        $categoryModel = Mage::getModel('category');
        if ($id = $this->getRequest()->get('id')) {
            $categoryModel->load($id);
        }
        $layout = Mage::getBlock('layout');
        $layout->setTemplate('layout');
        $content = $layout->getChild('content');
        $edit = Mage::getBlock('categories/edit');
        $content->addChild('edit', $edit);
        $edit->setData(['category' => $categoryModel]);
        $layout->render();
    }catch(Exception $e){
        echo $e->getMessage();
    }
    }

    public function deleteAction()
    {
        $categoryModel = Mage::getModel('category');
        if ($id = $this->getRequest()->get('id')) {
            $categoryModel->load($id);
            $categoryModel->delete();
        }
        $this->redirect('list', 'category');
    }
}

?>