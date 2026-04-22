<?php
class Block_Admin_Edit1_Tabs extends Block_Core_Template
{

    public function __construct()
    {
        $this->setTemplate("admin/edit1/tabs");
        
    }

    public function getTabs()
    {
        $module_code = $this->getParent()->getModule();
        $query = "select mt.* from module_tab mt join module m on mt.module_id = m.module_id where m.code = '$module_code'";
        $tab = Mage::getModel('tab')->fetchAll($query);
        return $tab;

    }

    public function getActiveTab()
    {
        $tabId = $this->getRequest()->get('tab');
        $tabs = $this->getTabs();

        if ($tabId) {
            foreach ($tabs as $tab) {
                if ($tab->tab_id == $tabId) {
                    return $tab;
                }
            }
        }
        foreach ($tabs as $tab) {
            if ($tab->default == 1) {
                return $tab;
            }
        }
    }

    public function getTabContent()
    {   
        $activeTab = $this->getActiveTab();
        if ($activeTab) {
            $blockClass = $activeTab->block;
            $block = Mage::getBlock($blockClass);
            $blockClass = strtolower($blockClass);
            $block = $this->addChild($activeTab->name, $block);
            return $block->render();
            }
    }
}
?>