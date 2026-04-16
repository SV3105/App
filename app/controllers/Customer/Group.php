<?php
require_once 'app/models/Customer/Group.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Customer_Group extends Controller_Core_Base
{

    public function listAction()
    {
        $customerGroupModel = Mage::getModel('customer/group');
        $sql = "SELECT * FROM customer_group";
        $customer_groups = $customerGroupModel->fetchAll($sql);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $list = Mage::getBlock('customer/group/list');
        $content->addChild('list', $list);
        $list->setData($customer_groups);
        $layout->render();
    }

    public function saveAction()
    {
        $customerGroupModel = Mage::getModel('customer/group');
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
        $customerGroupModel = Mage::getModel('customer/group');
        if ($id = $this->getRequest()->get('id')) {
            $customerGroupModel->load($id);
        }
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $edit = Mage::getBlock('customer/group/edit');
        $content->addChild('edit', $edit);
        $edit->setData(['customer_group' => $customerGroupModel]);
        $layout->render();
    }

    public function deleteAction()
    {
        $customerGroupModel = Mage::getModel('customer/group');
        if ($id = $this->getRequest()->get('id')) {
            $customerGroupModel->load($id);
            $customerGroupModel->delete();
        }
        $this->redirect('list', 'customer_group');
    }
}

?>