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
    if (!in_array($gender, ['male', 'female'])) {
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
            header("Location: project.php");
            exit;
        } else {
            $errors[] = "فشل في تسجيل المستخدم. حاول مرة أخرى.";
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
    <style>
        /* إضافة تنسيق للـ form */
        .login__form {
            width: 600px; /* زيادة العرض */
            padding: 3rem 2rem;
            border-radius: 1rem;
            backdrop-filter: blur(8px);
        }

        .login__box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #fff;
        }

        .login__box-input {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .login__label {
            font-size: 1.1rem; /* زيادة حجم الخط */
            margin-bottom: 0.5rem;
        }

        .login__input {
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            font-size: 1.1rem; /* زيادة حجم الخط في الحقول */
        }

        .login__content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .login__content > .login__box {
            width: 48%;
        }

        .gender-label {
            margin-bottom: 0.5rem;
        }

        .login__box input[type="radio"] {
            margin-right: 0.5rem;
        }

        
       
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign up</h1>
        
        <div class="login">
            <img src="assets/img/dubai.png" alt="login image" class="login__img">
            <form method="POST" action="signup.php" class="login__form">
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
                            <label for="full_name">Name</label>
                            <input type="text" name="name" required class="login__input" id="full_name" placeholder=" ">
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-mail-line login__icon"></i>
                        <div class="login__box-input">
                            <label for="email">Email</label>
                            <input type="email" name="email" required class="login__input" id="email" placeholder=" ">
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>
                        <div class="login__box-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required class="login__input" id="password" placeholder=" ">
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>
                        <div class="login__box-input">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" required class="login__input" id="confirm_password" placeholder=" ">
                        </div>
                    </div>

                    <div class="login__box">
                        <div class="gender-label">Gender</div>
                        <div>
                            <label>
                                <input type="radio" name="gender" value="male" required> Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="female" required> Female
                            </label>
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-phone-line login__icon"></i>
                        <div class="login__box-input">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" required class="login__input" id="phone" placeholder=" ">
                        </div>
                    </div>
                </div>

                <button type="submit" class="login__button">Sign up</button>

                <p class="login__register">
                    Don't have an account? <a href="signin.php">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
