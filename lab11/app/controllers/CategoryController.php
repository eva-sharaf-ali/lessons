<?php
namespace App\Controllers;

use App\Models\Category;
use App\Models\Product; // استدعاء موديل المنتج
use Core\Controller;

class CategoryController extends Controller {

    private $basePath;

    public function __construct() {
        $this->basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }

    // عرض جميع الأقسام
    public function index() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('categories/index', ['categories' => $categories]);
    }

    // إنشاء قسم جديد
    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $categoryModel = new Category();
            $productModel = new Product(); // استدعاء موديل المنتج للتحقق

            // تحقق مما إذا كان القسم موجودًا بالفعل
            if ($categoryModel->getByName($name)) {
                $errors['name'] = 'هذا القسم موجود بالفعل.';
            }

            // تحقق مما إذا كان هناك منتج بنفس الاسم
            if ($productModel->getByName($name)) {
                $errors['name'] = 'لا يمكن إضافة هذا القسم لأنه يوجد منتج بنفس الاسم.';
            }

            if (empty($errors)) {
                $data = ['name' => $name];

                if ($categoryModel->create($data)) {
                    header('Location: ' . $this->basePath . '/categories');
                    exit;
                }
            }
        }

        $this->view('categories/create', ['errors' => $errors]);
    }

    // تعديل القسم
    public function edit($id) {
        $categoryModel = new Category();
        $productModel = new Product();
        $category = $categoryModel->getById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);

            // تحقق مما إذا كان الاسم الجديد موجودًا بالفعل لقسم آخر
            $existingCategory = $categoryModel->getByName($name);
            if ($existingCategory && $existingCategory['id'] != $id) {
                $errors['name'] = 'هذا القسم موجود بالفعل.';
            }

            // تحقق مما إذا كان هناك منتج بنفس الاسم
            if ($productModel->getByName($name)) {
                $errors['name'] = 'لا يمكن تعديل هذا القسم لأن هناك منتجًا بنفس الاسم.';
            }

            if (empty($errors)) {
                $data = ['name' => $name];

                if ($categoryModel->update($data, $id)) {
                    header('Location: ' . $this->basePath . '/categories');
                    exit;
                }
            }
        }

        $this->view('categories/edit', ['category' => $category, 'errors' => $errors]);
    }

    // حذف القسم
    public function delete($id) {
        $categoryModel = new Category();
        if ($categoryModel->delete($id)) {
            header('Location: ' . $this->basePath . '/categories');
            exit;
        }
    }
}
