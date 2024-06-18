<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
    <script>
        function toggleForm(userId) {
            var form = document.getElementById('payment-form-' + userId);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</head>
<body>
<h1>User Accounts</h1>
<a href="<?= base_url('accountant') ?>">Powrót</a>
<?php if (!empty($users) && is_array($users)): ?>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Meal Count</th>
            <th>Total Meal Cost</th>
            <th>Total Payments</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['meal_count']) ?></td>
                <td><?= esc($user['total_meal_cost']) ?></td>
                <td><?= esc($user['total_payments']) ?></td>
                <td><?= esc($user['balance']) ?></td>
                <td>
                    <button onclick="toggleForm(<?= $user['id'] ?>)">Add Payment</button>
                    <div id="payment-form-<?= $user['id'] ?>" style="display: none;">
                        <form action="<?= base_url('accountant/addPayment') ?>" method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="number" name="payment_amount" step="0.01" required>
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No user accounts found</p>
<?php endif ?>
</body>
</html>
