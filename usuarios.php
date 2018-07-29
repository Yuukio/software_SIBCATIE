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

//******GENERAR PASWORD
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
            $nombre_usuario = $nombre_usuario . $id;
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
            
            $contenido = "Bienvenido a SIBCATIE " . $nombre . ' ' . $apellido . '!! \n \n' . "Te han registrado como " . $nombre_rol . " en nuestro Sistema de Informaón Botánica del CATIE.\n\n" .
                        "Para iniciar sesión, ingresa en el siguiente link y utiliza los siguientes datos:" . "\n    - Usuario: " . $nombre_usuario . "\n    - Contraseña: " . $password .
                        "\n\nEsta contraseña es momentánea, por favor ingresa a tu perfil de usuario y cámbiala por una personal.";

            mail($destino, "Nueva cuenta SIBCATIE", $contenido);
            header("Location:usuarios.php");
            
            echo '1';
        } catch (Exception $e) {
            echo '0';
        }
    } elseif ($sentencia == 0) {
        echo '2';
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
                <div class="col-md-8">
                    <!--Usuarios registrados-->
                    <div class="card">
                        <header>
                            <div class="header bg-blue-grey" style="padding: 0px !important; padding-top: 8px">
                                <ul class="nav nav-tabs" style="padding-left: 15px; padding-bottom: 15px; font-size: 18px; font-weight: normal; border-bottom: 0px solid #b7b7b7">
                                    <li class="active"><a data-toggle="tab" href="#administradores" style="color: #fff !important">ADMINISTRADORES</a></li>
                                    <li><a data-toggle="tab" href="#ayudantes" style="color: #fff !important">COLABORADORES</a></li>
                                    <li><a data-toggle="tab" href="#publico" style="color: #fff !important">PÚBLICO</a></li>
                                </ul>
                            </div>
                        </header>
                        <div class="body">

                            <div class="tab-content">

                                <!--******************************TAB 1-->
                                <div id="administradores" class="tab-pane fade in active">
                                    <div class="body" style="padding: 0px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>Apellido</th>
                                                        <th>Nombre</th>
                                                        <th>Usuario</th>
                                                        <th>Email</th>
                                                        <th>Teléfono</th>
                                                        <th>Activo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_admin = "SELECT u.nombre, u.apellido, u.email, u.activo, u.telefono, u.nombre_usuario, s.nombre_seccion FROM usuario u
                                                                    LEFT JOIN seccion s ON u.seccion_idseccion=s.idseccion
                                                                    WHERE u.rol_idrol = 0";

                                                    $consulta_admin = Conexion::obtener_conexion()->query($sql_admin);

                                                    while ($file_admin = $consulta_admin->fetch(PDO::FETCH_ASSOC)) {

                                                        echo'
                                                            <tr valign="top">
                                                                <td>' . $file_admin['apellido'] . '</td> 
                                                                <td>' . $file_admin['nombre'] . '</td>
                                                                <td>' . $file_admin['nombre_usuario'] . '</td>
                                                                <td>' . $file_admin['email'] . '</td>
                                                                <td>' . $file_admin['telefono'] . '</td>
                                                                <td>' . $file_admin['activo'] . '</td>
                                                            </td>
                                                            ';
                                                    }
                                                    ?>                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!--******************************TAB 2-->
                                <div id="ayudantes" class="tab-pane fade">
                                    <div id="administradores" class="tab-pane fade in active">
                                        <div class="body" style="padding: 0px">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr style="background: white">
                                                            <th>Apellido</th>
                                                            <th>Nombre</th>
                                                            <th>Usuario</th>
                                                            <th>Email</th>
                                                            <th>Teléfono</th>
                                                            <th>Activo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_ayudante = "SELECT u.nombre, u.apellido, u.email, u.activo, u.telefono, u.nombre_usuario, s.nombre_seccion FROM usuario u
                                                                            LEFT JOIN seccion s ON u.seccion_idseccion=s.idseccion
                                                                            WHERE u.rol_idrol = 1";

                                                        $consulta_ayudante = Conexion::obtener_conexion()->query($sql_ayudante);

                                                        while ($file_ayudante = $consulta_ayudante->fetch(PDO::FETCH_ASSOC)) {

                                                            echo'
                                                                <tr valign="top">
                                                                    <td>' . $file_ayudante['apellido'] . '</td> 
                                                                    <td>' . $file_ayudante['nombre'] . '</td>
                                                                    <td>' . $file_ayudante['nombre_usuario'] . '</td>
                                                                    <td>' . $file_ayudante['email'] . '</td>
                                                                    <td>' . $file_ayudante['telefono'] . '</td>
                                                                    <td>' . $file_ayudante['activo'] . '</td>
                                                                </td>
                                                                ';
                                                        }
                                                        ?>                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--******************************TAB 3-->
                                <div id="publico" class="tab-pane fade">
                                    <div id="administradores" class="tab-pane fade in active">
                                        <div class="body" style="padding: 0px">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr style="background: white">
                                                            <th>Usuario</th>
                                                            <th>Email</th>
                                                            <th>Activo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_publico = "SELECT email, activo, nombre_usuario FROM usuario
                                                                        WHERE rol_idrol = 2";

                                                        $consulta_publico = Conexion::obtener_conexion()->query($sql_publico);

                                                        while ($file_publico = $consulta_publico->fetch(PDO::FETCH_ASSOC)) {

                                                            echo'
                                                                <tr valign="top">
                                                                    <td>' . $file_publico['nombre_usuario'] . '</td>
                                                                    <td>' . $file_publico['email'] . '</td>
                                                                    <td>' . $file_publico['activo'] . '</td>
                                                                </td>
                                                                ';
                                                        }
                                                        ?>                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <form role="form">
                                                <h4 style="margin-bottom: 20px; margin-top: 5px; text-align: center; width: 100%">Suspender cuenta de SIBCATIE</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" id="nombre" placeholder="Nombre de usuario" value="" required>
                                                        <!--<div class="invalid-feedback">
                                                            Valid first name is required.
                                                        </div>-->
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" id="apellido" placeholder="Correo electrónico" value="" required>
                                                        <!--<div class="invalid-feedback">
                                                            Valid last name is required.
                                                        </div>-->
                                                    </div>
                                                </div>
                                                <hr class="mb-4" style="margin-top: 0px">
                                                <button class="btn btn-danger btn-lg btn-block" type="submit">Suspender cuenta</button>
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
        $('#registrar-admin').click(function ()
        {
            nombre = $('#nombre').val();
            apellido = $('#apellido').val();
            correo = $('#email').val();
            telefono = $('#telefono').val();
            rol = $('#rol').val();

            /*if (!nombre_forma)
             {
             alertify.warning('Debe completar todos los campos');
             } else
             {*/

            $.ajax({
                type: "POST",
                url: "app/registrarAdministrado.php",
                data: {'nombre': nombre, 'apellido': apellido, 'correo': correo, 'telefono': telefono, 'rol': rol},
                success: function (r) {

                    if (r == 1) {
                        alertify.success("Agregado con éxito");
                    } else if (r == 2) {
                        alertify.warning("Este correo ya se encuentra en uso");
                    } else {
                        alertify.error("Error del servidor");
                    }
                }
            });
            //}
        });
    </script>

    <?php
    Conexion::cerrar_conexion();
    ?>

</body>

<!--<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontentC");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>-->
</html>