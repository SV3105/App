<?php
require_once 'app/blocks/Layout.php';
class Controller_Core_Base
{

    protected $request = null;

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
        $request = Mage::getModel('request');
        $this->request = $request;
        return $this->request;
    }

    public function redirect($a = null, $c = null, $params = [])
    {
        if (!$a) {
            $a = $this->getRequest()->get("a");
        }
        if (!$c) {
            $c = $this->getRequest()->get("c");
        }
        if (empty($params)) {
            $query = http_build_query(['c' => $c, 'a' => $a]);
        } else {
            $query = http_build_query(array_merge(['c' => $c, 'a' => $a], $params));
        }
        header("Location: index.php?" . $query);
        exit();
    }

    public function dispatch()
    {
        $this->preDispatch();
        $action = $this->getRequest()->get("a", "list");
        $action = $action . "Action";
        $this->$action();

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