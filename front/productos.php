<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Productos</title>
        <link rel="stylesheet" href="estilo-front.css?v=<?php echo time(); ?>">
        <?php 
        require "../administrador/funciones/conecta.php";
        $con = conecta();
        ?>
    </head>
    <header>
        <?php include('menu.php') ?>
    </header>
    <body>
        <?php
        $sql = "SELECT id,nombre,costo,archivo_n,archivo FROM productos where eliminado = 0 ORDER BY nombre;";
        $res = $con->query($sql);
        ?>
         <div class="cards4">
                <?php 
                while ($producto = $res->fetch_array()) {
                    $id         = $producto["id"];
                    $nombre     = $producto["nombre"];
                    $costo      = $producto["costo"];
                    $archivo_n  = $producto['archivo_n'];
                    $archivo_f  = $producto['archivo'];

                    $arreglo    = explode(".",$archivo_n);
                    $len        = count($arreglo);
                    $pos        = $len-1;
                    $ext        = $arreglo[$pos];

                    $imagen     = "../administrador/productos_fotos/$archivo_f.$ext";
                    echo "<a class='card' href='productos_agregar.php?id=$id'>
                            <div class='uppercard'>
                                <div class='comprar'>
                                    <img class='yellowicon' src='../fontawesome-free-6.5.2-web/svgs/solid/eye.svg'>
                                </div>
                                <img class='banner' src='$imagen' alt='' onerror='this.src=\"../fontawesome-free-6.5.2-web/svgs/solid/camera.svg\";'>
                            </div>
                            <div class='lowercard'>
                                <h3>$nombre</h3>
                                <p class='precio'>\$".number_format($costo,2)."</p>
                            </div>
                        </a>";
                }
                ?>
            </div>
    </body>
    <footer>
        <?php include('foot.php') ?>
    </footer>
</html>