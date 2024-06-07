<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Detalle de empleado
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <?php include('menu.php') ?>
        <?php
        require "funciones/conecta.php";
        $id = $_GET['id'];
        $con = conecta();
        $sql = "SELECT nombre,apellidos,correo,rol,estado,archivo_n,archivo_f FROM empleados WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();

        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $correo = $row['correo'];
        $rol = $row['rol'] ==1  ? 'Gerente' : 'Ejecutivo';
        $status = $row['estado'] ? 'Activo' : 'Inactivo';
        $archivo_n = $row['archivo_n'];
        $archivo_f = $row['archivo_f'];

        $arreglo    = explode(".",$archivo_n);
        $len        = count($arreglo);
        $pos        = $len-1;
        $ext        = $arreglo[$pos];

        $imagen = "empleados_fotos/$archivo_f.$ext";
        ?>
        
        <div class="cuadro_empleado">
            <div class="ver_empleado">
                <?php
                echo "<h1 class='barraTitulo'>$nombre $apellidos</h1>";
                echo "<img class='id_cartilla' src='$imagen' onerror=\"this.src='../fontawesome-free-6.5.2-web/svgs/regular/circle-user.svg';this.classList.add('svgSutil');\" >";
                ?>
                <div style="text-align: left; padding: 0px 25px;">
                    <?php
                    echo "<p><b>Correo: </b>$correo</p>";
                    echo "<p><b>Rol: </b>$rol</p>";
                    echo "<p><b>Estatus: </b>$status</p>";
                    ?>
                </div>
            </div>
            <button class="btn" onclick="window.open('empleados_lista.php','_self')">Regresar</button>
        </div>
    </body>
</html>