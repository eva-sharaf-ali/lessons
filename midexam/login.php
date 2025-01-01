<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_name'] = $user['name'];
        header("Location: welcome.php");
        exit;
    } else {
        $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="login.php">
        <h2>تسجيل الدخول</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <label >  :البريد الإلكتروني</label>
        <input type="email" name="email" required>
        
        <label >:كلمة المرور</label>
        <input type="password" name="password" required>
        
        <button type="submit">دخول</button>
    </form>
</body>
</html>

