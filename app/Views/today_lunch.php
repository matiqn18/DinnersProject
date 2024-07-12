<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dzisiejszy obiad</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
</head>
<body>
<style>
    body {
        background: url('<?php echo base_url('1.png'); ?>') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
    }
</style>
<main>
    <div class="menu-links">
        <a class="main_buttons" href="<?php echo base_url('login'); ?>">Zaloguj się</a>
        <a class="main_buttons" href="<?php echo base_url('register'); ?>">Zarejestruj się</a>
    </div>

    <header class="menu">
        <h1>Dzisiejszy obiad</h1>
    </header>

    <?php if ($meal->ingredients): ?>
        <div class="meal-container">
            <h2><?php echo $meal->ingredients; ?></h2>
        </div>
    <?php else: ?>
        <h2>Nie ma dzisiaj obiadu w menu.</h2>
    <?php endif; ?>

    <br>

    <a class="main_buttons" href="<?php echo base_url('menu'); ?>">Wyświetl jadłospis</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
