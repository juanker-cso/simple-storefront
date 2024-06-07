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
        $sql = "SELECT nombre,correo,direccion,UNIX_TIMESTAMP(fecha) AS fecha,estado FROM pedidos WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();

        $nombre = $row['nombre'];
        $correo = $row['correo'];
        $direccion = $row['direccion'];
        setlocale(LC_TIME, 'Spanish');
        date_default_timezone_set("America/Mexico_City");
        $fecha = strftime("%e de %B de %Y - %R", $row['fecha']);
        $status = $row['estado'] ? 'Cerrado' : 'Abierto';
        ?>
        
        <div class="cuadro_empleado">
            <div class="ver_empleado">
                <?php
                echo "<h1 class='barraTitulo'>Pedido $id</h1>";
                ?>
                <div style="text-align: left; padding: 0px 25px;">
                    <?php
                    echo "<p><b>Usuario: </b>$nombre</p>";
                    echo "<p><b>Correo: </b>$correo</p>";
                    echo "<p><b>Dirección: </b>$direccion</p>";
                    echo "<p><b>Fecha: </b>$fecha</p>";
                    echo "<p><b>Estatus: </b>$status</p>";
                    ?>
                    <hr style="color: #142d4c;">
                </div>
                <div class="tabla">
                    <div class="fila" style="font-weight: 600;">
                        <div class="celda">Producto</div>
                        <div class="celda">Código</div>
                        <div class="celda">Cantidad</div>
                        <div class="celda">Subtotal</div>
                    </div>
                    <?php 
                    $sql_prod = "SELECT p.nombre AS producto,codigo,cantidad,costo FROM productos p INNER JOIN listado_pedidos lp WHERE p.id = lp.id_producto AND lp.id_pedido ='$id' AND lp.eliminado = 0;";
                    $res = $con->query($sql_prod);

                    $total = 0;
                    while($row = $res->fetch_array()){
                        $producto   = $row["producto"];
                        $codigo     = $row["codigo"];
                        $cantidad   = $row["cantidad"];
                        $costo      = $row["costo"];
                        $subtotal   = $costo * $cantidad;

                        echo "<div class='fila'>
                        <div class='celda nombre'>$producto</div>
                        <div class='celda '>$codigo</div>
                        <div class='celda '>$cantidad</div>
                        <div class='celda costo'>\$$subtotal</div>
                        </div>";
                        $total += $subtotal;
                    }
                    ?>
                    <div class="fila">
                        <div class="celda"></div>
                        <div class="celda"></div>
                        <div class="celda" style="font-weight:600;">
                            Total: 
                        </div>
                        <div class="celda costo">
                            $<?php echo $total; ?>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn" onclick="window.open('pedidos_lista.php','_self')">Regresar</button>
        </div>
    </body>
</html>