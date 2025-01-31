<?php
// مثال على استخدام دوال التعبيرات النمطية (Regular Expressions) في PHP

// النص الذي سنعمل عليه
$text = "Hello World! This is a test string.";
/////////////////////////////////////////////////////////////////////////////////////////////////
// استخدام preg_match للتحقق من وجود كلمة "test"
if (preg_match("/test/", $text)) {
    echo "The word 'test' was found in the text.\n"; // إذا وُجدت الكلمة، طباعة رسالة
} else {
    echo "The word 'test' was not found in the text.\n"; // إذا لم توجد الكلمة، طباعة رسالة أخرى
}
/////////////////////////////////////////////////////////////////////////////////////////////////


// استخدام preg_replace لاستبدال "test" بـ "sample"
$new_text = preg_replace("/test/", "sample", $text);
echo $new_text . "\n"; // طباعة النص بعد الاستبدال
/////////////////////////////////////////////////////////////////////////////////////////////////




// استخدام preg_split لتقسيم النص إلى مصفوفة بناءً على الفراغات
$words = preg_split("/s+/", $text);
echo "Words in the text:\n";
print_r($words); // طباعة المصفوفة الناتجة عن تقسيم النص
/////////////////////////////////////////////////////////////////////////////////////////////////


// استخدام preg_last_error للحصول على آخر خطأ حدث أثناء تنفيذ دوال التعبيرات النمطية
$error = preg_last_error();
if ($error !== PREG_NO_ERROR) {
    echo "An error occurred: " . $error . "\n"; // طباعة رسالة الخطأ إذا حدث
} else {
    echo "No errors occurred.\n"; // إذا لم يحدث خطأ، طباعة رسالة
}
/////////////////////////////////////////////////////////////////////////////////////////////////


$text2 = "The quick brown fox jumps over the lazy dog.";

// استخدام preg_match_all للعثور على جميع الكلمات التي تبدأ بحرف 't'
preg_match_all("/\btw*/i", $text2, $matches);
print_r($matches[0]); // طباعة الكلمات المطابقة


// استخدام preg_grep لتصفية الكلمات التي تحتوي على حرف 'o'
$filtered_words = preg_grep("/o/", $words);
print_r($filtered_words);
///////////////////////////////////////////////////////////////////////////////////////////////////



//يستخدم فئة الأحرف الرقمية التي تطابق أي رقم هاتف رقمي واحد:
$pattern='/\d/';
$phone='(650)-543-2100';
if(preg_match_all($pattern,$phone,$matches)){
print_r($matches[0]);
}



///////////////////////////////////////////////////////////////////////////////////////////////////
// يستخدم المثال التالي فئة أحرف الكلمة لمطابقة جميع الأحرف، بما في ذلك الحروف الهجائية اللاتينية وأرقام:
$pattern='/\w/';
$str='PHP8.0';
if(preg_match_all($pattern,$str,$matches)){
print_r($matches[0]);
}
?>