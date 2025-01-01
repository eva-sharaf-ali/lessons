<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    // تحقق من صحة البيانات
    if (!preg_match('/^77|78|73d{7}$/', $phone)) {
        $error_message = "رقم الهاتف يجب أن يبدأ بـ 77، 78، أو 73.";
        
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail.com$/', $email)) {
        $error_message = "البريد الإلكتروني غير صحيح.";
    } else {
        // تحقق مما إذا كان البريد الإلكتروني موجودًا بالفعل
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $error_message = "البريد الإلكتروني مستخدم بالفعل.";
        } else {
            // إدخال المستخدم الجديد
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone, gender) VALUES (:name, :email, :password, :phone, :gender)");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password, 'phone' => $phone, 'gender' => $gender]);
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل حساب جديد</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            text-align: right;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="radio"] {
            margin-left: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: right;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>تسجيل حساب جديد</h2>
        <label for="name">الاسم:</label>
        <input type="text" name="name" required>
        
        <label for="email">البريد الإلكتروني:</label>
        <input type="email" name="email" required>
        
        <label for="password">كلمة المرور:</label>
        <input type="password" name="password" required>
        
        <label for="confirm_password">تأكيد كلمة المرور:</label>
        <input type="password" name="confirm_password" required>

        <label for="phone">رقم الهاتف:</label>
        <input type="text" name="phone" required>

        <label>الجنس:</label>
        <input type="radio" name="gender" value="ذكر" required> ذكر
        <input type="radio" name="gender" value="أنثى" required> أنثى
        
        <button type="submit">تسجيل</button>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
    </form>
</body>
</html>
