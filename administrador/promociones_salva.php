<?php
require "funciones/conecta.php";
$con = conecta();

$nombre     = $_REQUEST['nombre'];

$archivo_n  = $_FILES['foto']['name'];
$archivo_tmp= $_FILES['foto']['tmp_name'];
$archivo_f  = md5_file($archivo_tmp);
$arreglo    = explode(".",$archivo_n);
$len        = count($arreglo);
$pos        = $len-1;
$ext        = $arreglo[$pos];
$dir        = "promociones_fotos/";
$archivo_enc  = "$archivo_f.$ext";

$sql = "INSERT INTO promociones (nombre,archivo) VALUES ('$nombre','$archivo_enc')";
$res = $con->query($sql);

copy($archivo_tmp, $dir.$archivo_enc);
header("Location: promociones_lista.php");
?>