<?php

class Usuario {

    private $idusuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $nombre_usuario;
    private $password;
    private $fecha_registro;
    private $activo;
    private $rol;
    private $telefono;
    private $seccion;

    public function __construct($idusuario, $nombre, $apellido, $nombre_usuario, $correo, $password, $fecha_registro, $activo, $rol, $seccion, $telefono) {
        $this->idusuario = $idusuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->nombre_usuario = $nombre_usuario;
        $this->password = $password;
        $this->fecha_registro = $fecha_registro;
        $this->activo = $activo;
        $this->rol = $rol;
        $this->seccion = $seccion;
        $this->telefono = $telefono;
    }
    
    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getNombre_usuario() {
        return $this->nombre_usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFecha_registro() {
        return $this->fecha_registro;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getSeccion(){
        return $this->seccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

}
