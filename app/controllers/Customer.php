<?php
require_once 'app/Models/Customer.php';
require_once 'app/Models/Customergroup.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Customer extends Controller_Core_Base
{

    public function listAction()
    {
        $customerModel = new Model_Customer();
        $sql = "SELECT c.*, cg.group_name FROM customer c LEFT JOIN customer_group cg ON c.customer_group_id = cg.customer_group_id ";
        $customers = $customerModel->fetchAll($sql);
        $this->renderTemplate('customers/list.phtml', [
            'customers' => $customers
        ]);
    }

    public function saveAction()
    {
        $customerModel = new Model_Customer();
        if ($id = $this->getRequest()->get('id')) {
            $customerModel->load($id);
        }
        $data = $this->getRequest()->post('customer');
        foreach ($data as $key => $value) {
            $customerModel->$key = $value;
        }
        $customerModel->save();
        $this->redirect('list', 'customer');
    }

    public function editAction()
    {
        $customerModel = new Model_Customer();
        if ($id = $this->getRequest()->get('id')) {
            $customerModel->load($id);
        }
        $groupModel = new Model_Customergroup();
        $groups = $groupModel->fetchAll("SELECT * FROM customer_group");

        $this->renderTemplate('customers/edit.phtml', [
            'customers' => $customerModel,
            'customerGroups' => $groups
        ]);
    }

    public function deleteAction()
    {
        $customerModel = new Model_Customer();
        if ($id = $this->getRequest()->get('id')) {
            $customerModel->load($id);
            $customerModel->delete();
        }
        $this->redirect('list', 'customer');
    }
}

?>