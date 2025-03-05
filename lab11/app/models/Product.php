<?php
namespace App\Models;

use Core\Database;
use PDO;

class Product {
    protected $conn;
    protected $table = 'products'; // اسم الجدول

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
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByName($name) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE name = :name LIMIT 1");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data, $id) {
        // جلب بيانات المنتج الحالي للتحقق من الصورة
        $product = $this->getById($id);
        
        // الاحتفاظ بالصورة القديمة إذا لم يتم رفع صورة جديدة
        if (empty($data['image'])) {
            $data['image'] = $product['image'];
        }

        $stmt = $this->conn->prepare("UPDATE {$this->table} SET name = :name, description = :description, price = :price, 
                                      category_id = :category_id, image = :image WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
