<?php
require "funciones/conecta.php";
$con = conecta();

$nombre     = $_REQUEST['nombre'];
$codigo     = $_REQUEST['codigo'];
$descripcion  = $_REQUEST['descripcion'];
$costo        = $_REQUEST['costo'];
$stock       = $_REQUEST['stock'];

$archivo_n  = $_FILES['foto']['name'];
$archivo_tmp= $_FILES['foto']['tmp_name'];
$archivo_f  = md5_file($archivo_tmp);
$arreglo    = explode(".",$archivo_n);
$len        = count($arreglo);
$pos        = $len-1;
$ext        = $arreglo[$pos];
$dir        = "productos_fotos/";
$archivo_enc  = "$archivo_f.$ext";

$sql = "INSERT INTO productos (nombre,descripcion,codigo,stock,costo,archivo_n,archivo) VALUES ('$nombre','$descripcion','$codigo',$stock,$costo,'$archivo_n','$archivo_f')";
$res = $con->query($sql);

copy($archivo_tmp, $dir.$archivo_enc);
header("Location: productos_lista.php");
?>