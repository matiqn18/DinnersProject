<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Użytkownika</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            position: relative;
        }
        #main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            height: 90%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            position: relative;
            z-index: 1;
        }
        #navigation {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        #navigation a {
            text-decoration: none;
            color: white;
            background-color: #14452f;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        #navigation a:hover {
            background-color: #0e3723;
        }
        #content {
            flex: 1;
            width: 100%;
            border: none;
            margin-bottom: 5px;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Stylizacja modalu */
        #class-selection-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
            justify-content: center;
            align-items: center;
        }
        #modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 500px;
            width: 80%;
        }
        #modal-content h2 {
            margin-bottom: 20px;
        }
        #modal-content select, #modal-content button {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            font-size: 16px;
        }
        #modal-content button {
            background-color: #14452f;
            color: white;
            border: none;
            cursor: pointer;
        }
        #modal-content button:hover {
            background-color: #0e3723;
        }
    </style>
</head>
<body>
<div id="main-container">
    <div id="navigation">
        <a style="background-color: darkred" href="#" onclick="window.location.href='<?php echo base_url(); ?>'">Wyloguj</a>
        <a href="#" onclick="loadContent()">Zamów posiłek</a>
        <a href="#" onclick="loadContent('<?php echo base_url('user/info'); ?>')">Wyświetl informacje o koncie</a>
    </div>
    <iframe id="content"></iframe>
</div>

<!-- Modal do wyboru klasy -->
<div id="class-selection-modal">
    <div id="modal-content">
        <h2>Gratulujemy! Wybierz swoją nową klasę</h2>
        <form action="<?php echo base_url('user/selectClass'); ?>" method="post">
            <select name="selected_class" required>
                <?php foreach ($class as $classItem): ?>
                    <option value="<?php echo $classItem['id_class']; ?>">
                        <?php echo $classItem['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Wybierz klasę</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
    function loadContent(url) {
        const iframe = document.getElementById('content');
        let baseUrl = '<?php echo base_url(); ?>';
        let userOrderUrl = baseUrl + 'user/order';
        let mobileOrderUrl = baseUrl + 'user/order_mobile';

        if (window.innerWidth <= 768) {
            iframe.src = url || mobileOrderUrl;
        } else {
            iframe.src = url || userOrderUrl;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadContent();

        // Sprawdzenie zmiennej `class` i wyświetlenie modalu
        const classData = <?php echo json_encode($class); ?>;
        if (classData.length > 0) {
            document.getElementById('class-selection-modal').style.display = 'flex';
        }
    });
</script>
</body>
</html>
