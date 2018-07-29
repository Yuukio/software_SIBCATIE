<?php
include_once '../app/conexion2.php';
?>

<link rel="stylesheet" href="../css/gallery-clean.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

<div class="tz-gallery">
    <div class="row">

        <?php
        $id = $_GET['id'];

        $sql_img = "SELECT imagen.id, imagen.cretido, imagen.url, imagen.fecha_imagen, estadosalud.nombre_estado FROM `imagen` 
                    LEFT JOIN estadosalud ON imagen.estado_idEstado=estadosalud.idEstadoSalud
                    WHERE imagen.planta_idPlanta=$id";

        $consulta = $pdoConn->query($sql_img);

        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

            $id = $fila['id'];
            $creditos = $fila['cretido'];
            $url = $fila['url'];
            $estado = $fila['nombre_estado'];
            $fecha = $fila['fecha_imagen'];
            ?>

            <div class="col-sm-6 col-md-2">
                <div class="thumbnail">
                    <a class="lightbox" href="app/<?php echo $url; ?>">
                        <img src="app/<?php echo $url; ?>" alt="">
                    </a>
                    <a href="#" style="color: red">
                        <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" 
                                onclick="eliminarImagen('<?php echo $id; ?>')" style="position: absolute; top: 0; margin: 5px">
                            <i class="material-icons">delete</i>
                        </button>
                    </a>

                    <div class="caption">
                        <h3 style="margin-bottom: 5px;"><?php echo $creditos; ?></h3>
                        <p style="margin-bottom: 5px;"><?php echo $estado; ?></p>
                        <p><b><?php echo $fecha; ?></b></p>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>

<script>

    //ELIMINAR NOMBRE COMUN
    function eliminarImagen(id) {

        //pasar conjunto de url y id para eliminar la url al momento de darle a eliminar imagen

        $.ajax({
            type: "POST",
            url: "app/actualizarDatos.php",
            data: {'funcion': 'eliminarImagen', 'id': id},
            success: function (r) {
                if (r == 1) {
                    //$('#tabla-imagenes').load('tablaImagenes.php?id=' + "<?php //echo $id; ?>");
                    location.reload();
                    //alertify.success("Se eliminó correctamente");
                } else if (r == 0) {
                    alertify.error("Falló el servidor");
                } else if (r == id) {
                    console.log('no se sabe');
                } else {
                    console.log('no se sabe');
                }
            }
        });
    }

</script>