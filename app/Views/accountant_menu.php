<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
<h1>Menu</h1>
<a href="<?= base_url('accountant') ?>">Panel Główny</a><br>
<a href="<?= base_url('accountant/menu?page=' . $todayPage) ?>">Dzisiejsza</a><br>

<?php if (!empty($menu) && is_array($menu)): ?>
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Available</th>
            <th>Ingredients</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($menu as $item): ?>
            <tr>
                <td><?= esc($item['date']) ?></td>
                <td><?= esc($item['available']) ?></td>
                <td><?= esc($item['ingredients']) ?></td>
                <td>
                    <a href="<?= base_url('accountant/menu/edit/'.esc($item['id']) ) ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No menu items found</p>
<?php endif ?>

<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <a href="<?= base_url('accountant/menu?page=1') ?>" class="first">Pierwsza</a>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?= base_url('accountant/menu?page=' . $i) ?>" class="<?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor ?>
        <a href="<?= base_url('accountant/menu?page=' . $totalPages) ?>" class="last">Ostatnia</a>
    <?php endif ?>

    <!-- Przyciski nawigacyjne dla miesięcy -->
    <?php if ($totalPages > 1): ?>
        <div class="month-navigation">
            <?php if ($currentPage > 1): ?>
                <a href="<?= base_url('accountant/menu?page=' . ($currentPage - 1)) ?>">Poprzedni miesiąc</a>
            <?php endif ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="<?= base_url('accountant/menu?page=' . ($currentPage + 1)) ?>">Następny miesiąc</a>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>

<form action="<?= base_url('accountant/uploadMenu') ?>" method="post" enctype="multipart/form-data">
    <label for="menu_file">Upload Menu File (.txt):</label>
    <input type="file" id="menu_file" name="menu_file" accept=".txt" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>
