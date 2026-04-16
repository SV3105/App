<?php
require_once "app/blocks/core/Template.php";
class Block_Customers_Edit extends Block_Core_Template{
    protected $customers;
    public function __construct(){
        $this->setTemplate('customers/edit');

    }

    public function setCustomers($customers){
        $this->customers = $customers;
        return $this;
    }

    public function getCustomers(){
        return $this->customers;
    }

    public function getCustomerGroups(){
        $customer_group = $this->getCustomers()->getParent('customer_group');
        $customer_groups = $customer_group->fetchAll('select * from customer_group');
        return $customer_groups;
    }
}
?>
 
