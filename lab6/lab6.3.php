<?php
class MagicVariablesExample {
    public function displayInfo() {
        echo "السطر الحالي: " . __LINE__ . "\n";
        echo "اسم الملف: " . __FILE__ . "\n";
        echo "اسم الدالة: " . __FUNCTION__ . "\n";
        echo "اسم الكلاس: " . __CLASS__ . "\n";
    }
}

$example = new MagicVariablesExample();
$example->displayInfo();
?>

<!-- 
__LINE__	يعرض رقم السطر الحالي في السكربت.
__FILE__	يعرض المسار الكامل واسم الملف الذي يتم تنفيذه حاليًا.
__DIR__	يعرض المسار الكامل للدليل الذي يحتوي الملف.
__FUNCTION__	يعرض اسم الدالة التي يتم تنفيذها حاليًا.
__CLASS__	يعرض اسم الكلاس الذي يتم تنفيذه حاليًا.
__METHOD__	يعرض اسم الكلاس مع اسم الطريقة (method) التي يتم تنفيذها.
__NAMESPACE__	يعرض اسم الـ namespace الحالي. -->