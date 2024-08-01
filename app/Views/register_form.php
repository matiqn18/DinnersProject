<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz Rejestracji</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('back_button.css'); ?>">
</head>
<body>

<main>
    <button class="close-btn" onclick="window.location.href='<?php echo base_url(); ?>'">X</button>
    <h1>Rejestracja</h1>

    <?php if (session()->has('error')): ?>
        <div class="error">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('register/process'); ?>" method="post">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>

        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" required>

        <label for="surname">Nazwisko:</label>
        <input type="text" id="surname" name="surname" required>

        <label for="class">Klasa:</label>
        <select id="class" name="class">
            <?php foreach ($classes as $class): ?>
                <option value="<?php echo $class['id_class']; ?>"><?php echo $class['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Zarejestruj">
    </form>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
