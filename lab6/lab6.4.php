<?php

class Example {
    // تعريف ثابت باستخدام const
    const PI = 3.14159;

    // تعريف متغير static
    public static $counter = 0;

    // دالة ثابتة
    public static function incrementCounter() {
        self::$counter++;
    }

    // دالة لعرض معلومات
    public function showInfo() {
        echo "قيمة الثابت PI: " . self::PI . PHP_EOL;
        echo "عدد المرات التي تم فيها زيادة العداد: " . self::$counter . PHP_EOL;
    }
}

// الوصول إلى الثابت مباشرة عبر اسم الكلاس
echo "قيمة الثابت PI: " . Example::PI . PHP_EOL;

// استخدام الدالة الثابتة لزيادة العداد
Example::incrementCounter();
Example::incrementCounter();

// إنشاء كائن لعرض المعلومات
$obj = new Example();
$obj->showInfo();

?>
<!-- الفرق بين const و static
const: تُستخدم لتعريف قيم ثابتة غير قابلة للتغيير.
static: تُستخدم لتعريف متغيرات أو دوال مشتركة بين جميع الكائنات التي تُنشأ من نفس الكلاس.






