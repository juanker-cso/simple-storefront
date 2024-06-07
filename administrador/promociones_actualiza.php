<?php
require "funciones/conecta.php";
$con = conecta();

$id         = $_REQUEST['id'];

$nombre     = $_REQUEST['nombre'];


if ( $_FILES['foto']['error'] != 4 ) {
    $archivo_n  = $_FILES['foto']['name'];
    $archivo_tmp= $_FILES['foto']['tmp_name'];
    $archivo_f  = md5_file($archivo_tmp);
    $arreglo    = explode(".",$archivo_n);
    $len        = count($arreglo);
    $pos        = $len-1;
    $ext        = $arreglo[$pos];
    $dir        = "promociones_fotos/";
    $archivo_enc  = "$archivo_f.$ext";
    copy($archivo_tmp, $dir.$archivo_enc);
    $archivoUpdate = ",archivo='$archivo_enc'";
}

$sql = "UPDATE promociones SET nombre='$nombre'".$archivoUpdate." WHERE id='$id'";
// echo "$sql";
$res = $con->query($sql);

header("Location: promociones_lista.php");
?>