<?php 
require_once 'app/Models/Customergroup.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Customergroup extends Controller_Core_Base
{

    public function listAction()
    {
        $customerGroupModel = new Model_Customergroup();
        $sql = "SELECT * FROM customer_group";
        $customerGroups = $customerGroupModel->fetchAll($sql);
          $this->renderTemplate('customer_groups/list.phtml', [
            'customerGroups' => $customerGroups
        ]);
    }

    public function saveAction()
    {
        $customerGroupModel = new Model_Customergroup();
        if ($id = $this->getRequest()->get('id')) {
            $customerGroupModel->load($id);
        }
        $data = $this->getRequest()->post('customer_group');
        if ($data) {
            foreach ($data as $key => $value) {
                $customerGroupModel->$key = $value;
            }
            $customerGroupModel->save();
        }
        $this->redirect('list', 'customer_group');
    }

    public function editAction()
    {
        $customerGroupModel = new Model_Customergroup();
        if ($id = $this->getRequest()->get('id')) {
            $customerGroupModel->load($id);
        }
         $this->renderTemplate('customer_groups/edit.phtml', [
            'customerGroup' => $customerGroupModel
        ]);
    }

    public function deleteAction()
    {
        $customerGroupModel = new Model_Customergroup();
        if ($id = $this->getRequest()->get('id')) {
            $customerGroupModel->load($id);
            $customerGroupModel->delete();
        }
        $this->redirect('list', 'customer_group');
    }
}

?>