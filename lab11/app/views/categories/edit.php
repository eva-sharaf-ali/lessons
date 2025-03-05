<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit Category</h1>

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
    
    <form action="<?= PATH . "/categories/edit/$category[id]"; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $category['name']; ?>" required>
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
