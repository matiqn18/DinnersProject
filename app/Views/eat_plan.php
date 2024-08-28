<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dzisiejszy obiad</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
</head>
<body>
<style>
</style>
<main>

    <header class="menu">
        <h1>Obiady na najbliższe 2 tygodnie</h1>
    </header>

    <div class="meal-schedule">
        <?php if ($meals && count($meals) > 0): ?>
            <?php foreach ($meals as $meal): ?>
                <div class="meal">
                    <h2><?php echo date('d-m-Y', strtotime($meal->date)); ?></h2>
                    <p><?php echo htmlspecialchars($meal->ingredients); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2>Brak dostępnych obiadów na najbliższe 2 tygodnie.</h2>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
