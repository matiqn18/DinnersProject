<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF dzienne zamówienia <?= esc($date) ?></title>
    <style>
        body {
            font-family: DejaVu Sans, serif;
        }
        h1, h2 {
            margin-bottom: 10px;
        }
        ul {
            margin-top: 0;
            padding-left: 20px;
        }
        li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<h1>Zamówienia na dzień: <?= esc($date) ?></h1>

<?php foreach ($dailyOrders as $order): ?>
    <h2>Menu: <?= esc($order['menu']['ingredients']) ?> (<?= esc($order['menu']['date']) ?>)</h2>
    <ul>
        <?php if (!empty($order['users'])): ?>
            <?php foreach ($order['users'] as $user): ?>
                <li><?= esc($user['name'])." ".esc($user['surname']) ?> (<?= esc($user['email']) ?>)</li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Brak zamówień.</li>
        <?php endif; ?>
    </ul>
<?php endforeach; ?>
</body>
</html>
