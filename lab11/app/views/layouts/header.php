<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>store</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= PATH . "/public/assets/css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" href="<?= PATH . "/public/assets/css/docs.css"; ?>">
    <style>
        .custom-logout-btn {
            background-color: white;
            color: #003366; /* اللون الكحلي */
            border: 1px solid #003366; /* حد باللون الكحلي */
            border-radius: 25px; /* حواف مدورة */
            padding: 8px 20px; /* إضافة padding لجعل الزر أكبر */
            text-decoration: none; /* إزالة التسطير من الرابط */
        }

        .custom-logout-btn:hover {
            background-color: #003366; /* تغيير اللون في الـ hover */
            color: white;
            border-color: #003366; /* الحفاظ على اللون الكحلي للحد */
        }
    </style>
</head>
<body>

    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- SAVA at the far left -->
            <a class="navbar-brand me-auto" href="/">SAVA</a>

            <!-- Navbar Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centered Navbar Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= PATH . "/users"; ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PATH . "/users/create"; ?>">Create User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= PATH . "/categories"; ?>">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PATH . "/categories/create"; ?>">Create Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= PATH . "/products"; ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PATH . "/products/create"; ?>">Create Product</a>
                    </li>
                </ul>
            </div>

            <!-- Log Out Button on the far right -->
            <div class="d-flex">
                <a class="nav-link active custom-logout-btn" aria-current="page" href="<?= PATH . "/logout"; ?>">Log Out</a>
            </div>
        </div>
    </nav>

    <!-- Content of the page -->
    <div class="container mt-4">
        <!-- The content will be rendered here -->
        <!-- <?php echo $content; ?> -->
    </div>

    <!-- Bootstrap JS -->
    <script src="<?= PATH . "/public/assets/js/bootstrap.bundle.min.js"; ?>"></script>
</body>
</html>
