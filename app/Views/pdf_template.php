<!-- pdf_template.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Daily Orders PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
<h1>Daily Orders for <?= esc($date) ?></h1>

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
</body>
</html>
