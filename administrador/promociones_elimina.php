<?php
require "funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];
$sql = "UPDATE promociones SET eliminado = 1 WHERE id = '$id';";
$res = $con->query($sql);
echo "Promocion con id $id eliminado exitosamente.";
?>