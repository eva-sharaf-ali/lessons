<?php
use App\Controllers\NotFound;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\AuthController;


$controller = new UserController();
$controller2 = new ProductController();
$controller3 = new CategoryController();
$controller4 = new AuthController();
$notf = new NotFound();

// URI الطلب الكامل
$requestUri = $_SERVER['REQUEST_URI'];

// إزالة المسار الأساسي من URI الطلب للحصول على URI النسبي
$relativeUri = ltrim(str_replace(PATH, '', $requestUri), '/');

if ($relativeUri == "") {
    $notf->welcome();
}

// تحقق من وجود جلسة للمدير

// مسارات المصادقة
if ($relativeUri == 'auth/login') {
    $controller4->showLoginForm();
} elseif ($relativeUri == 'auth/register') {
    $controller4->showRegisterForm();
} elseif ($relativeUri == 'auth/login') {
    $controller4->signIn();
} elseif ($relativeUri == 'auth/register') {
    $controller4->register();
} elseif ($relativeUri == 'auth/logout') {
    $controller4->logout();
//     Session::start();
// if (!Session::isUser()) {
//     $notf->notFound(); // توجيه إلى صفحة غير موجودة إذا لم يكن المستخدم مديرًا
//     exit;
// }

}

// مسارات المستخدمين
if ($relativeUri == 'users') {
    $controller->index();
} elseif ($relativeUri == 'users/create') {
    $controller->create();
} elseif (preg_match('/^users\/edit\/(\d+)/', $relativeUri, $matches)) {
    $controller->edit($matches[1]);
} elseif (preg_match('/^users\/delete\/(\d+)/', $relativeUri, $matches)) {
    $controller->delete($matches[1]);
}

// مسارات المنتجات
if ($relativeUri == 'products') {
    $controller2->index();
} elseif ($relativeUri == 'products/create') {
    $controller2->create();
} elseif (preg_match('/^products\/edit\/(\d+)/', $relativeUri, $matches)) {
    $controller2->edit($matches[1]);
} elseif (preg_match('/^products\/delete\/(\d+)/', $relativeUri, $matches)) {
    $controller2->delete($matches[1]);
}

// مسارات الفئات
if ($relativeUri == 'categories') {
    $controller3->index();
} elseif ($relativeUri == 'categories/create') {
    $controller3->create();
} elseif (preg_match('/^categories\/edit\/(\d+)/', $relativeUri, $matches)) {
    $controller3->edit($matches[1]);
} elseif (preg_match('/^categories\/delete\/(\d+)/', $relativeUri, $matches)) {
    $controller3->delete($matches[1]);
}
?>