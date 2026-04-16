<?php
require_once 'app/models/Customer.php';
require_once 'app/models/Customer/Group.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Customer extends Controller_Core_Base
{

    public function listAction()
    {
        $customerModel = Mage::getModel('customer');
        $sql = "SELECT c.*, cg.group_name FROM customer c LEFT JOIN customer_group cg ON c.customer_group_id = cg.customer_group_id ";
        $customers = $customerModel->fetchAll($sql);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $list = Mage::getBlock('customers/list');
        $content->addChild('list', $list);
        $list->setData($customers);
        $layout->render();
        
    }

    public function saveAction()
    {
        $customerModel = Mage::getModel('customer');
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
        $customerModel = Mage::getModel('customer');
        if ($id = $this->getRequest()->get('id')) {
            $customerModel->load($id);
        }

       $layout = $this->getLayout();
       $content = $layout->getChild('content');
       $edit = Mage::getBlock('customers/edit');
       $content->addChild('edit', $edit);
       $edit->setCustomers($customerModel);
       $layout->render();
    }

    public function deleteAction()
    {
        $customerModel = Mage::getModel('customer');
        if ($id = $this->getRequest()->get('id')) {
            $customerModel->load($id);
            $customerModel->delete();
        }
        $this->redirect('list', 'customer');
    }
}

?>