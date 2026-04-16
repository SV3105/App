<?php 
require_once 'app/models/Core/Table.php';
class Model_Product_Media extends Model_Core_Table {
    public function __construct(){
        parent::__construct();
        $this->tableName = "product_media";
        $this->primaryKey = "product_media_id";
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