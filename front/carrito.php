<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Productos</title>
        <link rel="stylesheet" href="estilo-front.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            function check() {
                var nombre      = $('#nombre').val();
                var correo      = $('#correo').val();
                var direccion   = $('#direccion').val();
                if (nombre == '' || correo == '' || direccion == '') {
                    $('#comprar').prop('disabled',true);
                    return;
                } else {
                    $('#comprar').prop('disabled',false);
                }
            }
            function elimina(id) {
                if (confirm("Eliminar producto?")) {
                    $.ajax({
                        url     : 'carrito_elimina.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : {id:id},
                        success: function (response) {
                            console.log(response);
                            $("#fila"+id).hide();
                        },
                        error: function (){
                            alert("Error");
                        }
                    });
                }
            }
            function comprar(id_pedido) {
                var nombre      = $('#nombre').val();
                var correo      = $('#correo').val();
                var direccion   = $('#direccion').val();
                $.ajax({
                    url     : 'carrito_cerrar.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : {id:id_pedido,
                        nombre:nombre,
                        direccion:direccion,
                        correo:correo
                    },
                    success: function (response) {
                        console.log(response);
                        window.location.href = "home.php";
                    },
                    error: function (){
                        alert("Error");
                    }
                });
            }
        </script>
        <?php 
        require "../administrador/funciones/conecta.php";
        $con = conecta();
        $recolectar = "SELECT id FROM pedidos WHERE estado = 0 limit 1;";
        $res = $con->query($recolectar);
        if ($res->num_rows > 0) {
            $row = $res->fetch_array();
            $id_pedido = $row['id'];
            $res->free_result();
        } else{
            $id_pedido = -1;
        }
        ?>
    </head>
    <header>
        <?php include('menu.php') ?>
    </header>
    <body>
        <div class="carritoCard">
            <div class="carritoLeft">
                <div>
                    <h1>Pedido pendiente</h1>
                    <hr style="color: #03afff;">
                </div>
                <form action="carrito_cerrar.php" name="datos_envio" style="padding: 0 10% 2rem;">
                    <div class="grow-wrap">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" onblur="check();"> 
                    </div>
                    <div class="grow-wrap">
                        <label for="correo">Correo:</label>
                        <input type="text" name="correo" id="correo" onblur="check();"> 
                    </div>
                    <div class="grow-wrap">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" onblur="check();" onkeypress="this.onblur();"> 
                    </div>
                </form>
                <div class="carritoTable">
                    <div class="tabla">
                        <div class="fila" style="font-weight: 600;">
                            <div class="celda">&nbsp</div>
                            <div class="celda">Producto</div>
                            <div class="celda">Código</div>
                            <div class="celda">Cantidad</div>
                            <div class="celda">Subtotal</div>
                            <div class="celda">Eliminar</div>
                        </div>
                        <?php 
                        $sql_prod = "SELECT relacion,p.nombre AS producto,codigo,cantidad,costo,archivo_n,archivo FROM productos p INNER JOIN listado_pedidos lp WHERE p.id = lp.id_producto AND lp.id_pedido ='$id_pedido' AND lp.eliminado = 0;";
                        $res = $con->query($sql_prod);
                        if ($res->num_rows==0) {
                            return;
                        }
    
                        $total = 0;
                        while($row = $res->fetch_array()){
                            $id_rel     = $row["relacion"];
                            $producto   = $row["producto"];
                            $codigo     = $row["codigo"];
                            $cantidad   = $row["cantidad"];
                            $costo      = $row["costo"];
                            $subtotal   = $costo * $cantidad;
                            
                            $archivo_n = $row['archivo_n'];
                            $archivo_f = $row['archivo'];
                    
                            $arreglo    = explode(".",$archivo_n);
                            $len        = count($arreglo);
                            $pos        = $len-1;
                            $ext        = $arreglo[$pos];
                    
                            $imagen = "../administrador/productos_fotos/$archivo_f.$ext";
                            echo "<div class='fila' id='fila$id_rel'>
                            <div class='celda img-prod'>
                                <img src='$imagen' onerror=\"this.src='../fontawesome-free-6.5.2-web/svgs/solid/robot.svg';this.classList.add('svgSutil');\" >
                            </div>
                            <div class='celda nombre'>$producto</div>
                            <div class='celda '>$codigo</div>
                            <div class='celda '>$cantidad</div>
                            <div class='celda costo'>\$".number_format($subtotal,2)."</div>
                            <div class='celda '> 
                                <button class='btn_secundario' id='elim$id_rel' onclick='elimina($id_rel)'>
                                    <img src='../fontawesome-free-6.5.2-web/svgs/regular/trash-can.svg' class='smallicon' width='16px' height='16px'>
                                </button>
                            </div>
                            </div>";
                            $total += $subtotal;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="carritoRight">
                <h1>Total: 
                    <div class="precio" style="float:none;">
                        <?php echo "\$".number_format($total,2)?>
                    </div>
                </h1>
                <div>
                    <input class="btn_secundario" style="font-size: xx-large;width:100%;height:6rem;" type="button" value="Comprar" id="comprar" onclick="comprar(<?php echo $id_pedido ?>);" disabled>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <?php include('foot.php') ?>
    </footer>
</html>