<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Lista de pedidos terminados</title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
    </head>
    <body>
    <?php include('menu.php') ?>
        <?php //consulta vista empleados
            require "funciones/conecta.php";
            $con = conecta();

            $sql = "SELECT id,nombre,correo,direccion,UNIX_TIMESTAMP(fecha) as fecha FROM pedidos WHERE estado = 1 AND eliminado = 0"; //pedidos cerrados
            $res = $con->query($sql);
            $num = $res->num_rows;
        ?>
        <div id="tituloLista" class="barraTitulo" style="margin-bottom: 5px;">
            <h1>Pedidos terminados (<?php echo "$num"; ?>)</h1>
        </div>
        
        <div id="lista">
            <div class="tabla" id="tablaEmpleados">
                <div class="fila header">
                    <div class='celda cid' style="border: none;">Id</div>
                    <div class='celda cnombre'>Usuario</div>
                    <div class='celda ccorreo'>Correo</div>
                    <div class='celda crol'>Dirección</div>
                    <div class='celda crol'>Fecha</div>
                    <div class='celda cver'>Ver detalle</div>
                </div>
                <?php
                    while($row = $res->fetch_array()){
                        $id         = $row["id"];
                        $nombre     = $row["nombre"];
                        $correo     = $row["correo"];
                        $direccion  = $row["direccion"];
                        setlocale(LC_TIME, 'Spanish');
                        date_default_timezone_set("America/Mexico_City");
                        $fecha = strftime("%F - %T", $row['fecha']);
                        echo "<div class='fila'>
                        <div class='celda cid'>$id</div>
                        <div class='celda cnombre'>$nombre</div>
                        <div class='celda ccorreo'>$correo</div>
                        <div class='celda crol'>$direccion</div>
                        <div class='celda '>$fecha</div>
                        <div class='celda cver'>
                            <button class='btn querybtn' id='ver$id' onclick=\"window.open('pedidos_detalle.php?id=$id','_self')\">
                                <img src='../fontawesome-free-6.5.2-web/svgs/solid/circle-info.svg' class='svgBtn' width='20px' height='16px'>
                            </button>
                        </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
        <br>
        
    </body>
</html>

