<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #14452f;
            color: white;
        }
        button {
            background-color: #14452f;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9em;
        }
        button:hover {
            background-color: #0e3723;
        }
        #payment-form {
            display: none;
        }
    </style>
</head>
<body>
<h1>Baza Uczniów</h1>
<div class="search-container">
    <input type="text" id="search-input" onkeyup="filterTable()" placeholder="Wyszukaj imiona lub nazwiska">
</div>
<?php if (!empty($users) && is_array($users)): ?>
    <table id="user-table">
        <thead>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Klasa</th>
            <th>Ilość zamówionych posiłków</th>
            <th>Koszt zamówień</th>
            <th>Wartość wpłat</th>
            <th>Balans</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['name']) ?></td>
                <td><?= esc($user['surname']) ?></td>
                <td><?= esc($user['class_name']) ?></td>
                <td><?= esc($user['meal_count']) ?></td>
                <td><?= esc($user['total_meal_cost']) ?></td>
                <td><?= esc($user['total_payments']) ?></td>
                <td><?= esc($user['balance']) ?></td>
                <td>
                    <button class="but_table" onclick="toggleForm(<?= $user['id'] ?>)">Add Payment</button>
                    <div id="payment-form-<?= $user['id'] ?>" style="display: none;">
                        <form action="<?= base_url('accountant/addPayment') ?>" method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="number" name="payment_amount" step="0.01" required>
                            <button class="but_table" type="submit">Save</button>
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

<script>
    function toggleForm(userId) {
        var form = document.getElementById('payment-form-' + userId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function filterTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById('search-input');
        filter = input.value.toLowerCase();
        table = document.getElementById('user-table');
        tr = table.getElementsByTagName('tr');

        for (i = 1; i < tr.length; i++) { // start from 1 to skip table header
            tr[i].style.display = 'none'; // hide all rows initially

            td = tr[i].getElementsByTagName('td');
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = ''; // show the row
                        break; // stop checking other cells in the same row
                    }
                }
            }
        }
    }
</script>
</body>
</html>
