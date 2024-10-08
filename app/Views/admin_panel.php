<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?php echo base_url('admin_style.css'); ?>">
    <style>

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
                    <a href="<?= base_url('admin/delete/'.$user['id']) ?>" class="action-link" style="background-color: darkred; color: white" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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
                    <a href="<?= base_url('admin/delete/'.$user['id']) ?>" style="background-color: darkred; color: white" class="action-link" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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
                    <a href="<?= base_url('admin/delete/'.$accountant['id']) ?>" style="background-color: darkred; color: white" class="action-link" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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
                    <a href="<?= base_url('admin/delete/'.$admin['id']) ?>" style="background-color: darkred; color: white"  class="action-link" onclick="return confirm('Czy na pewno chcesz usunąć urzytkownika?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>



</body>
</html>
