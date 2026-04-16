<?php
require_once 'app/models/Core/Table.php';
class Model_Menu extends Model_Core_Table{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public $tableName = "menu";
    public $primaryKey = "menu_id";

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
