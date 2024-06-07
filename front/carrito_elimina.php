<?php
require "../administrador/funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];
$sql = "UPDATE listado_pedidos SET eliminado = 1 WHERE relacion = '$id';";
$res = $con->query($sql);
echo "Producto con id $id eliminado de carrito.";
?>