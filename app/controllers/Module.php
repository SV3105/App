<?php 
class Controller_Module extends Controller_Core_Base{
    public function listAction(){
        try{
            $moduleModel = Mage::getModel('module');
            $sql = "SELECT * FROM module";
            $module = $moduleModel->fetchAll($sql);
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $list = Mage::getBlock('module/list');
            $content->addChild('list', $list);
            $list->setData(['modules' => $module]);
            $layout->render();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function saveAction(){
        try{
            $moduleModel = Mage::getModel('module');
            $data = $this->getRequest()->post('module');
            if ($data) {
                foreach ($data as $key => $value) {
                    $moduleModel->$key = $value;
                }
                $moduleModel->save();
            }
            $this->redirect('list', 'module');
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function editAction(){
        try{
            $moduleModel = Mage::getModel('module');
            if ($id = $this->getRequest()->get('id')) {
                $moduleModel->load($id);
            }
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $edit = Mage::getBlock('module/edit');
            $content->addChild('edit', $edit);
            $edit->setData(['module' => $moduleModel]);
            $layout->render();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function deleteAction(){
        try{
            $moduleModel = Mage::getModel('module');
            if ($id = $this->getRequest()->get('id')) {
                $moduleModel->load($id);
                $moduleModel->delete();
            }
            $this->redirect('list', 'module');
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>