<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Alta de nuevo producto
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            //verificar datos
            function validar() {
                var nombre = $("#nombre").val();
                var descripcion = $("#descripcion").val();
                var codigo = $("#codigo").val();
                var costo = $("#costo").val();
                var foto = $("#foto").val();
                if (nombre=="" || descripcion=="" || codigo=="" || costo=="" || foto==''){
                    $("#mensajeForma").css("display", "block");
                    setTimeout(("$('#mensajeForma').css('display', 'none')"), 5000);
                    return;
                }
                else {
                    document.Forma01.method = 'post';
                    document.Forma01.action = 'productos_salva.php';
                    document.Forma01.submit();
                }
            }
            function validaCodigo() {
                var tiempo = 5000;
                var codigo = $("#codigo").val();
                $.ajax({
                    url     : "codigo_consulta.php",
                    type    : "post",
                    datatype: "text",
                    data    : {codigo:codigo},
                    success : function (response) {
                        console.log(response);
                        if(response){
                            $("#mensajeCodigo").css("display","inline-block");
                            $('#mensajeCodigo').html('El codigo '+codigo+' ya existe');
                            setTimeout(("$('#mensajeCodigo').css('display', 'none')"), tiempo);
                            setTimeout(("$('#mensajeCodigo').html('')"), tiempo);
                            $("#codigo").val("");
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
                <h1 class="barraTitulo">Producto nuevo:</h1>
                <form enctype="multipart/form-data" action="productos_salva.php" name="Forma01" method="post">
                    
                    <input type="text" name="nombre" id="nombre"  placeholder="Nombre de producto"/> <br>
                    <textarea type="text" name="descripcion" id="descripcion"  placeholder="Descripción" rows="3" cols="19"></textarea> <br>
                    <input type="text" name="codigo" id="codigo" onblur="validaCodigo();"  placeholder="Código"/>
                    <div class="cuadroMens" id= "mensajeCodigo" style="float:right;margin-left:5px;"></div>
                    <br>
                    <input type="number" name="costo" id="costo"  placeholder="Costo"/> <br>
                    <input type="number" name="stock" id="stock"  placeholder="Stock"/> <br>
                    
                    <label for="foto">Foto de producto:</label> <br>
                    <input class="btn" type="file" id="foto" name="foto"> <br>
                    <input class="btn" onclick="validar();return false;" type="submit" value="Enviar"/>
                </form>
                <div id="mensajeForma" class="cuadroMens mensForma" > Faltan campos por llenar </div>
            </div>
            <a href="productos_lista.php" class="btn" style="text-decoration: none;">Regresar al listado</a>
        </div>
    </body>
</html>