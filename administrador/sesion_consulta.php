<?php
session_start();
require "funciones/conecta.php";
$con        = conecta();
$correo     = $_REQUEST["correo"];
$password   = $_REQUEST["password"];
$passenc    = md5($password);

$sql        = "SELECT id,nombre,correo,pass FROM empleados WHERE correo = '$correo' AND eliminado = 0";
$res        = $con->query($sql);
$num        = $res->num_rows;

if ($num == 0) {
    echo false;
}
else{
    $row        = $res->fetch_array();
    
    $pass       = $row["pass"];
    
    if ($passenc == $pass) {
        $_SESSION['idSesion'] = $row["id"];
        $_SESSION['nombreSesion'] = $row["nombre"];
        $_SESSION['correoSesion'] = $row["correo"];
        echo true;
    }
    else {
        echo false;
    }
}

?>