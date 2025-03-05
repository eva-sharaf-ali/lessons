<!-- Header -->
<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit Product</h1>
    <form action="<?= PATH . "/products/edit/$product[id]"; ?>" method="POST" enctype="multipart/form-data">
        <!-- عرض الصورة الحالية -->
        <div class="mb-3">
            <!-- <label>الصورة الحالية:</label>
            <br>
            <img src="<?= isset($product['image']) ? '/' . $product['image'] : '/uploads/default.png' ?>" width="100">
            <br><br> -->

            <label for="image" class="form-label">تحديث الصورة (اختياري):</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        
        <!-- حقل اسم المنتج -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $product['name']; ?>" required>
        </div>
        
        <!-- حقل الوصف -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"><?= $product['description']; ?></textarea>
        </div>
        
        <!-- حقل السعر -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price']; ?>" required>
        </div>
        
        <!-- حقل الفئة -->
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

        <!-- زر التحديث والعودة -->
        <button type="submit" class="btn btn-warning">Update Product</button>
        <a href="<?= PATH . "/products"; ?>" class="btn btn-secondary">Back to List</a>
    </form>
</div>

<!-- Footer -->
<?php include 'app/views/layouts/footer.php'; ?>
