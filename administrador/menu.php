<!DOCTYPE html>
<html>
    <?php
    session_start();
    $nombreUsuario = $_SESSION['nombreSesion'];
    if (!isset($nombreUsuario)) {
        header("Location: index.php");
    }
    ?>
    <head>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <ul class="navbar">
            <li><a href="bienvenido.php">Inicio</a></li>
            <li><a href="empleados_lista.php">Empleados</a></li>
            <li><a href="productos_lista.php">Productos</a></li>
            <li><a href="promociones_lista.php">Promociones</a></li>
            <li><a href="pedidos_lista.php">Pedidos</a></li>
            <li><a> Bienvenido <?php echo $nombreUsuario ?></a></li>
            <li><a href="salir.php">Cerrar Sesion</a></li>
        </ul>
    </body>
</html>