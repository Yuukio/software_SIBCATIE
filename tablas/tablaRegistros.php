<?php
include_once '../app/Conexion.inc.php';
include_once '../app/conexion2.php';
include_once '../plantillas/dataTable.inc.php';
include_once '../app/Redireccion.inc.php';
?>

<style>
    .bs-example{
        margin: 200px 100px;
    }
    .bs-example a{
        margin: 25px;
        font-size: 20px;
    }
    /* Styles for custom tooltip template */
    .tooltip-head{
        color: #fff;
        background: #000;
        padding: 10px 10px 5px;
        border-radius: 4px 4px 0 0;
        text-align: center;
        margin-bottom: -2px; /* Hide default tooltip rounded corner from top */
    }
    .tooltip-head .glyphicon{
        font-size: 22px;
        vertical-align: bottom;
    }
    .tooltip-head h3{
        margin: 0;
        font-size: 18px;
    }
</style>


<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>ID</th>
                <th>Familia</th>
                <th>Género</th>
                <th>Epíteto</th>
                <th>Visible</th>
                <th>Opciones</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Imagen</th>
                <th>ID</th>
                <th>Familia</th>
                <th>Género</th>
                <th>Epíteto</th>
                <th>Visible</th>
                <th>Opciones</th>
                <th>Seleccionar</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $sql = "SELECT P.idPlanta, P.idMascara, P.autor, P.fecha_ingreso, P.fuente_informacion, P.altura, P.reproduccion, P.visible, P.revision, Fa.nombre_familia, 
                    Ge.nombre_genero, Ep.nombre_epiteto, Fo.nombre_forma, Co.nombre_color, De.nombre_determinado, Ti.nombre_hoja, P.reino_idReino, P.division_idDivision,
                    P.clase_idClase, P.orden_idOrden, P.Familia_idFamilia, P.Genero_idGenero, P.Epiteto_idEpiteto, P.Color_idColor, P.Forma_idForma, P.TipoHoja_idTipoHoja, 
                    P.DeterminadaPor_idDeterminadaPor, P.url_img
                    FROM planta P 
                    LEFT JOIN familia Fa ON P.Familia_idFamilia = Fa.idFamilia
                    LEFT JOIN genero Ge ON P.Genero_idGenero = Ge.idGenero
                    LEFT JOIN epiteto Ep ON P.Epiteto_idEpiteto = Ep.idEpiteto
                    LEFT JOIN forma Fo ON P.Forma_idForma = Fo.idForma
                    LEFT JOIN color Co ON P.Color_idColor = Co.idColor
                    LEFT JOIN tipohoja Ti ON P.TipoHoja_idTipoHoja = Ti.idTipoHoja
                    LEFT JOIN determinadapor De ON P.DeterminadaPor_idDeterminadaPor = De.idDeterminadaPor
                    WHERE P.revision=1";

            $consulta = $pdoConn->prepare($sql);

            $consulta->execute();

            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

                $id = $fila['idPlanta'];
                $imagen = $fila['url_img'];

                if ($fila['reino_idReino'] == NULL || $fila['reino_idReino'] == 0) {
                    $reino = 'Indefinido';
                } else {
                    $reino = $fila['reino_idReino'];
                }

                if ($fila['division_idDivision'] == NULL || $fila['division_idDivision'] == 0) {
                    $division = 'Indefinido';
                } else {
                    $division = $fila['division_idDivision'];
                }

                if ($fila['clase_idClase'] == NULL || $fila['clase_idClase'] == 0) {
                    $clase = 'Indefinido';
                } else {
                    $clase = $fila['clase_idClase'];
                }

                if ($fila['orden_idOrden'] == NULL || $fila['orden_idOrden'] == 0) {
                    $orden = 'Indefinido';
                } else {
                    $orden = $fila['orden_idOrden'];
                }

                if ($fila['Familia_idFamilia'] == NULL || $fila['Familia_idFamilia'] == 0) {
                    $familia = 'Indefinido';
                } else {
                    $familia = $fila['Familia_idFamilia'];
                }

                if ($fila['Genero_idGenero'] == NULL || $fila['Genero_idGenero'] == 0) {
                    $genero = 'Indefinido';
                } else {
                    $genero = $fila['Genero_idGenero'];
                }

                if ($fila['Epiteto_idEpiteto'] == NULL || $fila['Epiteto_idEpiteto'] == 0) {
                    $epiteto = 'Indefinido';
                } else {
                    $epiteto = $fila['Epiteto_idEpiteto'];
                }

                if ($fila['Color_idColor'] == NULL || $fila['Color_idColor'] == 0) {
                    $color = 'Indefinido';
                } else {
                    $color = $fila['Color_idColor'];
                }

                if ($fila['Forma_idForma'] == NULL || $fila['Forma_idForma'] == 0) {
                    $forma = 'Indefinido';
                } else {
                    $forma = $fila['Forma_idForma'];
                }

                if ($fila['TipoHoja_idTipoHoja'] == NULL || $fila['TipoHoja_idTipoHoja'] == 0) {
                    $tipo = 'Indefinido';
                } else {
                    $tipo = $fila['TipoHoja_idTipoHoja'];
                }

                if ($fila['DeterminadaPor_idDeterminadaPor'] == NULL || $fila['DeterminadaPor_idDeterminadaPor'] == 0) {
                    $determinado = 'Indefinido';
                } else {
                    $determinado = $fila['DeterminadaPor_idDeterminadaPor'];
                }

                $datos = $reino . '*' . $division . '*' . $clase . '*' . $orden . '*' . $familia . '*' . $genero . '*' . $epiteto . '*' .
                        $fila['autor'] . '*' . $fila['fuente_informacion'] . '*' . $fila['altura'] . '*' . $color . '*' . $forma . '*' . $tipo . '*' .
                        $determinado . '*' . $fila['reproduccion'] . '*' . $fila['revision'] . '*' . $fila['visible'] . '*' . $id;

                $nombre_cientifico = $fila['nombre_genero'] . ' ' . $fila['nombre_epiteto'];
                $visible = $fila['visible'];

                /* ingreso de iconos de visible */
                if ($visible == 1) {

                    $visible = '<a style="color: #27AE60">
                                    <i class="material-icons">visibility</i>
                                </a>
                                ';
                } else {
                    $visible = '<a style="color: #E74C3C">
                                    <i class="material-icons">visibility_off</i>
                                </a>
                                ';
                }

                /* asignando en tabla */
                ?>
                <tr valign="top">
                    <td>
                        <div class="tz-gallery">
                            <div class="thumbnail" style="margin-bottom: 0px;">
                                <a class="lightbox" href="app/<?php echo $fila['url_img']; ?>">
                                    <img src="app/<?php echo $fila['url_img']; ?>" alt="Bridge" width="80" height="50">
                                </a>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $fila['idMascara'] ?></td>
                    <td><?php echo $fila['nombre_familia'] ?></td>
                    <td><?php echo $fila['nombre_genero'] ?></td>
                    <td><?php echo $fila['nombre_epiteto'] ?></td>
                    <td style="text-align:center; width: 5px;"><?php echo $visible ?></td>
                    <td style="text-align:center;">
                        <a href="<?php echo "http://localhost/software_SIBCATIE/especie.php" . '?id=' . "$id"; ?>" style="color: #17c4cb" data-toggle="opciones" title="Ver registro <?php echo $fila['idMascara'] ?> completo." data-placement='bottom'>
                            <i class="material-icons">search</i>
                        </a>
                        <i>&nbsp;</i>
                        <a href="#" style="color: #ffc122" data-toggle="opciones" title="Editar registro <?php echo $fila['idMascara'] ?>." data-placement='bottom'>
                            <i class="material-icons" data-toggle="modal" data-target="#modalActualizarPlanta" onclick="formActualizarDatos('<?php echo $datos ?>')">edit</i>
                        </a>
                        <i>&nbsp;</i>
                        <a href="#" style="color: #2a445f" name="btn-comun" data-toggle="opciones" title="Mantenimiento de nombres comunes del registro <?php echo $fila['idMascara'] ?>." data-placement='bottom'>
                            <i class="material-icons" data-toggle="modal" data-target="#modalAgregarComun" onclick="obtenerID('<?php echo $id ?>')">playlist_add</i>
                        </a>
                    </td>
                    <td style="text-align:center;">
                        <label class="containerCheck" style="margin-left: 7px">
                            <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
                                baguetteBox.run('.tz-gallery');
</script>

<script>
    /*$(document).ready(function(){
        $('[data-toggle="opciones"]').tooltip(); 
    });*/
</script>