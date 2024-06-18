<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant Panel</title>
</head>
<body>
<h1>Panel księgowej</h1>
<a href="<?php echo base_url('logout'); ?>">Wyloguj się</a><br>


<a href="<?= base_url('accountant/menu') ?>">Wyświetl jadłospis</a><br>
<a href="<?= base_url('accountant/financialInfo') ?>">Wyświetl informacje finansowe użytkowników</a><br>
<a href="<?= base_url('accountant/daily_orders') ?>">Dodaj opłatę do użytkownika</a>
</body>
</html>
