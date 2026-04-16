<?php
class Model_Admin extends Model_Core_Table
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'admin';
        $this->primaryKey = 'admin_id';
    }

    public function insert()
    {
        $this->data['created_date'] = date('Y-m-d H:i:s');

        return parent::insert();
    }

    public function update()
    {
        $this->data['updated_date'] = date('Y-m-d H:i:s');

        return parent::update();
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => 'Enabled',
            self::STATUS_DISABLED => 'Disabled'
        ];
    }

    public function getStatus()
    {
        if (!array_key_exists($this->status, $this->getStatusOption())) {
            return null;
        }
        return $this->getStatusOption()[$this->status];
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE username = '$username' AND password = '$password' AND status = '" . self::STATUS_ENABLED . "'";
        return $this->fetchRow($sql);
    }
}
?>