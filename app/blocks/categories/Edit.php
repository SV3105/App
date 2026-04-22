<?php
require_once "app/blocks/core/Template.php";
class Block_Categories_Edit extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('categories/edit');
    }

    public function getCategories()
    {
        $categoryModel = Mage::getModel('category');
        $sql = "SELECT * FROM category ORDER BY path_id ASC";
        return $categoryModel->fetchAll($sql);
    }

    public function getCategoriesWithNames()
    {
        $categories = $this->getCategories();
        if (!$categories) {
            return [];
        }

        foreach ($categories as $cat) {
            $cat->name_path = $cat->getNamePath();
        }

        return $categories;
    }
}
?>
