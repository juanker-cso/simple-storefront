<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Detalle de producto
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
    </head>
    <body>
    <?php include('menu.php') ?>
        <?php
        require "funciones/conecta.php";
        $id = $_GET['id'];
        $con = conecta();
        $sql = "SELECT nombre,codigo,descripcion,costo,stock,estado,archivo_n,archivo FROM productos WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();

        $nombre = $row['nombre'];
        $codigo = $row['codigo'];
        $descripcion = $row['descripcion'];
        $costo = $row['costo'];
        $costo_moneda = number_format($costo,2,'.',',');

        $stock = $row['stock'];
        $status = $row['estado'] ? 'Activo' : 'Inactivo';
        $archivo_n = $row['archivo_n'];
        $archivo_f = $row['archivo'];

        $arreglo    = explode(".",$archivo_n);
        $len        = count($arreglo);
        $pos        = $len-1;
        $ext        = $arreglo[$pos];

        $imagen = "productos_fotos/$archivo_f.$ext";
        ?>
        
        <div class="cuadro_empleado">
            <div class="ver_empleado">
                <?php
                echo "<h1 class='barraTitulo'>$nombre</h1>";
                echo "<img class='id_cartilla' src='$imagen' onerror=\"this.src='../fontawesome-free-6.5.2-web/svgs/solid/apple-whole.svg';this.classList.add('svgSutil');\" >";
                ?>
                <div style="text-align: left; padding: 0px 25px;">
                    <?php
                    echo "<p><b>Código: </b>$codigo</p>";
                    echo "<p>$descripcion</p>";
                    echo "<p><b>Precio: </b>$costo_moneda</p>";
                    echo "<p><b>Stock: </b>$stock</p>";
                    echo "<p><b>Estado: </b>$status</p>";
                    ?>
                </div>
            </div>
            <button class="btn" onclick="window.open('productos_lista.php','_self')">Regresar</button>
        </div>
    </body>
</html>