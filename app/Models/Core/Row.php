<?php


require_once 'Database.php';

    class Model_Core_Row {
        public $tableName = null;
        public $primaryKey = null;
        public $data = [];
        public $db = null;
        
        public function __construct(){
            $this->db = new Model_Core_Database();
        }

        public function load($value, $column = null)
    {
        $column = $column ?? $this->primaryKey;
 
        $query = "select * from {$this->tableName} where $column = '$value' limit 1";
        $row = $this->db->fetchRow($query);
 
        if ($row) {
            $this->data = $row;
            return $this;
        }
        return false;
    }
 
    public function fetchRow($query)
    {
        $result = $this->db->fetchRow($query);
        if ($result) {
            $this->data = $result;
            return $this;
        }
        return false;
    }
 
    public function fetchAll($query)
    {
        $rows = $this->db->fetchAll($query);
        if ($rows) {
            foreach ($rows as $key => $value) {
                $obj = new static();
                $obj->data = $value;
                $rows[$key] = $obj;
            }
            return $rows;
        }
        return false;
    }
 
    public function insert()
    {
        $column = implode(",", array_keys($this->data));
        $values = array_map(function ($v) {
            return "'$v'";
        }, array_values($this->data));
 
        $values = implode(",", $values);
 
        $query = "insert into {$this->tableName} ($column) values ($values)";
        $id = $this->db->insert($query);
 
        if ($id) {
            $this->data[$this->primaryKey] = $id;
            return $this;
        }
 
        return false;
    }
 
    public function update()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return false;
        }
 
        $id = $this->data[$this->primaryKey];
        $data = $this->data;
 
        unset($data[$this->primaryKey]);
 
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key='$value'";
        }
 
        $set = implode(",", $set);
        $query = "update {$this->tableName} set $set where {$this->primaryKey} = $id";
       
        if ($this->db->update($query)) {
            return $this;
        }
        return false;
    }
 
    public function save()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return $this->insert();
        }
        return $this->update();
    }
 
    public function delete()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return false;
        }
 
        $id = $this->data[$this->primaryKey];
        $query = "delete from {$this->tableName} where {$this->primaryKey} = $id";
        return $this->db->delete($query);
    }
 

        public function __set($key, $value){
            $this->data[$key] = $value;
        }

        public function __get($key){
            return array_key_exists($key, $this->data) ? $this->data[$key] : null;
        }

    }
?>