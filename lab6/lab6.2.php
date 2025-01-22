<?php
class MagicExample {
    private $properties = [];

    // __set تُستدعى عند تعيين قيمة لخاصية غير موجودة
    public function __set($name, $value) {
        $this->properties[$name] = $value;
    }

    // __get تُستدعى عند محاولة الوصول لخاصية غير موجودة
    public function __get($name) {
        return $this->properties[$name] ?? "الخاصية غير موجودة.";
    }

    // __toString تُستدعى عند محاولة طباعة الكائن
    public function __toString() {
        return "هذا كائن من النوع MagicExample.";
    }
}

$example = new MagicExample();
$example->title = "PHP Magic Methods";
echo $example->title; // PHP Magic Methods
echo $example; // هذا كائن من النوع MagicExample.
?>

<!-- __construct()	يتم استدعاؤها عند إنشاء كائن من الكلاس (المُنشئ).
__destruct()	يتم استدعاؤها عند تدمير الكائن (التخلص منه).
__get($name)	تُستدعى عند محاولة الوصول إلى خاصية غير موجودة أو غير قابلة للوصول.
__set($name, $value)	تُستدعى عند محاولة تعيين قيمة لخاصية غير موجودة أو غير قابلة للوصول.
__call($name, $arguments)	تُستدعى عند محاولة استدعاء دالة غير موجودة أو غير قابلة للوصول.
__toString()	تُستدعى عند محاولة تحويل الكائن إلى سلسلة نصية (string).
__clone()	تُستدعى عند استنساخ كائن باستخدام clone. -->