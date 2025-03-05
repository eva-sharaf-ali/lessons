<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Create New Category</h1>
    <form action="<?php echo PATH . "/categories/create"; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
        <a href="<?= PATH . "/categories"; ?>" class="btn btn-secondary">Back to List</a>
    </form>
</div>

<?php include 'app/views/layouts/footer.php'; ?>

<!-- CSS internal -->
<style>
    /* إضافة مساحة سفلية لعدم تغطية الفوتر للأزرار */
    body {
        padding-bottom: 60px; /* تعديل المسافة السفلية حسب الحاجة */
    }
</style>
