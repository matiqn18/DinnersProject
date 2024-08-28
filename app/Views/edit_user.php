<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('admin_style.css'); ?>">
</head>
<body>
<a href="<?= base_url('admin/users') ?>">Powrót</a>
<?php if (session()->has('error')): ?>
    <div class="error-message">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="form-container">
    <form action="<?= base_url('admin/update/'.$user['id']); ?>" method="post">
        <label for="username">Nazwa Urzytkownika:</label>
        <input type="text" id="username" name="username" value="<?= $user['username'] ?>">
        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" value="<?= $user['name'] ?>">
        <label for="surname">Nazwisko:</label>
        <input type="text" id="surname" name="surname" value="<?= $user['surname'] ?>">
        <?php if (!in_array($user['role'], [0, 1, 3])): ?>
            <label for="class">Klasa:</label>
            <select name="class_id" id="class">
                <option value="">-</option>
                <?php foreach ($class as $classItem): ?>
                    <option value="<?= $classItem['id_class']; ?>" <?= (isset($user['class_id']) && $classItem['id_class'] == $user['class_id']) ? 'selected' : ''; ?>>
                        <?= $classItem['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

        <?php endif; ?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
        <label for="role">Typ użytkownika:</label>
        <select id="role" name="role">
            <option value="2" <?= $user['role'] == '2' ? 'selected' : '' ?>>Uczeń</option>
            <option value="3" <?= $user['role'] == '3' ? 'selected' : '' ?>>Absolwent</option>
            <option value="1" <?= $user['role'] == '1' ? 'selected' : '' ?>>Księgowa</option>
            <option value="0" <?= $user['role'] == '0' ? 'selected' : '' ?>>Administrator</option>

        </select>

        <label for="password">Password (leave blank to keep current password):</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>
