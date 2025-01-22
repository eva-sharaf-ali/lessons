<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع الصور إلى قاعدة البيانات</title>
</head>
<body>
    <h2>رفع صورة إلى قاعدة البيانات</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">اختر صورة:</label>
        <input type="file" name="image" id="file" required>
        <button type="submit" name="upload">رفع الصورة</button>
    </form>

    <?php
    // التحقق من إرسال النموذج
    if (isset($_POST['upload'])) {
        // الاتصال بقاعدة البيانات
        $conn = new mysqli('localhost', 'root', '', 'eva');

        // التحقق من الاتصال
        if ($conn->connect_error) {
            die("<p style='color: red;'>فشل الاتصال بقاعدة البيانات: " . $conn->connect_error . "</p>");
        }

        // التحقق من رفع الملف
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageName = $_FILES['image']['name'];
            $imageTmp = $_FILES['image']['tmp_name'];
            $imageType = $_FILES['image']['type'];

            // التحقق من نوع الملف (jpeg, png, gif فقط)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($imageType, $allowedTypes)) {
                die("<p style='color: red;'>نوع الملف غير مدعوم. الرجاء اختيار صورة بصيغة jpeg أو png أو gif.</p>");
            }

            // قراءة محتوى الملف
            $imageData = file_get_contents($imageTmp);

            // إعداد الاستعلام
            $stmt = $conn->prepare("INSERT INTO images (image, image_name) VALUES (?, ?)");
            $null = NULL;
            $stmt->bind_param("bs", $null, $imageName);

            // تمرير البيانات الثنائية
            $stmt->send_long_data(0, $imageData);

            // تنفيذ الاستعلام
            if ($stmt->execute()) {
                echo "<p style='color: green;'>تم رفع الصورة بنجاح!</p>";
            } else {
                echo "<p style='color: red;'>حدث خطأ أثناء رفع الصورة: " . $stmt->error . "</p>";
            }

            // إغلاق الاتصال
            $stmt->close();
        } else {
            echo "<p style='color: red;'>يرجى اختيار صورة صحيحة.</p>";
        }

        $conn->close();
    }
    ?>

    <h2>عرض الصور</h2>
    <?php
    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'root', '', 'eva');

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("<p style='color: red;'>فشل الاتصال بقاعدة البيانات: " . $conn->connect_error . "</p>");
    }

    // استرجاع الصور من قاعدة البيانات
    $result = $conn->query("SELECT image, image_name FROM images");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // عرض اسم الصورة والصورة نفسها
            echo "<h3>" . htmlspecialchars($row['image_name']) . "</h3>";
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="300"><br><br>';
        }
    } else {
        echo "<p>لا توجد صور مرفوعة.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
