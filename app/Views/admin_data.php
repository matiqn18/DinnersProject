<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('admin_style.css'); ?>">
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

        <div class="checkbox-group">
            <input type="checkbox" id="resetTable" name="resetTable" onclick="showWarning()">
            <label for="resetTable">Zresetuj tabelę z obiadami i wygeneruj ponownie:</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="graduation" name="graduation">
            <label for="graduation">Promocje do następnej klasy uczniów:</label>
        </div>

        <input class="navigator" type="submit" value="Zapisz zmiany">
        <br>
    </form>

</div>



<!-- Formularz zarządzania klasami -->
<h2><button class="toggle-button"  onclick="togglePanel('classPanel')">Klasy</button></h2>
<br>
<div id="classPanel" class="panel">
    <form action="<?php echo base_url('admin/updateClassAvailability'); ?>" method="post">
        <button style="margin-bottom: 10px;" class="navigator" type="submit">Zapisz zmiany</button>
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
