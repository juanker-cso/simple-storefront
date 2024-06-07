<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>
            Alta de nueva promocion
        </title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            //verificar datos
            function validar() {
                var nombre = $("#nombre").val();
                var foto = $("#foto").val();
                if (nombre=="" || foto==''){
                    $("#mensajeForma").css("display", "block");
                    setTimeout(("$('#mensajeForma').css('display', 'none')"), 5000);
                    return;
                }
                else {
                    document.Forma01.method = 'post';
                    document.Forma01.action = 'promociones_salva.php';
                    document.Forma01.submit();
                }
            }
        </script>
    </head>
    <body>
    <?php include('menu.php') ?>
        <div class="cuadro_empleado">
            <div class="ver_empleado">
                <h1 class="barraTitulo">Promocion nueva:</h1>
                <form enctype="multipart/form-data" action="promociones_salva.php" name="Forma01" method="post">
                    
                    <input type="text" name="nombre" id="nombre"  placeholder="Nombre de promocion"/> <br>
                    
                    <label for="foto">Imágen:</label> <br>
                    <input class="btn" type="file" id="foto" name="foto"> <br>
                    <input class="btn" onclick="validar();return false;" type="submit" value="Enviar"/>
                </form>
                <div id="mensajeForma" class="cuadroMens mensForma" > Faltan campos por llenar </div>
            </div>
            <a href="promociones_lista.php" class="btn" style="text-decoration: none;">Regresar al listado</a>
        </div>
    </body>
</html>