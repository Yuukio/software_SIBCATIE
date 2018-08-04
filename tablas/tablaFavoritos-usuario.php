<?php
include_once '../app/ControlSesion.inc.php';
include_once '../app/Conexion.inc.php';
include_once '../app/conexion2.php';
include_once '../app/Redireccion.inc.php';

if (!ControlSesion::sesionIniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
?>

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"/>

<style>
    @media screen and (max-width: 1024px){
        table{
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
    }
</style>

<div style="padding-left: 20px">
    <table id="tabla-favoritos" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Familia</th>
                <th>Género</th>
                <th>Epíteto</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Familia</th>
                <th>Género</th>
                <th>Epíteto</th>
                <th>Ver</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $usuario = $_SESSION['idUsuario'];

            $sql = "SELECT planta.idPlanta, planta.idMascara, genero.nombre_genero, epiteto.nombre_epiteto, familia.nombre_familia FROM favorito
                    LEFT JOIN (planta 
                    LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                    LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                    LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia) 
                    ON favorito.Planta_idPlanta=planta.idPlanta
                    WHERE favorito.Usuario_idUsuario='$usuario'";

            $consulta = $pdoConn->prepare($sql);

            $consulta->execute();

            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

                /* asignando en tabla */
                ?>
                <tr valign="top">
                    <td>
                        <label class="containerCheck" style="margin-left: 10px">
                            <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><?php echo $fila['idMascara'] ?></td>
                    <td><?php echo $fila['nombre_familia'] ?></td>
                    <td><?php echo $fila['nombre_genero'] ?></td>
                    <td><?php echo $fila['nombre_epiteto'] ?></td>
                    <td style="text-align:center;">
                        <a href="<?php echo "http://localhost/software_SIBCATIE/especie.php" . '?id=' . "$id"; ?>" style="color: #17c4cb" data-toggle="opciones" title="Ver registro <?php echo $fila['idMascara'] ?> completo." data-placement='bottom'>
                            <i class="material-icons">search</i>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script src="js/jquery.dataTables.min.js"></script>

<script>

    $(document).ready(function () {
        $('#tabla-favoritos').DataTable({
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });

</script>
