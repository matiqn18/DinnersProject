<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
</head>
<body STYLE="margin: 0">
<main class="container mt-4 profile-container">

    <div class="profile-details">

        <div class="profile-info">
            <h1>Profil użytkownika: <?= $user['username'] ?></h1>
            <p><strong>Imię:</strong> <?= $user['name'] ?></p>
            <p><strong>Nazwisko:</strong> <?= $user['surname'] ?></p>
            <p><strong>E-mail:</strong> <?= $user['email'] ?></p>
            <p><strong>Ilość zamówionych posiłków:</strong> <?= $orderedMeals ?></p>
            <p><strong>Kwota opłaconych posiłków:</strong> <?= $totalPaidAmount ?></p>
        </div>
        <div class="profile-picture-container">
            <img src="<?= base_url('uploads/user_' . $user['id'] . '.jpg') ?>" alt="Zdjęcie użytkownika" class="profile-picture">
        </div>
    </div>
</main>
</body>
</html>
