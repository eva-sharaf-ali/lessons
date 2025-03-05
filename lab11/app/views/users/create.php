<?php include 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Create New User</h1>

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

    <form action="<?= PATH . "/users/create"; ?>" method="POST">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input type="date" name="birth_date" id="birth_date" class="form-control">
        </div>
        <!-- Role dropdown -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="user">User </option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
        <a href="<?= PATH . "/users"; ?>" class="btn btn-secondary">Back to List</a>
    </form>
</div>

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