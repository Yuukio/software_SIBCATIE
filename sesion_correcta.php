<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
} else {
    //Redireccion::redirigir(SERVIDOR);
}

$titulo = 'Registro Correcto';

include_once './plantillas/documento-declaracion.inc.php';
?>

<nav class="navbar-sesion navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img  src="img/sibcatie-logo.png">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="regresar-home" href="index.php">Regresar al Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="text-align: center">
    <div>
        <img src="img/success.png" width="200" height="200"> 
    </div>
    <br>
    <div class="jumbotron-fluid text-center">
        <h3 style="color: #676565">Registro exitoso</h3>
        <br>
        <div class="panel-body text-center">
            <h1 style="color: #4CAF50">¡Bienvenido a SIBCATIE <b style="color: #2a632c"><?php echo $usuario ?></b>!</h1>
            <br>
            <p><a href="<?php echo RUTA_LOGIN ?>">Inicia sesión</a> para comenzar a usar tu cuenta.</p>
        </div>
    </div>
</div>