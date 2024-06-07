<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Editar producto existente
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <?php
        require "funciones/conecta.php";
        $id = $_GET['id'];
        $con = conecta();
        $sql = "SELECT nombre,codigo,descripcion,costo,stock FROM productos WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();

        $nombre     = $row['nombre'];
        $codigoViejo  = $row['codigo'];
        $descripcion = $row['descripcion'];
        $costo        = $row['costo'];
        $stock        = $row['stock'];
        ?>
        <script>
            //verificar datos
            function validar() {
                var id      = <?php echo $id ?>;
                var nombre  = $("#nombre").val();
                var codigo = $("#codigo").val();
                var descripcion  = $("#descripcion").val();
                var costo     = $("#costo").val();
                var stock    = $("#stock").val();
                if (nombre=="" || codigo=="" || descripcion=="" || costo=="" || stock==""){
                    $("#mensajeForma").css("display", "block")
                    setTimeout(("$('#mensajeForma').css('display', 'none')"), 5000);
                    return;
                }
                else {
                    document.Forma01.method = 'post';
                    document.Forma01.action = 'productos_actualiza.php?id='+id;
                    document.Forma01.submit();
                }
            }
            function validaCodigo() {
                var tiempo = 5000;
                var viejo  = "<?php echo $codigoViejo ?>";
                var codigo = $("#codigo").val();
                if (viejo == codigo) {
                    return;
                }
                $.ajax({
                    url     : "codigo_consulta.php",
                    type    : "post",
                    datatype: "text",
                    data    : {codigo:codigo},
                    success : function (response) {
                        console.log(response);
                        if(response && response != codigo){
                            $("#mensajeCodigo").css("display","inline-block");
                            $('#mensajeCodigo').html('El codigo '+codigo+' ya existe');
                            setTimeout(("$('#mensajeCodigo').css('display', 'none')"), tiempo);
                            setTimeout(("$('#mensajeCodigo').html('')"), tiempo);
                            $("#codigo").val("<?php echo $codigoViejo ?>");
                        }
                    },
                    error   : function () {
                        alert("Error");
                    }
                });
            }
        </script>
    </head>
    <body>
    <?php include('menu.php') ?>
        <div class="cuadro_empleado">
            <div class="ver_empleado">
                <h1 class="barraTitulo">Editar producto:</h1>
                <form enctype="multipart/form-data" action="productos_actualiza.php" name="Forma01" method="post">
                    <input type="text" name="nombre" id="nombre"  placeholder="Agregar nombre" value="<?php echo $nombre ?>" /> <br>
                    <input type="text" name="codigo" id="codigo"  placeholder="Agregar codigo" onblur="validaCodigo();" value="<?php echo $codigoViejo ?>"/>
                    <div class="cuadroMens" id= "mensajeCodigo" style="float:right;margin-left:5px;"></div>
                    <br>


                    <textarea type="text" name="descripcion" id="descripcion"  placeholder="Descripción" rows="3" cols="19"><?php echo $descripcion ?></textarea> <br>
                    <label for="costo">$</label>
                    <input type="number" name="costo" id="costo" value="<?php echo $costo ?>" style="width:19ch;"> <br>
                    <input type="number" name="stock" id="stock" value="<?php echo $stock ?>" /> <br>
                    <label for="foto">Cambiar foto:</label> <br>
                    <input class="btn" type="file" id="foto" name="foto"> <br>
                    <input class="btn" onclick="validar();return false;" type="submit" value="Enviar"/>
                </form>
                <div id="mensajeForma" class="cuadroMens mensForma"> Faltan campos por llenar </div>
            </div>

            <a href="productos_lista.php" class="btn" style="text-decoration: none;">Regresar al listado</a>
        </div>
    </body>
</html>