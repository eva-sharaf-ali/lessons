<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Users List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['first_name']; ?></td>
                <td><?= $user['last_name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td>
                    <a href="<?= PATH . "/users/edit/$user[id]"; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= PATH . "/users/delete/$user[id];" ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= PATH . "/users/create"; ?>" class="btn btn-primary">Create New User</a>
</div>

<?php include 'app/views/layouts/footer.php'; ?>

<!-- CSS internal -->
<style>
    body {
        padding-bottom: 60px; /* مسافة سفلية لمنع تغطية الفوتر للأزرار */
    }
</style>
