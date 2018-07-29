<?php

date_default_timezone_set('America/Costa_Rica');
include_once 'conexion2.php';

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$rol = $_POST["rol"];

$sentencia = 9;

//******GENERAR PASWORD
function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }

    return $string_aleatorio;
}

$password = sa(6);

//******VALIDAR USUARIO
$nombre_usuario = $nombre . $apellido;
$sql_existe = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
$stmt_existe = $pdoConn->prepare($sql_existe);
$stmt_existe->execute();
$resultado = $stmt_existe->fetchAll();

if (count($resultado)) {

    $nombre_usuario = $nombre_usuario . '1';

    $sql_existe = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
    $stmt_existe = $pdoConn->prepare($sql_existe);
    $stmt_existe->execute();
    $resultado = $stmt_existe->fetchAll();

    if (count($resultado)) {
        $id = substr($nombre_usuario, -1);
        $id = $id + 1;
        $nombre_usuario = $nombre_usuario . $id;
    }
} else {
    $nombre_usuario = $nombre_usuario;
}

//******VALIDAR EMAIL
$sql_email = "SELECT * FROM usuario WHERE email = '$correo'";
$stmt_email = $pdoConn->prepare($sql_email);
$stmt_email->execute();
$resultado_email = $stmt_email->fetchAll();

if (count($resultado_email)) {
    $sentencia = 0;
} else {
    $sentencia = 1;
}

if ($sentencia == 1) {
    try {
        $sql = "INSERT INTO `usuario`(`idUsuario`, `nombre`, `apellido`, `email`, `nombre_usuario`, `password`, `fecha_registro`, `activo`, `telefono`, `rol_idrol`, `seccion_idseccion`)
                VALUES ('','$nombre','$apellido','$email','$nombre_usuario','$password',NOW(),1,'$telefono',$rol,2)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
} elseif ($sentencia == 0) {
    echo '2';
}
