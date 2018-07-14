<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/validadorRegistroPublico.inc.php';
include_once 'app/validadorSesionPublico.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';

//VALIDAR INICIO DE SESION
if(ControlSesion::sesionIniciada()){
    //echo 'listo';
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['login'])) {

    Conexion::abrir_conexion();

    $validador_s = new ValidarLogin($_POST['nombre_usuario'], $_POST['password'], Conexion::obtener_conexion());

    if ($validador_s->obtenerError() === '' && !is_null($validador_s->obtenerUsuario())) {
        //iniciar sesion
        ControlSesion::iniciarSesion($validador_s->obtenerUsuario()->getIdusuario(), $validador_s->obtenerUsuario()->getNombre_usuario(), 
                $validador_s->obtenerUsuario()->getRol(), $validador_s->obtenerUsuario()->getSeccion(), $validador_s->obtenerUsuario()->getCorreo(),
                $validador_s->obtenerUsuario()->getNombre(), $validador_s->obtenerUsuario()->getApellido());
        Redireccion::redirigir(SERVIDOR);
        //redirigir a index
        //echo 'Bien';
    }

    Conexion::cerrar_conexion();
}

//VALIDAR REGISTRO DE USUARIO
if (isset($_POST['enviar'])) {

    Conexion::abrir_conexion();

    $validador = new ValidadorRegistro($_POST['email'], $_POST['usuario'], $_POST['pass1'], $_POST['pass2'], Conexion::obtener_conexion());

    if ($validador->registroValido()) {

        $nombre_usuario = $validador->getUsuario();
        $correo = $validador->getEmail();
        $password = password_hash($validador->getPass(), PASSWORD_DEFAULT);

        $usuario = new Usuario('', '', '', $nombre_usuario, $correo, $password, '', '', '', '', '');
        $usuario_insertado = RepositorioUsuario::agregarUsuario(Conexion::obtener_conexion(), $usuario);

        if ($usuario_insertado) {
            $nombre = $usuario->getNombre_usuario();
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '?usuario=' . $nombre);
        }
    }

    Conexion::cerrar_conexion();
}

$titulo = 'SIBCATIE';

include_once 'plantillas/documento-declaracion.inc.php';
?>

<style>
    label{
        display: contents !important;
    }
</style>

<body style="background: #f2f2f2;">

    <!-- Navigation -->
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

    <!--REGISTRAR CUENTA-->
    <div class="container-fluid div-sesion sombra">
        <div class="row">

            <!--iniciar secion-->
            <div class="col-md-4">
                <div class="col-md-12 col-all">
                    <h2>Inicia sesion</h2>
                    <p class="subhead">Ya tienes cuenta? Inicia sesión más abajo.</p>
                </div>
                <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="col-md-12 col-all">
                        <p>
                            <label for="signup_with_profile_email" class="required">
                                <span class="label-text">Nombre de Usuario</span>
                                <input class="std-form" type="text" id="nombre_usuario" name="nombre_usuario"  
                                <?php
                                if (isset($_POST['login']) && isset($_POST['nombre_usuario']) && !empty($_POST['nombre_usuario'])) {
                                    echo 'value="' . $_POST['nombre_usuario'] . '"';
                                }
                                ?>
                                       required autofocus>
                            </label>
                        </p>
                    </div>
                    <div class="col-md-12 col-all">
                        <p>
                            <label for="signup_with_profile_password" class="required">
                                <span class="label-text">Contraseña</span>
                                <input class="std-form" type="password" id="password" name="password" required>
                            </label>
                        </p>
                    </div>

                    <?php
                    if (isset($_POST['login'])) {
                        $validador_s->mostrarError();
                    }
                    ?>

                    <div class="col-md-12 col-all" style="text-align: center">
                        <button class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" type="submit" name="login">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
                <div class="col-md-12" style="text-align: center; padding-top: 20px">
                    <p>
                        <small>
                            ¿Olvidaste tu contraña? Ingrese 
                            <a href="#">aquí.</a>
                        </small>
                    </p>
                </div>

            </div>
            <div class="col-md-1">

            </div>

            <!--registrar cuenta-->
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12 col-all">
                        <h2>Registrar cuenta en SIBCATIE</h2>
                        <p class="subhead">¡Únete a SIBCATIE y descubre tus ventajas!</p>
                    </div>
                    <div class="col-md-12">
                        <!--**************FORMULARIO PUBLICO**************-->
                        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                            <?php
                            if (isset($_POST['enviar'])) {
                                include_once './plantillas/registroPublico_validado.inc.php';
                            } else {

                                include_once './plantillas/registroPublico_vacio.inc.php';
                            }
                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="container-fluid text-center" style="padding-top: 100px">
        <!--<a class="nav-link js-scroll-trigger" href="#page-top" style="font-size: 50px;">^</a>-->
        <p>Copyright &copy; 2018 - SIBCATIE creado por <a href="https://www.catie.ac.cr/">www.catie.ac.cr</a></p>
    </footer>

    <?php
    include_once './plantillas/documento-cierre.inc.php';
    ?>