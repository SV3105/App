<?php 
class Block_Admin_Edit1_Tabs_Edit_Select extends Block_Core_Template {
    public function __construct() {
        $this->setTemplate("admin/edit1/tabs/edit/select");
    }

    public function getValue(){
        $row = $this->getParent()->getRow();
        $field = $this->getData('field');
        if($field && isset($field['code'])){
            $code = $field['code'];
            return $row->$code;
        }
        return null;
    }
}
?>