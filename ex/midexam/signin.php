<?php
session_start(); // بدء الجلسة

// التحقق من إرسال النموذج عبر POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استقبال المدخلات
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // الاتصال بقاعدة البيانات
        $dsn = "mysql:host=localhost;dbname=sre;charset=utf8mb4";
        $pdo = new PDO($dsn, 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // تفعيل الأخطاء
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // طريقة جلب النتائج
        ]);

        // التحقق من وجود المستخدم
        $stmt = $pdo->prepare("SELECT full_name, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(); // جلب النتائج

        if ($user) {
            // التحقق من كلمة المرور
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_name'] = $user['full_name']; // تخزين اسم المستخدم في الجلسة
                header("Location: project.html"); // الانتقال إلى صفحة project
                exit;
            } else {
                $error_message = "كلمة المرور غير صحيحة.";
            }
        } else {
            $error_message = "البريد الإلكتروني غير مسجل.";
        }
    } catch (PDOException $e) {
        $error_message = "خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage();
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
    <title>Sign in</title>
</head>
<body>
    <div class="container">
        <h1>Sign in</h1>

        <?php
        // عرض رسالة خطأ إن وجدت
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <div class="login">
            <img src="assets/img/dubai.png" alt="login image" class="login__img">

            <form method="POST" action="" class="login__form">
                <h1 class="login__title">Sign in</h1>

                <div class="login__content">
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
                </div>

                <button type="submit" class="login__button">Sign in</button>

                <p class="login__register">
                    Don't have an account? <a href="signup.php">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
