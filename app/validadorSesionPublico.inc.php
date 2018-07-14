<?php

include_once 'RepositorioUsuario.inc.php';

class ValidarLogin {

    private $usuario;
    private $error;

    public function __construct($nombre_usuario, $password, $conexion) {
        $this->error = "";

        if (!$this->variable_iniciada($nombre_usuario) || !$this->variable_iniciada($password)) {
            $this->usuario = NULL;
            $this->error = "Debes introducir tu usuario y contraseña.";
        } else {
            $this->usuario = RepositorioUsuario::obtenerUsuario($conexion, $nombre_usuario);

            if (is_null($this->usuario) || ! password_verify($password, $this->usuario->getPassword())) {
                $this->error = "El usuario o contraseña son incorrectos.";
            }
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerUsuario() {
        return $this->usuario;
    }
    
    public function obtenerError() {
        return $this->error;
    }
    
    public function mostrarError() {
        if ($this->error !== ''){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";
        }
    }
}
