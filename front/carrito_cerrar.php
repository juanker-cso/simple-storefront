<?php
$id_pedido  = $_REQUEST["id"];
$nombre     = $_REQUEST["nombre"];
$correo     = $_REQUEST["correo"];
$direccion  = $_REQUEST["direccion"];

//obtener fecha en zona
date_default_timezone_set("America/Mexico_City");
$timestamp = date("Y-m-d H:i:s");

//actualizar pedido
require "../administrador/funciones/conecta.php";
$con = conecta();

$sql = "UPDATE pedidos SET nombre='$nombre', correo='$correo', direccion='$direccion', fecha='$timestamp', estado=1 WHERE id='$id_pedido';";
$con->query($sql);

//restar inventarios
$buscar = "SELECT id_producto,cantidad FROM listado_pedidos WHERE id_pedido = '$id_pedido' AND eliminado = 0;";
$res = $con->query($buscar);
while ($producto = $res->fetch_array()) {
    $id_producto    = $producto["id_producto"];
    $cantidad       = $producto["cantidad"];
    $inventario = "UPDATE productos SET stock = stock - $cantidad WHERE id = $id_producto;";
    $con->query($inventario);
}
?>