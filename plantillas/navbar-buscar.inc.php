<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion::abrir_conexion();
?>

<body id="page-top" data-spy="scroll" data-target=".navbar" data-offset="60">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img  src="img/logo-SIBCATIE-lg.png" height="38">
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
                    <li style="padding-right: 60px"></li>

                    <?php
                    if (ControlSesion::sesionIniciada()) {

                        if (ControlSesion::rolAdminNativa()) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?php echo RUTA_DASHBOARD ?>">Administracion</a>
                            </li>
                            <?php
                        } elseif (ControlSesion::rolColaboradorNativa()) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="registros.php">Administracion</a>
                            </li>
                            <?php
                        } elseif (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
                            ?>

                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">
                                    <?php echo $_SESSION['nombre_usuario']; ?>
                                </a>
                                <div class="dropdown-menu" style="left: -60px">
                                    <a class="dropdown-item" style="" href="perfil.php">Perfil</a>
                                    <a class="dropdown-item" href="#">Hacer consulta</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="app/cerrarSesion.inc.php">Cerrar sesión</a>
                                </div>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?php echo RUTA_LOGIN ?>">Iniciar sesión</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
