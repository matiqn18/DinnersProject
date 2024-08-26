<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            color: #e0e0e0;
        }

        a {
            color: #bb86fc;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        h1, h2 {
            color: #bb86fc;
            margin-top: 20px;
        }

        h2 {
            margin-top: 40px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
            background: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #333;
        }

        th {
            background-color: #333;
            color: #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #1e1e1e;
        }

        tr:nth-child(odd) {
            background-color: #2c2c2c;
        }

        .success-message {
            color: green;
            margin: 20px 0;
        }

        button, .action-link {
            background-color: #14452f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
            text-decoration: none;
            display: inline-block;
        }

        button:hover, .action-link:hover {
            background-color: #0e3723;
        }

        .pagination-links {
            margin-top: 20px;
        }

        .pagination-links a {
            background-color: #bb86fc;
            color: #121212;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            margin: 0 5px;
            font-size: 16px;
        }

        .pagination-links a.disabled {
            background-color: gray;
            color: #ccc;
            pointer-events: none;
        }

        .pagination-links a:hover {
            background-color: #9f67e4;
        }

        @media (max-width: 600px) {
            table, th, td {
                font-size: 14px;
                padding: 8px;
            }

            button, .action-link {
                width: 100%;
                padding: 12px;
            }
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            background-color: #bb86fc;
            color: #121212;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #9f67e4;
        }

        .panel {
            display: none;
        }

        .panel.active {
            display: block;
        }
        .search-input {
            width: 80%;
        }

        .toggle-button {
            cursor: pointer;
            color: white;
            background: none;
            border: none;
            font-size: 18px;
            margin-top: 20px;
        }

        .toggle-button:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function filterTable(tableId, searchFieldId) {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById(searchFieldId);
            filter = input.value.toLowerCase();
            table = document.getElementById(tableId);
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

        function togglePanel(panelId) {
            var panel = document.getElementById(panelId);
            if (panel.classList.contains('active')) {
                panel.classList.remove('active');
            } else {
                panel.classList.add('active');
            }
        }
    </script>
</head>
<body>
<?php if (session()->has('success')): ?>
    <div class="success-message">
        <?= session('success') ?>
    </div>
<?php endif; ?>


<h2><button class="toggle-button" onclick="togglePanel('users_panel')">Uczniowie</button></h2>
<div id="users_panel" class="panel">
    <form class="search-form">
        <input type="text" class="search-input" id="user_search" placeholder="Szukaj po imieniu, nazwisku lub klasie" onkeyup="filterTable('users_table', 'user_search')">
    </form>
    <table id="users_table">
        <tr>
            <th>ID</th>
            <th>Nazwa użytkownika</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Klasa</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['surname'] ?></td>
                <td><?= $user['class_name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <a href="<?= base_url('admin/edit/'.$user['id']) ?>" class="action-link">Edit</a>
                    <a href="<?= base_url('admin/delete/'.$user['id']) ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<h2><button class="toggle-button" onclick="togglePanel('graduated_panel')">Absolwenci</button></h2>
<div id="graduated_panel" class="panel">
    <form class="search-form">
        <input type="text" class="search-input" id="graduated_search" placeholder="Szukaj po imieniu lub nazwisku" onkeyup="filterTable('graduated_table', 'graduated_search')">
    </form>
    <table id="graduated_table">
        <tr>
            <th>ID</th>
            <th>Nazwa użytkownika</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($graduated as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['surname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <a href="<?= base_url('admin/edit/'.$user['id']) ?>" class="action-link">Edit</a>
                    <a href="<?= base_url('admin/delete/'.$user['id']) ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<h2><button class="toggle-button" onclick="togglePanel('accountants_panel')">Księgowość</button></h2>
<div id="accountants_panel" class="panel">
    <form class="search-form">
        <input type="text" class="search-input" id="accountant_search" placeholder="Szukaj po imieniu lub nazwisku" onkeyup="filterTable('accountants_table', 'accountant_search')">
    </form>
    <table id="accountants_table">
        <tr>
            <th>ID</th>
            <th>Nazwa użytkownika</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($accountants as $accountant): ?>
            <tr>
                <td><?= $accountant['id'] ?></td>
                <td><?= $accountant['username'] ?></td>
                <td><?= $accountant['name'] ?></td>
                <td><?= $accountant['surname'] ?></td>
                <td><?= $accountant['email'] ?></td>
                <td>
                    <a href="<?= base_url('admin/edit/'.$accountant['id']) ?>" class="action-link">Edit</a>
                    <a href="<?= base_url('admin/delete/'.$accountant['id']) ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<h2><button class="toggle-button" onclick="togglePanel('admins_panel')">Administratorzy</button></h2>
<div id="admins_panel" class="panel">
    <form class="search-form">
        <input type="text" class="search-input" id="admin_search" placeholder="Szukaj po imieniu lub nazwisku" onkeyup="filterTable('admins_table', 'admin_search')">
    </form>
    <table id="admins_table">
        <tr>
            <th>ID</th>
            <th>Nazwa użytkownika</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?= $admin['id'] ?></td>
                <td><?= $admin['username'] ?></td>
                <td><?= $admin['name'] ?></td>
                <td><?= $admin['surname'] ?></td>
                <td><?= $admin['email'] ?></td>
                <td>
                    <a href="<?= base_url('admin/edit/'.$admin['id']) ?>" class="action-link">Edit</a>
                    <a href="<?= base_url('admin/delete/'.$admin['id']) ?>" style="background-color: darkred; color: white" class="action-link" onclick="return confirm('Czy na pewno chcesz usunąć urzytkownika?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>



</body>
</html>
