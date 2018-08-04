<?php 

$nombre_usuario = 'Luis.Solano2';

$id = substr($nombre_usuario, -1);
$id = $id + 1;
$nombre_usuario = substr ($nombre_usuario, 0, strlen($nombre_usuario) - 1);
$nombre_usuario = $nombre_usuario . $id;

echo $nombre_usuario;
 ?>