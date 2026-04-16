<?php 
require_once 'app/models/Menu.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Menu extends Controller_Core_Base
{

    public function listAction()
    {
        try{
        $menuModel = Mage::getModel('menu');
        $sql = "SELECT * FROM menu";
        $menus = $menuModel->fetchAll($sql);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $list = Mage::getBlock('menus/list');
        $content->addChild('list', $list);
        $list->setData(['menus' => $menus]);
        $layout->render();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveAction()
    {
        try{
        $menuModel = Mage::getModel('menu');
        if ($id = $this->getRequest()->get('id')) {
            $menuModel->load($id);
        }
        $data = $this->getRequest()->post('menu');
        foreach ($data as $key => $value) {
            $menuModel->$key = $value;
        }
        $menuModel->save();
        $this->redirect('list', 'menu');
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function editAction()
    {
        try{
        $menuModel = Mage::getModel('menu');
        if ($id = $this->getRequest()->get('id')) {
            $menuModel->load($id);
        }
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $edit = Mage::getBlock('menus/edit');
        $content->addChild('edit', $edit);
        $edit->setData(['menu' => $menuModel]);
        $layout->render();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        try{
        $menuModel = Mage::getModel('menu');
        if ($id = $this->getRequest()->get('id')) {
            $menuModel->load($id);
            $menuModel->delete();
        }
        $this->redirect('list', 'menu');
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>