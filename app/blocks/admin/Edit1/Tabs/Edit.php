<?php
class Block_Admin_Edit1_Tabs_Edit extends Block_Core_Template
{
    protected $form = [
        'action' => '',
        'method' => 'post'
    ];
    protected $fields = [];
    protected $buttons = [];

    public function __construct()
    {
        $this->setTemplate("admin/edit1/tabs/edit");
        $text = Mage::getBlock('admin/edit1/tabs/edit/text');
        $textarea = Mage::getBlock('admin/edit1/tabs/edit/textarea');
        $select = Mage::getBlock('admin/edit1/tabs/edit/select');
        $password = Mage::getBlock('admin/edit1/tabs/edit/password');
        $this->addChild('text', $text);
        $this->addChild('textarea', $textarea);
        $this->addChild('select', $select);
        $this->addChild('password', $password);
        $this->prepareForm();
    }

    public function prepareForm()
    {
        $this->setForm($this->getUrl('save'), 'post');
        $this->addField('username', 'Username', 'text', true);
        $this->addField('password', 'Password', 'password', true);
        $this->addField('email', 'Email', 'text', true);
        $this->addField('status', 'Status', 'select', true, '1', ['1' => 'Enable', '0' => 'Disable']);
        $this->addButton('save', 'submit', $this->getUrl('save'));
        $this->addButton('back', 'submit', $this->getUrl('list', 'admin', [], true));

    }

    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function addField($code, $label, $type, $isRequired = false, $defaultValue = null, $options = [], $params = [])
    {
        $this->fields[] = [
            'code' => $code,
            'label' => $label,
            'type' => $type,
            'isRequired' => $isRequired,
            'options' => $options,
            'defaultValue' => $defaultValue,
            'params' => $params,
        ];
        return $this;
    }

    public function getField($code)
    {
        foreach ($this->fields as $field) {
            if ($field['code'] == $code) {
                return $field;
            }
        }
        return null;
    }

    public function getFields()
    {
        if (empty($this->fields)) {
            return [];
        }
        return $this->fields;
    }

    public function removeFields($code)
    {
        unset($this->fields[$code]);
    }

    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
        return $this;
    }

    public function addButton($label, $type, $url, $params = [])
    {
        $this->buttons[] = [
            'label' => $label,
            'type' => $type,
            'url' => $url,
            'params' => $params,
        ];
        return $this;
    }

    public function getButton($label)
    {
        foreach ($this->buttons as $button) {
            if ($button['label'] == $label) {
                return $button;
            }
        }
        return null;
    }

    public function getButtons()
    {
        if (empty($this->buttons)) {
            return [];
        }
        return $this->buttons;
    }

    public function removeButton($code)
    {
        unset($this->buttons[$code]);
    }

    public function setForm($url, $method, $enctype = null, $params = [])
    {
        $this->form = [
            'action' => $url,
            'method' => $method,
            'enctype' => $enctype,
            'params' => $params,
        ];
        return $this;
    }

    public function getForm()
    {
        if (empty($this->form)) {
            return [];
        }
        return $this->form;
    }

    public function getRow()
    {
        return $this->getParent()->getParent()->getRow();
    }
}
?>