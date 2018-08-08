<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion::abrir_conexion();

if (ControlSesion::sesionIniciada()) {
    $id_usuario = $_SESSION['idUsuario'];
}
?>

<body id="page-top" data-spy="scroll" data-target=".navbar" data-offset="60">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg" id="mainNav" style="background-color: #020202">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img  src="img/sibcatie-logo2.png" height="38">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="buscar-flora-nativa.php">buscar</a>
                    </li>
                    <li style="padding-right: 60px"></li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">
                            <?php echo $_SESSION['nombre_usuario']; ?>
                        </a>
                        <div class="dropdown-menu" style="left: -60px">
                            <a class="dropdown-item" style="" href="#">Perfil</a>
                            <a class="dropdown-item" href="#">Hacer consulta</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="app/cerrarSesion.inc.php">Cerrar sesión</a>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
