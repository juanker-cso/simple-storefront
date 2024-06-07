<?php
require "funciones/conecta.php";
$con = conecta();
$correo = $_REQUEST["correo"];
$sql = "SELECT correo FROM empleados WHERE correo = '$correo' AND eliminado = 0";
$res = $con->query($sql);
$row = $res->fetch_array();
if ($row=='') {
    echo false;
}
else {
    echo true;
}
?>