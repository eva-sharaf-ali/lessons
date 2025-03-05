<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Categories List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category['id']; ?></td>
                <td><?= $category['name']; ?></td>
                <td>
                    <a href="<?= PATH . "/categories/edit/$category[id]"; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= PATH . "/categories/delete/$category[id]"; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= PATH . "/categories/create"; ?>" class="btn btn-primary">Create New Category</a>
</div>

<!-- Footer -->
<?php include 'app/views/layouts/footer.php'; ?>