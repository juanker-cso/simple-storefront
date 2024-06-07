<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            function elimina(id) {
                if (confirm("Eliminar producto "+id+"?")) {
                    $.ajax({
                        url     : 'productos_elimina.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : {id:id},
                        success: function (response) {
                            console.log(response);
                            $("#elim"+id).parent().parent().hide();
                        },
                        error: function (){
                            alert("Error");
                        }
                    });
                }
            }
        </script>
    </head>
    <body>
    <?php include('menu.php') ?>
        <?php //consulta vista productos
            require "funciones/conecta.php";
            $con = conecta();

            $sql = "SELECT id,nombre,codigo,descripcion,costo,stock FROM productos WHERE eliminado = 0;";
            $res = $con->query($sql);
            $num = $res->num_rows;
        ?>
        <div id="tituloLista" class="barraTitulo" style="margin-bottom: 5px;">
            <h1>Lista de productos (<?php echo "$num"; ?>)</h1>
        </div>
        
        <button class="btn" onclick="window.open('productos_alta.php','_self')">Crear nuevo registro</button>

        <div id="lista">
            <div class="tabla" id="tablaProductos">
                <div class="fila header">
                    <div class='celda cid' style="border: none;">Id</div>
                    <div class='celda '>Nombre</div>
                    <div class='celda ccod'>Código</div>
                    <div class='celda '>Descripción</div>
                    <div class='celda '>Costo</div>
                    <div class='celda '>Stock</div>
                    <div class='celda cver'>Ver detalle</div>
                    <div class='celda cedit'>Editar</div>
                    <div class='celda celim'>Eliminar</div>
                </div>
                <?php
                    while($row = $res->fetch_array()){
                        $id         = $row["id"];
                        $nombre     = $row["nombre"];
                        $codigo     = $row["codigo"];
                        $descripcion= $row["descripcion"];
                        $costo      = $row["costo"];
                        $stock      = $row["stock"];
                        $costo_moneda = number_format($costo,2,'.',',');
                        echo "<div class='fila'>
                        <div class='celda cid'>$id</div>
                        <div class='celda '>$nombre</div>
                        <div class='celda ccod'>$codigo</div>
                        <div class='celda cdesc'>$descripcion</div>
                        <div class='celda '>\$$costo_moneda</div>
                        <div class='celda '>$stock</div>
                        <div class='celda cver'>
                            <button class='btn querybtn' id='ver$id' onclick=\"window.open('productos_detalle.php?id=$id','_self')\">
                                <img src='../fontawesome-free-6.5.2-web/svgs/solid/circle-info.svg' class='svgBtn' width='20px' height='16px'>
                            </button>
                        </div>
                        <div class='celda cedit'>
                            <button class='btn querybtn' id='editar$id' onclick=\"window.open('productos_editar.php?id=$id','_self')\">
                                <img src='../fontawesome-free-6.5.2-web/svgs/regular/pen-to-square.svg' class='svgBtn' width='20px' height='16px'>
                            </button>
                        </div>
                        <div class='celda celim'>
                            <button class='btn delbtn' id='elim$id' onclick='elimina($id)'>
                                <img src='../fontawesome-free-6.5.2-web/svgs/regular/trash-can.svg' class='svgBlanco' width='16px' height='16px'>
                            </button>
                        </div></div>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>