<?php

include_once 'conexion2.php';
include_once 'ControlSesion.inc.php';

//VALIDAR INICIO DE SESION
if (ControlSesion::sesionIniciada()) {

    $id_usuario = $_SESSION['idUsuario'];

    $funcion = $_POST['funcion'];

    $id = $_POST['id'];

    if ($funcion == 'agregar-favoritos') {

        try {

            $sql = "INSERT INTO `favorito`(`Planta_idPlanta`, `Usuario_idUsuario`) VALUES ($id, $id_usuario)";
            $stmt = $pdoConn->prepare($sql);
            $stmt->execute();

            echo '1';
        } catch (PDOException $ex) {
            print 'ERROR' . $ex->getMessage();
            //echo '0';
        }
    } 

    elseif ($funcion == 'agregar-exportar') {
        $id = $_POST["id"];
        try {

            $sql = "INSERT INTO `exportar`(`Planta_idPlanta`, `Usuario_idUsuario`) VALUES ($id, '$id_usuario')";
            $stmt = $pdoConn->prepare($sql);
            $stmt->execute();

            echo '1';
        } catch (Exception $e) {
            echo '0';
        }
    }
    
} else {
    echo '2';
}