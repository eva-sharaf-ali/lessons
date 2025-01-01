<?php
require 'db.php';
session_start(); // بدء الجلسة

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $errors = [];

    // التحقق من كلمة المرور
    if ($password !== $confirm_password) {
        $errors[] = "The passwords do not match";
    }

    // التحقق من رقم الهاتف
    if (!preg_match('/^(77|78|73)\d{7}$/', $phone)) {
        $errors[] = "The phone number must consist of 9 digits and only start with 77, 78, or 73";
    }

    // إذا لم تكن هناك أخطاء
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        try {
            // الاتصال بقاعدة البيانات باستخدام PDO
            $dsn = "mysql:host=localhost;dbname=sre;charset=utf8mb4";
            $pdo = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // لتفعيل الأخطاء
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // لتحديد طريقة جلب النتائج
            ]);

            // تحضير الاستعلام
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, gender, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $hashed_password);
            $stmt->bindParam(4, $gender);
            $stmt->bindParam(5, $phone);

            // تنفيذ الاستعلام
            if ($stmt->execute()) {
                $_SESSION['user_name'] = $name; // تخزين الاسم في الجلسة
                header("Location: welcome.php"); // الانتقال إلى الصفحة الرئيسية
                exit;
            } else {
                echo "<p class='error'>فشل التسجيل</p>";
            }
        } catch (PDOException $e) {
            echo "<p class='error'>خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage() . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Sign up</title>
</head>
<body>
    <div class="container">
        <h1>Sign up</h1>

        <div class="login">
            <img src="assets/img/dubai.png" alt="login image" class="login__img">

            <form method="POST" action="register.php" class="login__form">

                <h1 class="login__title">Sign up</h1>

                <?php if (!empty($errors)) { ?>
                <div class="errors">
                    <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
                </div>
                <?php } ?>

                <div class="login__content">
                    <div class="login__box">
                        <i class="ri-user-3-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="text" name="name" required class="login__input" id="login-email" placeholder=" ">
                            <label for="login-email" class="login__label">Name</label>
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-user-3-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="email" name="email" required class="login__input" id="login-email" placeholder=" ">
                            <label for="login-email" class="login__label">Email</label>
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="password" name="password" required class="login__input" id="login-pass" placeholder=" ">
                            <label for="login-pass" class="login__label">Password</label>
                            <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="password" name="confirm_password" required class="login__input" id="login-pass" placeholder=" ">
                            <label for="login-pass" class="login__label">Confirm Password</label>
                            <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                        </div>
                    </div>

                    <div class="login__box">
                        <div class="gender-label">Gender</div><br>
                        <label>
                            <input type="radio" name="gender" value="male" required> Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female" required> Female
                        </label>
                    </div>

                    <div class="login__box">
                        <i class="ri-phone-line login__icon"></i>

                        <div class="login__box-input">
                            <input type="text" name="phone" required class="login__input" id="login-pass" placeholder=" ">
                            <label for="login-pass" class="login__label">Phone</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="login__button">Sign up</button>

                <p class="login__register">
                    Don't have an account? <a href="login.php">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
