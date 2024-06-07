<?php 
require "../administrador/funciones/conecta.php";
$con = conecta();

//obtener datos de producto
$id_producto    = $_REQUEST["id"];
$cantidad       = $_REQUEST["cantidad"];

$buscar = "SELECT costo FROM productos WHERE id = $id_producto;";
$res = $con->query($buscar);
$costo = $res->fetch_array()["costo"];
$res->free_result();

$importe = $costo * $cantidad;

// verificar carrito abierto
$consultar = "SELECT id FROM pedidos WHERE estado = 0 LIMIT 1;";   //solo habrá un carrito abierto
$res = $con->query($consultar);
$row = $res->fetch_array();

if (!$row) { //no hay carrito abierto
    // hacer nuevo carrito 
    $insertar = "INSERT INTO pedidos() VALUES ();";
    $recibir = "SELECT LAST_INSERT_ID() AS id;";
    $con->query($insertar);
    $res = $con->query($recibir);
    $id_pedido  = $res->fetch_array()["id"];
} else {
    $id_pedido  = $row["id"];
}
$res->free_result();

// insertar en lista del pedido
$agregar = "INSERT INTO listado_pedidos(id_pedido,id_producto,cantidad,importe) VALUES ($id_pedido,$id_producto,$cantidad,$importe);";
$res = $con->query($agregar);
// return $res->fetch_array();
header("Location: productos.php");
?>