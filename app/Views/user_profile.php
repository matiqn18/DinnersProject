<!DOCTYPE html>
<html>
<head>
    <title>Profil użytkownika</title>
</head>
<body>
<a href="<?= base_url('user') ?>">Panel Główny</a><br>
<h1>Profil użytkownika: <?= $user['username'] ?></h1>
<p>E-mail: <?= $user['email'] ?></p>
<p>Ilość zamówionych posiłków: <?= $orderedMeals ?></p>
<p>Kwota opłaconych posiłków: <?= $totalPaidAmount ?></p>
</body>
</html>
