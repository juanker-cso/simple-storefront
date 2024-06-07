<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Robocorner</title>
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
        <div id="promociones" style="margin:0;">
            <?php 
            $sql_promo = "SELECT archivo FROM promociones WHERE eliminado = 0 ORDER BY RAND() LIMIT 1;";
            $res_promo = $con->query($sql_promo);
            $promo = $res_promo->fetch_array(); 
            $promo_archivo = $promo["archivo"];
            ?>
            <div class="bannerbox">
                <img class="banner" src="../administrador/promociones_fotos/<?php echo $promo_archivo ?>" alt="">
            </div>
        </div>
        <div id="productos">
            <?php
            $sql_prods = "SELECT nombre,descripcion,costo,archivo_n,archivo FROM productos where eliminado = 0 order by rand() limit 3;";
            $res_prods = $con->query($sql_prods);
            ?>
            <div class="cards">
                <?php 
                while ($producto = $res_prods->fetch_array()) {
                    $nombre     = $producto["nombre"];
                    $descripcion= $producto["descripcion"];
                    $desc       = explode(".",$descripcion)[1].'.';

                    $costo      = $producto["costo"];
                    $archivo_n  = $producto['archivo_n'];
                    $archivo_f  = $producto['archivo'];

                    $arreglo    = explode(".",$archivo_n);
                    $len        = count($arreglo);
                    $pos        = $len-1;
                    $ext        = $arreglo[$pos];

                    $imagen     = "../administrador/productos_fotos/$archivo_f.$ext";
                    echo "<div class='card'>
                            <div class='uppercard'>
                                <img class='banner' src='$imagen' alt='' onerror='this.src=\"../fontawesome-free-6.5.2-web/svgs/solid/camera.svg\";'>
                            </div>
                            <div class='lowercard'>
                                <h3>$nombre</h3>
                                <p>$desc</p>
                            </div>
                        </div>";
                }
                ?>
            </div>
        </div>
    </body>
    <footer>
        <?php include('foot.php') ?>
    </footer>
</html>