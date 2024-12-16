
<?php echo "H.W"; ?>
<?php
// عدد صحيح
$age = 30;

// عدد عشري
$height = 5.9;

// سلسلة نصية
$name = "Alice";

// مصفوفة
$colors = array("red", "green", "blue");

// كائن
class Person {
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
}
$person = new Person("Bob");

// قيمة منطقية
$isStudent = true;

// NULL
$address = null;

// طباعة القيم
echo "Name: " . $name . "\n";
echo "Age: " . $age . "\n";
echo "Height: " . $height . "\n";
echo "Favorite Colors: " . implode(", ", $colors) . "\n";
echo "Person Name: " . $person->name . "\n";
echo "Is Student: " . ($isStudent ? 'Yes' : 'No') . "\n";
echo "Address: " . ($address === null ? 'Not specified' : $address) . "\n";
?>

<?php
//الجملة الشرطية if
$age = 20;

if ($age >= 18) {
    echo "You are an adult.";
}
?>

<?php
//الجملة الشرطية if-else
$age = 16;

if ($age >= 18) {
    echo "You are an adult.";
} else {
    echo "You are a minor.";
}
?>


<?php
//لجملة الشرطية if-elseif-else

$score = 75;

if ($score >= 90) {
    echo "Grade: A";
} elseif ($score >= 80) {
    echo "Grade: B";
} elseif ($score >= 70) {
    echo "Grade: C";
} else {
    echo "Grade: D or F";
}
?>

<?php
//
$day = 3;
//الجملة الشرطية switch
switch ($day) {
    case 1:
        echo "Monday";
        break;
    case 2:
        echo "Tuesday";
        break;
    case 3:
        echo "Wednesday";
        break;
    case 4:
        echo "Thursday";
        break;
    case 5:
        echo "Friday";
        break;
    case 6:
        echo "Saturday";
        break;
    case 7:
        echo "Sunday";
        break;
    default:
        echo "Invalid day";
}
?>



<?php
// الجملة الشرطية مع العوامل المنطقية
$age = 20;
$is_student = true;

if ($age >= 18 && $is_student) {
    echo "You are an adult student.";
} elseif ($age < 18 && !$is_student) {
    echo "You are a minor and not a student.";
} else {
    echo "Check your eligibility.";
}
?>

<?php
//حلقة while
$count = 1;

while ($count <= 5) {
    echo "Count: $count\n";
    $count++;
}
?>

<?php
//حلقة do while
$count = 1;

do {
    echo "Count: $count\n";
    $count++;
} while ($count <= 5);
?> 

<?php
// foreach
// تعريف مصفوفة من الأسماء
$names = array("أحمد", "فاطمة", "يوسف", "علي");

// استخدام حلقة foreach للتكرار على العناصر
foreach ($names as $name) {
    echo "مرحبا، $name!<br>";
}
?>


