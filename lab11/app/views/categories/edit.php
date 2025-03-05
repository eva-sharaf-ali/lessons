<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit Category</h1>

    <form action="<?= PATH . "/categories/edit/$category[id]"; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control <?= !empty($errors['name']) ? 'is-invalid' : ''; ?>" 
                   value="<?= htmlspecialchars($_POST['name'] ?? $category['name']); ?>" required>
            <?php if (!empty($errors['name'])): ?>
                <small class="text-danger"><?= htmlspecialchars($errors['name']); ?></small>
            <?php endif; ?>
        </div>
        
        <button type="submit" class="btn btn-warning">Update Category</button>
        <a href="<?= PATH . "/categories"; ?>" class="btn btn-secondary">Back to List</a>
    </form>
</div>

<?php include 'app/views/layouts/footer.php'; ?>

<!-- CSS internal -->
<style>
    body {
        padding-bottom: 60px; /* مسافة سفلية لمنع تغطية الفوتر للأزرار */
    }
</style>
