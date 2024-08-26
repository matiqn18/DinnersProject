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




            display: inline-block;
            padding: 10px 20px;
            background-color: #14452f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            /*background-color: #0e3723;*/
            /*transform: scale(1.05);*/

            background-color: #0e3723;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
