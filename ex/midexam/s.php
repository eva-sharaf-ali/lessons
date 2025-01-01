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

        .login__button {
            width: 100%;
            padding: 1.25rem; /* زيادة ارتفاع الزر */
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .login__button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign up</h1>
        
        <?php
        session_start(); // بدء الجلسة

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];

            $errors = [];

            // التحقق من كلمة المرور
            if ($password !== $confirm_password) {
                $errors[] = "كلمتا المرور غير متطابقتين.";
            }

            // التحقق من رقم الهاتف
            if (!preg_match('/^(77|78|73)\d{7}$/', $phone)) {
                $errors[] = "رقم الهاتف يجب أن يتكون من 9 أرقام فقط ويبدأ بـ 77، 78، أو 73.";
            }

            // إذا لم تكن هناك أخطاء
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $conn = new mysqli('localhost', 'root', '', 'advanced_web');
                if ($conn->connect_error) {
                    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, gender, phone) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $full_name, $email, $hashed_password, $gender, $phone);

                if ($stmt->execute()) {
                    $_SESSION['user_name'] = $full_name; // تخزين الاسم في الجلسة
                    header("Location: welcome.php"); // الانتقال إلى صفحة الترحيب
                    exit;
                } else {
                    echo "<p class='error'>فشل التسجيل: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            } else {
                foreach ($errors as $error) {
                    echo "<div class='error'>$error</div>";
                }
            }
        }
        ?>

        <div class="login">
            <img src="assets/img/dubai.png" alt="login image" class="login__img">
            <form method="POST" action="" class="login__form">
                <h1 class="login__title">Sign up</h1>

                <div class="login__content">
                    <div class="login__box">
                        <i class="ri-user-3-line login__icon"></i>
                        <div class="login__box-input">
                            <label for="full_name">Name</label>
                            <input type="text" name="full_name" required class="login__input" id="full_name" placeholder=" ">
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
                    Don't have an account? <a href="login.php">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
