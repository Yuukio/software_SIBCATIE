<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';
include_once 'app/Redireccion.inc.php';

Conexion::abrir_conexion();

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$titulo = 'Registros';

$id_usuario = $_SESSION['idUsuario'];
?>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php
    if (!isset($titulo) || empty($titulo)) {
        $titulo = 'Administración';
    }
    echo "<title>$titulo</title>";
    ?>

    <!-- Favicon-->
    <link rel="icon" type="image/png" href="img/favicon-admin.png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="css/css/themes/default.css">

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script src="js/jquery.stickytableheaders.js"></script>
    <script src="js/script.js"></script>
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="js/alertify.js"></script>
</head>

<body class="theme-red">

    <?php
    $registros = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <!-- Centro del Contenido-->
    <section class="content">
        <div class="container-fluid">

            <!--**********REGISTRO DE ESPECIES****************************-->
            <div class="card">
                <div class="header">
                    <h2>
                        REGISTRO DE ESPECIES
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown" style="vertical-align: top; margin-right: 10px; top: -5px">
                            <div class="btn-group" role="group">
                                <button type="submit" name="favoritos" id="favoritos" class="btn btn-info waves-effect">Favorito</button>
                                <button type="submit" name="exportar" id="exportar" class="btn btn-info waves-effect">Exportar</button>
                                <button type="submit" name="ocultar" id="ocultar" class="btn btn-info waves-effect">Ocultar</button>                                    
                                <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#modalRegistroPlanta">Agregar</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="body" id="tabla-registro">

                </div>
            </div>

            <!-- ******************************* REGISTRO DE PLANTA ************************************************** -->

            <!-- Modal REGISTRAR NUEVA PLANTA -->
            <div class="modal fade" id="modalRegistroPlanta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar un nuevo Registro</h4>
                        </div>

                        <form>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <h4 style="text-align: center">TAXONOMÍA</h4>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="pl-reino">Reino</label>
                                        <select id="id-reino" name="id-reino" class="form-control">
                                            <?php
                                            $sql = "SELECT nombre_reino, idReino FROM reino ORDER BY nombre_reino";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idReino'] ?>"><?php echo $fila['nombre_reino'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pl-division">División</label>
                                        <select class="form-control" name="id-division" id="id-division">
                                            <?php
                                            $sql = "SELECT nombre_division, idDivision FROM division ORDER BY nombre_division";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option value="<?php echo $fila['idDivision'] ?>">Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idDivision'] ?>"><?php echo $fila['nombre_division'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pl-clase">Clase</label>
                                        <select class="form-control" name="id-clase" id="id-clase">
                                            <?php
                                            $sql = "SELECT nombre_clase, idClase FROM clase ORDER BY nombre_clase";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idClase'] ?>"><?php echo $fila['nombre_clase'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Orden</label>
                                        <select class="form-control" name="id-orden" id="id-orden">
                                            <?php
                                            $sql = "SELECT nombre_orden, idOrden FROM orden ORDER BY nombre_orden";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idOrden'] ?>"><?php echo $fila['nombre_orden'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-3">
                                        <label>Familia</label>
                                        <select class="form-control" name="id-familia" id="id-familia">
                                            <?php
                                            $sql = "SELECT nombre_familia, idFamilia FROM familia ORDER BY nombre_familia";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idFamilia'] ?>"><?php echo $fila['nombre_familia'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Género</label>
                                        <select class="form-control" name="id-genero" id="id-genero">
                                            <?php
                                            $sql = "SELECT nombre_genero, idGenero FROM genero ORDER BY nombre_genero";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idGenero'] ?>"><?php echo $fila['nombre_genero'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Epíteto</label>
                                        <select class="form-control" name="id-epiteto" id="id-epiteto">
                                            <?php
                                            $sql = "SELECT nombre_epiteto, idEpiteto FROM epiteto ORDER BY nombre_epiteto";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idEpiteto'] ?>"><?php echo $fila['nombre_epiteto'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Autor</label>
                                        <input type="text" class="form-control" id="autor" name="autor">
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding-top: 20px">
                                    <h4 style="text-align: center">CARACTERÍSTICAS</h4>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Fuente de información</label>
                                        <input type="text" class="form-control" id="fuente" name="fuente">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estatura</label>
                                        <input type="text" class="form-control" id="altura" name="altura">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Color</label>
                                        <select class="form-control" name="id-color" id="id-color">
                                            <?php
                                            $sql = "SELECT nombre_color, idColor FROM color ORDER BY nombre_color";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idColor'] ?>"><?php echo $fila['nombre_color'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-4">
                                        <label>Forma de la Hoja</label>
                                        <select class="form-control" name="id-forma" id="id-forma">
                                            <?php
                                            $sql = "SELECT nombre_forma, idForma FROM forma";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idForma'] ?>"><?php echo $fila['nombre_forma'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tipo de Hoja</label>
                                        <select class="form-control" name="id-tipo" id="id-tipo">
                                            <?php
                                            $sql = "SELECT nombre_hoja, idTipoHoja FROM tipohoja";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idTipoHoja'] ?>"><?php echo $fila['nombre_hoja'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Determinación</label>
                                        <select class="form-control" name="id-determinado" id="id-determinado">
                                            <?php
                                            $sql = "SELECT nombre_determinado, idDeterminadaPor FROM determinadapor";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idDeterminadaPor'] ?>"><?php echo $fila['nombre_determinado'] ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <hr style=" margin-bottom: 10px !important; margin-top: 25px !important">

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-4" style="top: 20px;">
                                        <label>Imagen principal</label>
                                        <div class="row">
                                            <div class="col-md-10 col-xs-10">
                                                <input type="text" class="form-control" id="comun" name="comun">
                                            </div>
                                            <div class="col-md-2 col-xs-2" style="margin-left: -20px">
                                                <button type="button" name="agregar-img" id="agregar-img" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">file_upload</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-left: -30px; margin-right: 30px">
                                        <div class="box-shadow">
                                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x100%]" style="width: 100%; display: block;" src="img/image-gallery/1.jpg" data-holder-rendered="true">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center; padding-top: 15px">
                                        <label>Reproducción</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">

                                            <label class="containerCheck" style="margin-right: 7px">Sexual
                                                <input type="checkbox" value="" name="sexual" id="sexual">
                                                <span class="checkmark"></span>
                                            </label>

                                            <label class="containerCheck" style="margin-left: 7px">Asexual
                                                <input type="checkbox" value="" name="asexual" id="asexual">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center; padding-top: 15px">
                                        <label>Identificado</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>No</label>
                                            <label class="switch"><input type="checkbox" id="revision" name="revision"><span class="slider round"></span></label>
                                            <label>Sí</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center; padding-top: 15px">
                                        <label>Visible</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>No</label>
                                            <label class="switch"><input type="checkbox" id="visible" name="visible"><span class="slider round"></span></label>
                                            <label>Sí</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-link waves-effect" style="margin-right: 100px">BORRAR</button>
                                <button type="button" class="btn btn-link waves-effect" id="agregar-registro">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CERRAR</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal ACTUALIZAR PLANTA -->
            <div class="modal fade" id="modalActualizarPlanta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Actualizar registro</h4>
                        </div>

                        <form>
                            <div class="modal-body">
                                <input type="text" class="form-control" name="id-planta" id="id-planta" >
                                <div class="col-md-12">
                                    <h4 style="text-align: center">TAXONOMÍA</h4>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="pl-reino">Reino</label>
                                        <select id="id-reino-a" name="id-reino-a" class="form-control">
                                            <?php
                                            $sql = "SELECT nombre_reino, idReino FROM reino ORDER BY nombre_reino";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idReino'] ?>"><?php echo $fila['nombre_reino'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pl-division">División</label>
                                        <select class="form-control" name="id-division" id="id-division-a">
                                            <?php
                                            $sql = "SELECT nombre_division, idDivision FROM division ORDER BY nombre_division";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idDivision'] ?>"><?php echo $fila['nombre_division'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pl-clase">Clase</label>
                                        <select class="form-control" name="id-clase" id="id-clase-a">
                                            <?php
                                            $sql = "SELECT nombre_clase, idClase FROM clase ORDER BY nombre_clase";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idClase'] ?>"><?php echo $fila['nombre_clase'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Orden</label>
                                        <select class="form-control" name="id-orden" id="id-orden-a">
                                            <?php
                                            $sql = "SELECT nombre_orden, idOrden FROM orden ORDER BY nombre_orden";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idOrden'] ?>"><?php echo $fila['nombre_orden'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-3">
                                        <label>Familia</label>
                                        <select class="form-control" name="id-familia" id="id-familia-a">
                                            <?php
                                            $sql = "SELECT nombre_familia, idFamilia FROM familia ORDER BY nombre_familia";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idFamilia'] ?>"><?php echo $fila['nombre_familia'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Género</label>
                                        <select class="form-control" name="id-genero" id="id-genero-a">
                                            <?php
                                            $sql = "SELECT nombre_genero, idGenero FROM genero ORDER BY nombre_genero";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idGenero'] ?>"><?php echo $fila['nombre_genero'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Epíteto</label>
                                        <select class="form-control" name="id-epiteto" id="id-epiteto-a">
                                            <?php
                                            $sql = "SELECT nombre_epiteto, idEpiteto FROM epiteto ORDER BY nombre_epiteto";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idEpiteto'] ?>"><?php echo $fila['nombre_epiteto'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Autor</label>
                                        <input type="text" class="form-control" id="autor-a" name="autor">
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding-top: 20px">
                                    <h4 style="text-align: center">CARACTERÍSTICAS</h4>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Fuente de información</label>
                                        <input type="text" class="form-control" id="fuente-a" name="fuente">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estatura</label>
                                        <input type="text" class="form-control" id="altura-a" name="altura">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Color</label>
                                        <select class="form-control" name="id-color" id="id-color-a">
                                            <?php
                                            $sql = "SELECT nombre_color, idColor FROM color ORDER BY nombre_color";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idColor'] ?>"><?php echo $fila['nombre_color'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-4">
                                        <label>Forma de la Hoja</label>
                                        <select class="form-control" name="id-forma" id="id-forma-a">
                                            <?php
                                            $sql = "SELECT nombre_forma, idForma FROM forma";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idForma'] ?>"><?php echo $fila['nombre_forma'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tipo de Hoja</label>
                                        <select class="form-control" name="id-tipo" id="id-tipo-a">
                                            <?php
                                            $sql = "SELECT nombre_hoja, idTipoHoja FROM tipohoja";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idTipoHoja'] ?>"><?php echo $fila['nombre_hoja'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Determinación</label>
                                        <select class="form-control" name="id-determinado" id="id-determinado-a">
                                            <?php
                                            $sql = "SELECT nombre_determinado, idDeterminadaPor FROM determinadapor";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idDeterminadaPor'] ?>"><?php echo $fila['nombre_determinado'] ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <hr style=" margin-bottom: 10px !important; margin-top: 25px !important">

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-6">
                                        <label>Imagen principal</label>
                                        <div class="row">
                                            <div class="col-md-10 col-xs-10">
                                                <input type="text" class="form-control" id="comun" name="comun">
                                            </div>
                                            <div class="col-md-2 col-xs-2" style="margin-left: -20px">
                                                <button type="submit" name="agregar-comun" id="agregar-comun" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <label>Reproducción</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">

                                            <label class="containerCheck" style="margin-right: 7px">Sexual
                                                <input type="checkbox" value="" name="sexual" id="sexual-a">
                                                <span class="checkmark"></span>
                                            </label>

                                            <label class="containerCheck" style="margin-left: 7px">Asexual
                                                <input type="checkbox" value="" name="asexual" id="asexual-a">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <label>Identificado</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>No</label>
                                            <label class="switch"><input type="checkbox" id="revision-a" name="revision"><span class="slider round"></span></label>
                                            <label>Sí</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <label>Visible</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>No</label>
                                            <label class="switch"><input type="checkbox" id="visible-a" name="visible"><span class="slider round"></span></label>
                                            <label>Sí</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="actualizar-registro">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CERRAR</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabla-registro').load('tablas/tablaRegistros.php');
        });
    </script>

    <!-- CREAR -->
    <script>
        //CREAR NUEVO REGISTRO
        $('#agregar-registro').click(function ()
        {
            id_reino = $('#id-reino').val();
            id_division = $('#id-division').val();
            id_clase = $('#id-clase').val();
            id_orden = $('#id-orden').val();
            id_familia = $('#id-familia').val();
            id_genero = $('#id-genero').val();
            id_epiteto = $('#id-epiteto').val();
            id_determinado = $('#id-determinado').val();
            id_color = $('#id-color').val();
            id_forma = $('#id-forma').val();
            id_tipo = $('#id-tipo').val();
            autor = $('#autor').val();
            fuente = $('#fuente').val();
            altura = $('#altura').val();

            if ($('#sexual').is(':checked')) {
                sexual = 1;
            } else {
                sexual = 0;
            }

            if ($('#asexual').is(':checked')) {
                asexual = 1;
            } else {
                asexual = 0;
            }

            if ($('#visible').is(':checked')) {
                visible = 1;
            } else {
                visible = 0;
            }

            if ($('#revision').is(':checked')) {
                revision = 1;
            } else {
                revision = 0;
            }

            if (id_familia == "Indefinido")
            {
                alertify.warning('Debe seleccionar al menos el campo Familia');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarRegistro', 'reino': id_reino, 'division': id_division, 'clase': id_clase, 'orden': id_orden, 'familia': id_familia,
                        'genero': id_genero, 'epiteto': id_epiteto, 'determinado': id_determinado, 'color': id_color, 'forma': id_forma, 'tipo': id_tipo, 'autor': autor,
                        'fuente': fuente, 'altura': altura, 'revision': revision, 'visible': visible, 'sexual': sexual, 'asexual': asexual},
                    success: function (r) {

                        if (r == 1) {
                            $('#tabla-registro').load('tablas/tablaRegistros.php');
                            alertify.success("Registro agregado");

                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //AGREGAR NOMBRE COMUN
        $('#agregar-comun').click(function ()
        {
            nombre_comun = $('#comun').val();
            if (!nombre_comun)
            {
                alertify.warning('Debe agregar un nombre común');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarNombreComun', 'n_comun': nombre_comun},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Agregado con éxito");

                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });
    </script>

    <!-- ACTUALIZAR -->
    <script>
        //***** ACTUALIZAR REINO
        $('#actualizar-registro').click(function ()
        {
            id_planta = $('#id-planta').val();
            id_reino = $('#id-reino-a').val();
            id_division = $('#id-division-a').val();
            id_clase = $('#id-clase-a').val();
            id_orden = $('#id-orden-a').val();
            id_familia = $('#id-familia-a').val();
            id_genero = $('#id-genero-a').val();
            id_epiteto = $('#id-epiteto-a').val();
            id_determinado = $('#id-determinado-a').val();
            id_color = $('#id-color-a').val();
            id_forma = $('#id-forma-a').val();
            id_tipo = $('#id-tipo-a').val();
            autor = $('#autor-a').val();
            fuente = $('#fuente-a').val();
            altura = $('#altura-a').val();

            if ($('#sexual-a').is(':checked')) {
                sexual = 1;
            } else {
                sexual = 0;
            }

            if ($('#asexual-a').is(':checked')) {
                asexual = 1;
            } else {
                asexual = 0;
            }

            if ($('#visible-a').is(':checked')) {
                visible = 1;
            } else {
                visible = 0;
            }

            if ($('#revision-a').is(':checked')) {
                revision = 1;
            } else {
                revision = 0;
            }

            if (id_familia == "Indefinido")
            {
                alertify.warning('Debe seleccionar al menos el campo Familia');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarRegistro', 'reino': id_reino, 'division': id_division, 'clase': id_clase, 'orden': id_orden, 'familia': id_familia,
                        'genero': id_genero, 'epiteto': id_epiteto, 'determinado': id_determinado, 'color': id_color, 'forma': id_forma, 'tipo': id_tipo, 'autor': autor,
                        'fuente': fuente, 'altura': altura, 'revision': revision, 'visible': visible, 'sexual': sexual, 'asexual': asexual, 'id-planta': id_planta},
                    success: function (r) {

                        if (r == 1) {
                            $('#tabla-registro').load('tablas/tablaRegistros.php');
                            alertify.success("Registro agregado");
                            console.log(r);

                        } else {
                            alertify.error("Error del servidor");
                            console.log(r);
                        }
                    }
                });
            }
        });

        function agregarForm(datos) {
            re = datos.split('-');
            console.log(datos);

            $('#id-reino-a').val(re[0]);
            $('#id-division-a').val(re[1]);
            $('#id-clase-a').val(re[2]);
            $('#id-orden-a').val(re[3]);
            $('#id-familia-a').val(re[4]);
            $('#id-genero-a').val(re[5]);
            $('#id-epiteto-a').val(re[6]);
            $('#autor-a').val(re[7]);
            $('#fuente-a').val(re[8]);
            $('#altura-a').val(re[9]);
            $('#id-color-a').val(re[10]);
            $('#id-forma-a').val(re[11]);
            $('#id-tipo-a').val(re[12]);
            $('#id-determinado-a').val(re[13]);
            $('#reproduccion-a').val(re[14]);
            $('#revision-a').val(re[15]);
            $('#visible-a').val(re[16]);
            $('#id-planta').val(re[17]);

            //COMPROBAR ESTADO REPRODUCCION
            if (re[14] == 0) {
                $('#sexual-a').prop('checked', false);
                $('#asexual-a').prop('checked', false);
            } else if (re[14] == 1) {
                $('#sexual-a').prop('checked', true);
                $('#asexual-a').prop('checked', false);
            } else if (re[14] == 2) {
                $('#sexual-a').prop('checked', false);
                $('#asexual-a').prop('checked', true);
            } else if (re[14] == 3) {
                $('#sexual-a').prop('checked', true);
                $('#asexual-a').prop('checked', true);
            }

            //COMPROBAR REVISION
            if (re[15] == 1) {
                $('#revision-a').prop('checked', true);
            } else {
                $('#revision-a').prop('checked', false);
            }

            //COMPROBAR VISIBILIDAD
            if (re[16] == 1) {
                $('#visible-a').prop('checked', true);
            } else {
                $('#visible-a').prop('checked', false);
            }
        }
    </script>

    <!--FUNCIONES CHECKBOX-->
    <script>

        //AGREGAR A OCULTOS
        $('#ocultar').click(function ()
        {
            var checked = [];
            $("input[name='seleccion[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });

            if (checked.length == 0)
            {
                alertify.warning('No ha seleccionado ninguna casilla');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'ponerOcultos', 'seleccion': checked},
                    success: function (r) {

                        if (r == 1) {
                            $('#tabla-registro').load('tablas/tablaRegistros.php');
                            alertify.success("Ocultos correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //AGREGAR A FAVORITOS
        $('#favoritos').click(function ()
        {
            var checked = [];
            $("input[name='seleccion[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });

            if (checked.length == 0)
            {
                alertify.warning('No ha seleccionado ninguna casilla');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'ponerFavoritos', 'seleccion': checked},
                    success: function (r) {

                        if (r == 1) {
                            $('#tabla-registro').load('tablas/tablaRegistros.php');
                            alertify.success("Ocultos correctamente");
                        } else {
                            alertify.error("Error del servidor");
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