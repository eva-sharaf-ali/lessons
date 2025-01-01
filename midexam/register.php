<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $errors = [];

    // التحقق من البيانات
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@gmail.com')) {
        $errors[] = "البريد الإلكتروني يجب أن يكون @gmail.com.";
    }
    if (strlen($password) < 6) {
        $errors[] = "كلمة المرور يجب أن تكون 6 أحرف على الأقل.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "كلمتا المرور غير متطابقتين.";
    }
    if (!preg_match("/^(77|73|78)\d{7}$/", $phone)) {
        $errors[] = "رقم الهاتف يجب أن يبدأ بـ 77 أو 73 أو 78 ويتكون من 9 أرقام.";
    }
    if (!in_array($gender, ['ذكر', 'أنثى'])) {
        $errors[] = "الجنس غير صالح.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $phone, $gender]);
        
        // التأكد من نجاح الاستعلام قبل إعادة التوجيه
        if ($stmt->rowCount() > 0) {
            session_start();
            $_SESSION['user_name'] = $name; // تخزين اسم المستخدم في الجلسة
            header("Location: welcome.php");
            exit;
        } else {
            $errors[] = "فشل في تسجيل المستخدم. حاول مرة أخرى.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>تسجيل حساب</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="register.php">
        <h2>تسجيل حساب جديد</h2>
        <?php if (!empty($errors)) { ?>
            <div class="errors">
                <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
            </div>
        <?php } ?>
        <label>الاسم:</label>
        <input type="text" name="name" required>
        
        <label >:البريد الإلكتروني</label>
        <input type="email" name="email" required>
        
        <label >:كلمة المرور</label>
        <input type="password" name="password" required>
        
        <label>:تأكيد كلمة المرور</label>
        <input type="password" name="confirm_password" required>
        
        <label >:رقم الهاتف</label>
        <input type="text" name="phone" required>
        
        <label >:الجنس</label>
        <input type="radio" name="gender" value="ذكر" required> ذكر
        <input type="radio" name="gender" value="أنثى" required> أنثى
        
        <button type="submit">تسجيل</button>
    </form>
</body>
</html>
