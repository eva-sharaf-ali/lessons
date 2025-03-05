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

    public function getByName($name) {
        $sql = "SELECT * FROM categories WHERE name = :name LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // يعيد بيانات القسم إذا وجد، أو NULL إذا لم يوجد
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
}