<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
    <style>

    </style>
</head>
<body>
<h1>Zamówienia na dzień <?= esc($date) ?></h1>

<form class="dateform" method="get" action="<?= base_url('accountant/daily_orders') ?>">
    <input type="date" name="date" value="<?= esc($date) ?>">
    <button type="submit">Go</button>
    <a href="<?= base_url('accountant/daily_orders/' . date('Y-m-d', strtotime($date . ' -1 day'))) ?>">Previous Day</a>
    <a href="<?= base_url('accountant/daily_orders/' . date('Y-m-d', strtotime($date . ' +1 day'))) ?>">Next Day</a>
</form>

<form action="<?= base_url('accountant/generatePDF/' . $date) ?>" method="post">
    <button type="submit">Generuj PDF</button>
</form>

<?php if (!empty($dailyOrders)): ?>
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
<?php else: ?>
    <p>Brak menu na tą datę.</p>
<?php endif; ?>
</body>
</html>
