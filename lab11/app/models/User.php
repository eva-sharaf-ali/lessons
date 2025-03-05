<?php
namespace App\Models;

use Core\Database;
use PDO;

class User {
    protected $conn;
    protected $table = 'users'; // تعريف اسم الجدول كخاصية

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // تأكد من أن جميع الحقول المطلوبة موجودة في المصفوفة
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (first_name, last_name, email, password, birth_date, role, phone) 
                                      VALUES (:first_name, :last_name, :email, :password, :birth_date, :role, :phone)");
    
        // تعيين الدور الافتراضي إذا لم يكن موجودًا
        if (!isset($data['role'])) {
            $data['role'] = 'user'; 
        }
    
        // تشفير كلمة المرور
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    
        // سجل البيانات للتحقق
        error_log(print_r($data, true)); // هذا سيسجل البيانات في ملف السجل
        var_dump($data);
    
        // إزالة المتغيرات الزائدة
        unset($data['created_at']); // تأكد من عدم وجود created_at في المصفوفة
    
        // تنفيذ الاستعلام
        if (!$stmt->execute($data)) {
            // إذا فشل التنفيذ، احصل على رسالة الخطأ
            $errorInfo = $stmt->errorInfo();
            error_log("Error executing query: " . print_r($errorInfo, true));
            return false; // أو يمكنك رمي استثناء
        }
    
        return true; // أو يمكنك إرجاع ID المستخدم الجديد
    }

    public function update($data, $id) {
        $data['id'] = $id; // إضافة ID المستخدم
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET first_name = :first_name, last_name = :last_name, email = :email, 
                                       birth_date = :birth_date, role = :role, phone = :phone WHERE id = :id");
    
        // تعيين الدور الافتراضي إذا لم يكن موجودًا
        if (!isset($data['role'])) {
            $data['role'] = 'user'; 
        }
    
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function emailExists($email, $userId = null) {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE email = :email";
        if ($userId) {
            $query .= " AND id != :userId"; // استبعاد المستخدم الحالي إذا كان موجودًا
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        if ($userId) {
            $stmt->bindParam(':userId', $userId);
        }
        $stmt->execute();

        return $stmt->fetchColumn() > 0; // إذا كان العدد أكبر من 0، فهذا يعني أن البريد موجود
    }
}
?>