<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('main_style.css'); ?>">
    <style>
        body {
            height: 100vh;

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

    </style>
</head>
<body>
<div id="main-container">
    <div id="navigation">
        <a style="background-color: darkred" href="#" onclick="window.location.href='<?php echo base_url(); ?>'">Wyloguj</a>
        <a href="#" onclick="loadContent('<?php echo base_url('accountant/menu'); ?>')">Edycja Jadłospisu</a>
        <a href="#" onclick="loadContent('<?php echo base_url('accountant/financialInfo'); ?>')">Finanse Uczniów</a>
        <a href="#" onclick="loadContent('<?php echo base_url('accountant/daily_orders'); ?>')">Dzienna rozpiska</a>
    </div>
    <iframe id="content" src="<?php echo base_url('accountant/menu'); ?>"></iframe>
</div>
<?php include 'footer.php'; ?>
<script>
    function loadContent(url) {
        document.getElementById('content').src = url;
    }
</script>
</body>
</html>
