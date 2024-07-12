<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dzisiejszy obiad</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url('<?php echo base_url('1.png'); ?>') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            width: 100%;
            background-color: rgba(20, 69, 47, 0.8);
            color: white;
            padding: 1em 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-weight: 700;
        }

        main {
            width: 90%;
            max-width: 600px;
            padding: 2em;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .menu-links {
            display: flex;
            justify-content: center;
            gap: 1em;
            margin-bottom: 2em;
        }

        a {
            color: white;
            background-color: #14452f;
            text-decoration: none;
            padding: 0.75em 1.5em;
            border: none;
            border-radius: 25px;
            font-weight: 500;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        a:hover {
            background-color: #0e3723;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #14452f;
            margin: 1em 0;
        }

        p {
            margin: 1.5em 0;
            font-size: 1.1em;
            color: #555;
        }

        .meal-container {
            background-color: #eef7f0;
            border-radius: 8px;
            padding: 1.5em;
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .menu {
            color: white;
            background-color: #14452f;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            font-weight: 500;
            transition: background-color 0.3s, box-shadow 0.3s;
        }


        @media (max-width: 600px) {
            .menu-links {
                flex-direction: column;
                align-items: center;
            }

            .menu-links a {
                width: 100%;
                text-align: center;
                margin: 0.5em 0;
            }
        }
    </style>
</head>
<body>



<main>
    <div class="menu-links">
        <a href="<?php echo base_url('login'); ?>">Zaloguj się</a>
        <a href="<?php echo base_url('register'); ?>">Zarejestruj się</a>
    </div>

    <header class="menu">
        <h1>Dzisiejszy obiad</h1>
    </header>

    <?php if ($meal->ingredients): ?>
        <div class="meal-container">
            <h2><?php echo $meal->ingredients; ?></h2>
        </div>
    <?php else: ?>
        <h2>Nie ma dzisiaj obiadu w menu.</h2>
    <?php endif; ?>

    <br>

    <a href="<?php echo base_url('menu'); ?>">Wyświetl jadłospis</a>
</main>

</body>
</html>
