<!DOCTYPE html>
<html>
<head>
    <title>Zamawianie posiłków</title>
</head>
<body>
<a href="<?= base_url('user') ?>">Panel Główny</a><br>
<h1>Zamawianie posiłków</h1>
<h2>Miesiąc: <?= $currentMonth ?></h2>
<form method="post" action="<?= base_url('user/save') ?>">
    <table border="1">
        <tr>
            <th>Data</th>
            <th>Menu</th>
            <th>Zamówienie</th>
        </tr>
        <?php foreach ($menu as $item): ?>
            <tr>
                <td><?= $item['date'] ?></td>
                <td><?= $item['ingredients'] ?></td>
                <td>
                    <input type="checkbox" name="meals[]" value="<?= $item['id'] ?>"
                        <?= in_array($item['id'], $userMealIds) ? 'checked' : '' ?>
                        <?= $item['available'] == 1 ? '' : 'disabled' ?>>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit">Zapisz</button>
</form>
<a href="<?= base_url('user/changeMonth/prev/' . $currentIndex) ?>" <?= $currentIndex == 0 ? 'style="pointer-events: none; color: gray;"' : '' ?>>
    Poprzedni miesiąc
</a>
<a href="<?= base_url('user/changeMonth/next/' . $currentIndex) ?>" <?= $currentIndex == count($months) - 1 ? 'style="pointer-events: none; color: gray;"' : '' ?>>
    Następny miesiąc
</a>

</body>
</html>
