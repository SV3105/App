<?php
class Block_Core_template
{
    protected $template;
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