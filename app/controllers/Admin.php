<?php
require_once 'app/models/Admin.php';
require_once 'app/controllers/Core/Base.php';
class Controller_Admin extends Controller_Core_Base
{
    public function listAction()
    {
        try {
            $adminModel = Mage::getModel('admin');
            $sql = "SELECT * FROM admin";
            $admins = $adminModel->fetchAll($sql);
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $list = Mage::getBlock('admin/list');
            $content->addChild('list', $list);
            $list->setData($admins);
            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function saveAction()
    {
        try {
            $adminModel = Mage::getModel('admin');
            if ($id = $this->getRequest()->get('id')) {
                $adminModel->load($id);
            }
            $data = $this->getRequest()->post('admin');
            if ($data) {
                foreach ($data as $key => $value) {
                    $adminModel->$key = $value;
                }
                $adminModel->save();
            }
            $this->redirect('list', 'admin');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editAction()
    {
        try {
            $adminModel = Mage::getModel('admin');
            if ($id = $this->getRequest()->get('id')) {
                $adminModel->load($id);
            }
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $edit = Mage::getBlock('admin/edit');
            $content->addChild('edit', $edit);
            $edit->setData(['admin' => $adminModel]);
            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        try {
            $adminModel = Mage::getModel('admin');
            if ($id = $this->getRequest()->get('id')) {
                $adminModel->load($id);
                $adminModel->delete();
            }
            $this->redirect('list', 'admin');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function loginAction()
    {
        try {
            $adminModel = Mage::getModel('admin');
            $username = $this->getRequest()->post('username');
            $password = $this->getRequest()->post('password');
            if ($this->getRequest()->isPost()) {
                if($username && $password && $adminModel->login($username, $password)){
                    $session = new Model_Core_Session();
                    $session->setSession('admin_id', $adminModel->admin_id);
                    $this->redirect('list', 'admin');
                    return;
                } else {
                    echo "<div>Invalid username or password</div>";
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $layout = $this->getLayout();
        $layout->setTemplate('emptylayout');
        $content = $layout->getChild('content');
        $login = Mage::getBlock('login');
        $content->addChild('login', $login);
        $layout->render();
    }

    public function logoutAction(){
        require_once 'app/models/Core/Session.php';
        $session = new Model_Core_Session();
        $session->removeSession('admin_id');
        $session->destroySession();
        $this->redirect('login', 'admin');
    }
}