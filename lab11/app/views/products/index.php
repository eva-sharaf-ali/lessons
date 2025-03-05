<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Products List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th style="width:10%;">Photo</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id']; ?></td>
                <td>
                    <img src="<?= htmlspecialchars($product['image']); ?>" alt="Product Image" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                </td>
                <td><?= $product['name']; ?></td>
                <td><?= $product['description']; ?></td>
                <td><?= number_format($product['price'], 2); ?> $</td>
                <td>
                    <?php 
                    // البحث عن القسم باستخدام category_id
                    $categoryName = '';
                    foreach ($categories as $category) {
                        if ($category['id'] == $product['category_id']) {
                            $categoryName = $category['name'];
                            break;
                        }
                    }
                    echo $categoryName;
                    ?>
                </td>

                <td>
                    <a href="<?= PATH . "/products/edit/$product[id]"; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= PATH . "/products/delete/$product[id]"; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= PATH . "/products/create"; ?>" class="btn btn-primary">Create New Product</a>
</div>

<!-- Footer -->
<?php include 'app/views/layouts/footer.php'; ?>

<!-- CSS internal -->
<style>
    /* إضافة مساحة سفلية لعدم تغطية الفوتر للأزرار */
    body {
        padding-bottom: 60px; /* تعديل المسافة السفلية حسب الحاجة */
    }
</style>
