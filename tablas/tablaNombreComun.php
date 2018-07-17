<?php
include_once '../app/conexion2.php';
?>

<table class="table dataTable" id="tablaForma" style="text-align: center">
    <thead>
        <tr style="background-color: white">
            <th>Nombre</th>
            <th>Lengua</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT `nombre_nombre_comun`, `lengua` FROM `nombrecomun` WHERE Planta_idPlanta=2 ORDER BY nombre_nombre_comun";

            $consulta = $pdoConn->prepare($sql);

            $consulta->execute();

            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

                /* asignando en tabla */
                ?>
                <tr valign="top">
                    <td><?php echo $fila['nombre_nombre_comun'] ?></td> 
                    <td><?php echo $fila['lengua'] ?></td>
                    <td style="text-align:center;">
                        <button type="submit" name="eliminar-comun" class="btn btn-xl waves-effect btn-danger">ELIMINAR</button>
                    </td>

                </tr>
                <?php
            }
            ?>
    </tbody>
</table>