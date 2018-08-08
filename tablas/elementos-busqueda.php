<?php
include_once '../app/conexion2.php';
?>

<div class="container-fluid">
    <input style="display: none;" id="id-lista" type='text' value=''>
    <div class="row">

        <?php
        $sql_mostrar = "SELECT genero.nombre_genero, epiteto.nombre_epiteto, planta.idMascara, planta.idPlanta, planta.url_img FROM `planta` 
                        INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero 
                        INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                        WHERE planta.activo=1 AND planta.visible=1 AND planta.revision=1
                        ORDER BY planta.idMascara";

        $consulta_mostra = $pdoConn->prepare($sql_mostrar);
        $consulta_mostra->execute();

        while ($fila_muestra = $consulta_mostra->fetch(PDO::FETCH_ASSOC)) {

            $id_mascara = $fila_muestra['idMascara'];
            $id = $fila_muestra['idPlanta'];
            ?>

            <div class="col-xsa-5 col-sma-5 col-mda-5 col-lga-5" style="padding: 10px; padding-top: 20px">
                <div style="height: 100%; width: 100%">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x100%]" style="width: 100%; display: block;" src="app/<?php
                        if ($fila_muestra['url_img'] != null) {
                            echo $fila_muestra['url_img'];
                        } else {
                            echo "fotos/1-1-image (5).png";
                        }
                        ?>" data-holder-rendered="true">
                        <div class="card-body" style="text-align: center">
                            <div style="text-align: left; margin-bottom: 5px">
                                <h6><?php echo $fila_muestra['nombre_genero']; ?></h6>
                                <p style="margin-bottom: 0px;"><i><?php echo $fila_muestra['nombre_epiteto']; ?></i></p>
                            </div>
                            <div style="text-align: right; margin-bottom: 10px">
                                <small class="text-muted">ID - <?php echo $id_mascara; ?></small>
                            </div>
                            <div class="justify-content-between align-items-center">
                                <div class="btn-group" style="text-align: center;">
                                    <button type="button" class="btn btn-sm btn-info">
                                        <a href='http://localhost/software_SIBCATIE/ver-especie.php?id=<?php echo $id; ?>' style='color: white; text-decoration: none; padding: 6px 0px 6px 0px'>Ver</a>
                                    </button>
                                    <form>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="guardar" onclick="guardarFavorito('<?php echo $id; ?>')">Guardar</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="exportar" onclick="guardarExportar('<?php echo $id; ?>')">Exportar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<!-- AGREGAR A LISTAS DE USUARIOS -->
<script>
    function guardarFavorito(id) {
        $('#id-lista').val(id);

        id = $('#id-lista').val();
        
        $.ajax({
            type: "POST",
            url: "app/listas-usuario.php",
            data: {'funcion': 'agregar-favoritos', 'id': id},
            success: function (r) {
                if (r == 1) {
                    alertify.success("Agregado a favoritos");
                }else if(r == 2){
                    alertify.warning("Debes estar registrado");
                }else{
                    alertify.error("Error del servidor");
                }
            }
        });
    }

    function guardarExportar(id) {
        $('#id-lista').val(id);

        id = $('#id-lista').val();
        
        $.ajax({
            type: "POST",
            url: "app/listas-usuario.php",
            data: {'funcion': 'agregar-exportar', 'id': id},
            success: function (r) {
                if (r == 1) {
                    alertify.success("Agregado a Exportación");
                }else if(r == 2){
                    alertify.warning("Debes estar registrado");
                }else{
                    alertify.error("Error del servidor");
                }
            }
        });
    }

</script>

