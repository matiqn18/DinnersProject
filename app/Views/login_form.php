<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz Logowania</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('back_button.css'); ?>">

</head>
<body>
<style>
    body {

    }
</style>

<main>
    <button class="close-btn" onclick="window.location.href='<?php echo base_url(); ?>'">X</button>
    <h1>Logowanie</h1>

    <?php if (session()->has('error')): ?>
        <div class="error">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
        <label for="username">Email lub Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Zaloguj">
        <a id="links" href="<?php echo base_url('forgotpass'); ?>">Zapomniałeś hasła?</a>
    </form>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
