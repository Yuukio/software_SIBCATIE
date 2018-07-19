<?php

include_once '../app/conexion2.php';

$nombre = $_POST["nombre"];
$seleccion = $_POST["seleccion"];
$imagen = $_FILES["imagen"];
$temporal = $_FILES["imagen"]["tmp_name"];

$sql = "SELECT `id`, `nombre`, `seleccion`, `url` FROM `imagen` ORDER BY id DESC LIMIT 1";

$consulta = $pdoConn->prepare($sql);
$consulta->execute();
$fila = $consulta->fetch(PDO::FETCH_ASSOC);

$id = $fila['id'];

if ($id == NULL) {
    $id = 1;
} else {
    $id = $id + 1;
}

//$ruta = "fotos/" . md5($imagen["tmp_name"]) . ".jpg";
$ruta = "fotos/" . $id . $imagen["name"];

$sql = "INSERT INTO `imagen`(`nombre`, `seleccion`, `url`) VALUES ('$nombre', '$seleccion', '$ruta')";
$stmt = $pdoConn->prepare($sql);
$stmt->execute();

$directorio = 'fotos/';

if (file_exists($directorio)) {
    echo 'Sí existe directorio' . '<br>';
} else {
    mkdir("fotos/", 0777);
    echo 'No existía el directorio, pero se creó' . '<br>';
}

$insertado = move_uploaded_file($imagen["tmp_name"], $ruta);

if ($insertado) {
    echo 'Se insertó correctamente';
} else {
    echo "Ocurrió un error";
}
?>