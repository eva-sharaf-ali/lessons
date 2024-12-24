<!-- PDOالاتصال عن طريق -->
<?php
$host = 'localhost'; // أو عنوان السيرفر إذا كنت تستخدم سيرفر بعيد
$db = 'EvaDB'; // اسم قاعدة البيانات
$user = 'root'; // اسم المستخدم
$pass = ''; // كلمة المرور (عادةً تكون فارغة في XAMPP)

try {
    // إنشاء اتصال PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
    // ضبط وضع الخطأ
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "تم الاتصال بقاعدة البيانات بنجاح!";
} catch (PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>


<?php
// افترض أنك قمت بإنشاء اتصال PDO كما في السابق

try {
    $name = "احمد";
    $email = "AHAMED@example.com";

    // إعداد استعلام الإدراج
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    
    // ربط القيم
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    // تنفيذ الاستعلام
    $stmt->execute();

    echo "تم إدراج البيانات بنجاح!";
} catch (PDOException $e) {
    echo "فشل الإدراج: " . $e->getMessage();
}
?>
