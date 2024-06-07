<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Detalle de promoción
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
    </head>
    <body>
    <?php include('menu.php') ?>
        <?php
        require "funciones/conecta.php";
        $id = $_GET['id'];
        $con = conecta();
        $sql = "SELECT nombre,estado,archivo FROM promociones WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();

        $nombre = $row['nombre'];
        $status = $row['estado'] ? 'Activo' : 'Inactivo';
        $archivo = $row['archivo'];

        $imagen = "promociones_fotos/$archivo";
        ?>
        
        <div class="cuadro_empleado">
            <div class="ver_empleado">
                <?php
                echo "<h1 class='barraTitulo'>$nombre</h1>";
                echo "<img class='id_cartilla' src='$imagen' onerror=\"this.src='../fontawesome-free-6.5.2-web/svgs/solid/piggy-bank.svg';this.classList.add('svgSutil');\" >";
                ?>
                <div style="text-align: left; padding: 0px 25px;">
                    <?php
                    echo "<p><b>Estado: </b>$status</p>";
                    ?>
                </div>
            </div>
            <button class="btn" onclick="window.open('promociones_lista.php','_self')">Regresar</button>
        </div>
    </body>
</html>