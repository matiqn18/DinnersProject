<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dzisiejszy obiad</title>
</head>
<body>

<a href="<?php echo base_url('login'); ?>">Zaloguj się</a>
<a href="<?php echo base_url('register'); ?>">Zarejestruj się</a>

<h1>Dzisiejszy obiad:</h1>
<?php if ($meal): ?>
    <h2><?php echo $meal->ingredients; ?></h2>
<?php else: ?>
    <p>Nie ma dzisiaj obiadu w menu.</p>
<?php endif; ?>
</body>
</html>