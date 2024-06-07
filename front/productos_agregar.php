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
        $con    = conecta();
        $id     = $_GET['id'];
        ?>
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            function agregar(id) {
                var producto = id;
                var cantidad = $('#cantidad').val();
                console.log(producto);
                document.carrito.method = 'post';
                document.carrito.action = 'carrito_agregar.php?id='+producto;
                document.carrito.submit();
            }
        </script>
    </head>
    <header>
        <?php include('menu.php') ?>
    </header>
    <body>
        <?php
        $sql = "SELECT * FROM productos WHERE id=$id";
        $res = $con->query($sql);
        $producto = $res->fetch_array();

        $nombre         = $producto['nombre'];
        $codigo         = $producto['codigo'];
        $descripcion    = $producto['descripcion'];
        $costo          = $producto['costo'];
        $costo_moneda   = number_format($costo,2,'.',',');

        $stock      = $producto['stock'];
        $status     = $producto['estado'] ? 'Activo' : 'Inactivo';
        $archivo_n  = $producto['archivo_n'];
        $archivo_f  = $producto['archivo'];

        $arreglo    = explode(".",$archivo_n);
        $len        = count($arreglo);
        $pos        = $len-1;
        $ext        = $arreglo[$pos];

        $imagen     = "productos_fotos/$archivo_f.$ext";
        ?>
        <div class='productoCard'>
            <div class='productoLeft'>
                <img class='banner' src="../administrador/<?php echo $imagen ?>" alt="">
            </div>
            <div class='productoRight'>
                <h1><?php echo $nombre ?></h1>
                <hr style='color: #03afff;'>
                <p><?php echo nl2br($descripcion) ?></p>
                <div style="display:flex; overflow:hidden; width: inherit;align-items:center;">
                    <div style="font-weight: bolder; font-size: 2.5em; color: #FFC107;float:left;margin: 0 1rem; width:100%;"><?php echo "\$".number_format($costo,2) ?></div>
                    <form style="width:80%;" name="carrito" action="carrito_agregar.php">
                        <div class='grow-wrap'>
                            <div>
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" max='<?php echo $stock ?>' value='1' min='1'>
                            </div>
                            <input class='btn_secundario' type="button" value="Agregar al carrito" onclick="agregar(<?php echo $id?>);return false;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <?php include('foot.php') ?>
    </footer>
</html>