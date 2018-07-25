<?php
include_once '../app/conexion2.php';
$id = $_GET['id'];
?>

<table class="table dataTable" id="tablaForma" style="text-align: center">
    <thead>
        <tr style="background-color: white">
            <th style="text-align: center">Nombre</th>
            <th style="text-align: center">Lengua</th>
            <th style="text-align: center">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT `idNombreComun`, `nombre_nombre_comun`, `lengua` FROM `nombrecomun` WHERE Planta_idPlanta=$id ORDER BY nombre_nombre_comun";
        $consulta = $pdoConn->prepare($sql);
        $consulta->execute();

        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $id_eliminar = $fila['idNombreComun'];
            ?>
            <tr valign="top">
                <td><?php echo $fila['nombre_nombre_comun'] ?></td> 
                <td><?php echo $fila['lengua'] ?></td>
                <td style="text-align:center;">
                    <button type="button" class="btn bg-red waves-effect" onclick="eliminarComun('<?php echo $id_eliminar ?>')">
                        <i class="material-icons" style="top: 0px">delete</i>
                    </button>
                </td>

            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>

    //ELIMINAR NOMBRE COMUN
    function eliminarComun(id) {

        $.ajax({
            type: "POST",
            url: "app/actualizarDatos.php",
            data: {'funcion': 'eliminarComun', 'id': id},
            success: function (r) {
                if (r == 1) {
                    $('#id-comun').val(id);
                    $('#tabla-comun').load('tablas/tablaNombreComun.php?id=' + "<?php echo $id; ?>");
                    alertify.success("Se eliminó correctamente");
                } else if (r == 0) {
                    alertify.error("Falló el servidor");
                } 
            }
        });
    }

</script>
