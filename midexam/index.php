<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الواجهة الرئيسية</title>
    <style>
      body {
        
    font-family: 'Arial', sans-serif;
    background-color: #e0f7fa; /* لون خلفية مائي */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 300px;
        }

        h1{
    margin-bottom: 20px;
    color: #00796b; /* لون أخضر داكن */
    text-align: center; /* توسيط العنوان */
}

        p {
            color: #666;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color:rgb(64, 147, 39);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color:rgb(64, 147, 39);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>مرحباً بكم في الواجهة الرئيسية</h1>
        <p>يمكنكم التسجيل أو تسجيل الدخول لاستخدام النظام.</p>
        <a href="register.php">تسجيل حساب</a><br>
        <a href="login.php">تسجيل الدخول</a>
    </div>
</body>
</html>
