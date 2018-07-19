<?php 
include_once '../app/conexion2.php';
?>

<table class="table table-bordered table-danger">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Seleccion</th>
            <th>Imagen</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT `id`, `nombre`, `seleccion`, `url` FROM `imagen` ORDER BY id ASC";

        $consulta = $pdoConn->prepare($sql);
        $consulta->execute();

        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr valign="top">
                <td><?php echo $fila['id'] ?></td>
                <td><?php echo $fila['nombre'] ?></td>
                <td><?php echo $fila['seleccion'] ?></td>
                <td><img src="<?php echo $fila['url'] ?>" height="50"></td>
            </tr>
            <?php
        }
        ?>             
    </tbody>
</table>