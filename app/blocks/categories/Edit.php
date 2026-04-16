<?php
require_once "app/blocks/core/Template.php";
class Block_Categories_Edit extends Block_Core_Template{
    public function __construct(){
        $this->setTemplate('categories/edit');
    }

    public function getCategories()
    {
        $categoryModel = Mage::getModel('category');
        $sql = "SELECT * FROM category";
        return $categoryModel->fetchAll($sql);
    }

    public function getCategoriesWithNames()
    {
        $categories = $this->getCategories();
        if (!$categories) {
            return [];
        }

        $idToName = [];
        foreach ($categories as $cat) {
            $idToName[$cat->category_id] = $cat->name;
        }

        foreach ($categories as $cat) {
            $pathIds = explode('/', $cat->path_id);
            $namePath = [];
            foreach ($pathIds as $id) {
                if (isset($idToName[$id])) {
                    $namePath[] = $idToName[$id];
                }
            }
            if (empty($namePath)) {
                $cat->name_path = $cat->name;
            } else {
                $cat->name_path = implode(' / ', $namePath);
            }
        }

        return $categories;
    }
}
?>
