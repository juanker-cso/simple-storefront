<?php 
$nombre = $_REQUEST["nombre"];
$correo = $_REQUEST["correo"];
$telefono = $_REQUEST["telefono"];
$mensaje = $_REQUEST["mensaje"];

$mensaje = $mensaje. "\n\n------------------\n Nombre: $nombre\n Correo: $correo\n Telefono: $telefono";

wordwrap($mensaje, 70, "\r\n");

// $headers = [
//     'Nombre'    => "{$nombre}",
//     'Correo'    => "{$correo}",
//     'Telefono'  => "{$telefono}"
// ];

return mail('juan.solmos@alumnos.udg.mx','Contacto roboC',$mensaje);
?>