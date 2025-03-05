<?php
namespace App\Models;

use Core\Database;
use PDO;

class Category {
    protected $conn;
    protected $table = 'categories'; // Define table name as a property

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (name) VALUES (:name)");
        return $stmt->execute($data);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data, $id) {
        $data['id'] = $id;
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function categoryExists($name, $categoryId = null) {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE name = :name";
        if ($categoryId) {
            $query .= " AND id != :categoryId"; // استبعاد القسم الحالي إذا كان موجودًا
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        if ($categoryId) {
            $stmt->bindParam(':categoryId', $categoryId);
        }
        $stmt->execute();
    
        return $stmt->fetchColumn() > 0; // إذا كان العدد أكبر من 0، فهذا يعني أن القسم موجود
    }
    
}