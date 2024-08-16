<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
<h1>Panel Administracyjny</h1>

<form action="<?php echo base_url('admin/updateDateRecords'); ?>" method="post">
        <label for="startDate">Data rozpoczęcia:</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo $startdate; ?>">
        <label for="endDate">Data zakończenia:</label>
        <input type="date" id="endDate" name="endDate" value="<?php echo $enddate; ?>">
        <label for="recordPrice">Cena:</label>
        <input step="any" type="number" id="recordPrice" name="recordPrice" value="<?php echo $price; ?>">
        <label for="resetTable">Zresetuj tabelę z obiadami i wygeneruj ponownie:</label>
        <input type="checkbox" id="resetTable" name="resetTable" onclick="showWarning()">
        <input type="submit" value="Zapisz zmiany">
        <br>
</form>
<script>
    function showWarning() {
        alert("UWAGA: Wybranie tej opcji spowoduje zresetowanie tabeli z obiadami i ponowne jej wygenerowanie!");
    }
</script>
</body>
</html>
