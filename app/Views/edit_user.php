<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
<a href="<?= base_url('admin') ?>">Powrót</a>
<h1>Edit User</h1>
<?php if (session()->has('error')): ?>
    <div style="color: red;">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form action="<?= base_url('admin/update/'.$user['id']); ?>" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" value="<?= $user['username'] ?>"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= $user['email'] ?>"><br>
    <label for="role">Role:</label><br>
    <select id="role" name="role">
        <option value="2" <?= $user['role'] == '2' ? 'selected' : '' ?>>User</option>
        <option value="1" <?= $user['role'] == '1' ? 'selected' : '' ?>>Accountant</option>
        <option value="0" <?= $user['role'] == '0' ? 'selected' : '' ?>>Admin</option>
    </select><br>
    <label for="password">Password (leave blank to keep current password):</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Update">
</form>
</body>
</html>