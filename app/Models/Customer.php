<?php 
require_once 'app/models/Core/Table.php';
class Model_Customer extends Model_Core_Table {
    
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function __construct(){
        parent::__construct();
        $this->tableName = "customer";
        $this->primaryKey = "customer_id";
        $this->addParent('customer_group',Mage::getModel('customer_group'));
    }
    
    public function insert(){
        $this->data['created_date'] = date('Y-m-d H:i:s');

        return parent::insert();
    }

    public function update(){
        $this->data['updated_date'] = date('Y-m-d H:i:s');

        return parent::update();
    }


    public function getStatusOption(){
        return [
            self::STATUS_ENABLED => 'Enabled',
            self::STATUS_DISABLED => 'Disabled'
        ];
    }

    public function getStatus(){
        if(!array_key_exists($this->status, $this->getStatusOption())){
            return null;
        }
        return $this->getStatusOption()[$this->status];
    }
}
?>