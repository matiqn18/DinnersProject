<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            color: #e0e0e0;
            font-family: 'Roboto', sans-serif;
            background-color: transparent; /* Bez tła */
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

        form {
            margin: 20px auto;
            width: 90%;
            padding: 20px;
            border-radius: 8px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            color: #e0e0e0;
        }

        form input[type="date"],
        form input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #333;
            color: #e0e0e0;
        }

        form input[type="checkbox"] {
            margin-right: 10px;
        }


        .navigator {
            display: inline-block;
            padding: 10px 20px;
            background-color: #14452f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .navigator:hover {
            background-color: #0e3723;
            transform: scale(1.05);
        }

        .panel {
            display: none;
        }

        .panel.active {
            display: block;
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

        .section-header {
            background-color: #14452f;
            padding: 10px;
            color: white;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: left;
            font-weight: bold;
        }

        .class-table {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 10px;
        }

        .class-table div {
            background-color: #333;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: left;
        }

        .class-table.sp div {
            width: calc(20% - 10px); /* 4 kolumny */
        }

        .class-table.lo div {
            width: calc(25% - 10px); /* 3 kolumny */
        }

        .class-table.tech div {
            width: calc(40% - 10px); /* 2 kolumny */
        }

        .class-table div label {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .class-table div label input {
            margin-left: 10px;
        }

        .success-message {
            color: green;
            margin: 20px 0;
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

        function showWarning() {
            alert("UWAGA: Wybranie tej opcji spowoduje zresetowanie tabeli z obiadami i ponowne jej wygenerowanie!");
        }
    </script>

</head>
<body>

<?php if (session()->has('success')): ?>
    <div class="success-message">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<h2><button class="toggle-button" onclick="togglePanel('systemPanel')">System</button></h2>
<div id="systemPanel" class="panel">
    <form action="<?php echo base_url('admin/updateDateRecords'); ?>" method="post">
        <label for="startDate">Data rozpoczęcia:</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo $startdate; ?>">
        <label for="endDate">Data zakończenia:</label>
        <input type="date" id="endDate" name="endDate" value="<?php echo $enddate; ?>">
        <label for="recordPrice">Cena:</label>
        <input step="any" type="number" id="recordPrice" name="recordPrice" value="<?php echo $price; ?>">
        <label for="resetTable">Zresetuj tabelę z obiadami i wygeneruj ponownie:</label>
        <input type="checkbox" id="resetTable" name="resetTable" onclick="showWarning()">
        <label for="graduation">Promocje do następnej klasy uczniów:</label>
        <input type="checkbox" id="graduation" name="graduation" >
        <input class="navigator"  type="submit" value="Zapisz zmiany">
        <br>
    </form>
</div>



<!-- Formularz zarządzania klasami -->
<h2><button class="toggle-button" onclick="togglePanel('classPanel')">Klasy</button></h2>
<div id="classPanel" class="panel">
    <form action="<?php echo base_url('admin/updateClassAvailability'); ?>" method="post">
        <button class="navigator" type="submit">Zapisz zmiany</button>
        <!-- Podstawówka (SP) -->
        <div class="section-header">Podstawówka (SP)</div>
        <div class="class-table sp">
            <?php foreach ($class as $c): ?>
                <?php if (strpos($c['name'], 'SP_') === 0): ?>
                    <div>
                        <label for="<?= $c['id_class'] ?>">
                            <?= $c['name'] ?>
                            <input type="checkbox" name="<?= $c['id_class'] ?>" id="<?= $c['id_class'] ?>"
                                   <?= $c['available'] == 1 ? 'checked' : '' ?>>
                        </label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="section-header">Liceum (LO)</div>
        <div class="class-table lo">
            <?php foreach ($class as $c): ?>
                <?php if (strpos($c['name'], 'LO_') === 0): ?>
                    <div>
                        <label for="classID<?= $c['id_class'] ?>">
                            <?= $c['name'] ?>
                            <input type="checkbox" name="<?= $c['id_class'] ?>" id="<?= $c['id_class'] ?>"
                                   <?= $c['available'] == 1 ? 'checked' : '' ?>>
                        </label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="section-header">Technikum (TE)</div>
        <div class="class-table tech">
            <?php foreach ($class as $c): ?>
                <?php if (strpos($c['name'], 'TE_') === 0): ?>
                    <div>
                        <label for="<?= $c['id_class'] ?>">
                            <?= $c['name'] ?>
                            <input type="checkbox" name="<?= $c['id_class'] ?>" id="<?= $c['id_class'] ?>"
                                   <?= $c['available'] == 1 ? 'checked' : '' ?>>
                        </label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>


    </form>
</div>
</body>
</html>
