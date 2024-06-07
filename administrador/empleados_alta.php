<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Alta de nuevo empleado
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            //verificar datos
            function validar() {
                var nombre = $("#nombre").val();
                var apellidos = $("#apellidos").val();
                var correo = $("#correo").val();
                var pass = $("#pass").val();
                var rol = $("#rol").val();
                var foto = $("#foto").val();
                if (nombre=="" || apellidos=="" || correo=="" || pass=="" || rol==0 || foto==''){
                    $("#mensajeForma").css("display", "block");
                    setTimeout(("$('#mensajeForma').css('display', 'none')"), 5000);
                    return;
                }
                else {
                    document.Forma01.method = 'post';
                    document.Forma01.action = 'empleados_salva.php';
                    document.Forma01.submit();
                }
            }
            function validaCorreo() {
                var tiempo = 5000;
                var correo = $("#correo").val();
                $.ajax({
                    url     : "correo_consulta.php",
                    type    : "post",
                    datatype: "text",
                    data    : {correo:correo},
                    success : function (response) {
                        console.log(response);
                        if(response){
                            $("#mensajeCorreo").css("display","inline-block");
                            $('#mensajeCorreo').html('El correo '+correo+' ya existe');
                            setTimeout(("$('#mensajeCorreo').css('display', 'none')"), tiempo);
                            setTimeout(("$('#mensajeCorreo').html('')"), tiempo);
                            $("#correo").val("");
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
                <h1 class="barraTitulo">Empleado nuevo:</h1>
                <form enctype="multipart/form-data" action="empleados_salva.php" name="Forma01" method="post">
                    
                    <input type="text" name="nombre" id="nombre"  placeholder="Agregar nombre"/> <br>
                    <input type="text" name="apellidos" id="apellidos"  placeholder="Agregar apellidos"/> <br>
                    
                    <input type="text" name="correo" id="correo" onblur="validaCorreo();"  placeholder="Escribe correo"/> 
                    <div class="cuadroMens" id= "mensajeCorreo" style="float:right;margin-left:5px;"></div>
                    <br>
                    
                    <select name="rol" id="rol">
                        <option value="0">Selecciona</option>
                        <option value="1">Gerente</option>
                        <option value="2">Ejecutivo</option>
                    </select>
                    <br>
                    <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña" /> <br>
                    <label for="foto">Foto de empleado:</label> <br>
                    <input class="btn" type="file" id="foto" name="foto"> <br>
                    <input class="btn" onclick="validar();return false;" type="submit" value="Enviar"/>
                </form>
                <div id="mensajeForma" class="cuadroMens mensForma" > Faltan campos por llenar </div>
            </div>
            <a href="empleados_lista.php" class="btn" style="text-decoration: none;">Regresar al listado</a>
        </div>
    </body>
</html>