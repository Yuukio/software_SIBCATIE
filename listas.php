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
    $listas = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <section class="content" style="padding-left: 20px; padding-right: 20px">

        <ul class="nav nav-tabs" style="text-align: center; font-size: 20px; margin-left: 20px; margin-right: 20px">
            <li class="active" style="float: none; display: inline-block; zoom: 1"><a data-toggle="tab" href="#favoritos">Lista de Favoritos</a></li>
            <li style="float: none; display: inline-block; zoom: 1"><a data-toggle="tab" href="#exportacion">Lista de Exportación</a></li>
        </ul>

        <div class="tab-content">
            
            <div id="favoritos" class="tab-pane fade in active">
                <div class="container-fluid">
                    <div class="card" style="margin-top: 20px">
                        <div class="header bg-green">
                            <button type="button" class="btn btn-default waves-effect close" style="line-height: 0.5; color: black; opacity: 1; margin-right: 30px; margin-top: -4px; width: 50px; height: 30px;">
                                <i class="material-icons" style="color: #2196f3 !important; width: 30px; top: 1px;">delete</i>
                            </button>
                            <h2>LISTA DE FAVORITOS</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr style="background-color: white">
                                        <th>ID</th>
                                        <th>Familia</th>
                                        <th>Género</th>
                                        <th>Epíteto</th>
                                        <th>Selección</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $usuario_favoritos = $_SESSION['idUsuario'];

                                    $sql_favoritos = "SELECT planta.idPlanta, planta.idMascara, genero.nombre_genero, epiteto.nombre_epiteto, familia.nombre_familia FROM favorito
                                                            LEFT JOIN (planta 
                                                            LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                                                            LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                                                            LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia) 
                                                            ON favorito.Planta_idPlanta=planta.idPlanta
                                                            WHERE favorito.Usuario_idUsuario='$usuario_favoritos'";

                                    $consulta_favoritos = $pdoConn->prepare($sql_favoritos);
                                    $consulta_favoritos->execute();

                                    while ($fila_favoritos = $consulta_favoritos->fetch(PDO::FETCH_ASSOC)) {
                                        $id_favorito = $fila_favoritos['idPlanta']
                                        ?>
                                        <tr valign="top">
                                            <td><?php echo $fila_favoritos['idMascara'] ?></td>
                                            <td><?php echo $fila_favoritos['nombre_familia'] ?></td>
                                            <td><?php echo $fila_favoritos['nombre_genero'] ?></td>
                                            <td><?php echo $fila_favoritos['nombre_epiteto'] ?></td>
                                            <td style="text-align:center;">
                                                <label class="containerCheck" style="margin-left: 7px">
                                                    <input type="checkbox" name="seleccion_f[]" value="<?php echo $id_favorito ?>">
                                                    <span class="checkmark"></span>
                                                </label>
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
            
            <div id="exportacion" class="tab-pane fade">
                <div class="container-fluid">
                    <div class="card" style="margin-top: 20px">
                        <div class="header bg-green">
                            <button type="button" class="btn btn-default waves-effect close" style="line-height: 0.5; color: black; opacity: 1; margin-right: 30px; margin-top: -4px; width: 50px; height: 30px;">
                                <i class="material-icons" style="color: #2196f3 !important; width: 30px; top: 1px;">delete</i>
                            </button>
                            <h2>LISTA DE EXPORTACIÓN</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr style="background-color: white">
                                        <th>ID</th>
                                        <th>Familia</th>
                                        <th>Género</th>
                                        <th>Epíteto</th>
                                        <th>Selección</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $usuario_exportar = $_SESSION['idUsuario'];

                                    $sql_favoritos = "SELECT planta.idPlanta, planta.idMascara, genero.nombre_genero, epiteto.nombre_epiteto, familia.nombre_familia FROM exportar
                                                            LEFT JOIN (planta 
                                                            LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                                                            LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                                                            LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia) 
                                                            ON exportar.Planta_idPlanta=planta.idPlanta
                                                            WHERE exportar.Usuario_idUsuario='$usuario_exportar'";

                                    $consulta_favoritos = $pdoConn->prepare($sql_favoritos);
                                    $consulta_favoritos->execute();

                                    while ($fila_favoritos = $consulta_favoritos->fetch(PDO::FETCH_ASSOC)) {
                                        $id_favorito = $fila_favoritos['idPlanta']
                                        ?>
                                        <tr valign="top">
                                            <td><?php echo $fila_favoritos['idMascara'] ?></td>
                                            <td><?php echo $fila_favoritos['nombre_familia'] ?></td>
                                            <td><?php echo $fila_favoritos['nombre_genero'] ?></td>
                                            <td><?php echo $fila_favoritos['nombre_epiteto'] ?></td>
                                            <td style="text-align:center;">
                                                <label class="containerCheck" style="margin-left: 7px">
                                                    <input type="checkbox" name="seleccion_f[]" value="<?php echo $id_favorito ?>">
                                                    <span class="checkmark"></span>
                                                </label>
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

    </section>

