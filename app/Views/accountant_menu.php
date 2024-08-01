<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('inframe_style.css'); ?>">
    <style>


    </style>
</head>
<body>
<main class="container mt-4">
    <h1>Plan Posiłków</h1>
    <?php if (!empty($menu) && is_array($menu)): ?>
        <table class="table">
            <thead>
            <tr>
                <th class="col-date">Data</th>
                <th class="col-availability">Dostępność</th>
                <th class="col-ingredients">Menu</th>
                <th class="col-actions text-center">Operacje</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($menu as $item): ?>
                <tr>
                    <td class="col-date"><?= esc($item['date']) ?></td>
                    <td class="col-availability">
                        <?php if (esc($item['available']) == 1): ?>
                            <span class="text-success">&#10003;</span>
                        <?php else: ?>
                            <span class="text-danger">&#10007;</span>
                        <?php endif ?>
                    </td>
                    <td class="col-ingredients"><?= esc($item['ingredients']) ?></td>
                    <td class="col-actions text-center">
                        <a class="but_table" href="<?= base_url('accountant/menu/edit/'.esc($item['id'])) ?>" class="btn btn-sm">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No menu items found</p>
    <?php endif ?>

    <div class="centered-container">
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

            <div class="month-navigation">
                <?php if ($currentPage > 1): ?>
                    <a href="<?= base_url('accountant/menu?page=' . ($currentPage - 1)) ?>">Poprzedni miesiąc</a>
                <?php endif ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= base_url('accountant/menu?page=' . ($currentPage + 1)) ?>">Następny miesiąc</a>
                <?php endif ?>
            </div>
        </div>

        <form action="<?= base_url('accountant/uploadMenu') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="menu_file">Upload Menu File (.txt):</label>
                <input type="file" id="menu_file" name="menu_file" accept=".txt" class="form-control-file" required>
            </div>
            <button type="submit" class="but_table">Upload</button>
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

</body>
</html>
