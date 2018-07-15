<?php
include_once '../app/Conexion.inc.php';
include_once '../app/conexion2.php';
?>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabla-reino">
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

            //$consulta_reino = Conexion::obtener_conexion()->query($sql_reino);
            //*********
            $consulta_reino = $pdoConn->prepare($sql_reino);

            $consulta_reino->execute();
            //*********

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