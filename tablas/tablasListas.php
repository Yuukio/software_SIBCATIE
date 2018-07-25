<?php
include_once '../app/ControlSesion.inc.php';
include_once '../app/Conexion.inc.php';
include_once '../app/conexion2.php';
include_once '../plantillas/dataTable.inc.php';
include_once '../app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}
?>

<div id="favoritos" class="tab-pane fade in active">
    <div class="container-fluid">
        <div class="card" style="margin-top: 20px">
            <div class="header bg-green">
                <button type="submit" name="quitar-favoritos" id="quitar-favoritos" class="btn btn-default waves-effect close" 
                        style="line-height: 0.5; color: black; opacity: 1; margin-right: 30px; margin-top: -4px; width: 50px; height: 30px;">
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
                            $id_favorito = $fila_favoritos['idPlanta'];
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
                <button type="button" onClick = "$('#tabla-exportar').tableExport({type: 'pdf', escape: 'false'});" class="btn btn-default waves-effect close" 
                        style="line-height: 0.5; color: black; opacity: 1; margin-right: 30px; margin-top: -4px; width: 50px; height: 30px;">
                    <i class="material-icons" style="color: #2196f3 !important; width: 30px; top: 1px;">list</i>
                </button>
                <button type="submit" name="exportar" id="exportar" class="btn btn-default waves-effect close" 
                        style="line-height: 0.5; color: black; opacity: 1; margin-right: 30px; margin-top: -4px; width: 50px; height: 30px;">
                    <i class="material-icons" style="color: #2196f3 !important; width: 30px; top: 1px;">delete</i>
                </button>
                <h2>LISTA DE EXPORTACIÓN</h2>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover">
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

                        $sql_exportar = "SELECT planta.idPlanta, planta.idMascara, genero.nombre_genero, epiteto.nombre_epiteto, familia.nombre_familia FROM exportar
                                            LEFT JOIN (planta 
                                            LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                                            LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                                            LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia) 
                                            ON exportar.Planta_idPlanta=planta.idPlanta
                                            WHERE exportar.Usuario_idUsuario='$usuario_exportar'";

                        $consulta_exportar = $pdoConn->prepare($sql_exportar);
                        $consulta_exportar->execute();

                        while ($fila_exportar = $consulta_exportar->fetch(PDO::FETCH_ASSOC)) {
                            $id_exportar = $fila_exportar['idPlanta']
                            ?>
                            <tr valign="top">
                                <td><?php echo $fila_exportar['idMascara'] ?></td>
                                <td><?php echo $fila_exportar['nombre_familia'] ?></td>
                                <td><?php echo $fila_exportar['nombre_genero'] ?></td>
                                <td><?php echo $fila_exportar['nombre_epiteto'] ?></td>
                                <td style="text-align:center;">
                                    <label class="containerCheck" style="margin-left: 7px">
                                        <input type="checkbox" name="seleccion_e[]" value="<?php echo $id_exportar ?>">
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

<script>

    //QUITAR DE FAVORITOS
    $('#quitar-favoritos').click(function ()
    {
        var checked = [];
        $("input[name='seleccion_f[]']:checked").each(function ()
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
                data: {'funcion': 'quitarFavoritos', 'seleccion_f': checked},
                success: function (r) {

                    if (r == 1) {
                        location.reload();
                        alertify.success("Eliminados correctamente");
                    } else {
                        alertify.error("Error del servidor");
                    }
                }
            });
        }
    });

    //AGREGAR A EXPORTACION
    $('#exportar').click(function ()
    {
        var checked = [];
        $("input[name='seleccion_e[]']:checked").each(function ()
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
                data: {'funcion': 'quitarExportacion', 'seleccion_e': checked},
                success: function (r) {

                    if (r == 1) {
                        location.reload();
                        alertify.success("Ocultos correctamente");
                    } else {
                        alertify.error("Error del servidor");
                    }
                }
            });
        }
    });

</script>






