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
        header("Location: project.php");
        exit;
    } else {
        $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة.";
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

        <div class="login">
            <img src="assets/img/dubai.png" alt="login image" class="login__img">

            <form method="POST" action="" class="login__form">
                <h1 class="login__title">Sign in</h1>
                <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

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
