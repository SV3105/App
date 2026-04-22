<?php
require_once 'app/blocks/Layout.php';
class Controller_Core_Base
{

    protected $request = null;
    protected $message = null;

    public function getLayout()
    {
        return Mage::getBlock('layout');
    }

    public function setLayout($layout)
    {
        Mage::getBlock($layout);

    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this->request;
    }

    public function getRequest()
    {
        if ($this->request) {
            return $this->request;
        }
        $request = Mage::getModel('core/request');
        $this->request = $request;
        return $this->request;
    }

    public function redirect($a = null, $c = null, $params = [], $reset = false)
    {
        $url = Mage::getModel('core/url')->getUrl($a, $c, $params, $reset);
        header("Location: " . $url);
        exit();
    }

    public function dispatch()
    {
        $this->preDispatch();
        $action = $this->getRequest()->get("a", "list");
        $action = $action . "Action";
        $this->$action();

    }

    public function getMessage()
    {
        if ($this->message) {
            return $this->message;
        }
        $this->message = Mage::getModel('core/message');
        return $this->message;
    }
    public function preDispatch()
    {
        $session = new Model_Core_Session();
        $c = $this->getRequest()->get('c');
        $a = $this->getRequest()->get('a');

        if ($session->getSession('admin_id')) {
            if ($c == 'admin' && $a == 'login') {
                $this->redirect('list', 'admin');
            }
            return;
        }

        if ($c == 'admin' && $a == 'login') {
            return;
        }

        $this->redirect('login', 'admin');
    }


    public function renderTemplate($template, $data = [])
    {
        extract($data);

        $templatePath = 'app/templates/' . $template;

        if (!file_exists($templatePath)) {
            die("Template not found: " . $templatePath);
        }

        include $templatePath;
    }

}

?>