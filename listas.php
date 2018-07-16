<!-- modal LISTA FAVORITOS -->
<div class="modal fade" id="modalFavoritos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-right: 1px !important">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                            style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                    <button type="button" class="btn btn-default waves-effect close" style="line-height: 0.5; color: black; opacity: 1; margin-right: 30px; margin-top: -4px; width: 50px; height: 30px;">
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
                                $id_favorito = $fila_favoritos['idPlanta']
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
</div>

<!-- modal LISTA EXPORTACION -->
<div class="modal fade" id="modalExportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                            style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                    <h2>FILTRO SOBRE FORMA</h2>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaForma">
                        <thead>
                            <tr style="background-color: white">
                                <th>ID</th>
                                <th>Familia</th>
                                <th>Género</th>
                                <th>Epíteto</th>
                                <th>Ingreso</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal LISTA OCULTOS -->
<div class="modal fade" id="modalOcultos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
                            style="font-size: 40px; line-height: 0.5; color: #fff; opacity: 1"><span aria-hidden="true">&times;</span></button>
                    <h2>FILTRO SOBRE FORMA</h2>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaForma">
                        <thead>
                            <tr style="background-color: white">
                                <th>ID</th>
                                <th>Familia</th>
                                <th>Género</th>
                                <th>Epíteto</th>
                                <th>Ingreso</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
