<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
<h1>Admin Panel</h1>
<a href="<?php echo base_url('logout'); ?>">Wyloguj się</a>

<a href="<?php echo base_url('admin/data'); ?>">Zmień dane systemowe</a>

<?php if (session()->has('success')): ?>
    <div style="color: green;">
        <?= session('success') ?>
    </div>
<?php endif; ?>


<h2>Admins</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($admins as $admin): ?>
        <tr>
            <td><?= $admin['id'] ?></td>
            <td><?= $admin['username'] ?></td>
            <td><?= $admin['email'] ?></td>
            <td>
                <a href="<?= base_url('admin/edit/'.$admin['id']) ?>">Edit</a>
                <a href="<?= base_url('admin/delete/'.$admin['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Users</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <a href="<?= base_url('admin/edit/'.$user['id']) ?>">Edit</a>
                <a href="<?= base_url('admin/delete/'.$user['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Accountants</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($accountants as $accountant): ?>
        <tr>
            <td><?= $accountant['id'] ?></td>
            <td><?= $accountant['username'] ?></td>
            <td><?= $accountant['email'] ?></td>
            <td>
                <a href="<?= base_url('admin/edit/'.$accountant['id']) ?>">Edit</a>
                <a href="<?= base_url('admin/delete/'.$accountant['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>