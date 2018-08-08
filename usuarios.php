<?php
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

date_default_timezone_set('America/Costa_Rica');
include_once 'app/conexion2.php';

if (isset($_POST['enviar'])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["email"];
    $telefono = $_POST["telefono"];
    $rol = $_POST["rol"];

    $sentencia = 9;

//******GENERAR PASSWORD
    function sa($longitud) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numero_caracteres = strlen($caracteres);
        $string_aleatorio = '';

        for ($i = 0; $i < $longitud; $i++) {
            $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
        }

        return $string_aleatorio;
    }

    $password = sa(6);
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

//******VALIDAR USUARIO
    $nombre_usuario = $nombre . '.' . $apellido;
    $sql_existe = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
    $stmt_existe = $pdoConn->prepare($sql_existe);
    $stmt_existe->execute();
    $resultado = $stmt_existe->fetchAll();

    if (count($resultado)) {

        $nombre_usuario = $nombre_usuario . '1';

        $sql_existe = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
        $stmt_existe = $pdoConn->prepare($sql_existe);
        $stmt_existe->execute();
        $resultado = $stmt_existe->fetchAll();

        if (count($resultado)) {
            $id = substr($nombre_usuario, -1);
            $id = $id + 1;
            $nombre_usuario = substr($nombre_usuario, 0, strlen($nombre_usuario) - 1);
            $nombre_usuario = $nombre_usuario . $id;

            $sql_existe = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
            $stmt_existe = $pdoConn->prepare($sql_existe);
            $stmt_existe->execute();
            $resultado = $stmt_existe->fetchAll();

            if (count($resultado)) {
                $id = substr($nombre_usuario, -1);
                $id = $id + 1;
                $nombre_usuario = substr($nombre_usuario, 0, strlen($nombre_usuario) - 1);
                $nombre_usuario = $nombre_usuario . $id;
            }
        }
    } else {
        $nombre_usuario = $nombre_usuario;
    }

//******VALIDAR EMAIL
    $sql_email = "SELECT * FROM usuario WHERE email = '$correo'";
    $stmt_email = $pdoConn->prepare($sql_email);
    $stmt_email->execute();
    $resultado_email = $stmt_email->fetchAll();

    if (count($resultado_email)) {
        $sentencia = 0;
    } else {
        $sentencia = 1;
    }

    if ($sentencia == 1) {
        try {
            $sql = "INSERT INTO `usuario`(`idUsuario`, `nombre`, `apellido`, `email`, `nombre_usuario`, `password`, `fecha_registro`, `activo`, `telefono`, `rol_idrol`, `seccion_idseccion`)
                VALUES ('','$nombre','$apellido','$correo','$nombre_usuario','$password_encriptada',NOW(),1,'$telefono',$rol,1)";
            $stmt = $pdoConn->prepare($sql);
            $stmt->execute();

            if ($rol == 1) {
                $nombre_rol = 'Administrador';
            } elseif (rol == 2) {
                $nombre_rol = 'Colaborador';
            }

            $destino = "ruisu.08@gmail.com";

            $contenido = "Bienvenido a SIBCATIE " . $nombre . ' ' . $apellido . "!! \n \n" . "Te han registrado como " . $nombre_rol . " en nuestro Sistema de Informaón Botánica del CATIE.\n\n" .
                    "Ingresa a nuestro sitio web sibcatie.com e inicia sesión con los siguientes datos:" . "\n    - Usuario: " . $nombre_usuario . "\n    - Contraseña: " . $password .
                    "\n\nEsta contraseña es momentánea, por favor ingresa a tu perfil de usuario y cámbiala por una personal.";

            mail($destino, "Nueva cuenta SIBCATIE", $contenido);
            header("Location:usuarios.php");

            echo "<script>
                alert('Usuario registrado correctamente.');
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Error de servidor.');
            </script>";
        }
    } elseif ($sentencia == 0) {
        echo "<script>
                alert('Este correo ya se encuentra registrado.');
            </script>";
    }
}

$titulo = 'Usuarios';
include_once 'plantillas/head-dashboard.php';
?>

