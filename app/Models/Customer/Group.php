<?php 
require_once 'app/Models/Core/Row.php';
class Model_Customer_Group extends Model_Core_Row {
    public function __construct(){
        parent::__construct();
        $this->tableName = "customer_group";
        $this->primaryKey = "customer_group_id";
    }
    
    public function insert(){
        $this->data['created_at'] = date('Y-m-d H:i:s');

        return parent::insert();
    }

    public function update(){
        $this->data['updated_at'] = date('Y-m-d H:i:s');

        return parent::update();
    }
}
?>