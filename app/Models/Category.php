<?php
require_once 'app/models/Core/Table.php';
class Model_Category extends Model_Core_Table
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    protected static $_allCategoryNames = null;
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "category";
        $this->primaryKey = "category_id";
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

    public function getCategoryParent()
    {
        if (!$this->parent_id) {
            return false;
        }
        $parent = Mage::getModel('category');
        return $parent->load($this->parent_id);
    }

    public function updateChildPaths($oldPath, $newPath)
    {
        $sql = "SELECT * FROM category WHERE path_id LIKE '$oldPath/%'";
        $children = $this->fetchAll($sql);
        if ($children) {
            foreach ($children as $child) {
                $child->path_id = str_replace($oldPath, $newPath, $child->path_id);
                $child->save();
            }
        }
    }

    protected function _loadAllCategoryNames()
    {
        if (self::$_allCategoryNames === null) {
            $sql = "SELECT category_id, name FROM category";
            $all = $this->db->fetchAll($sql);
            self::$_allCategoryNames = [];
            if ($all) {
                foreach ($all as $row) {
                    self::$_allCategoryNames[$row['category_id']] = $row['name'];
                }
            }
        }
    }
  
    protected function _getNamePathArray()
    {
        $pathId = trim($this->path_id ?? '');
        $this->_loadAllCategoryNames();

        if (!$pathId) {
            return [$this->name ?? 'Root'];
        }

        $ids = array_filter(array_map('trim', explode('/', $pathId)));
        
        $names = [];
        foreach ($ids as $id) {
            $names[] = self::$_allCategoryNames[$id] ?? "[ID: $id]";
        }

        return !empty($names) ? $names : [$this->name ?? 'Root'];
    }

    public function getNamePath()
    {
        return implode(' / ', $this->_getNamePathArray());
    }

    public function getPathNames()
    {
        $names = $this->_getNamePathArray();
        array_pop($names);
        return !empty($names) ? implode(' / ', $names) : 'Root';
    }

}
?>