<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapomniane hasło</title>
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
    <button class="close-btn" onclick="window.location.href='<?php echo base_url('login'); ?>'">X</button>
    <h1>Zapomniane hasło</h1>
    <p>Jeśli zapomniałeś(aś) hasła do swojego konta, prosimy o kontakt z administratorem systemu.</p>
    <p>Administrator pomoże Ci w odzyskaniu dostępu do konta lub zresetuje hasło.</p>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
