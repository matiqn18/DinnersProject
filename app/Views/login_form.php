<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz Logowania</title>
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

        main {
            position: relative;
            width: 90%;
            max-width: 400px;
            padding: 2em;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #14452f;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 1.2em;
            font-weight: bold;
            line-height: 1;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .close-btn:hover {
            background-color: #0e3723;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-weight: 700;
            color: #14452f;
            margin-bottom: 1em;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }

        label {
            font-weight: 500;
            color: #14452f;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            padding: 0.75em;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 0.75em;
            border: none;
            border-radius: 5px;
            background-color: #14452f;
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0e3723;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .error {
            color: red;
            margin-bottom: 1em;
        }
    </style>
</head>
<body>

<main>
    <button class="close-btn" onclick="window.location.href='<?php echo base_url(); ?>'">X</button>
    <h1>Logowanie</h1>

    <?php if (session()->has('error')): ?>
        <div class="error">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
        <label for="username">Email lub Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Zaloguj">
    </form>
</main>

</body>
</html>
