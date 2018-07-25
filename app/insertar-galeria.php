<?php

date_default_timezone_set('America/Costa_Rica');
include_once '../app/conexion2.php';

//$reino = $_POST["id-reino"];
$id_planta = $_POST["id-planta"];
$creditos = $_POST["creditos"];
$estado = $_POST["id-estado"];
$imagen = $_FILES["imagen"];
$temporal = $_FILES["imagen"]["tmp_name"];

if ($imagen["type"] == "image/jpg" || $imagen["type"] == "image/jpeg" || $imagen["type"] == "image/png") {

    $directorio = 'galeria/';

    $ruta = "galeria/" . $id_planta . '-' . $imagen["name"];

    $sql = "INSERT INTO `imagen`(`planta_idPlanta`, `cretido`, `url`, `estado_idEstado`, `fecha_imagen`)
            VALUES ($id_planta, '$creditos', '$ruta', $estado, NOW())";

    $stmt = $pdoConn->prepare($sql);
    $stmt->execute();

    if (!file_exists($directorio)) {
        mkdir($directorio, 0777);
    }

    $insertado = move_uploaded_file($imagen["tmp_name"], $ruta);

    if ($insertado) {
        //carga correcta
        echo '1';
    } else {
        //falló el servidor
        echo '2';
    }
} else {
    //formato incorrecto
    echo '3';
}
?>