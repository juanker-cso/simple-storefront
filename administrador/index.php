<!-- Copyright (C) 2024 Juan Carlos Salcedo Olmos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 3.
-->

<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['nombreSesion'])) {
    header("Location: bienvenido.php");
}
?>
    <head>
        <title>Iniciar sesión</title>
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <script src="../jquery-3.7.1.min.js"></script>
        <script>
            function datosLlenos() {
                var usuario = $("#usuario").val();
                var pass  = $("#pass").val();
                var tiempo  = 5000;
                if (usuario == "" || pass == "") {
                    $("#campos").css("display","block");
                    setTimeout(("$('#campos').css('display', 'none')"), tiempo);
                    return;
                } else {
                    $.ajax({
                        url     : "sesion_consulta.php",
                        type    : "post",
                        dataType: "text",
                        data    : {correo:usuario,password:pass},
                        success : function (response) {
                            console.log(!response);
                            if (!response){
                                $("#sesion").css("display","block");
                                setTimeout(("$('#sesion').css('display', 'none')"), tiempo);    
                                return;
                            }
                            else{
                                window.location.href = 'bienvenido.php';
                            }
                        },
                        error   : function () {
                            alert("Error");
                        }
                    });

                }
            }
        </script>
    </head>
    <body class="third-color" style="text-align: center;padding: 15vh 40vw;">
        <div class="fourth-color" style="border-radius: 15px;text-align: center;width: 100%;min-width: fit-content;display: block; padding: 15px;">
            <h1 class="barraTitulo">Iniciar Sesión</h1>
            <form action="bienvenido.php" method="post" id="login">
                <input type="email" name="usuario" id="usuario" placeholder="Correo"><br>
                <input type="password" name="pass" id="pass" placeholder="Contraseña"><br>
                <input type="submit" class="btn" onclick="datosLlenos();return false;" value="Enviar">
            </form>
            <div class="cuadroMens mensForma" id="campos">Faltan campos por llenar</div>
            <div class="cuadroMens mensForma" id="sesion">Datos no válidos</div>
        </div>
    </body>
</html>