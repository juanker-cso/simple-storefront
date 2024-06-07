<?php
require "funciones/conecta.php";
$con = conecta();
$codigo = $_REQUEST["codigo"];
$sql = "SELECT codigo FROM productos WHERE codigo = '$codigo' AND eliminado = 0";
$res = $con->query($sql);
$row = $res->fetch_array();
if ($row=='') {
    echo false;
}
else {
    echo true;
}
?>