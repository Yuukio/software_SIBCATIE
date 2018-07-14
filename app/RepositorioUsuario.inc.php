<?php

include_once 'Conexion.inc.php';
include_once 'Usuario.inc.php';

class RepositorioUsuario {

    public static function obtenerNumeroUsuarios($conexion) {

        $total_usuarios = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $total_usuarios;
    }

    public static function insertarUsuario($conexion, $usuario) {

        $usuario_insertado = false;

        if (isset($conexion)) {
            try {

                $sql = "INSERT INTO `bd_sibcatie`.`usuario` (`idUsuario`, `nombre`, `apellido`, `email`, `nombre_usuario`, `password`, `fecha_registro`, `activo`, "
                        . "`telefono`, `rol_idrol`, `seccion_idseccion`) VALUES ('', :nombre, :apellido, :email, :nombre_usuario, :password, NOW(), "
                        . ":activo, :telefono, :rol_idrol, :seccion_idseccion)";

                $sentencia = $conexion->prepare($sql);

                $nombre = $usuario->getNombre();
                $apellido = $usuario->getApellido();
                $email = $usuario->getEmail();
                $nombre_usuario = $usuario->getNombre_usuario();
                $password = $usuario->getPassword();
                $activo = $usuario->getActivo();
                $seccion_idseccion = $usuario->getSeccion();
                $rol_idrol = $usuario->getRol();
                $telefono = $usuario->getTelefono();

                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
                $sentencia->bindParam(':password', $password, PDO::PARAM_STR);
                $sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
                $sentencia->bindParam(':rol_idrol', $rol_idrol, PDO::PARAM_STR);
                $sentencia->bindParam(':seccion_idseccion', $seccion_idseccion, PDO::PARAM_STR);
                $sentencia->bindParam(':activo', $activo, PDO::PARAM_STR);


                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }

            return $usuario_insertado;
        }
    }

    public static function agregarUsuario($conexion, $usuario) {
        $usuario_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuario (nombre_usuario, password, email, fecha_registro, rol_idRol, activo) VALUES(:nombre_usuario, :password, :email, NOW(), 2, 0)";
                $sentencia = $conexion->prepare($sql);

                $nombre_usuario = $usuario->getNombre_usuario();
                $pass = $usuario->getPassword();
                $correo = $usuario->getCorreo();

                $sentencia->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
                $sentencia->bindParam(':password', $pass, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $correo, PDO::PARAM_STR);

                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }

    public static function usuarioExiste($conexion, $usuario) {
        $usuario_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE nombre_usuario = :nombre_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre_usuario', $usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $usuario_existe = true;
                } else {
                    $usuario_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex->getMessage();
            }
        }
        return $usuario_existe;
    }

    public static function emailExiste($conexion, $email) {
        $email_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE email = :email";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex->getMessage();
            }
        }
        return $email_existe;
    }

    public static function obtenerUsuario($conexion, $nombre_usuario) {
        $usuario = null;

        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM usuario WHERE nombre_usuario = :nombre_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['idUsuario'], $resultado['nombre'], $resultado['apellido'], 
                            $resultado['nombre_usuario'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], 
                            $resultado['activo'], $resultado['rol_idrol'], $resultado['seccion_idseccion'], $resultado['telefono']);
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex->getMessage();
            }
        }
        return $usuario;
    }

}
