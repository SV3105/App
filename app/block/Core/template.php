<?php
class Block_Core_template
{
    protected $template;
    protected $data = [];

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : null;
    }


    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function toHtml()
    {
        return require __DIR__ . '/../../templates/' . $this->template . '.phtml';
    }
}

?>