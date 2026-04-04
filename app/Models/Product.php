<?php 
require_once 'app/Models/Core/Row.php';
class Model_Product extends Model_Core_Row {
    public function __construct($db){
        parent::__construct($db);
        $this->tableName = "product";
        $this->primaryKey = "product_id";
    }
    
    public function insert(){
        $this->data['created_date'] = date('Y-m-d H:i:s');

        return parent::insert();
    }
}
?>