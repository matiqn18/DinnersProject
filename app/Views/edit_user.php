<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            color: #e0e0e0;
        }

        a {
            color: #bb86fc;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            color: #bb86fc;
            margin-top: 20px;
        }

        .form-container {
            background: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            text-align: left;
        }

        label {
            color: #bb86fc;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            background: #2c2c2c;
            color: #e0e0e0;
            font-size: 16px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #bb86fc;
            color: #121212;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #9f67e4;
        }

        .error-message {
            color: red;
            margin: 20px 0;
        }

        @media (max-width: 600px) {
            input[type="text"], input[type="email"], input[type="password"], select {
                width: calc(100% - 16px);
                font-size: 14px;
                padding: 8px;
            }

            input[type="submit"] {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<a href="<?= base_url('admin/users') ?>">Powrót</a>
<h1>Edit User</h1>
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
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>">

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="2" <?= $user['role'] == '2' ? 'selected' : '' ?>>User</option>
            <option value="1" <?= $user['role'] == '1' ? 'selected' : '' ?>>Accountant</option>
            <option value="0" <?= $user['role'] == '0' ? 'selected' : '' ?>>Admin</option>
        </select>

        <label for="password">Password (leave blank to keep current password):</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>
