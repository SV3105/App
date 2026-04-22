<?php
require_once 'app/models/Category.php';
require_once 'app/controllers/Core/Base.php';

class Controller_Category extends Controller_Core_Base
{
    public function listAction()
    {
        $categoryModel = Mage::getModel('category');
        $sql = "SELECT * FROM category ORDER BY path_id ASC";
        $categories = $categoryModel->fetchAll($sql);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $list = Mage::getBlock('categories/list');
        $content->addChild('list', $list);
        $list->setData($categories);
        $layout->render();
    }

    public function saveAction()
    {
        $categoryModel = Mage::getModel('category');
        $id = $this->getRequest()->get('id');
        if (!$id) {
            $data = $this->getRequest()->post('category');
            $id = isset($data['category_id']) ? $data['category_id'] : null;
        }

        if ($id) {
            $categoryModel->load($id);
        }

        $oldPath = $categoryModel->path_id;
        $data = $this->getRequest()->post('category');

        foreach ($data as $key => $value) {
            $categoryModel->$key = $value;
        }

        if ($categoryModel->parent_id == 0) {
            $categoryModel->path_id = $id ? $id : '';
        } else {
            $parent = Mage::getModel('category')->load($categoryModel->parent_id);
            if ($parent) {
                $categoryModel->path_id = $parent->path_id . '/';
                if ($id) {
                    $categoryModel->path_id .= $id;
                }
            }
        }

        $categoryModel->save();

        if (!$id) {
            $newId = $categoryModel->category_id;
            if ($categoryModel->parent_id == 0) {
                $categoryModel->path_id = $newId;
            } else {
                $categoryModel->path_id .= $newId;
            }
            $categoryModel->save();
        } else {

            if ($oldPath != $categoryModel->path_id) {
                $categoryModel->updateChildPaths($oldPath, $categoryModel->path_id);
            }
        }

        $this->redirect('list', 'category', [], true);
    }

    public function editAction()
    {
        try {
            $categoryModel = Mage::getModel('category');
            if ($id = $this->getRequest()->get('id')) {
                $categoryModel->load($id);
            }
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $edit = Mage::getBlock('categories/edit');
            $content->addChild('edit', $edit);
            $edit->setData(['category' => $categoryModel]);
            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $categoryModel = Mage::getModel('category');
        if ($id = $this->getRequest()->get('id')) {
            $categoryModel->load($id);

            $parentId = $categoryModel->parent_id;
            $oldPath = $categoryModel->path_id;

            $sql = "SELECT * FROM category WHERE parent_id = '$id'";
            $children = $categoryModel->fetchAll($sql);

            if ($children) {
                foreach ($children as $child) {
                    $child->parent_id = $parentId;

                    $oldChildPath = $child->path_id;
                    if ($parentId == 0) {
                        $newChildPath = $child->category_id;
                    } else {
                        $parent = Mage::getModel('category')->load($parentId);
                        $newChildPath = $parent->path_id . '/' . $child->category_id;
                    }

                    $child->path_id = $newChildPath;
                    $child->save();

                    $child->updateChildPaths($oldChildPath, $newChildPath);
                }
            }

            $categoryModel->delete();
        }
        $this->redirect('list', 'category', [], true);
    }
}

?>