<?php

class ControlSesion {

    public static function iniciarSesion($id_usuario, $nombre_usuario, $rol, $seccion, $email, $nombre, $apellido) {

        if (session_id() == '') {
            session_start();
        }

        $_SESSION['idUsuario'] = $id_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['rol_idRol'] = $rol;
        $_SESSION['seccion_idSeccion'] = $seccion;
        $_SESSION['email'] = $email;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
    }

    public static function cerrarSesion() {

        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION['idUsuario'])) {
            unset($_SESSION['idUsuario']);
        }

        if (isset($_SESSION['nombre_usuario'])) {
            unset($_SESSION['nombre_usuario']);
        }

        session_destroy();
    }

    public static function sesionIniciada() {

        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION['idUsuario']) && isset($_SESSION['nombre_usuario'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function rolAdminNativa() {

        if (isset($_SESSION['rol_idRol']) && $_SESSION['seccion_idSeccion']) {

            if ($_SESSION['rol_idRol'] == 0 && $_SESSION['seccion_idSeccion'] == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }

    public static function rolColaboradorNativa() {

        if (isset($_SESSION['rol_idRol']) && $_SESSION['seccion_idSeccion']) {

            if ($_SESSION['rol_idRol'] == 1 && $_SESSION['seccion_idSeccion'] == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }

    public static function rolVisitante() {

        if (isset($_SESSION['rol_idRol'])) {

            if ($_SESSION['rol_idRol'] == 2) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }
}
