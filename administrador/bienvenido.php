<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenido</title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <?php include('menu.php') ?>
    </head>
    <body class="third-color">
        <h1 class="barraTitulo">Hola <?php echo $nombreUsuario ?>, bienvenido al sistema.</h1>
    </body>
</html>