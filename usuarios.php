<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
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
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Email</th>
                                                        <th>Usuario</th>
                                                        <th>Teléfono</th>
                                                        <th>Sección</th>
                                                        <th>Activo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_admin = "SELECT u.nombre, u.apellido, u.email, u.activo, u.telefono, u.nombre_usuario, s.nombre_seccion FROM usuario u
                                                                    INNER JOIN seccion s ON u.seccion_idseccion=s.idseccion
                                                                    WHERE u.rol_idrol = 1";

                                                    $consulta_admin = Conexion::obtener_conexion()->query($sql_admin);

                                                    while ($file_admin = $consulta_admin->fetch(PDO::FETCH_ASSOC)) {

                                                        echo'
                                                            <tr valign="top">
                                                                <td>' . $file_admin['apellido'] . '</td> 
                                                                <td>' . $file_admin['nombre'] . '</td>
                                                                <td>' . $file_admin['nombre_usuario'] . '</td>
                                                                <td>' . $file_admin['email'] . '</td>
                                                                <td>' . $file_admin['telefono'] . '</td>
                                                                <td>' . $file_admin['nombre_seccion'] . '</td>
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
                                                            <th>Nombre</th>
                                                            <th>Apellido</th>
                                                            <th>Email</th>
                                                            <th>Usuario</th>
                                                            <th>Teléfono</th>
                                                            <th>Sección</th>
                                                            <th>Activo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_ayudante = "SELECT u.nombre, u.apellido, u.email, u.activo, u.telefono, u.nombre_usuario, s.nombre_seccion FROM usuario u
                                                                            INNER JOIN seccion s ON u.seccion_idseccion=s.idseccion
                                                                            WHERE u.rol_idrol = 2";

                                                        $consulta_ayudante = Conexion::obtener_conexion()->query($sql_ayudante);

                                                        while ($file_ayudante = $consulta_ayudante->fetch(PDO::FETCH_ASSOC)) {

                                                            echo'
                                                                <tr valign="top">
                                                                    <td>' . $file_ayudante['apellido'] . '</td> 
                                                                    <td>' . $file_ayudante['nombre'] . '</td>
                                                                    <td>' . $file_ayudante['nombre_usuario'] . '</td>
                                                                    <td>' . $file_ayudante['email'] . '</td>
                                                                    <td>' . $file_ayudante['telefono'] . '</td>
                                                                    <td>' . $file_ayudante['nombre_seccion'] . '</td>
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
                                                            <th>Email</th>
                                                            <th>Usuario</th>
                                                            <th>Activo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_publico = "SELECT email, activo, nombre_usuario FROM usuario
                                                                            WHERE rol_idrol = 3";

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
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>REGISTRAR USUARIO</h2>
                        </div>
                        <div class="body">
                            <div class="container-fluid">
                                <div class="row clearfix">

                                    <!---->

                                    <h4 class="mb-3" style="padding-bottom: 15px; text-align: center">Complete los campos de registro</h4>
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="firstName">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" placeholder="" value="" required>
                                                <!--<div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>-->
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="lastName">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" placeholder="" value="" required>
                                                <!--<div class="invalid-feedback">
                                                    Valid last name is required.
                                                </div>-->
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">Correo electrónico</label>
                                            <input type="email" class="form-control" id="email" placeholder="email@ejemplo.com" required>
                                            <!--<div class="invalid-feedback">
                                                Please enter a valid email address for shipping updates.
                                            </div>-->
                                        </div>

                                        <div class="row" style="padding-top: 20px">
                                            <div class="col-md-6 mb-3">
                                                <label for="username">Usuario </label>
                                                <input type="text" class="form-control" id="username" required>
                                                <!--<div class="invalid-feedback" style="width: 100%;">
                                                    Your username is required.
                                                </div>-->
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tel">Número telefónico</label>
                                                <input type="tel" class="form-control" id="tel" placeholder="">
                                                <!--<div class="invalid-feedback">
                                                    Please enter a valid email address for shipping updates.
                                                </div>-->
                                            </div>
                                        </div>

                                        <hr class="mb-4">

                                        <div class="container-fluid">
                                            <div class="col-md-6">
                                                <h4 class="">Rol administrativo</h4>
                                                <div class="d-block my-3">
                                                    <div class="custom-control custom-radio">
                                                        <input id="admin" name="roladmin" type="radio" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="admin">Administrador</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input id="ayudante" name="roladmin" type="radio" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="ayudante">Colaborador</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <h4 class="">Sección del Jardín</h4>
                                                <div class="d-block my-3">
                                                    <div class="custom-control custom-radio">
                                                        <input id="nativo" name="seccion" type="radio" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="nativo">Flora nativa</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input id="cultivo" name="seccion" type="radio" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="cultivo">Cultivos botánicos</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr class="mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Registrar cuenta nueva</button>
                                    </form>

                                    <!---->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
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
        </script>
    </section>

    <?php
    Conexion::cerrar_conexion();
    ?>

</body>
</html>