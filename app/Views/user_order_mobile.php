<?php
function getDayName($date) {
    $days = ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'];
    $timestamp = strtotime($date);
    return $days[date('w', $timestamp)];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamawianie posiłków</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
</head>
<body style="margin: 0;">
<main class="container mt-4">
    <h1>Zamawianie posiłków</h1>
    <h2>Miesiąc: <?= $currentMonthFull ?></h2>
    <a href="<?= base_url('user/changeMonth/prev/' . $currentIndex) ?>"
       class="but_table"
        <?= $currentIndex == 0 ? 'style="pointer-events: none; color: gray;"' : '' ?>>
        Poprzedni miesiąc
    </a>
    <a href="<?= base_url('user/changeMonth/next/' . $currentIndex) ?>"
       class="but_table"
        <?= $currentIndex == count($months) - 1 ? 'style="pointer-events: none; color: gray;"' : '' ?>>
        Następny miesiąc
    </a>
    <form method="post" action="<?= base_url('user/save') ?>">
        <div class="calendar">
            <?php foreach ($menu as $item): ?>
                <?php $dayName = getDayName($item['date']); ?>
                <div class="calendar-day" <?= !$item['available'] ? 'disabled' : '' ?>>
                    <div class="date"><?= $dayName . ' ' . date('d', strtotime($item['date'])) ?> </div>
                    <div class="menu"><?= $item['ingredients'] ?></div>
                    <div class="order">
                        <input type="checkbox" name="meals[]" value="<?= $item['id'] ?>"
                            <?= in_array($item['id'], $userMealIds) ? 'checked' : '' ?>
                            <?= $item['available'] == 1 ? '' : 'disabled' ?>>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="but_table">Zapisz</button>

    </form>
</main>
</body>
</html>
