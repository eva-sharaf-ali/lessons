<!-- يمكنك إنشاء استثناء باستخدام الكلمة المفتاحة# throw. على سبيل المثال: -->
<?php
function divide($numerator, $denominator) {
    if ($denominator == 0) {
        throw new Exception("لا يمكن القسمة على صفر.");
    }
    return $numerator / $denominator;
}
try {
    echo divide(10, 0);
} catch (Exception $e) {
    echo "حدث خطأ: " . $e->getMessage();
}
// يمكنك إنشاء أصناف مخصصة للاستثناءات عن طريق الوراثة من Exception.

class MyCustomException extends Exception {}

function checkNumber($number) {
    if ($number < 0) {
        throw new MyCustomException("الرقم يجب أن يكون غير سالب.");
    }
    return $number;
}

try {
    echo checkNumber(-5);
} catch (MyCustomException $e) {
    echo "خطأ مخصص: " . $e->getMessage();
} catch (Exception $e) {
    echo "خطأ عام: " . $e->getMessage();
}
// خصائص وطرق في Exception
// $e->getMessage(): للحصول على رسالة الخطأ.
// $e->getCode(): للحصول على كود الخطأ (إذا تم توفيره).
// $e->getFile(): لمعرفة اسم الملف الذي حدث فيه الخطأ.
// $e->getLine(): لمعرفة رقم السطر الذي حدث فيه الخطأ.
// $e->getTrace() و $e->getTraceAsString(): للحصول على تفاصيل التسلسل البرمجي الذي أدى إلى الخطأ.


class InvalidAgeException extends Exception {}

function checkAge($age) {
    if ($age < 18) {
        throw new InvalidAgeException("العمر يجب أن يكون 18 أو أكبر.");
    }
    return "مرحبًا بك!";
}

try {
    echo checkAge(16);
} catch (InvalidAgeException $e) {
    echo "خطأ متعلق بالعمر: " . $e->getMessage();
} catch (Exception $e) {
    echo "خطأ عام: " . $e->getMessage();
}
// throw: لرمي الاستثناء.
// try-catch: لمعالجة الاستثناء.
