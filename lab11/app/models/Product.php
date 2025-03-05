<?php
namespace App\Models;

use Core\Database;
use PDO;

class Product {
    protected $conn;
    protected $table = 'products'; // Define table name as a property

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (name, description, price, category_id, image) 
                                      VALUES (:name, :description, :price, :category_id, :image)");
        return $stmt->execute($data);
    }

    public function getCategories() {
        $stmt = $this->conn->prepare("SELECT id, name FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data, $id) {
        $data['id'] = $id;
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET name = :name, description = :description, price = :price, 
                                      category_id = :category_id, image = :image WHERE id = :id");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function productExistsInCategory($name, $categoryId, $productId = null) {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE name = :name AND category_id = :categoryId";
        
        // إذا كان productId موجودًا (أي إذا كان التعديل وليس الإنشاء)، نضيف شرط استبعاد المنتج الحالي من التحقق
        if ($productId) {
            $query .= " AND id != :productId"; // استبعاد المنتج الحالي من التحقق
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':categoryId', $categoryId);
    
        // إذا كان productId موجودًا، نمرره أيضًا
        if ($productId) {
            $stmt->bindParam(':productId', $productId);
        }
    
        $stmt->execute();
    
        // إذا كان العدد أكبر من 0، فهذا يعني أن المنتج بنفس الاسم موجود في نفس القسم
        return $stmt->fetchColumn() > 0;
    }
    
    
}
