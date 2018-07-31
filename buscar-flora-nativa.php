<?php
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';

$titulo = 'FLORA NATIVA';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar-buscar.inc.php';
?>
<?php
Conexion::abrir_conexion();
?>

<link href="css/buscar-especies.css" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="color: white; background-image: url(img/nativa2.jpg); text-align: center">
            <h1 style="padding-top: 140px; padding-bottom: 60px; text-align: center">Flora Nativa del Jardín Botánico del CATIE</h1>
        </div>
        <div class="col-md-12 col-lg-2" style="background-color: #e9e9e9; border-right: ridge;">

            <form style="margin-top: 20px">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <input class="form-control" type="search" placeholder="Buscar...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-info" type="submit">
                            <i class="material-icons">search</i>
                        </button>
                    </div>
                </div>
            </form>

            <h5 style="padding: 10px; padding-top: 30px; text-align: center;">Buscador avanzado</h5>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 70px 10px 70px"></div>

            <label style="padding-top: 10px">Género</label>
            <select id="genero" class="form-control" style="width: 100%; color: black">
                <option>Todos</option>
                <?php
                $sql_genero = "SELECT DISTINCT genero.nombre_genero FROM `planta` 
                                    INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero
                                    WHERE planta.activo=1
                                    ORDER BY genero.nombre_genero ASC";
                $consulta_genero = $pdoConn->prepare($sql_genero);
                $consulta_genero->execute();

                while ($fila_genero = $consulta_genero->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <option><?php echo $fila_genero['nombre_genero']; ?></option>
                    <?php
                }
                ?>
            </select>
            <label style="padding-top: 10px">Epíteto</label>
            <select class="form-control" style="width: 100%">
                <option>Todos</option>
                <?php
                $sql_epiteto = "SELECT DISTINCT epiteto.nombre_epiteto FROM `planta` 
                                    INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                                    WHERE planta.activo=1
                                    ORDER BY epiteto.nombre_epiteto ASC";
                $consulta_epiteto = $pdoConn->prepare($sql_epiteto);
                $consulta_epiteto->execute();

                while ($fila_epiteto = $consulta_epiteto->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <option><?php echo $fila_epiteto['nombre_epiteto']; ?></option>
                    <?php
                }
                ?>
            </select>
            <label style="padding: 10px 0px 10px 0px;">Color</label>

            <div style="text-align: center; padding-bottom: 10px">
                <label class="containerCheck rojo">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-rojo"></span>
                </label>
                <label class="containerCheck naranja">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-naranja"></span>
                </label>
                <label class="containerCheck amarillo">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-amarillo"></span>
                </label>
                <label class="containerCheck verde">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-verde"></span>
                </label>
            </div>

            <div style="text-align: center; padding-bottom: 10px">
                <label class="containerCheck azul">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-azul"></span>
                </label>
                <label class="containerCheck morado">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-morado"></span>
                </label>
                <label class="containerCheck rosado">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-rosado"></span>
                </label>
                <label class="containerCheck blanco">
                    <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>">
                    <span class="checkmark checkmark-blanco"></span>
                </label>
            </div>

            <button type="button" class="btn btn-block btn-lg btn-info" style="margin-bottom: 20px">FILTRAR</button>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 70px 10px 70px"></div>

        </div>
        <div class="col-md-12 col-lg-10" id="elementos-busqueda">
            
        </div>
    </div>
</div>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#elementos-busqueda').load('tablas/elementos-busqueda.php');
    });
</script>