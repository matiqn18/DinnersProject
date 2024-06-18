<!DOCTYPE html>
<html>
<head>
    <title>Daily Orders</title>
</head>
<body>
<h1>Daily Orders for <?= esc($date) ?></h1>
<a href="<?= base_url('accountant') ?>">Powrót</a>

<form method="get" action="<?= base_url('accountant/daily_orders') ?>">
    <input type="date" name="date" value="<?= esc($date) ?>">
    <button type="submit">Go</button>
</form>

<div>
    <a href="<?= base_url('accountant/daily_orders/' . date('Y-m-d', strtotime($date . ' -1 day'))) ?>">Previous Day</a>
    <a href="<?= base_url('accountant/daily_orders/' . date('Y-m-d', strtotime($date . ' +1 day'))) ?>">Next Day</a>
</div>

<form action="<?= base_url('accountant/generatePDF/' . $date) ?>" method="post">
    <button type="submit">Generate PDF</button>
</form>

<?php if (!empty($dailyOrders)): ?>
    <?php foreach ($dailyOrders as $order): ?>
        <h2>Menu: <?= esc($order['menu']['ingredients']) ?> (<?= esc($order['menu']['date']) ?>)</h2>
        <ul>
            <?php if (!empty($order['users'])): ?>
                <?php foreach ($order['users'] as $user): ?>
                    <li><?= esc($user['username']) ?> (<?= esc($user['email']) ?>)</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No orders for this menu item.</li>
            <?php endif; ?>
        </ul>
    <?php endforeach; ?>
<?php else: ?>
    <p>No menu items found for this date.</p>
<?php endif; ?>
</body>
</html>
