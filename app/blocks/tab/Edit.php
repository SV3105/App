<?php

class Block_Tab_Edit extends Block_Core_Template
{
    protected $tab;
    public function __construct()
    {
        $this->setTemplate('tab/edit');
    }

    public function getTab()
    {
        return $this->tab;
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        return $this;
    }

    public function getModules()
    {
        $module = $this->getTab()->getParent('module');
        $modules = $module->fetchAll('select * from module');
        return $modules;
    }

}
?>