<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
</head>
<body>
<h1>Panel użytkownika</h1>
<a href="<?php echo base_url('logout'); ?>">Wyloguj się</a><br>


<a href="<?= base_url('user/info') ?>">Wyświetl informacje o koncie</a><br>
<a href="<?= base_url('user/order') ?>">Zamów posiłek</a><br>
</body>
</html>
