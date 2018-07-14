<?php

include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro {

    private $email;
    private $usuario;
    private $error_email;
    private $error_usuario;
    private $pass;
    private $error_pass1;
    private $error_pass2;
    private $aviso_inicio;
    private $aviso_cierre;

    public function __construct($email, $usuario, $pass1, $pass2, $conexion) {

        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->email = "";
        $this->usuario = "";
        $this->pass = "";

        $this->error_usuario = $this->validar_usuario($conexion, $usuario);
        $this->error_email = $this->validar_email($conexion, $email);
        $this->error_pass1 = $this->validar_pass1($pass1);
        $this->error_pass2 = $this->validar_pass2($pass1, $pass2);

        if ($this->error_pass1 === "" && $this->error_pass2 === "") {
            $this->pass = $pass1;
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_usuario($conexion, $usuario) {
        if (!$this->variable_iniciada($usuario)) {
            return "Debes escribir un nombre de usuario.";
        } else {
            $this->usuario = $usuario;
        }
        if (strlen($usuario) < 6) {
            return "Debe tener más de 6 caracteres.";
        }
        if (strlen($usuario) > 24) {
            return "Debe tener menos de 24 caracteres.";
        }
        if(RepositorioUsuario::usuarioExiste($conexion, $usuario)){
            return "Este nombre de usuario ya está en uso. Por favor, prueba otro nombre.";
        }
        
        return "";
    }

    private function validar_email($conexion, $email) {
        if (!$this->variable_iniciada($email)) {
            return "Debes indicar un email.";
        } else {
            $this->email = $email;
        }
        if(RepositorioUsuario::emailExiste($conexion, $email)){
            return "Este correo ya se encuentra registrado. Ingresa otro correo o <a href='#'>intente recuperar su contraseña</a>.";
        }
        
        return "";
    }

    private function validar_pass1($pass1) {
        if (!$this->variable_iniciada($pass1)) {
            return "Debes escribir una contraseña.";
        }
        return "";
    }

    private function validar_pass2($pass1, $pass2) {
        if (!$this->variable_iniciada($pass1)) {
            return "Debes ingresar una contraseña.";
        }
        if (!$this->variable_iniciada($pass2)) {
            return "Repite la contraseña.";
        }
        if ($pass1 !== $pass2) {
            return "La contraseña no coincide.";
        }
        return "";
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    
    public function getPass() {
        return $this->pass;
    }

    public function getError_email() {
        return $this->error_email;
    }

    public function getError_usuario() {
        return $this->error_usuario;
    }

    public function getError_pass1() {
        return $this->error_pass1;
    }

    public function getError_pass2() {
        return $this->error_pass2;
    }

    public function mostrarUsuario() {
        if ($this->usuario !== "") {
            echo 'value="' . $this->usuario . '"';
        }
    }

    public function mostrarError_usuario() {
        if ($this->error_usuario !== "") {
            echo $this->aviso_inicio . $this->error_usuario . $this->aviso_cierre;
        }
    }

    public function mostrarEmail() {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }

    public function mostrarError_email() {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrarError_pass1() {
        if ($this->error_pass1 !== "") {
            echo $this->aviso_inicio . $this->error_pass1 . $this->aviso_cierre;
        }
    }

    public function mostrarError_pass2() {
        if ($this->error_pass2 !== "") {
            echo $this->aviso_inicio . $this->error_pass2 . $this->aviso_cierre;
        }
    }

    public function registroValido() {
        if ($this->error_usuario === "" && $this->error_email === "" && $this->error_pass1 === "" && $this->error_pass2 === "") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
