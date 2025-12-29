<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASE_URL . '/static/css/form.css'; ?>">
        <link rel="stylesheet" href="<?php echo BASE_URL . '/static/css/style.css'; ?>">
        <script type="text/javascript" src="<?php echo BASE_URL . '/static/js/script.js'; ?>" ></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL . '/static/js/jquery.js'; ?>" ></script>
        <title>Registre</title>
    </head>
    <body>
        <?php
        include_once __DIR__.'/controladors/header.php';
        include __DIR__.'/controladors/registre.php';
        ?>

    </body>
</html>