<body class="theme-red">

    <?php
    $usuarios = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <!-- Centro del Contenido-->
    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">

                <!--**********LISTA DE USUARIOS****************************-->
                <div class="col-md-8" id="tabla-usuarios">
                    <!--Usuarios registrados-->

                </div>

                <!--**********REGISTRO DE USUARIOS********************-->
                <div class="col-md-4">
                    <div class="col-md-12" style="padding: 0px">
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>REGISTRAR USUARIO</h2>
                            </div>
                            <div class="body">
                                <div class="container-fluid">
                                    <div class="row clearfix">

                                        <!---->

                                        <h4 class="mb-3" style="padding-bottom: 15px; text-align: center">Complete los campos de registro</h4>

                                        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Nombre</label>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Apellido</label>
                                                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Correo electrónico</label>
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Número telefónico</label>
                                                    <input type="tel" class="form-control" name="telefono" id="telefono">
                                                </div>
                                            </div>

                                            <hr class="mb-4">

                                            <div class="container-fluid" style="text-align: center">
                                                <h4 style="margin-bottom: 20px">Rol administrativo</h4>
                                                <select id="rol" name="rol" class="form-control">
                                                    <option value="0">Administrador</option>
                                                    <option value="1">Colaborador</option>
                                                </select>
                                            </div>
                                            <hr class="mb-4">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="enviar" id="enviar">Registrar cuenta nueva</button>


                                        </form>

                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="padding: 0px">
                            <div class="card">
                                <div class="body">
                                    <div class="container-fluid">
                                        <div class="row clearfix">

                                            <form id="form-actualizar">
                                                <a href="#" data-toggle="admin-usuarios" title="
                                                   Al ingresar el nombre de usuario y contraseña, podrá suspender o activar su cuenta. El color verde indica que la cuenta será activada y el color rojo indica que la cuenta será suspendida. Si selecciona un rol administrativo, podrá modificar los permisos del usuario al precionar el botón 'Cambiar'.
                                                   " data-placement='left' class="close">?</a>
                                                <h4 style="margin-bottom: 20px; margin-top: 5px; text-align: center; width: 100%">Administrar cuenta de SIBCATIE</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario" value="" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" id="correo" placeholder="Correo electrónico" value="" required>
                                                    </div>
                                                </div>
                                                <hr class="mb-4" style="margin-top: 0px">

                                                <div class="col-md-6 col-sm-12 col-xs-12" style="padding: 0px">
                                                    <div class="col-md-3" style="padding: 0px; padding-right: 10px">
                                                        <button type="button" class="btn btn-success waves-effect" id="activar-cuenta">
                                                            <i class="material-icons" style="top: -0.5px">lock_open</i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3" style="padding: 0px; padding-right: 10px">
                                                        <button type="button" class="btn bg-red waves-effect" id="suspender-cuenta">
                                                            <i class="material-icons" style="top: -0.5px">lock_outline</i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6" style="padding: 0px; padding-right: 10px">
                                                        <button class="btn btn-info btn-block" type="button" id="cambiar-rol" style="height: 33px">
                                                            Cambiar</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <select id="rol-mant" name="rol" class="form-control">
                                                        <option value="0">Administrador</option>
                                                        <option value="1">Colaborador</option>
                                                    </select>
                                                </div>

                                            </form>

                                            <!---->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>

    <script>
        $(document).ready(function () {
            $('[data-toggle="admin-usuarios"]').tooltip();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabla-usuarios').load('tablas/tablaUsuarios.php');
        });
    </script>

    <script>

        $('#suspender-cuenta').click(function ()
        {
            usuario = $('#usuario').val();
            correo = $('#correo').val();

            if (usuario == '' && correo == '') {
                alertify.warning("Debe llenar los campos.");
            } else {
                $.ajax({
                    type: "POST",
                    url: "app/mantenimiento-usuarios.php",
                    data: {'funcion': 'suspenderCuenta', 'usuario': usuario, 'correo': correo},
                    success: function (r) {

                        if (r == '1') {
                            $('#tabla-usuarios').load('tablas/tablaUsuarios.php');
                            alertify.success("Cuenta suspendida.");
                        } else if (r == '2') {
                            alertify.error("Esta cuenta no existe.");
                        } else if (r == '3') {
                            alertify.warning("Esta cuenta ya está suspendida.");
                        } else if (r == '4') {
                            alertify.error("No puedes manipular una cuenta de administrador.");
                        } else {
                            alertify.error("Error del servidor.");
                        }
                    }
                });
            }
        });

        $('#activar-cuenta').click(function ()
        {
            usuario = $('#usuario').val();
            correo = $('#correo').val();

            if (usuario == '' && correo == '') {
                alertify.warning("Debe llenar los campos.");
            } else {

                $.ajax({
                    type: "POST",
                    url: "app/mantenimiento-usuarios.php",
                    data: {'funcion': 'activarCuenta', 'usuario': usuario, 'correo': correo},
                    success: function (r) {

                        if (r == '1') {
                            $('#tabla-usuarios').load('tablas/tablaUsuarios.php');
                            alertify.success("Cuenta activada.");
                        } else if (r == '2') {
                            alertify.error("Esta cuenta no existe.");
                        } else if (r == '3') {
                            alertify.warning("Esta cuenta ya está activada.");
                        } else if (r == '4') {
                            alertify.error("No puedes manipular una cuenta de administrador.");
                        } else {
                            alertify.error("Error del servidor.");
                        }
                    }
                });
            }
        });

        $('#cambiar-rol').click(function ()
        {
            usuario = $('#usuario').val();
            correo = $('#correo').val();
            rol = $('#rol-mant').val();
            
            console.log(rol);

            if (usuario == '' && correo == '') {
                alertify.warning("Debe llenar los campos.");
            } else {

                $.ajax({
                    type: "POST",
                    url: "app/mantenimiento-usuarios.php",
                    data: {'funcion': 'cambiarRol', 'usuario': usuario, 'correo': correo, 'rol': rol},
                    success: function (r) {

                        if (r == '1') {
                            alertify.error("Esta cuenta no existe.");
                        } else if (r == '2') {
                            alertify.error("No puedes manipular esta cuenta.");
                        } else if (r == '3') {
                            alertify.warning("Esta cuenta ya tiene ese rol.");
                        } else if (r == '4') {
                            $('#tabla-usuarios').load('tablas/tablaUsuarios.php');
                            alertify.success("Rol modificado.");
                        } else {
                            alertify.error("Error del servidor.");
                        }
                    }
                });
            }
        });

    </script>

    <?php
    Conexion::cerrar_conexion();
    ?>

</body>
</html>