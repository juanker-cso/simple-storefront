<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Contacto</title>
        <link rel="stylesheet" href="estilo-front.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            function check() {
                var mensaje = $('#mensaje').val();
                var nombre  = $('#nombre').val();
                var correo  = $('#correo').val();
                if (nombre == '' || correo == '' || mensaje == '') {
                    $('#enviar').prop('disabled',true);
                    return;
                }
                var regex = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
                console.log(regex.test(correo));
                if (!regex.test(correo)) {
                    $('#correo').val('');
                    $("#mensajeCorreo").css("visibility", "visible");
                    setTimeout(("$('#mensajeCorreo').css('visibility', 'hidden')"), 5000);
                } else {
                    $('#enviar').prop('disabled',false);
                }
            }
            function enviar_correo() {
                var nombre      = $('#nombre').val();
                var correo      = $('#correo').val();
                var telefono    = $('#telefono').val();
                var mensaje     = $('#mensaje').val();
                $.ajax({
                    url     : "contacto_enviar.php",
                    type    : "post",
                    datatype: "text",
                    data    : {nombre:nombre,correo:correo,telefono:telefono,mensaje:mensaje},
                    success : function (response) {
                        console.log(response);
                        if(response==''){
                            $('#nombre').val('');
                            $('#correo').val('');
                            $('#telefono').val('');
                            $('#mensaje').val('');
                            $('#enviado').css("visibility","visible");
                            setTimeout(("$('#enviado').css('visibility', 'hidden')"), 5000);
                        }
                    },
                    error   : function () {
                        alert("Error");
                    }
                })

            }
        </script>
    </head>
    <header>
        <?php include('menu.php') ?>
    </header>
    <body>
        <div class='bannerbox'>
            <h1>Contacto</h1>
            <form id="formaContacto" action="" method="post">
                <label for="mensaje">Escribenos tu duda o comentario:</label> <br>
                <div class="grow-wrap">
                    <textarea name="mensaje" id="mensaje" rows="10" onblur='check();'></textarea>
                </div>
                <label for="nombre">Nombre:</label> <br>
                <input type="text" name="nombre" id="nombre" onblur='check();'> <br>
                <label for="correo">Correo:</label> <br>
                <input type="email" name="correo" id="correo" onblur='check();'> 
                <div class="mensaje" id="mensajeCorreo">Ingese un correo válido</div> <br>
                <label for="telefono">Teléfono</label> <br>
                <input type="tel" name="telefono" id="telefono" placeholder='opcional'> <br>
                <input class="btn_secundario" type="button" id='enviar' value="Enviar" disabled onclick="enviar_correo();return false;">
                <div class="mensaje" id='enviado'>Gracias por su mensaje</div>
            </form>
        </div>
    </body>
    <footer>
        <?php include('foot.php') ?>
    </footer>
</html>