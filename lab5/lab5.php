<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP تاريخ ووقت في </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
        }
        .result {
            background-color: #fff;
            border-left: 5px solid #007BFF;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h1>تاريخ ووقت في PHP</h1>

<div class="result">
    <?php
    // 1. date() - لتنسيق التاريخ والوقت الحالي
    echo "التاريخ والوقت الحالي: " . date('Y-m-d H:i:s') . "<br>"; // مثال: 2023-10-01 12:00:00
    ?>
</div>

<div class="result">
    <?php
    //تستخدم للحصول على الطابع الزمني الحالي (عدد الثواني منذ 1 يناير 1970).
    // 2. time() - للحصول على الطابع الزمني الحالي
    echo "الطابع الزمني الحالي: " . time() . "<br>"; // مثال: 1696156800
    ?>
</div>

<div class="result">
    <?php
    // 3. strtotime() - لتحويل سلسلة تاريخية إلى طابع زمني
    echo "الطابع الزمني لتاريخ معين (2023-10-01): " . strtotime('2023-10-01') . "<br>"; // مثال: 1696118400
    ?>
</div>

<div class="result">
    <?php
    // 4. mktime() - لإنشاء طابع زمني من مكونات التاريخ
    echo "الطابع الزمني باستخدام mktime(): " . mktime(12, 0, 0, 10, 1, 2023) . "<br>"; // مثال: 1696156800
    ?>
</div>

<div class="result">
    <?php
    // 5. getdate() - للحصول على معلومات عن التاريخ الحالي كصفيف
    echo "معلومات عن التاريخ الحالي:<br>";
    print_r(getdate()); 
    ?>
</div>

<div class="result">
    <?php
    // 6. checkdate() - للتحقق مما إذا كان تاريخ معين صحيح
    echo "هل 29 فبراير 2024 تاريخ صحيح؟ " . (checkdate(2, 29, 2024) ? 'نعم' : 'لا') . "<br>"; // true
    echo "هل 29 فبراير 2023 تاريخ صحيح؟ " . (checkdate(2, 29, 2023) ? 'نعم' : 'لا') . "<br>"; // false
    ?>
</div>

<div class="result">
    <?php
    // 7. date_create() - لإنشاء كائن تاريخ ووقت جديد
    $date = date_create('2023-10-01');
    echo "تاريخ تم إنشاؤه باستخدام date_create(): " . date_format($date, 'Y-m-d') . "<br>"; // مثال: 2023-10-01
    ?>
</div>

<div class="result">
    <?php
    // 8. date_diff() - لحساب الفرق بين تاريخين
    $date1 = date_create('2023-10-01');
    $date2 = date_create('2023-11-01');
    $diff = date_diff($date1, $date2);
    echo "الفرق بين التاريخين: " . $diff->format('%R%a days') . "<br>"; // مثال: +31 days
    ?>
</div>

<div class="result">
    <?php
    // 9. date_modify() - لتعديل كائن تاريخ ووقت
    $date = date_create('2023-10-01');
    date_modify($date, '+1 month');
    echo "تاريخ بعد إضافة شهر: " . date_format($date, 'Y-m-d') . "<br>"; // مثال: 2023-11-01
    ?>
</div>

<div class="result">
    <?php
    // 10. date_timezone_set() - لتعيين منطقة زمنية لكائن تاريخ ووقت
    $date = date_create('2023-10-01');
    $timezone = new DateTimeZone('America/New_York');
    date_timezone_set($date, $timezone);
    echo "التاريخ والوقت بعد تعيين المنطقة الزمنية: " . date_format($date, 'Y-m-d H:i:s') . "<br>"; // يعرض الوقت في المنطقة الزمنية المحددة
    ?>
</div>

</body>
</html>
