<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Lista de empleados</title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            function elimina(id) {
                if (confirm("Eliminar empleado "+id+"?")) {
                    $.ajax({
                        url     : 'empleados_elimina.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : {id:id},
                        success: function (response) {
                            console.log(response);
                            // $(".tituloLista").load(" h1");
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
        <?php //consulta vista empleados
            require "funciones/conecta.php";
            $con = conecta();

            $sql = "SELECT * FROM mview_empleados";
            $res = $con->query($sql);
            $num = $res->num_rows;
        ?>
        <div id="tituloLista" class="barraTitulo" style="margin-bottom: 5px;">
            <h1>Lista de empleados (<?php echo "$num"; ?>)</h1>
        </div>
        
        <button class="btn" onclick="window.open('empleados_alta.php','_self')">Crear nuevo registro</button>
        
        <div id="lista">
            <div class="tabla" id="tablaEmpleados">
                <div class="fila header">
                    <div class='celda cid' style="border: none;">Id</div>
                    <div class='celda cnombre'>Nombre</div>
                    <div class='celda ccorreo'>Correo</div>
                    <div class='celda crol'>Rol</div>
                    <div class='celda cver'>Ver detalle</div>
                    <div class='celda cedit'>Editar</div>
                    <div class='celda celim'>Eliminar</div>
                </div>
                <?php
                    while($row = $res->fetch_array()){
                        $id     = $row["id"];
                        $nombre     = $row["nombre completo"];
                        $correo     = $row["correo"];
                        $rol        = $row["rol"];
                        echo "<div class='fila'>
                        <div class='celda cid'>$id</div>
                        <div class='celda cnombre'>$nombre</div>
                        <div class='celda ccorreo'>$correo</div>
                        <div class='celda crol'>$rol</div>
                        <div class='celda cver'>
                            <button class='btn querybtn' id='ver$id' onclick=\"window.open('empleados_detalle.php?id=$id','_self')\">
                                <img src='../fontawesome-free-6.5.2-web/svgs/regular/address-card.svg' class='svgBtn' width='20px' height='16px'>
                            </button>
                        </div>
                        <div class='celda cedit'>
                            <button class='btn querybtn' id='editar$id' onclick=\"window.open('empleados_editar.php?id=$id','_self')\">
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
        <br>
        
    </body>
</html>

