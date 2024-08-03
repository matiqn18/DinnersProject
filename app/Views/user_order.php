<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamawianie posiłków</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
    <style>

    </style>
</head>
<body>
<main class="container mt-4">
    <h1>Zamawianie posiłków</h1>
    <h2>Miesiąc: <?= htmlspecialchars($currentMonth) ?></h2>
    <form method="post" action="<?= base_url('user/save') ?>">
        <div class="calendar">
            <div class="calendar-day weekend">Pon</div>
            <div class="calendar-day weekend">Wt</div>
            <div class="calendar-day weekend">Śr</div>
            <div class="calendar-day weekend">Cz</div>
            <div class="calendar-day weekend">Pt</div>
            <div class="calendar-day weekend">Sob</div>
            <div class="calendar-day weekend">Nd</div>

            <?php
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($currentMonth)), date('Y', strtotime($currentMonth)));
            $firstDayOfMonth = date('N', strtotime($currentMonth . '-01'));

            // Generate all days of the month
            $days = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = date('Y-m-d', strtotime("$currentMonth-$day"));
                $days[$date] = ['date' => $date, 'ingredients' => '', 'id' => null, 'available' => false];
            }

            // Populate days from menu
            foreach ($menu as $item) {
                $date = $item['date'];
                if (isset($days[$date])) {
                    $days[$date]['ingredients'] = $item['ingredients'];
                    $days[$date]['id'] = $item['id'];
                    $days[$date]['available'] = $item['available'] == 1;

                }
            }

            // Print empty days before the first day of the month
            for ($i = 1; $i < $firstDayOfMonth; $i++): ?>
                <div class="calendar-day empty"></div>
            <?php endfor; ?>

            <!-- Print days of the month -->
            <?php foreach ($days as $day): ?>
                <?php
                $dayOfWeek = date('N', strtotime($day['date']));
                $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 7);
                ?>
                <label class="calendar-day <?= $isWeekend ? 'weekend' : '' ?> <?= !$day['available'] ? 'disabled' : '' ?>">
                    <input type="checkbox" name="meals[]" value="<?= $day['id'] ?>"
                        <?= in_array($day['id'], $userMealIds) ? 'checked' : '' ?>
                        <?= !$day['available'] ? 'disabled' : '' ?>>
                    <div class="checkbox-label"></div>
                    <div class="date"><?= date('d', strtotime($day['date'])) ?></div>
                    <div class="menu"><?= htmlspecialchars($day['ingredients']) ?></div>
                </label>
            <?php endforeach; ?>

            <!-- Print empty days after the last day of the month -->
            <?php
            $totalCells = $firstDayOfMonth + $daysInMonth;
            $extraCells = (7 - ($totalCells % 7)) % 7;
            for ($i = 0; $i < $extraCells; $i++): ?>
                <div class="calendar-day empty"></div>
            <?php endfor; ?>
        </div>
        <button type="submit" class="but_table">Zapisz</button>
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
    </form>
</main>
<script>
    document.querySelectorAll('.calendar-day').forEach(day => {
        day.addEventListener('click', function () {
            const checkbox = this.querySelector('input[type="checkbox"]');
            if (checkbox && !checkbox.disabled) {
                checkbox.checked = !checkbox.checked;
            }
        });
    });
</script>
</body>
</html>
