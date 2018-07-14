<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$titulo = 'Catálogos';
include_once 'plantillas/head-dashboard.php';
?>

<body class="theme-red">

    <?php
    $catalogos = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>


    <!-- Centro del Contenido-->
    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">

                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="tabC">
                                <button class="tablinks" onclick="openCity(event, 'Reino')" id="defaultOpen">Reino</button>
                                <button class="tablinks" onclick="openCity(event, 'Division')">División</button>
                                <button class="tablinks" onclick="openCity(event, 'Clase')">Clase</button>
                                <button class="tablinks" onclick="openCity(event, 'Orden')">Orden</button>
                                <button class="tablinks" onclick="openCity(event, 'Familia')">Familias</button>
                                <button class="tablinks" onclick="openCity(event, 'Genero')">Géneros</button>
                                <button class="tablinks" onclick="openCity(event, 'Epiteto')">Epítetos</button>
                                <button class="tablinks" onclick="openCity(event, 'Color')">Colores</button>
                                <button class="tablinks" onclick="openCity(event, 'Determinado')">Determinados por</button>
                                <button class="tablinks" onclick="openCity(event, 'Forma')">Formas</button>
                                <button class="tablinks" onclick="openCity(event, 'Tipo')">Tipos de Hoja</button>
                                <button class="tablinks" onclick="openCity(event, 'Uso')">Usos</button>
                                <button class="tablinks" onclick="openCity(event, 'Estado')">Estados de Salud</button>
                            </div>
                        </div>

                        <!--***********TAB REINO************-->
                        <div class="col-md-9">
                            <div id="Reino" class="tabcontentC">
                                <div class="card" id="tabla-reino">
                                    <div class="header bg-cyan">
                                        <h2>REINOS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalReino">Agregar nuevo reino</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Reino</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $sql_reino = "SELECT `idReino`, `nombre_reino` FROM `reino`";

                                                    $consulta_reino = Conexion::obtener_conexion()->query($sql_reino);

                                                    while ($fila_reino = $consulta_reino->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_reino = $fila_reino['idReino'] . '-' . $fila_reino['nombre_reino'];

                                                        $id_reino = $fila_reino['idReino'];

                                                        $id_reino_nuevo = str_pad($id_reino, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_reino_nuevo ?></td>
                                                            <td><?php echo $fila_reino['nombre_reino'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalReino-e" onclick="agregarFormReino('<?php echo $datos_reino ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalReino-v" onclick="filtrarReino('<?php echo $id_reino ?>')">description</i>
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

                        <!--***********TAB DIVISION************-->
                        <div class="col-md-9">
                            <div id="Division" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>DIVISIONES</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalDivision">Agregar nueva división</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>División</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_division = "SELECT `idDivision`, `nombre_division` FROM `division`";

                                                    $consulta_division = Conexion::obtener_conexion()->query($sql_division);

                                                    while ($fila_division = $consulta_division->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_division = $fila_division['idDivision'] . '-' . $fila_division['nombre_division'];

                                                        $id_division = $fila_division['idDivision'];

                                                        $id_division_nuevo = str_pad($id_division, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_division_nuevo ?></td>
                                                            <td><?php echo $fila_division['nombre_division'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalDivision-e" onclick="agregarFormDivision('<?php echo $datos_division ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalDivision-v" onclick="filtrarDivision('<?php echo $id_division ?>')">description</i>
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

                        <!--***********TAB CLASE************-->
                        <div class="col-md-9">
                            <div id="Clase" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>CLASES</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalClase">Agregar nueva clase</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Clase</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_clase = "SELECT `idClase`, `nombre_clase` FROM `clase`";

                                                    $consulta_clase = Conexion::obtener_conexion()->query($sql_clase);

                                                    while ($fila_clase = $consulta_clase->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_clase = $fila_clase['idClase'] . '-' . $fila_clase['nombre_clase'];

                                                        $id_clase = $fila_clase['idClase'];

                                                        $id_clase_nuevo = str_pad($id_clase, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_clase_nuevo ?></td>
                                                            <td><?php echo $fila_clase['nombre_clase'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalClase-e" onclick="agregarFormClase('<?php echo $datos_clase ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalClase-v" onclick="filtrarClase('<?php echo $id_clase ?>')">description</i>
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

                        <!--***********TAB ORDEN************-->
                        <div class="col-md-9">
                            <div id="Orden" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>ORDEN</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalOrden">Agregar nuevo orden</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Orden</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_orden = "SELECT `idOrden`, `nombre_orden` FROM `orden`";

                                                    $consulta_orden = Conexion::obtener_conexion()->query($sql_orden);

                                                    while ($fila_orden = $consulta_orden->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_orden = $fila_orden['idOrden'] . '-' . $fila_orden['nombre_orden'];

                                                        $id_orden = $fila_orden['idOrden'];

                                                        $id_orden_nuevo = str_pad($id_orden, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_orden_nuevo ?></td>
                                                            <td><?php echo $fila_orden['nombre_orden'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalOrden-e" onclick="agregarFormOrden('<?php echo $datos_orden ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalOrden-v" onclick="filtrarOrden('<?php echo $id_orden ?>')">description</i>
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

                        <!--***********TAB FAMILIA************-->
                        <div class="col-md-9">
                            <div id="Familia" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>FAMILIAS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalFamilia">Agregar nueva familia</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Familia</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_familia = "SELECT `idFamilia`, `nombre_familia` FROM `familia`";

                                                    $consulta_familia = Conexion::obtener_conexion()->query($sql_familia);

                                                    while ($fila_familia = $consulta_familia->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_familia = $fila_familia['idFamilia'] . '-' . $fila_familia['nombre_familia'];

                                                        $id_familia = $fila_familia['idFamilia'];

                                                        $id_familia_nuevo = str_pad($id_familia, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_familia_nuevo ?></td>
                                                            <td><?php echo $fila_familia['nombre_familia'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalFamilia-e" onclick="agregarFormFamilia('<?php echo $datos_familia ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalFamilia-v" onclick="filtrarFamilia('<?php echo $id_familia ?>')">description</i>
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

                        <!--***********TAB GENEROS************-->
                        <div class="col-md-9">
                            <div id="Genero" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>GÉNEROS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalGenero">Agregar nuevo Género</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Género</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_genero = "SELECT `idGenero`, `nombre_genero` FROM `genero`";

                                                    $consulta_genero = Conexion::obtener_conexion()->query($sql_genero);

                                                    while ($fila_genero = $consulta_genero->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_genero = $fila_genero['idGenero'] . '-' . $fila_genero['nombre_genero'];

                                                        $id_genero = $fila_genero['idGenero'];

                                                        $id_genero_nuevo = str_pad($id_genero, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_genero_nuevo ?></td>
                                                            <td><?php echo $fila_genero['nombre_genero'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalGenero-e" onclick="agregarFormGenero('<?php echo $datos_genero ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalGenero-v" onclick="filtrarGenero('<?php echo $id_genero ?>')">description</i>
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

                        <!--***********TAB EPITETO************-->
                        <div class="col-md-9">
                            <div id="Epiteto" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>EPÍTETOS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalEpiteto">Agregar nuev Epíteto</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Epíteto</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_epiteto = "SELECT `idEpiteto`, `nombre_epiteto` FROM `epiteto`";

                                                    $consulta_epiteto = Conexion::obtener_conexion()->query($sql_epiteto);

                                                    while ($fila_epiteto = $consulta_epiteto->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_epiteto = $fila_epiteto['idEpiteto'] . '-' . $fila_epiteto['nombre_epiteto'];

                                                        $id_epiteto = $fila_epiteto['idEpiteto'];

                                                        $id_epiteto_nuevo = str_pad($id_epiteto, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_epiteto_nuevo ?></td>
                                                            <td><?php echo $fila_epiteto['nombre_epiteto'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalEpiteto-e" onclick="agregarFormEpiteto('<?php echo $datos_epiteto ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalEpiteto-v" onclick="filtrarEpiteto('<?php echo $id_epiteto ?>')">description</i>
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

                        <!--***********TAB COLOR************-->
                        <div class="col-md-9">
                            <div id="Color" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>COLORES</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalColor">Agregar nuevo Color</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Color</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_color = "SELECT `idColor`, `nombre_color` FROM `color`";

                                                    $consulta_color = Conexion::obtener_conexion()->query($sql_color);

                                                    while ($fila_color = $consulta_color->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_color = $fila_color['idColor'] . '-' . $fila_color['nombre_color'];

                                                        $id_color = $fila_color['idColor'];

                                                        $id_color_nuevo = str_pad($id_color, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_color_nuevo ?></td>
                                                            <td><?php echo $fila_color['nombre_color'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalColor-e" onclick="agregarFormColor('<?php echo $datos_color ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalColor-v" onclick="filtrarColor('<?php echo $id_color ?>')">description</i>
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

                        <!--***********TAB DETERMINADO POR************-->
                        <div class="col-md-9">
                            <div id="Determinado" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>DETERMINACIONES</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalDeterminadaPor">Agregar nuevo Determinador</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Determinadores</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_determinado = "SELECT `idDeterminadaPor`, `nombre_determinado` FROM `determinadapor`";

                                                    $consulta_determinado = Conexion::obtener_conexion()->query($sql_determinado);

                                                    while ($fila_determinado = $consulta_determinado->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_determinado = $fila_determinado['idDeterminadaPor'] . '-' . $fila_determinado['nombre_determinado'];

                                                        $id_determinado = $fila_determinado['idDeterminadaPor'];

                                                        $id_determinado_nuevo = str_pad($id_determinado, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_determinado_nuevo ?></td>
                                                            <td><?php echo $fila_determinado['nombre_determinado'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalDeterminado-e" onclick="agregarFormDeterminado('<?php echo $datos_determinado ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalDeterminadaPor-v" onclick="filtrarDeterminadaPor('<?php echo $id_determinado ?>')">description</i>
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

                        <!--***********TAB FORMA************-->
                        <div class="col-md-9">
                            <div id="Forma" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>FORMAS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalForma">Agregar nueva Forma</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Forma</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_forma = "SELECT `idForma`, `nombre_forma` FROM `forma`";

                                                    $consulta_forma = Conexion::obtener_conexion()->query($sql_forma);

                                                    while ($fila_forma = $consulta_forma->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_forma = $fila_forma['idForma'] . '-' . $fila_forma['nombre_forma'];

                                                        $id_forma = $fila_forma['idForma'];

                                                        $id_forma_nuevo = str_pad($id_forma, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_forma_nuevo ?></td>
                                                            <td><?php echo $fila_forma['nombre_forma'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalForma-e" onclick="agregarFormForma('<?php echo $datos_forma ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalForma-v" onclick="filtrarForma('<?php echo $id_forma ?>')">description</i>
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

                        <!--***********TAB TIPOS DE HOJA************-->
                        <div class="col-md-9">
                            <div id="Tipo" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>TIPOS DE HOJAS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalTipoHoja">Agregar nuevo Tipo de Hoja</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Tipo de Hoja</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_tipo = "SELECT `idTipoHoja`, `nombre_hoja` FROM `tipohoja`";

                                                    $consulta_tipo = Conexion::obtener_conexion()->query($sql_tipo);

                                                    while ($fila_tipo = $consulta_tipo->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_tipo = $fila_tipo['idTipoHoja'] . '-' . $fila_tipo['nombre_hoja'];

                                                        $id_tipo = $fila_tipo['idTipoHoja'];

                                                        $id_tipo_nuevo = str_pad($id_tipo, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_tipo_nuevo ?></td>
                                                            <td><?php echo $fila_tipo['nombre_hoja'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalTipoHoja-e" onclick="agregarFormTipoHoja('<?php echo $datos_tipo ?>')">edit</i>
                                                                </a>
                                                                <i>&nbsp;</i>
                                                                <a href="#" style="color: #A1D490">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalTipoHoja-v" onclick="filtrarTipoHoja('<?php echo $id_tipo ?>')">description</i>
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

                        <!--***********TAB USOS************-->
                        <div class="col-md-9">
                            <div id="Uso" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>USOS</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalUso">Agregar nuevo Uso</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Uso</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_uso = "SELECT `idUso`, `nombre_uso` FROM `uso`";

                                                    $consulta_uso = Conexion::obtener_conexion()->query($sql_uso);

                                                    while ($fila_uso = $consulta_uso->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_uso = $fila_uso['idUso'] . '-' . $fila_uso['nombre_uso'];

                                                        $id_uso = $fila_uso['idUso'];

                                                        $id_uso_nuevo = str_pad($id_uso, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_uso_nuevo ?></td>
                                                            <td><?php echo $fila_uso['nombre_uso'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalUso-e" onclick="agregarFormUso('<?php echo $datos_uso ?>')">edit</i>
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

                        <!--***********TAB ESTADOS DE SALUD************-->
                        <div class="col-md-9">
                            <div id="Estado" class="tabcontentC">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>ESTADOS DE SALUD</h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a data-toggle="modal" data-target="#modalEstadoSalud">Agregar nuevo Estado de Salud</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive">
                                                <!--<table class="table table-bordered table-striped table-hover">-->
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr style="background: white">
                                                        <th>ID</th>
                                                        <th>Estado de Salud</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_estado = "SELECT `idEstadoSalud`, `nombre_estado` FROM `estadosalud`";

                                                    $consulta_estado = Conexion::obtener_conexion()->query($sql_estado);

                                                    while ($fila_estado = $consulta_estado->fetch(PDO::FETCH_ASSOC)) {

                                                        $datos_estado = $fila_estado['idEstadoSalud'] . '-' . $fila_estado['nombre_estado'];

                                                        $id_estado = $fila_estado['idEstadoSalud'];

                                                        $id_estado_nuevo = str_pad($id_estado, 3, "0", STR_PAD_LEFT);
                                                        ?>
                                                        <tr valign="top">
                                                            <td><?php echo $id_estado_nuevo ?></td>
                                                            <td><?php echo $fila_estado['nombre_estado'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" style="color: #5DADE2">
                                                                    <i class="material-icons" data-toggle="modal" data-target="#modalEstadoSalud-e" onclick="agregarFormEstadoSalud('<?php echo $datos_estado ?>')">edit</i>
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
            </div>
        </div>

        <!--**************MODALES AGREGAR*****************-->
        <div>
            <!-- Modal REINO -->
            <div class="modal fade" id="modalReino" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Reino</h4>
                        </div>

                        <form id="fmr-reino">
                            <div class="modal-body">
                                <label for="nombre-reino">Nombre del Reino</label>
                                <input type="text" class="form-control" name="nombre-reino" id="nombre-reino" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-reino">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-reino"></div>

                    </div>
                </div>
            </div>
            <!-- Modal DIVISION -->
            <div class="modal fade" id="modalDivision" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nueva División</h4>
                        </div>

                        <form id="fmr-division">
                            <div class="modal-body">
                                <label for="nombre-division">Nombre de la División</label>
                                <input type="text" class="form-control" name="nombre-division" id="nombre-division" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-division">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-division"></div>

                    </div>
                </div>
            </div>
            <!-- Modal CLASE -->
            <div class="modal fade" id="modalClase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Clase</h4>
                        </div>

                        <form id="fmr-reino">
                            <div class="modal-body">
                                <label for="nombre-clase">Nombre de la Clase</label>
                                <input type="text" class="form-control" name="nombre-clase" id="nombre-clase" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-clase">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-reino"></div>

                    </div>
                </div>
            </div>
            <!-- Modal ORDEN -->
            <div class="modal fade" id="modalOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Orden</h4>
                        </div>

                        <form id="fmr-orden">
                            <div class="modal-body">
                                <label for="nombre-orden">Nombre de Orden</label>
                                <input type="text" class="form-control" name="nombre-orden" id="nombre-orden" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-orden">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-familia"></div>

                    </div>
                </div>
            </div>
            <!-- Modal FAMILIAL -->
            <div class="modal fade" id="modalFamilia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nueva Familia</h4>
                        </div>

                        <form id="fmr-familia">
                            <div class="modal-body">
                                <label for="nombre-familia">Nombre de la Familia</label>
                                <input type="text" class="form-control" name="nombre-familia" id="nombre-familia" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-familia">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-familia"></div>

                    </div>
                </div>
            </div>
            <!-- Modal GENERO -->
            <div class="modal fade" id="modalGenero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Género</h4>
                        </div>

                        <form id="fmr-genero">
                            <div class="modal-body">
                                <label for="nombre-genero">Nombre del Género</label>
                                <input type="text" class="form-control" name="nombre-genero" id="nombre-genero" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-genero">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-genero"></div>

                    </div>
                </div>
            </div>
            <!-- Modal EPITETO -->
            <div class="modal fade" id="modalEpiteto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Epíteto</h4>
                        </div>

                        <form id="fmr-epiteto">
                            <div class="modal-body">
                                <label for="nombre-epiteto">Nombre del Epíteto</label>
                                <input type="text" class="form-control" name="nombre-epiteto" id="nombre-epiteto" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-epiteto">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>

                        <div id="mensaje-epiteto"></div>
                    </div>
                </div>
            </div>
            <!-- Modal COLOR -->
            <div class="modal fade" id="modalColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Color</h4>
                        </div>

                        <form id="fmr-color">
                            <div class="modal-body">
                                <label for="nombre-color">Nombre del Color</label>
                                <input type="text" class="form-control" name="nombre-color" id="nombre-color" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-color">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>

                        <div id="mensaje-color"></div>
                    </div>
                </div>
            </div>
            <!-- Modal Determinado -->
            <div class="modal fade" id="modalDeterminado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nueva Determinación</h4>
                        </div>

                        <form id="fmr-determinado">
                            <div class="modal-body">
                                <label for="nombre-determinado">Nombre del Género</label>
                                <input type="text" class="form-control" name="nombre-determinado" id="nombre-determinado" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-determinado">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-determinado"></div>

                    </div>
                </div>
            </div>
            <!-- Modal FORMAS -->
            <div class="modal fade" id="modalForma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nueva Forma</h4>
                        </div>

                        <form id="fmr-forma">
                            <div class="modal-body">
                                <label for="nombre-forma">Nombre del Género</label>
                                <input type="text" class="form-control" name="nombre-forma" id="nombre-forma" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-forma">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-forma"></div>

                    </div>
                </div>
            </div>
            <!-- Modal TIPO DE HOJA -->
            <div class="modal fade" id="modalTipoHoja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Tipo de Hoja</h4>
                        </div>

                        <form id="fmr-tipohoja">
                            <div class="modal-body">
                                <label for="nombre-tipohoja">Nombre del Tipo de Hoja</label>
                                <input type="text" class="form-control" name="nombre-tipohoja" id="nombre-tipohoja" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-tipohoja">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-tipohoja"></div>

                    </div>
                </div>
            </div>
            <!-- Modal Uso -->
            <div class="modal fade" id="modalUso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Uso</h4>
                        </div>

                        <form id="fmr-uso">
                            <div class="modal-body">
                                <label for="nombre-uso">Nombre del Uso</label>
                                <input type="text" class="form-control" name="nombre-uso" id="nombre-uso" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-uso">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-uso"></div>

                    </div>
                </div>
            </div>
            <!-- Modal ESTADO DE SALUD -->
            <div class="modal fade" id="modalEstadoSalud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar nuevo Estado de Salud</h4>
                        </div>

                        <form id="fmr-estadosalud">
                            <div class="modal-body">
                                <label for="nombre-estadosalud">Nombre del Estado de Salud</label>
                                <input type="text" class="form-control" name="nombre-estadosalud" id="nombre-estadosalud" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" id="guardar-estadosalud">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-estadosalud"></div>

                    </div>
                </div>
            </div>
        </div>

        <!--**************MODALES EDITAR*****************-->
        <div>
            <!-- ******* MODAL EDITAR REINO -->
            <div class="modal fade" id="modalReino-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Reino</h4>
                        </div>

                        <form id="fmr-reino-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-reino" id="id-reino" >
                                <label for="nombre-reino-e">Nombre del Reino</label>
                                <input type="text" class="form-control" name="nombre-reino-e" id="nombre-reino-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-reino">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-reino-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR DIVISION -->
            <div class="modal fade" id="modalDivision-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar División</h4>
                        </div>

                        <form id="fmr-division-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-division" id="id-division" >
                                <label for="nombre-division-e">Nombre de la División</label>
                                <input type="text" class="form-control" name="nombre-division-e" id="nombre-division-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-division">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-division-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR CLASE -->
            <div class="modal fade" id="modalClase-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Clase</h4>
                        </div>

                        <form id="fmr-clase-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-clase" id="id-clase" >
                                <label for="nombre-clase-e">Nombre de la Clase</label>
                                <input type="text" class="form-control" name="nombre-clase-e" id="nombre-clase-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-clase">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-clase-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR ORDEN -->
            <div class="modal fade" id="modalOrden-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Orden</h4>
                        </div>

                        <form id="fmr-orden-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-orden" id="id-orden" >
                                <label for="nombre-orden-e">Nombre del Orden</label>
                                <input type="text" class="form-control" name="nombre-orden-e" id="nombre-orden-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-orden">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-orden-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR FAMILIA -->
            <div class="modal fade" id="modalFamilia-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Edita Familia</h4>
                        </div>

                        <form id="fmr-familia-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-familia" id="id-familia" >
                                <label for="nombre-familia-e">Nombre de la Familia</label>
                                <input type="text" class="form-control" name="nombre-familia-e" id="nombre-familia-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-familia">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-familia-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR GENERO -->
            <div class="modal fade" id="modalGenero-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Género</h4>
                        </div>

                        <form id="fmr-genero-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-genero" id="id-genero" >
                                <label for="nombre-genero-e">Nombre del Género</label>
                                <input type="text" class="form-control" name="nombre-genero-e" id="nombre-genero-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-genero">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-genero-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR EPITETO -->
            <div class="modal fade" id="modalEpiteto-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Epíteto</h4>
                        </div>

                        <form id="fmr-epiteto-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-epiteto" id="id-epiteto" >
                                <label for="nombre-epiteto-e">Nombre del Epíteto</label>
                                <input type="text" class="form-control" name="nombre-epiteto-e" id="nombre-epiteto-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-epiteto">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-epiteto-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR COLOR -->
            <div class="modal fade" id="modalColor-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Color</h4>
                        </div>

                        <form id="fmr-color-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-color" id="id-color" >
                                <label for="nombre-color-e">Nombre del Color</label>
                                <input type="text" class="form-control" name="nombre-color-e" id="nombre-color-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-color">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-color-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR DETERMINACION -->
            <div class="modal fade" id="modalDeterminado-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Determinación</h4>
                        </div>

                        <form id="fmr-determinado-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-determinado" id="id-determinado" >
                                <label for="nombre-determinado-e">Nombre de la Determinación</label>
                                <input type="text" class="form-control" name="nombre-determinado-e" id="nombre-determinado-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-determinado">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-determinado-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR FORMA -->
            <div class="modal fade" id="modalForma-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Forma</h4>
                        </div>

                        <form id="fmr-forma-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-forma" id="id-forma" >
                                <label for="nombre-forma-e">Nombre de la Forma</label>
                                <input type="text" class="form-control" name="nombre-forma-e" id="nombre-forma-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-forma">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-forma-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR TIPO DE HOJA -->
            <div class="modal fade" id="modalTipoHoja-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Tipo de Hoja</h4>
                        </div>

                        <form id="fmr-tipohoja-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-tipo" id="id-tipo" >
                                <label for="nombre-tipohoja-e">Nombre del Tipo de Hoja</label>
                                <input type="text" class="form-control" name="nombre-tipohoja-e" id="nombre-tipohoja-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-tipo">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-tipohoja-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR USO -->
            <div class="modal fade" id="modalUso-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Uso</h4>
                        </div>

                        <form id="fmr-uso-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-uso" id="id-uso" >
                                <label for="nombre-uso-e">Nombre del Uso</label>
                                <input type="text" class="form-control" name="nombre-uso-e" id="nombre-uso-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-uso">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-uso-e"></div>

                    </div>
                </div>
            </div>

            <!-- ******* MODAL EDITAR ESTADO DE SALUD -->
            <div class="modal fade" id="modalEstadoSalud-e" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document" style="width: 600px; margin: 30px auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Editar Estado de Salud</h4>
                        </div>

                        <form id="fmr-estadosalud-e">
                            <div class="modal-body">
                                <input type="text" Style = "display:none" class="form-control" name="id-estado" id="id-estado" >
                                <label for="nombre-estadosalud-e">Nombre del Estado de Salud</label>
                                <input type="text" class="form-control" name="nombre-estadosalud-e" id="nombre-estadosalud-e" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" id="actualizar-estado">ACTUALIZAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            </div>
                        </form>
                        <div id="mensaje-estadosalud-e"></div>

                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-------------------FILTRAR REINO-->
            <div class="modal fade" id="modalReino-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE REINO</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaReino">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR DIVISION-->
            <div class="modal fade" id="modalDivision-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE DIVISIÓN</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaDivision">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR CLASE-->
            <div class="modal fade" id="modalClase-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE CLASE</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaClase">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR ORDEN-->
            <div class="modal fade" id="modalOrden-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE ORDEN</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaOrden">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR FAMILIA-->
            <div class="modal fade" id="modalFamilia-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE FAMILIA</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaFamilia">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR GENERO-->
            <div class="modal fade" id="modalGenero-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE GÉNERO</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaGenero">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR EPITETO-->
            <div class="modal fade" id="modalEpiteto-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE EPÍTETO</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaEpiteto">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR COLOR-->
            <div class="modal fade" id="modalColor-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE COLOR</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaColor">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR DETERMINACION-->
            <div class="modal fade" id="modalDeterminadaPor-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE DETERMINACIÓN</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaDeterminadaPor">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR FORMAS-->
            <div class="modal fade" id="modalForma-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE FORMA</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaForma">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------FILTRAR TIPO DE HOJA-->
            <div class="modal fade" id="modalTipoHoja-v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="header bg-green">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                                        style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                                <h2>FILTRO SOBRE TIPO DE HOJA</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaTipoHoja">
                                    <thead>
                                        <tr style="background-color: white">
                                            <th>ID</th>
                                            <th>Familia</th>
                                            <th>Género</th>
                                            <th>Epíteto</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- SCRIPT INSERTAR DATOS -->
    <script type="text/javascript">

        //CREAR NUEVO REINO
        $('#guardar-reino').click(function ()
        {
            nombre_reino = $('#nombre-reino').val();
            if (!nombre_reino)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarReino', 'n_reino': nombre_reino},
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

        //CREAR NUEVA DIVISION
        $('#guardar-division').click(function ()
        {
            nombre_division = $('#nombre-division').val();
            if (!nombre_division)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarDivision', 'n_division': nombre_division},
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

        //CREAR NUEVA CLASE
        $('#guardar-clase').click(function ()
        {
            nombre_clase = $('#nombre-clase').val();
            if (!nombre_clase)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarClase', 'n_clase': nombre_clase},
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

        //CREAR NUEVA ORDEN
        $('#guardar-orden').click(function ()
        {
            nombre_orden = $('#nombre-orden').val();
            if (!nombre_orden)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarOrden', 'n_orden': nombre_orden},
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

        //CREAR NUEVA FAMILIA
        $('#guardar-familia').click(function ()
        {
            nombre_familia = $('#nombre-familia').val();
            if (!nombre_familia)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarFamilia', 'n_familia': nombre_familia},
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

        //CREAR NUEVA GENERO
        $('#guardar-genero').click(function ()
        {
            nombre_genero = $('#nombre-genero').val();
            if (!nombre_genero)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarGenero', 'n_genero': nombre_genero},
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

        //CREAR NUEVA EPITETO
        $('#guardar-epiteto').click(function ()
        {
            nombre_epiteto = $('#nombre-epiteto').val();
            if (!nombre_epiteto)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarEpiteto', 'n_epiteto': nombre_epiteto},
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

        //CREAR NUEVA COLOR
        $('#guardar-color').click(function ()
        {
            nombre_color = $('#nombre-color').val();
            if (!nombre_color)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarColor', 'n_color': nombre_color},
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

        //CREAR NUEVA DETERMINADO POR
        $('#guardar-determinado').click(function ()
        {
            nombre_determinado = $('#nombre-determinado').val();
            if (!nombre_determinado)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarDeterminado', 'n_determinado': nombre_determinado},
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

        //CREAR NUEVA FORMAS
        $('#guardar-forma').click(function ()
        {
            nombre_forma = $('#nombre-forma').val();
            if (!nombre_forma)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarForma', 'n_forma': nombre_forma},
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

        //CREAR NUEVA TIPO DE HOJAS
        $('#guardar-tipohoja').click(function ()
        {
            nombre_tipohoja = $('#nombre-tipohoja').val();
            if (!nombre_tipohoja)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarTipoHoja', 'n_tipohoja': nombre_tipohoja},
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

        //CREAR NUEVA USO
        $('#guardar-uso').click(function ()
        {
            nombre_uso = $('#nombre-uso').val();
            if (!nombre_uso)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarUso', 'n_uso': nombre_uso},
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

        //CREAR NUEVA ESTADO DE SALUD
        $('#guardar-estadosalud').click(function ()
        {
            nombre_estadosalud = $('#nombre-estadosalud').val();
            if (!nombre_estadosalud)
            {
                alertify.warning('Debe completar todos los campos');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarEstadoSalud', 'n_estadosalud': nombre_estadosalud},
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


        /*
         function desactivarReino(id)
         {
         if (confirm('Desea eliminar este reino?'))
         {
         
         } else
         {
         alert("Cancelo la actualizacion");
         }
         
         }*/
    </script>

    <!-- SCRIPT ACTUALIZAR DATOS -->
    <script>

        //***** ACTUALIZAR REINO
        $('#actualizar-reino').click(function ()
        {
            nombre_reino = $('#nombre-reino-e').val();
            id_reino = $('#id-reino').val();
            if (!nombre_reino)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarReino', 'n_reino': nombre_reino, 'id_reino': id_reino},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR DIVISION
        $('#actualizar-division').click(function ()
        {
            nombre_division = $('#nombre-division-e').val();
            id_division = $('#id-division').val();
            if (!nombre_division)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarDivision', 'n_division': nombre_division, 'id_division': id_division},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR CLASE
        $('#actualizar-clase').click(function ()
        {
            nombre_clase = $('#nombre-clase-e').val();
            id_clase = $('#id-clase').val();
            if (!nombre_clase)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarClase', 'n_clase': nombre_clase, 'id_clase': id_clase},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR ORDEN
        $('#actualizar-orden').click(function ()
        {
            nombre_orden = $('#nombre-orden-e').val();
            id_orden = $('#id-orden').val();
            if (!nombre_orden)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarOrden', 'n_orden': nombre_orden, 'id_orden': id_orden},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR FAMILIA
        $('#actualizar-familia').click(function ()
        {
            nombre_familia = $('#nombre-familia-e').val();
            id_familia = $('#id-familia').val();
            if (!nombre_familia)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarFamilia', 'n_familia': nombre_familia, 'id_familia': id_familia},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR GENERO
        $('#actualizar-genero').click(function ()
        {
            nombre_genero = $('#nombre-genero-e').val();
            id_genero = $('#id-genero').val();
            if (!nombre_genero)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarGenero', 'n_genero': nombre_genero, 'id_genero': id_genero},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR EPITETO
        $('#actualizar-epiteto').click(function ()
        {
            nombre_epiteto = $('#nombre-epiteto-e').val();
            id_epiteto = $('#id-epiteto').val();
            if (!nombre_epiteto)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarEpiteto', 'n_epiteto': nombre_epiteto, 'id_epiteto': id_epiteto},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR COLOR
        $('#actualizar-color').click(function ()
        {
            nombre_color = $('#nombre-color-e').val();
            id_color = $('#id-color').val();
            if (!nombre_color)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarColor', 'n_color': nombre_color, 'id_color': id_color},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR DETERMINACION
        $('#actualizar-determinado').click(function ()
        {
            nombre_determinado = $('#nombre-determinado-e').val();
            id_determinado = $('#id-determinado').val();
            if (!nombre_determinado)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarDeterminado', 'n_determinado': nombre_determinado, 'id_determinado': id_determinado},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR FORMA
        $('#actualizar-forma').click(function ()
        {
            nombre_forma = $('#nombre-forma-e').val();
            id_forma = $('#id-forma').val();
            if (!nombre_forma)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarForma', 'n_forma': nombre_forma, 'id_forma': id_forma},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR TIPO DE HOJA
        $('#actualizar-tipo').click(function ()
        {
            nombre_tipo = $('#nombre-tipohoja-e').val();
            id_tipo = $('#id-tipo').val();
            if (!nombre_tipo)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarTipo', 'n_tipo': nombre_tipo, 'id_tipo': id_tipo},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR USO
        $('#actualizar-uso').click(function ()
        {
            nombre_uso = $('#nombre-uso-e').val();
            id_uso = $('#id-uso').val();
            if (!nombre_uso)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarUso', 'n_uso': nombre_uso, 'id_uso': id_uso},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //***** ACTUALIZAR ESTADO DE SALUD
        $('#actualizar-estado').click(function ()
        {
            nombre_estado = $('#nombre-estadosalud-e').val();
            id_estado = $('#id-estado').val();
            if (!nombre_estado)
            {
                alertify.warning('El campo no puede quedar vacío');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'actualizarEstado', 'n_estado': nombre_estado, 'id_estado': id_estado},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Se actualizó correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        function agregarFormReino(datos_reino) {
            re = datos_reino.split('-');
            $('#id-reino').val(re[0]);
            $('#nombre-reino-e').val(re[1]);
        }

        function agregarFormDivision(datos_division) {
            di = datos_division.split('-');
            $('#id-division').val(di[0]);
            $('#nombre-division-e').val(di[1]);
        }

        function agregarFormClase(datos_clase) {
            cl = datos_clase.split('-');
            $('#id-clase').val(cl[0]);
            $('#nombre-clase-e').val(cl[1]);
        }

        function agregarFormOrden(datos_orden) {
            or = datos_orden.split('-');
            $('#id-orden').val(or[0]);
            $('#nombre-orden-e').val(or[1]);
        }

        function agregarFormFamilia(datos_familia) {
            fa = datos_familia.split('-');
            $('#id-familia').val(fa[0]);
            $('#nombre-familia-e').val(fa[1]);
        }

        function agregarFormGenero(datos_genero) {
            ge = datos_genero.split('-');
            $('#id-genero').val(ge[0]);
            $('#nombre-genero-e').val(ge[1]);
        }

        function agregarFormEpiteto(datos_epiteto) {
            ep = datos_epiteto.split('-');
            $('#id-epiteto').val(ep[0]);
            $('#nombre-epiteto-e').val(ep[1]);
        }

        function agregarFormColor(datos_color) {
            co = datos_color.split('-');
            $('#id-color').val(co[0]);
            $('#nombre-color-e').val(co[1]);
        }

        function agregarFormDeterminado(datos_determinado) {
            de = datos_determinado.split('-');
            $('#id-determinado').val(de[0]);
            $('#nombre-determinado-e').val(de[1]);
        }

        function agregarFormForma(datos_forma) {
            fo = datos_forma.split('-');
            $('#id-forma').val(fo[0]);
            $('#nombre-forma-e').val(fo[1]);
        }

        function agregarFormTipoHoja(datos_tipo) {
            ti = datos_tipo.split('-');
            $('#id-tipo').val(ti[0]);
            $('#nombre-tipohoja-e').val(ti[1]);
        }

        function agregarFormUso(datos_uso) {
            us = datos_uso.split('-');
            $('#id-uso').val(us[0]);
            $('#nombre-uso-e').val(us[1]);
        }

        function agregarFormEstadoSalud(datos_estado) {
            es = datos_estado.split('-');
            $('#id-estado').val(es[0]);
            $('#nombre-estadosalud-e').val(es[1]);
        }

    </script>

    <!-- SCRIPT FILTRAR DATOS -->
    <script>
        //***** FILTRAR REINO
        function filtrarReino(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarReino', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaReino').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR DIVISION
        function filtrarDivision(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarDivision', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaDivision').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR CLASE
        function filtrarClase(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarClase', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaClase').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR ORDEN
        function filtrarOrden(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarOrden', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaOrden').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR FAMILIA
        function filtrarFamilia(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarFamilia', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaFamilia').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR GENERO
        function filtrarGenero(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarGenero', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaGenero').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR EPITETO
        function filtrarEpiteto(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarEpiteto', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaEpiteto').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR COLOR
        function filtrarColor(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarColor', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaColor').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR DETERMINACION
        function filtrarDeterminadaPor(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarDeterminadaPor', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaDeterminadaPor').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR FORMA
        function filtrarForma(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarForma', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaForma').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
        //***** FILTRAR TIPO DE HOJA
        function filtrarTipoHoja(id) {

            $.ajax({
                type: "POST",
                url: "app/filtrarDatos.php",
                data: {'funcion': 'filtrarTipoHoja', 'id': id},

                success: function (r) {
                    var datos = $.parseJSON(r);
                    console.log(datos);
                    var t = $('#tablaTipoHoja').DataTable();
                    t.clear().draw();
                    $.each(datos, function (i, item)
                    {
                        t.row.add([
                            item.idPlanta,
                            item.nombre_familia,
                            item.nombre_genero,
                            item.nombre_epiteto,
                            item.fecha_ingreso

                        ]).draw(false);
                    });
                }
            });
        }
    </script>

    <?php
    Conexion::cerrar_conexion();
    ?>

</body>
</html>