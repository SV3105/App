<?php 
require_once 'app/Models/Core/Row.php';
class Model_Category extends Model_Core_Row {
    public function __construct(){
        parent::__construct();
        $this->tableName = "category";
        $this->primaryKey = "category_id";
    }
    
    public function insert(){
        $this->data['created_date'] = date('Y-m-d H:i:s');

        return parent::insert();
    }

    public function update(){
        $this->data['updated_date'] = date('Y-m-d H:i:s');

        return parent::update();
    }
}
?>