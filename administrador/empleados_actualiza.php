<?php
//empleados_actualiza.php
require "funciones/conecta.php";
$con = conecta();

$id         = $_REQUEST['id'];

$nombre     = $_REQUEST['nombre'];
$apellidos  = $_REQUEST['apellidos'];
$correo     = $_REQUEST['correo'];
$pass       = $_REQUEST['pass'];
$rol        = $_REQUEST['rol'];

$passUpdate = "";
$archivoUpdate = "";
if ($pass != "") {
    $passEnc    = md5($pass);
    $passUpdate = ",pass='$passEnc'";
}
if ( $_FILES['foto']['error'] != 4 ) {
    $archivo_n  = $_FILES['foto']['name'];
    $archivo_tmp= $_FILES['foto']['tmp_name'];
    $archivo_f  = md5_file($archivo_tmp);
    $arreglo    = explode(".",$archivo_n);
    $len        = count($arreglo);
    $pos        = $len-1;
    $ext        = $arreglo[$pos];
    $dir        = "empleados_fotos/";
    $archivo_enc  = "$archivo_f.$ext";
    copy($archivo_tmp, $dir.$archivo_enc);
    $archivoUpdate = ",archivo_n='$archivo_n',archivo_f='$archivo_f'";
}

$sql = "UPDATE empleados SET nombre='$nombre',apellidos='$apellidos',correo='$correo',rol=$rol".$passUpdate.$archivoUpdate." WHERE id='$id'";
// echo "$sql";
$res = $con->query($sql);

header("Location: empleados_lista.php");
?>