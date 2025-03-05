<?php
namespace App\Controllers;

use App\Models\Category; // تغيير إلى Category
use Core\Controller;

class CategoryController extends Controller {

    private $basePath;

    public function __construct() {
        // Dynamically get the base path
        $this->basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }

    // Read all categories
    public function index() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('categories/index', ['categories' => $categories]);
    }

    // Create a category (Form)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name']
            ];

            // Validate data
            $errors = $this->validateCategoryData($data);
            if (empty($errors)) {

                if ($categoryModel->update($data, $id)) {
                    header('Location: ' . $this->basePath . '/categories');
                    exit;
                }
            }

            // Handle errors (you can pass them to the view)
            $this->view('categories/create', ['errors' => $errors, 'data' => $data]);
        }
        
        $this->view('categories/create');
    }

    // Edit a category (Form)
    public function edit($id) {
        $categoryModel = new Category();
        $category = $categoryModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name']
            ];

            // Validate data
            $errors = $this->validateCategoryData($data, $id);
            if (empty($errors)) {

                if ($categoryModel->update($data, $id)) {
                    header('Location: ' . $this->basePath . '/categories');
                    exit;
                }
            }

            // Handle errors (you can pass them to the view)
            $this->view('categories/edit', ['category' => $category, 'errors' => $errors, 'data' => $data]);
        }
           

        $this->view('categories/edit', ['category' => $category]);
    }

    private function validateCategoryData($data, $categoryId = null) {
        $errors = [];
    
        // Validate category name
        if (empty($data['name'])) {
            $errors['name'] = 'اسم القسم مطلوب.';
        } else {
            $categoryModel = new Category();
            if ($categoryModel->categoryExists($data['name'], $categoryId)) {
                $errors['name'] = 'اسم القسم موجود بالفعل.';
            }
        }
    
        return $errors;
    }
    

    // Delete a category
    public function delete($id) {
        $categoryModel = new Category();
        if ($categoryModel->delete($id)) {
            header('Location: ' . $this->basePath . '/categories');
            exit;
        }
    }
}