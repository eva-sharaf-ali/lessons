<?php
$host = 'localhost'; // أو عنوان السيرفر إذا كنت تستخدم سيرفر بعيد
$user = 'EVA2'; // اسم المستخدم
$pass = ''; // كلمة المرور (عادةً تكون فارغة في XAMPP)
$db = 'my_database'; // اسم قاعدة البيانات

// إنشاء اتصال MySQLi
$conn = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
echo "تم الاتصال بقاعدة البيانات بنجاح!";
?>



<?php
// افترض أنك قمت بإنشاء اتصال MySQLi كما في السابق

$name = "أحمد";
$email = "ahmed@example.com";

// إعداد استعلام الإدراج
$sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

// تنفيذ الاستعلام والتحقق من النجاح
if ($conn->query($sql) === TRUE) {
    echo "تم إدراج البيانات بنجاح!";
} else {
    echo "فشل الإدراج: " . $conn->error;
}

// إغلاق الاتصال
$conn->close();
?>
