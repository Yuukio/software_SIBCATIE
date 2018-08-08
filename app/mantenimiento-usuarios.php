<?php

include_once 'conexion2.php';

$funcion = $_POST['funcion'];

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];

//SUSPENDER CUENTA
if ($funcion == 'suspenderCuenta') {

    $sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND email='$correo'";
    $consulta = $pdoConn->prepare($sql);
    $consulta->execute();
    $resultado = $consulta->fetchAll();

    if (count($resultado) != 0) {

        $sql_activo = "SELECT activo, rol_idrol FROM usuario WHERE nombre_usuario='$usuario' AND email='$correo'";
        $consulta_activo = $pdoConn->prepare($sql);
        $consulta_activo->execute();
        $fila_activo = $consulta_activo->fetch(PDO::FETCH_ASSOC);

        $activo = $fila_activo['activo'];
        $rol = $fila_activo['rol_idrol'];

        if ($rol == 0) {
            echo '4';
        } else {
            if ($activo == 0) {
                echo '3'; //Esta cuenta ya esta suspendida
            } else {

                try {

                    $sql_suspender = "UPDATE usuario SET activo=0 WHERE nombre_usuario='$usuario' AND email='$correo'";
                    $consulta_suspender = $pdoConn->prepare($sql_suspender);
                    $consulta_suspender->execute();

                    echo '1'; //Cuenta suspendida
                } catch (Exception $e) {
                    echo '0'; //Error del servidor
                }
            }
        }
    } else {
        echo '2'; //Esta cuenta no existe
    }
}

//ACTIVAR CUENTA
elseif ($funcion == 'activarCuenta') {

    $sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND email='$correo'";
    $consulta = $pdoConn->prepare($sql);
    $consulta->execute();
    $resultado = $consulta->fetchAll();

    if (count($resultado) != 0) {

        $sql_activo = "SELECT activo, rol_idrol FROM usuario WHERE nombre_usuario='$usuario' AND email='$correo'";
        $consulta_activo = $pdoConn->prepare($sql);
        $consulta_activo->execute();
        $fila_activo = $consulta_activo->fetch(PDO::FETCH_ASSOC);

        $activo = $fila_activo['activo'];
        $rol = $fila_activo['rol_idrol'];

        if ($rol == 0) {
            echo '4';
        } else {
            if ($activo == 1) {
                echo '3'; //Esta cuenta ya esta activada
            } else {

                try {

                    $sql_suspender = "UPDATE usuario SET activo=1 WHERE nombre_usuario='$usuario' AND email='$correo'";
                    $consulta_suspender = $pdoConn->prepare($sql_suspender);
                    $consulta_suspender->execute();

                    echo '1'; //Cuenta activada
                } catch (Exception $e) {
                    echo '0'; //Error del servidor
                }
            }
        }
    } else {
        echo '2'; //Esta cuenta no existe
    }
}

//CAMBIAR ROL
elseif ($funcion == 'cambiarRol') {

    $rol_form = $_POST['rol'];

    $sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND email='$correo'";
    $consulta = $pdoConn->prepare($sql);
    $consulta->execute();
    $resultado = $consulta->fetchAll();

    if (count($resultado) != 0) {

        $sql_rol = "SELECT rol_idrol, activo FROM usuario WHERE nombre_usuario='$usuario' AND email='$correo'";
        $consulta_rol = $pdoConn->prepare($sql);
        $consulta_rol->execute();
        $fila_rol = $consulta_rol->fetch(PDO::FETCH_ASSOC);

        $rol = $fila_rol['rol_idrol'];

        if ($rol == 0 || $rol == 2) {
            echo '2'; //No puedes manipular esta cuenta.
        } elseif ($rol == $rol_form) {
            echo '3'; //Esta cuenta ya tiene ese rol.
        } else {

            try {

                $sql_suspender = "UPDATE usuario SET rol_idrol=$rol_form WHERE nombre_usuario='$usuario' AND email='$correo'";
                $consulta_suspender = $pdoConn->prepare($sql_suspender);
                $consulta_suspender->execute();

                echo '4'; //Cuenta activada
            } catch (Exception $e) {
                echo '0'; //Error del servidor
            }
        }
    } else {
        echo '1'; //Esta cuenta no existe.
    }
}
        
        
        
        /*if ($rol == $rol_form) {
            echo '3'; //Esta cuenta ya tiene este rol
        } elseif($rol == 1){

            try {

                $sql_suspender = "UPDATE usuario SET activo=1 WHERE nombre_usuario='$usuario' AND email='$correo'";
                $consulta_suspender = $pdoConn->prepare($sql_suspender);
                $consulta_suspender->execute();

                echo '1'; //Cuenta activada
            } catch (Exception $e) {
                echo '0'; //Error del servidor
            }
        }
    } else {
        echo '2'; //Esta cuenta no existe
    }
}*/