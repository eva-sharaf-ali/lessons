<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج POST</title>
</head>
<body>
    <form action="process_post.php" method="post">
        <label for="username">اسم المستخدم:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="إرسال">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // معالجة البيانات (مثل التحقق من صحة البيانات)
    echo "اسم المستخدم: " . htmlspecialchars($username) . "<br>";
    echo "كلمة المرور: " . htmlspecialchars($password);
}
?>





<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج GET</title>
</head>
<body>
    <form action="process_get.php" method="get">
        <label for="search">البحث:</label>
        <input type="text" id="search" name="search" required>
        <br>
        <input type="submit" value="بحث">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET['search'];
    
    // معالجة البيانات (مثل البحث في قاعدة البيانات)
    echo "نتيجة البحث: " . htmlspecialchars($search);
}
?>
<!-- 
1. طريقة الإرسال:

   • $_POST: تُستخدم لإرسال البيانات عبر طريقة POST، حيث لا تظهر البيانات في عنوان URL.

   • $_GET: تُستخدم لإرسال البيانات عبر طريقة GET، حيث تظهر البيانات كجزء من عنوان URL.

2. الأمان:

   • $_POST: أكثر أمانًا، حيث لا تظهر البيانات في عنوان URL، مما يجعلها مناسبة للبيانات الحساسة.

   • $_GET: أقل أمانًا، حيث يمكن لأي شخص رؤية البيانات المرسلة.

3. حجم البيانات:

   • $_POST: يمكن إرسال كميات أكبر من البيانات.

   • $_GET: هناك حد أقصى لطول عنوان URL، مما يحد من كمية البيانات المرسلة.

4. الاستخدامات الشائعة:

   • $_POST: تُستخدم عادةً لتسجيل الدخول، التسجيل، أو أي نماذج تتطلب معالجة بيانات حساسة.

   • $_GET: تُستخدم عادةً للبحث أو تصفية النتائج، حيث تكون البيانات غير حساسة. 
 


-->