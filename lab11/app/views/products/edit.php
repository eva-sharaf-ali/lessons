<!-- Header -->
<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit Product</h1>
    
    <!-- Display errors if any -->
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= PATH . "/products/edit/$product[id]"; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $product['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"><?= $product['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['id']); ?>"
                            <?= $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No categories available</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" >
        </div>
        <button type="submit" class="btn btn-warning">Update Product</button>
        <a href=<?= PATH."/products";?> class="btn btn-secondary">Back to List</a>
    </form>
</div>

<!-- Footer -->
<?php include 'app/views/layouts/footer.php'; ?>

<!-- CSS internal -->
<style>
    body {
        padding-bottom: 60px; /* مسافة سفلية لمنع تغطية الفوتر للأزرار */
    }
    .alert {
        margin-top: 20px; /* مسافة أعلى للصندوق */
    }
</style>
