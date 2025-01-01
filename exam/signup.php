<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد</title>
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
    <div class="container">
        <h1>تسجيل حساب جديد</h1>
        
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


        <form method="POST" action="">
            <label>الاسم الكامل:</label>
            <input type="text" name="full_name" required>

            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" required>

            <label>كلمة المرور:</label>
            <input type="password" name="password" required>

            <label>تأكيد كلمة المرور:</label>
            <input type="password" name="confirm_password" required>

            <label>الجنس:</label>
            <input type="radio" name="gender" value="ذكر" required> ذكر
            <input type="radio" name="gender" value="أنثى" required> أنثى

            <label>رقم الهاتف:</label>
            <input type="text" name="phone" required>

            <button type="submit">تسجيل</button>
        </form>
        <p>لديك حساب؟ <a href="login.php">تسجيل الدخول</a></p>
    </div>
</body>
</html>