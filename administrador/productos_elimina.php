<?php
require "funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];
$sql = "UPDATE productos SET eliminado = 1 WHERE id = '$id';";
$res = $con->query($sql);
echo "Producto con id $id eliminado exitosamente.";
?>