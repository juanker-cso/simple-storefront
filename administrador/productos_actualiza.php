<?php
require "funciones/conecta.php";
$con = conecta();

$id         = $_REQUEST['id'];

$nombre     = $_REQUEST['nombre'];
$codigo     = $_REQUEST['codigo'];
$descripcion  = $_REQUEST['descripcion'];
$costo        = $_REQUEST['costo'];
$stock       = $_REQUEST['stock'];


if ( $_FILES['foto']['error'] != 4 ) {
    $archivo_n  = $_FILES['foto']['name'];
    $archivo_tmp= $_FILES['foto']['tmp_name'];
    $archivo_f  = md5_file($archivo_tmp);
    $arreglo    = explode(".",$archivo_n);
    $len        = count($arreglo);
    $pos        = $len-1;
    $ext        = $arreglo[$pos];
    $dir        = "productos_fotos/";
    $archivo_enc  = "$archivo_f.$ext";
    copy($archivo_tmp, $dir.$archivo_enc);
    $archivoUpdate = ",archivo_n='$archivo_n',archivo='$archivo_f'";
}

$sql = "UPDATE productos SET nombre='$nombre',codigo='$codigo',descripcion='$descripcion',stock=$stock,costo=$costo".$archivoUpdate." WHERE id='$id'";
// echo "$sql";
$res = $con->query($sql);

header("Location: productos_lista.php");
?>