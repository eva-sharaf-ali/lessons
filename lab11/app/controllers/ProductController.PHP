<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use Core\Controller;

class ProductController extends Controller {

    private $basePath;

    public function __construct() {
        $this->basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }

    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();
        $products = $productModel->getAll();
        $categories = $categoryModel->getAll();
        
        $this->view('products/index', ['products' => $products, 'categories' => $categories]);
    }

    public function create() {
        $productModel = new Product();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $errors = [];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);
            $category_id = $_POST['category_id'];
            
            if (empty($name)) {
                $errors['name'] = 'اسم المنتج مطلوب.';
            } elseif ($productModel->getByName($name)) {
                $errors['name'] = 'اسم المنتج موجود بالفعل.';
            }
    
            $imagePath = !empty($_FILES['image']['name']) ? $this->uploadImage($_FILES['image'], $errors) : null;
    
            if (empty($errors)) {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'category_id' => $category_id,
                    'image' => $imagePath
                ];
    
                if ($productModel->create($data)) {
                    header('Location: ' . $this->basePath . '/products');
                    exit;
                }
            }
        }
    
        $this->view('products/create', ['categories' => $categories, 'errors' => $errors]);
    }
    
    public function edit($id) {
        $productModel = new Product();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $product = $productModel->getById($id);
        $errors = [];
    
        $imagePath = $product['image'];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);
            $category_id = $_POST['category_id'];
            
            if (empty($name)) {
                $errors['name'] = 'اسم المنتج مطلوب.';
            } elseif ($existingProduct = $productModel->getByName($name)) {
                if ($existingProduct['id'] != $id) {
                    $errors['name'] = 'اسم المنتج موجود بالفعل.';
                }
            }
    
            if (!empty($_FILES['image']['name'])) {
                $newImagePath = $this->uploadImage($_FILES['image'], $errors);
                if ($newImagePath) {
                    $imagePath = $newImagePath;
                }
            }
    
            if (empty($errors)) {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'category_id' => $category_id,
                    'image' => $imagePath // يتم الاحتفاظ بالصورة القديمة إذا لم يتم رفع صورة جديدة
                ];
    
                if ($productModel->update($data, $id)) {
                    header('Location: ' . $this->basePath . '/products');
                    exit;
                }
            }
        }
    
        $this->view('products/edit', ['product' => $product, 'categories' => $categories, 'errors' => $errors]);
    }
    
    public function delete($id) {
        $productModel = new Product();
        if ($productModel->delete($id)) {
            header('Location: ' . $this->basePath . '/products');
            exit;
        }
    }

    private function uploadImage($file, &$errors) {
        $targetDir = "uploads/";
        $imageName = time() . "_" . basename($file["name"]);
        $targetFilePath = $targetDir . $imageName;
    
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                return $targetFilePath;
            } else {
                $errors['image'] = "حدث خطأ أثناء رفع الصورة.";
            }
        } else {
            $errors['image'] = "نوع الملف غير صالح. فقط JPG، JPEG، PNG، وGIF مسموح بها.";
        }
        return null;
    }
}