<?php 
include_once 'conexion2.php';

$password = $_POST['pass-antigua'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$id = $_POST['id'];

$sql = "SELECT password FROM usuario WHERE idUsuario=$id";
$consulta = $pdoConn->prepare($sql);
$consulta->execute();

$fila = $consulta->fetch(PDO::FETCH_ASSOC);
$password_encriptada = $fila['password'];

if (password_verify($password, $password_encriptada)) {//es correcta la contrasena?

    if ($pass1 == $pass2) {//coinciden las dos contrasenas?
        try {
            $pass_nueva = password_hash($pass1, PASSWORD_DEFAULT);
            $sql_insertar = "UPDATE usuario SET `password`='$pass_nueva' WHERE idUsuario=$id";
            $insertar = $pdoConn->prepare($sql_insertar);
            $insertar->execute();
            echo '1';
        } catch (Exception $exc) {
            //$validacion = 1; //error del servidor
            echo '2';
        }
    } else {
        //$validacion = 2; //contrasenas no coinciden
        echo '3';
    }
     
} else {
    echo '4';
}
