<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meal</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('checkbox.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('back_button.css'); ?>">

</head>
<body>
<button class="close-btn" onclick="window.location.href='<?php echo base_url('accountant/menu'); ?>'">X</button>
<h1>Edit Meal</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form class="editform" action="<?= base_url('accountant/menu/update/' . $meal['id']) ?>" method="post">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?= esc($meal['date']) ?>" readonly required>

    <div class="checkbox-wrapper-1">
        <input id="example-1" class="substituted" type="checkbox" name="available" value="1" <?= $meal['available'] ? 'checked' : '' ?>>
        <label for="example-1">Available:</label>
    </div>

    <label for="ingredients">Ingredients:</label>
    <textarea id="ingredients" name="ingredients" required><?= esc($meal['ingredients']) ?></textarea>

    <button type="submit">Save</button>
</form>
</body>
</html>
