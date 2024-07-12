<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz Rejestracji</title>
</head>
<body>
<h1>Registration</h1>
<?php if (session()->has('error')): ?>
    <div style="color: red;">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form action="<?php echo base_url('register/process'); ?>" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="name">Imie:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="surname">Nazwisko:</label><br>
    <input type="text" id="surname" name="surname"><br>
    <label for="class">Klasa:</label><br>
    <select id="class" name="class">
        <?php foreach ($classes as $class): ?>
            <option value="<?php echo $class['id_class']; ?>"><?php echo $class['name']; ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Register">
</form>
</body>
</html>