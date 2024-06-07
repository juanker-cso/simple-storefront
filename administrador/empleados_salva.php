<?php
//empleados_salva.php
require "funciones/conecta.php";
$con = conecta();

$nombre     = $_REQUEST['nombre'];
$apellidos  = $_REQUEST['apellidos'];
$correo     = $_REQUEST['correo'];
$rol        = $_REQUEST['rol'];
$pass       = $_REQUEST['pass'];
$passEnc    = md5($pass);

$archivo_n  = $_FILES['foto']['name'];
$archivo_tmp= $_FILES['foto']['tmp_name'];
$archivo_f  = md5_file($archivo_tmp);
$arreglo    = explode(".",$archivo_n);
$len        = count($arreglo);
$pos        = $len-1;
$ext        = $arreglo[$pos];
$dir        = "empleados_fotos/";
$archivo_enc  = "$archivo_f.$ext";

$sql = "INSERT INTO empleados (nombre,apellidos,correo,pass,rol,archivo_n,archivo_f) VALUES ('$nombre','$apellidos','$correo','$passEnc',$rol,'$archivo_n','$archivo_f')";
$res = $con->query($sql);

copy($archivo_tmp, $dir.$archivo_enc);
header("Location: empleados_lista.php");
?>