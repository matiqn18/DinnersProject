<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadłospis na najbliższe dni</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('back_button.css'); ?>">
    <style>


    </style>
</head>
<body>
<main style="max-width: 1000px">
    <button class="close-btn" style="margin-bottom: 10px" onclick="window.location.href='<?php echo base_url(); ?>'">X</button>
    <header class="menu">
        <h1>Jadłospis na najbliższe dni</h1>
    </header>

    <?php if ($meals): ?>
        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Składniki</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($meals as $meal): ?>
                <tr>
                    <td><strong><?php echo date('Y-m-d', strtotime($meal['date'])); ?></strong></td>
                    <td><?php echo htmlspecialchars($meal['ingredients']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h2>Brak posiłków do wyświetlenia.</h2>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
