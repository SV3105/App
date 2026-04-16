<?php
class Controller_Tab extends Controller_Core_Base
{
    public function listAction()
    {
        try {
            $tabModel = Mage::getModel('tab');
            $sql = "SELECT t.*, m.name as module_name FROM module_tab t LEFT JOIN module m ON t.module_id = m.module_id";
            $tab = $tabModel->fetchAll($sql) ?: [];
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $list = Mage::getBlock('tab/list');
            $content->addChild('list', $list);
            $list->setData(['tabs' => $tab]);
            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function saveAction()
    {
        try {
            $tabModel = Mage::getModel('tab');
            $data = $this->getRequest()->post('tab');
            if ($data) {
                foreach ($data as $key => $value) {
                    $tabModel->$key = $value;
                }
                $tabModel->save();
            }
            $this->redirect('list', 'tab');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function editAction()
    {
        try {
            $tabModel = Mage::getModel('tab');
            if ($id = $this->getRequest()->get('id')) {
                $tabModel->load($id);
            }
            $layout = $this->getLayout();
           
            $edit = Mage::getBlock('tab/edit');
            $edit->setTab($tabModel);
            $content = $layout->getChild('content');
            $content->addChild('edit', $edit);
            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteAction()
    {
        try {
            $tabModel = Mage::getModel('tab');
            if ($id = $this->getRequest()->get('id')) {
                $tabModel->load($id);
                $tabModel->delete();
            }
            $this->redirect('list', 'tab');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>