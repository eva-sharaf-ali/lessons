<?php
$host = 'localhost';
$db = 'project';
$user = 'root'; // استبدل باسم المستخدم الخاص بك
$pass = ''; // استبدل بكلمة المرور الخاصة بك

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
