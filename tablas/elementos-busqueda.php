<?php
include_once '../app/conexion2.php';
?>

<div class="container-fluid">
    <div class="row">

        <?php
        $sql_mostrar = "SELECT genero.nombre_genero, epiteto.nombre_epiteto, planta.idMascara, planta.idPlanta, planta.url_img FROM `planta` 
                        INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero 
                        INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                        WHERE planta.activo=1 AND planta.visible=1 AND planta.revision=1";

        $consulta_mostra = $pdoConn->prepare($sql_mostrar);
        $consulta_mostra->execute();

        while ($fila_muestra = $consulta_mostra->fetch(PDO::FETCH_ASSOC)) {

            $id_mascara = $fila_muestra['idMascara'];
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
                                    <button type="button" class="btn btn-sm btn-info">Ver</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Guardar</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
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


<!--<div class='col-xsa-5 col-sma-5 col-mda-5 col-lga-5' style='padding: 10px; padding-top: 20px'><div style='height: 100%; width: 100%'><div class='card mb-4 box-shadow'><img class='card-img-top' data-src='holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail' alt='Thumbnail [100%x100%]' style='width: 100%; display: block;' src='app/ item.url_imge ' data-holder-rendered='true'><div class='card-body' style='text-align: center'><div style='text-align: left; margin-bottom: 5px'><h6>item.nombre_familia</h6><p style='margin-bottom: 0px;'><i>Nombre Genero</i></p></div><div style='text-align: right; margin-bottom: 10px'><small class='text-muted'>ID - item.idMascara</small></div><div class='justify-content-between align-items-center'><div class='btn-group' style='text-align: center;'><button type='button' class='btn btn-sm btn-info'>Ver</button><button type='button' class='btn btn-sm btn-outline-secondary'>Guardar</button><button type='button' class='btn btn-sm btn-outline-secondary'>Exportar</button></div></div></div></div></div></div>-->