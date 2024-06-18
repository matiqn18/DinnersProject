<!DOCTYPE html>
<html>
<head>
    <title>Edit Meal</title>
</head>
<body>
<h1>Edit Meal</h1>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="<?= base_url('accountant/menu/update/' . $meal['id']) ?>" method="post">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?= esc($meal['date']) ?>" readonly required><br>

    <label for="available">Available:</label>
    <input type="checkbox" id="available" name="available" value="1" <?= $meal['available'] ? 'checked' : '' ?>>
    <br>

    <label for="ingredients">Ingredients:</label>
    <textarea id="ingredients" name="ingredients" required><?= esc($meal['ingredients']) ?></textarea><br>

    <button type="submit">Save</button>
</form>

<a href="<?= base_url('accountant/menu') ?>">Back to Menu</a>
</body>
</html>
