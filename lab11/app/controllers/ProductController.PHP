<?php
namespace App\Controllers;

use App\Models\Product; // تغيير إلى Product
use App\Models\Category; // إضافة استخدام نموذج Category
use Core\Controller;

class ProductController extends Controller {

    private $basePath;

    public function __construct() {
        // Dynamically get the base path
        $this->basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }

    // Read all products
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category(); // إضافة نموذج Category
        $products = $productModel->getAll();
        $categories = $categoryModel->getAll(); // جلب جميع الأقسام
        
        $this->view('products/index', ['products' => $products, 'categories' => $categories]);
    }

    // Create a product (Form)
    public function create() {
        $productModel = new Product();
        $categoryModel = new Category(); // إنشاء نموذج Category
        $categories = $categoryModel->getAll(); // جلب جميع الأقسام

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category_id']
            ];

            // Validate data
            $errors = $this->validateProductData($data);
            if (empty($errors)) {
                // التحقق من وجود ملف مرفوع
                $imagePath = null;
                if (!empty($_FILES['image']['name'])) {
                    $targetDir = "uploads/"; // مجلد حفظ الصور
                    $imageName = time() . "_" . basename($_FILES["image"]["name"]); // تغيير اسم الصورة لتجنب التكرار
                    $targetFilePath = $targetDir . $imageName;

                    // السماح بأنواع معينة من الملفات فقط
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                    if (in_array($fileType, $allowedTypes)) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                            $imagePath = $targetFilePath;
                        } else {
                            die("Error uploading the file.");
                        }
                    } else {
                        die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
                    }
                }

                $data['image'] = $imagePath; // حفظ المسار الصحيح للصورة

                // تحقق من وجود المنتج بنفس الاسم في نفس القسم
                if ($productModel->productExistsInCategory($data['name'], $data['category_id'])) {
                    $errors['name'] = 'المنتج موجود بالفعل في هذا القسم.';
                }

                if (empty($errors)) {
                    if ($productModel->create($data)) {
                        header('Location: ' . $this->basePath . '/products');
                        exit;
                    }
                }
            }

            // تمرير الأخطاء والبيانات إلى الصفحة
            $this->view('products/create', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
        }

        $this->view('products/create', ['categories' => $categories]);
    }

    // Edit a product (Form)
    public function edit($id) {
        $productModel = new Product();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $product = $productModel->getById($id);

        // حفظ المسار القديم للصورة إذا لم يتم رفع صورة جديدة
        $imagePath = $product['image']; // حفظ المسار القديم للصورة

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category_id']
            ];

            // Validate data
            $errors = $this->validateProductData($data, $id);
            if (empty($errors)) {
                // التحقق من وجود صورة جديدة
                if (!empty($_FILES['image']['name'])) {
                    $targetDir = "uploads/"; 
                    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
                    $targetFilePath = $targetDir . $imageName;

                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                    if (in_array($fileType, $allowedTypes)) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                            $imagePath = $targetFilePath; // حفظ المسار الجديد للصورة
                        } else {
                            die("Error uploading the file.");
                        }
                    } else {
                        die("Invalid file type.");
                    }
                }

                $data['image'] = $imagePath; // استخدام المسار الصحيح للصورة

                // تحقق من وجود المنتج بنفس الاسم في نفس القسم
                if ($productModel->productExistsInCategory($data['name'], $data['category_id'], $id)) {
                    $errors['name'] = 'المنتج موجود بالفعل في هذا القسم.';
                }

                if (empty($errors)) {
                    if ($productModel->update($data, $id)) {
                        header('Location: ' . $this->basePath . '/products');
                        exit;
                    }
                }
            }

            // تمرير الأخطاء والبيانات إلى الصفحة
            $this->view('products/edit', ['product' => $product, 'categories' => $categories, 'errors' => $errors, 'data' => $data]);
        }

        $this->view('products/edit', ['product' => $product, 'categories' => $categories]);
    }

    // Validate product data
    private function validateProductData($data, $productId = null) {
        $errors = [];

        // Validate product name
        if (empty($data['name'])) {
            $errors['name'] = 'اسم المنتج مطلوب.';
        }

        // Validate product price
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            $errors['price'] = 'السعر يجب أن يكون رقمًا موجبًا.';
        }

        // Validate category
        if (empty($data['category_id'])) {
            $errors['category_id'] = 'يجب تحديد القسم.';
        }

        return $errors;
    }

    // Delete a product
    public function delete($id) {
        $productModel = new Product();
        if ($productModel->delete($id)) {
            header('Location: ' . $this->basePath . '/products');
            exit;
        }
    }
}
