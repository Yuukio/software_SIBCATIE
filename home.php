<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);    
} 

$titulo = 'Home';
include_once 'plantillas/head-dashboard.php';
?>

<body class="theme-red">

    <?php
    $home = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <!-- Centro del Contenido-->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-2" style="height: 384px">
                    <div class="container-fluid" style="vertical-align: middle">
                        <div class="row">
                            <div class="datos col-md-12">
                                <div class="info-box-3 bg-teal hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">speaker_notes</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">IDENTIFICADAS</div>
                                        <div class="number">1250</div>
                                    </div>
                                </div>
                            </div>
                            <div class="datos col-md-12">
                                <div class="info-box-3 bg-green hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">speaker_notes_off</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">INDEFINIDAS</div>
                                        <div class="number">25</div>
                                    </div>
                                </div>
                            </div>
                            <div class="datos col-md-12">
                                <div class="info-box-3 bg-light-green hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">folder_shared</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">USUARIOS</div>
                                        <div class="number">75</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Especies no identificadas-->
                <div class="col-md-10">       
                    <div class="card">
                        <div class="header bg-red">
                            <h2>ESPECIES INDEFINIDAS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal" data-target="#modalNoIdentificadas">
                                        <i class="material-icons">zoom_out_map</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="scrollable-area">
                                <div class="row">
                                    <div class="table-responsive">
                                    <!--<table class="table table-bordered table-striped table-hover">-->
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr style="background: white">
                                                    <th>ID</th>
                                                    <th>Familia</th>
                                                    <th>Género</th>
                                                    <th>Epíteto</th>
                                                    <th>Ingreso</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql_no_identificadas = "SELECT f.nombre_familia, p.fecha_ingreso, p.idPlanta, g.nombre_genero, e.nombre_epiteto
                                                                            FROM planta p 
                                                                            LEFT JOIN familia f ON p.Familia_idFamilia = f.idFamilia
                                                                            LEFT JOIN genero g ON p.Genero_idGenero=g.idGenero
                                                                            LEFT JOIN epiteto e ON p.Epiteto_idEpiteto=e.idEpiteto
                                                                            WHERE p.revision = 0";

                                                $consulta_no_identificadas = Conexion::obtener_conexion()->query($sql_no_identificadas);

                                                while ($file_no_identificada = $consulta_no_identificadas->fetch(PDO::FETCH_ASSOC)) {

                                                    $id_no_identificada = $file_no_identificada['idPlanta'];

                                                    $fecha = $file_no_identificada['fecha_ingreso'];
                                                    $fecha = explode('-', $fecha);
                                                    $anno = $fecha[0];
                                                    $mes = $fecha[1];
                                                    $dia = $fecha[2];

                                                    $id_nuevo = str_pad($id_no_identificada, 4, "0", STR_PAD_LEFT);

                                                    $idMasc_no_identificada = $anno . $mes . $dia . $id_nuevo;
                                                    ?>

                                                    <tr valign="top">
                                                        <td><?php echo $id_nuevo ?></td> 
                                                        <td><?php echo $file_no_identificada['nombre_familia'] ?></td>
                                                        <td><?php echo $file_no_identificada['nombre_genero'] ?></td>
                                                        <td><?php echo $file_no_identificada['nombre_epiteto'] ?></td>
                                                        <td><?php echo $file_no_identificada['fecha_ingreso'] ?></td>
                                                        <td style="text-align:center;">
                                                            <a href="#" style="color: #17c4cb">
                                                                <i class="material-icons" data-toggle="modal" data-target="#modalVer">search</i>
                                                            </a>
                                                            <i>&nbsp;</i>
                                                            <a href="#" style="color: #ffc122">
                                                                <i class="material-icons" data-toggle="modal" data-target="#modalActualizar">edit</i>
                                                            </a>
                                                            <i>&nbsp;</i>
                                                            <a href="#" style="color: #2a445f">
                                                                <i class="material-icons" data-toggle="modal" data-target="#modalFotos">playlist_add</i>
                                                            </a>
                                                            <i>&nbsp;</i>
                                                            <a href="#" style="color: #ff6d3a">
                                                                <i class="material-icons" data-toggle="modal" data-target="#modalComun">add_a_photo</i>
                                                            </a>
                                                            <i>&nbsp;</i>
                                                            <a href="#" style="color: #E74C3C">
                                                                <i class="material-icons">delete</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
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

        <!--Registro de actividad-->
        <div class="col-md-7">
            <div class="card">
                <div class="header bg-green">
                    <h2>REGISTRO DE ACTIVIDAD</h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal" data-target="#modalRegistroActividad">
                                <i class="material-icons">zoom_out_map</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="scrollable-area">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Registro</th>
                                            <th>Actividad</th>
                                            <th>Revisión</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sql_historial = "SELECT planta.idPlanta, planta.revision, usuario.nombre_usuario, historial.fecha_historial, historial.accion, planta.fecha_ingreso
                                                                    FROM historial
                                                                    INNER JOIN planta ON historial.Planta_idPlanta=planta.idPlanta
                                                                    INNER JOIN usuario ON historial.Usuario_idUsuario=usuario.idUsuario
                                                                    ORDER BY historial.fecha_historial ASC";

                                        $consulta_historial = Conexion::obtener_conexion()->query($sql_historial);

                                        while ($file_historial = $consulta_historial->fetch(PDO::FETCH_ASSOC)) {

                                            $nombre_usuario_historial = $file_historial['nombre_usuario'];
                                            $id_historial = $file_historial['idPlanta'];
                                            $revision_historial = $file_historial['revision'];

                                            $fecha_historial = $file_historial['fecha_ingreso'];
                                            $fecha_historial = explode('-', $fecha_historial);
                                            $anno_historial = $fecha_historial[0];
                                            $mes_historial = $fecha_historial[1];
                                            $dia_historial = $fecha_historial[2];

                                            $id_historial = str_pad($id_historial, 4, "0", STR_PAD_LEFT);

                                            $idMasc_historial = $anno_historial . $mes_historial . $dia_historial . $id_historial;

                                            /* ingreso de iconos de revision */
                                            if ($revision_historial == 0) {

                                                $revision_historial = '
                                                        <a style="color: #E74C3C">
                                                            <i class="material-icons">close</i>
                                                        </a>
                                                        ';
                                            } else {
                                                $revision_historial = '
                                                        <a style="color: #27AE60">
                                                            <i class="material-icons">check</i>
                                                        </a>
                                                        ';
                                            }

                                            echo'
                                                <tr valign="top">
                                                <td>' . $file_historial['fecha_historial'] . '</td> 
                                                <td>' . $nombre_usuario_historial . '</td>
                                                <td>' . $idMasc_historial . '</td>
                                                <td>' . $file_historial['accion'] . '</td> 
                                                <td style="text-align:center;">' . $revision_historial . '</td>
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

        <!--Usuarios registrados-->
        <div class="col-md-5">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>USUARIOS ADMINISTRADORES</h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal" data-target="#modalUsuariosAdministradores">
                                <i class="material-icons">zoom_out_map</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="scrollable-area">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr style="background: white">
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_usuarios = "SELECT nombre, apellido, email, telefono FROM usuario WHERE seccion_idseccion=1 AND activo=1 AND (rol_idrol=0 OR rol_idrol=1) ORDER BY apellido ASC";

                                        $consulta_usuarios = Conexion::obtener_conexion()->query($sql_usuarios);

                                        while ($file_usuarios = $consulta_usuarios->fetch(PDO::FETCH_ASSOC)) {

                                            $nombre_completo = $file_usuarios['nombre'] . ' ' . $file_usuarios['apellido'];

                                            echo'
                                                <tr valign="top">
                                                <td>' . $nombre_completo . '</td> 
                                                <td>' . $file_usuarios['email'] . '</td>
                                                <td>' . $file_usuarios['telefono'] . '</td>
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

        <!--MODAL NO IDENTIFICADAS-->
        <div class="modal fade" id="modalNoIdentificadas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 80%">
                <div class="modal-content" style="width: 1400px">
                    <div class="card">
                        <div class="header bg-red">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                    style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                            <h2>ESPECIES INDEFINIDAS</h2>                                
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                    <!--<table class="table table-bordered table-striped table-hover">-->
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Autor</th>
                                            <th>Ingreso</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Autor</th>
                                            <th>Ingreso</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT P.idPlanta, P.autor, P.fecha_ingreso, P.fuente_informacion, P.altura, P.reproduccion, P.visible, P.revision, Fa.nombre_familia, 
                                                    Ge.nombre_genero, Ep.nombre_epiteto, Fo.nombre_forma, Co.nombre_color, De.nombre_determinado, Ti.nombre_hoja 
                                                    FROM planta P 
                                                    LEFT JOIN familia Fa ON P.Familia_idFamilia = Fa.idFamilia
                                                    LEFT JOIN genero Ge ON P.Genero_idGenero = Ge.idGenero
                                                    LEFT JOIN epiteto Ep ON P.Epiteto_idEpiteto = Ep.idEpiteto
                                                    LEFT JOIN forma Fo ON P.Forma_idForma = Fo.idForma
                                                    LEFT JOIN color Co ON P.Color_idColor = Co.idColor
                                                    LEFT JOIN tipohoja Ti ON P.TipoHoja_idTipoHoja = Ti.idTipoHoja
                                                    LEFT JOIN determinadapor De ON P.DeterminadaPor_idDeterminadaPor = De.idDeterminadaPor
                                                    WHERE P.revision=0";

                                        $consulta = Conexion::obtener_conexion()->query($sql);

                                        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

                                            $nombre_cientifico = $fila['nombre_genero'] . ' ' . $fila['nombre_epiteto'];
                                            $revision = $fila['revision'];
                                            $visible = $fila['visible'];

                                            /* ingreso de id mascara */
                                            $id = $fila['idPlanta'];

                                            $fecha = $fila['fecha_ingreso'];
                                            $fecha = explode('-', $fecha);
                                            $anno = $fecha[0];
                                            $mes = $fecha[1];
                                            $dia = $fecha[2];

                                            $id_nuevo = str_pad($id, 4, "0", STR_PAD_LEFT);

                                            $idMasc = $anno . $mes . $dia . $id_nuevo;

                                            /* asignando en tabla */
                                            ?>
                                            <tr valign="top">
                                                <td><?php echo $idMasc ?></td> 
                                                <td><?php echo $fila['nombre_familia'] ?></td>
                                                <td><?php echo $fila['nombre_genero'] ?></td>
                                                <td><?php echo $fila['nombre_epiteto'] ?></td>
                                                <td><?php echo $fila['autor'] ?></td>
                                                <td><?php echo $fila['fecha_ingreso'] ?></td>
                                                <td style="text-align:center;">
                                                    <a href="#" style="color: #17c4cb">
                                                        <i class="material-icons" data-toggle="modal" data-target="#modalVer">search</i>
                                                    </a>
                                                    <i>&nbsp;</i>
                                                    <a href="#" style="color: #ffc122">
                                                        <i class="material-icons" data-toggle="modal" data-target="#modalActualizar">edit</i>
                                                    </a>
                                                    <i>&nbsp;</i>
                                                    <a href="#" style="color: #2a445f">
                                                        <i class="material-icons" data-toggle="modal" data-target="#modalFotos">playlist_add</i>
                                                    </a>
                                                    <i>&nbsp;</i>
                                                    <a href="#" style="color: #ff6d3a">
                                                        <i class="material-icons" data-toggle="modal" data-target="#modalComun">add_a_photo</i>
                                                    </a>
                                                    <i>&nbsp;</i>
                                                    <a href="#" style="color: #E74C3C">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
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

        <!--MODAL REGISTRO DE ACTIVIDAD-->
        <div class="modal fade" id="modalRegistroActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="header bg-green">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                    style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                            <h2>REGISTRO DE ACTIVIDAD</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr style="background-color: white">
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th>Registro</th>
                                        <th>Actividad</th>
                                        <th>Revisión</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql_historial = "SELECT planta.idPlanta, planta.revision, usuario.nombre_usuario, historial.fecha_historial, historial.accion, planta.fecha_ingreso
                                                        FROM historial
                                                        INNER JOIN planta ON historial.Planta_idPlanta=planta.idPlanta
                                                        INNER JOIN usuario ON historial.Usuario_idUsuario=usuario.idUsuario
                                                        ORDER BY historial.fecha_historial ASC";

                                    $consulta_historial = Conexion::obtener_conexion()->query($sql_historial);

                                    while ($file_historial = $consulta_historial->fetch(PDO::FETCH_ASSOC)) {

                                        $nombre_usuario_historial = $file_historial['nombre_usuario'];
                                        $id_historial = $file_historial['idPlanta'];
                                        $revision_historial = $file_historial['revision'];

                                        $fecha_historial = $file_historial['fecha_ingreso'];
                                        $fecha_historial = explode('-', $fecha_historial);
                                        $anno_historial = $fecha_historial[0];
                                        $mes_historial = $fecha_historial[1];
                                        $dia_historial = $fecha_historial[2];

                                        $id_historial = str_pad($id_historial, 4, "0", STR_PAD_LEFT);

                                        $idMasc_historial = $anno_historial . $mes_historial . $dia_historial . $id_historial;

                                        /* ingreso de iconos de revision */
                                        if ($revision_historial == 0) {

                                            $revision_historial = '
                                                        <a style="color: #E74C3C">
                                                            <i class="material-icons">close</i>
                                                        </a>
                                                        ';
                                        } else {
                                            $revision_historial = '
                                                        <a style="color: #27AE60">
                                                            <i class="material-icons">check</i>
                                                        </a>
                                                        ';
                                        }

                                        echo'
                                                <tr valign="top">
                                                <td>' . $file_historial['fecha_historial'] . '</td> 
                                                <td>' . $nombre_usuario_historial . '</td>
                                                <td>' . $idMasc_historial . '</td>
                                                <td>' . $file_historial['accion'] . '</td> 
                                                <td style="text-align:center;">' . $revision_historial . '</td>
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

        <!--MODAL USUARIOS ADMINISTRADORES-->
        <div class="modal fade" id="modalUsuariosAdministradores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="header bg-cyan">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                    style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                            <h2>USUARIOS ADMINISTRATIVOS</h2>                                
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                    <!--<table class="table table-bordered table-striped table-hover">-->
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr style="background: white">
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_usuarios = "SELECT nombre, apellido, email, telefono, nombre_usuario FROM usuario ORDER BY apellido ASC";

                                        $consulta_usuarios = Conexion::obtener_conexion()->query($sql_usuarios);

                                        while ($file_usuarios = $consulta_usuarios->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr valign="top">
                                                <td><?php echo $file_usuarios['nombre'] ?></td>
                                                <td><?php echo $file_usuarios['apellido'] ?></td>
                                                <td><?php echo $file_usuarios['nombre_usuario'] ?></td>
                                                <td><?php echo $file_usuarios['email'] ?></td>
                                                <td><?php echo $file_usuarios['telefono'] ?></td>
                                                <?php
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

    </section>

    <?php
    include_once 'plantillas/dashboard-scripts.php';
    ?>