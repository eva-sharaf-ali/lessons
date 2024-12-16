<!-- 1. array_merge

دمج مصفوفتين أو أكثر في مصفوفة واحدة. -->

<?php
$array1 = ['a' => 'apple', 'b' => 'banana'];
$array2 = ['c' => 'cherry', 'b' => 'blueberry'];

$result = array_merge($array1, $array2);
// الناتج: ['a' => 'apple', 'b' => 'blueberry', 'c' => 'cherry']
print_r($result);
?>

<!-- 2. array_push

إضافة عنصر أو أكثر إلى نهاية المصفوفة. -->

<?php
$fruits = ['apple', 'banana'];
array_push($fruits, 'cherry', 'date');
// الناتج: ['apple', 'banana', 'cherry', 'date']
print_r($fruits);
?>


---

<!-- 3. array_pop

حذف العنصر الأخير من المصفوفة وإرجاعه. -->

<?php
$fruits = ['apple', 'banana', 'cherry'];
$last = array_pop($fruits);
// الناتج: 'cherry'
// $fruits: ['apple', 'banana']
echo $last;
print_r($fruits);
?>


---

<!-- 4. array_shift

إزالة العنصر الأول من المصفوفة وإرجاعه. -->

<?php
$fruits = ['apple', 'banana', 'cherry'];
$first = array_shift($fruits);
// الناتج: 'apple'
// $fruits: ['banana', 'cherry']
echo $first;
print_r($fruits);
?>


---
<!-- 
5. array_unshift

إضافة عناصر إلى بداية المصفوفة. -->

<?php
$fruits = ['banana', 'cherry'];
array_unshift($fruits, 'apple', 'date');
// الناتج: ['apple', 'date', 'banana', 'cherry']
print_r($fruits);
?>


---

<!-- 6. array_key_exists

التحقق مما إذا كان مفتاح معين موجودًا في المصفوفة. -->

<?php
$array = ['a' => 'apple', 'b' => 'banana'];
if (array_key_exists('a', $array)) {
    echo "Key exists!";
} else {
    echo "Key does not exist.";
}
?>


---
<!-- 
7. in_array

التحقق مما إذا كانت قيمة معينة موجودة في المصفوفة. -->

<?php
$fruits = ['apple', 'banana', 'cherry'];
if (in_array('banana', $fruits)) {
    echo "Value exists!";
} else {
    echo "Value does not exist.";
}
?>


---
<!-- 
8. array_keys

إرجاع جميع مفاتيح المصفوفة. -->

<?php
$array = ['a' => 'apple', 'b' => 'banana'];
$keys = array_keys($array);
// الناتج: ['a', 'b']
print_r($keys);
?>


---
<!-- 
9. array_values

إرجاع جميع القيم في المصفوفة. -->

<?php
$array = ['a' => 'apple', 'b' => 'banana'];
$values = array_values($array);
// الناتج: ['apple', 'banana']
print_r($values);
?>


---
<!-- 
10. array_filter

تصفية المصفوفة بناءً على دالة محددة. -->

<?php
$numbers = [1, 2, 3, 4, 5];
$even = array_filter($numbers, function($num) {
    return $num % 2 === 0;
});
// الناتج: [1 => 2, 3 => 4]
print_r($even);
?>


---

<!-- 11. array_map

تطبيق دالة على كل عنصر في المصفوفة. -->

<?php
$numbers = [1, 2, 3, 4];
$squared = array_map(fn($num) => $num ** 2, $numbers);
// الناتج: [1, 4, 9, 16]
print_r($squared);
?>


---
<!-- 
12. array_reduce

تقليل عناصر المصفوفة إلى قيمة واحدة. -->

<?php
$numbers = [1, 2, 3, 4];
$sum = array_reduce($numbers, fn($carry, $num) => $carry + $num, 0);
// الناتج: 10
echo $sum;
?>


---

<!-- 13. array_slice

إرجاع جزء من المصفوفة. -->

<?php
$fruits = ['apple', 'banana', 'cherry', 'date'];
$slice = array_slice($fruits, 1, 2);
// الناتج: ['banana', 'cherry']
print_r($slice);
?>


---

<!-- 14. array_splice

إزالة أو استبدال جزء من المصفوفة. -->

<?php
$fruits = ['apple', 'banana', 'cherry'];
array_splice($fruits, 1, 1, ['date']);
// الناتج: ['apple', 'date', 'cherry']
print_r($fruits);
?>


---

<!-- 15. array_reverse

عكس ترتيب عناصر المصفوفة. -->

<?php
$fruits = ['apple', 'banana', 'cherry'];
$reversed = array_reverse($fruits);
// الناتج: ['cherry', 'banana', 'apple']
print_r($reversed);
?>


---

<!-- 16. array_unique

إزالة القيم المكررة من المصفوفة. -->

<?php
$numbers = [1, 2, 2, 3, 4, 4];
$unique = array_unique($numbers);
// الناتج: [1, 2, 3, 4]
print_r($unique);
?>


---

<!-- 17. array_combine

دمج مصفوفتين في مصفوفة واحدة كمفاتيح وقيم. -->

<?php
$keys = ['a', 'b', 'c'];
$values = ['apple', 'banana', 'cherry'];
$combined = array_combine($keys, $values);
// الناتج: ['a' => 'apple', 'b' => 'banana', 'c' => 'cherry']
print_r($combined);
?>


---
<!-- 
18. sort

ترتيب المصفوفة بالقيم تصاعديًا. -->

<?php
$numbers = [4, 2, 1, 3];
sort($numbers);
// الناتج: [1, 2, 3, 4]
print_r($numbers);
?>


---
<!-- 
19. array_intersect

إرجاع القيم المشتركة بين المصفوفات. -->

<?php
$array1 = [1, 2, 3, 4];
$array2 = [3, 4, 5, 6];
$common = array_intersect($array1, $array2);
// الناتج: [3, 4]
print_r($common);
?>


---

<!-- 20. array_diff
إرجاع القيم الفريدة التي لا توجد في المصفوفة الأخرى. -->

<?php
$array1 = [1, 2, 3, 4];
$array2 = [3, 4, 5, 6];
$difference = array_diff($array1, $array2);
// الناتج: [1, 2]
print_r($difference);
?>
