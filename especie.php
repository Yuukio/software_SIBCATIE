<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/conexion2.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_planta = $_GET['id'];
} else {
    Redireccion::redirigir(RUTA_REGISTRO_ESPECIES);
}

$titulo = 'Especie';
include_once 'plantillas/head-dashboard.php';

$sql = "SELECT `idPlanta`, `idMascara`, familia.nombre_familia, genero.nombre_genero, epiteto.nombre_epiteto, `fecha_ingreso`, `fuente_informacion`, 
        `altura`, `autor`, forma.nombre_forma, color.nombre_color, tipohoja.nombre_hoja, `reproduccion`, determinadapor.nombre_determinado, `visible`, 
        `revision`, orden.nombre_orden, clase.nombre_clase, reino.nombre_reino, division.nombre_division, `url_img` 
        FROM `planta` 
        LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
        LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
        LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia
        LEFT JOIN reino ON planta.reino_idReino=reino.idReino
        LEFT JOIN clase on planta.clase_idClase=clase.idClase
        LEFT JOIN orden ON planta.orden_idOrden=orden.idOrden
        LEFT JOIN division ON planta.division_idDivision=division.idDivision
        LEFT JOIN color ON planta.Color_idColor=color.idColor
        LEFT JOIN forma ON planta.Forma_idForma=forma.idForma
        LEFT JOIN tipohoja ON planta.TipoHoja_idTipoHoja=tipohoja.idTipoHoja
        LEFT JOIN determinadapor ON planta.DeterminadaPor_idDeterminadaPor=determinadapor.idDeterminadaPor
        WHERE idPlanta=$id_planta";

$consulta = $pdoConn->query($sql);
$fila = $consulta->fetch(PDO::FETCH_ASSOC);

$idMascara = ($fila['idMascara'] == NULL) ? "" : $fila['idMascara'];
$reino = ($fila['nombre_reino'] == NULL) ? "" : $fila['nombre_reino'];
$division = $fila['nombre_division'];
$clase = $fila['nombre_clase'];
$orden = $fila['nombre_orden'];
$familia = $fila['nombre_familia'];
$genero = $fila['nombre_genero'];
$epiteto = $fila['nombre_epiteto'];
$autor = $fila['autor'];
$fuente = $fila['fuente_informacion'];
$altura = $fila['altura'];
$color = $fila['nombre_color'];
$forma = $fila['nombre_forma'];
$tipo = $fila['nombre_hoja'];
$determinado = $fila['nombre_determinado'];
$url = $fila['url_img'];
$reproduccion = $fila['reproduccion'];
$visible = $fila['visible'];
$identificado = $fila['revision'];
$nombre_cientifico = $genero . ' ' . $epiteto;

$echo = $idMascara . ' - ' . $reino . ' - ' . $division . ' - ' . $clase . ' - ' . $orden . ' - ' . $familia . ' - ' . $genero . ' - ' . $epiteto . ' - ' .
        $autor . ' - ' . $fuente . ' - ' . $tipo . ' - ' . $determinado . ' - ' . $url . ' - ' . $reproduccion . ' - ' . $visible . ' - ' . $identificado;
?>

<style>

    table{
    }

    th, td{
    }

    .col-md-4, .col-md-8, .col-md-12, .col-md-6{
        margin-bottom: 1px !important;
    }

    hr{
        height: 5px;
        margin-top: 3px !important;
        margin-bottom: 3px !important;
    }

    .img_pincipal{
        height: 330px;
        width: 440px;
        -webkit-box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
        box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);

    }

    .esquina{
        opacity: 1;
        height: 37px;
        width: 210px;
        left: 20px;
        top: -50px;
    }
    .icono{
        top: -3px !important;
    }

</style>


<body class="theme-red">

    <?php
    $registros = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <!-- Centro del Contenido-->
    <section class="content">

        <div class="container-fluid">
            <div class="card">

                <div class="header" style="padding-left: 48px; padding-right: 48px; padding-bottom: 5px; padding-top: 5px">
                    <h1><?php echo 'ID: ' . $idMascara . ' - ' . $nombre_cientifico; ?></h1>
                    <a href="<?php echo RUTA_REGISTRO_ESPECIES; ?>" class="btn bg-light-blue waves-effect close esquina" style="opacity: 1">
                        <i class="material-icons">keyboard_return</i>
                        <span class="icono" style="font-size: 16px">Regresar al registro</span>
                    </a>
                </div>

                <div class="body">
                    <div class="container-fluid">
                        <div class="row" style="margin-top: 30px">

                            <div class="col-md-4">
                                <div class="tz-gallery">
                                    <div class="thumbnail" style="margin-top: 20px; padding-bottom: 20px">
                                        <img src="<?php echo 'app/' . $url ?>" alt="Park">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3" style="padding-left: 40px; padding-right: 40px">
                                <table class="table">
                                    <h4 style="margin-bottom: 40px; text-align: center">TAXONOMÍA</h4>
                                    <tbody>
                                        <tr>
                                            <th>Reino:</th>
                                            <td><?php echo $reino; ?></td>
                                        </tr>
                                        <tr>
                                            <th>División:</th>
                                            <td><?php echo $division; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Clase:</th>
                                            <td><?php echo $orden; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Orden:</th>
                                            <td><?php echo $orden; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Familia:</th>
                                            <td><?php echo $division; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Género:</th>
                                            <td><?php echo $division; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Epíteto:</th>
                                            <td><?php echo $division; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-5" style="padding-left: 40px; padding-right: 40px">
                                <table class="table">
                                    <h4 style="margin-bottom: 40px; text-align: center">CARACTERÍSTICAS</h4>
                                    <tbody>
                                        <tr>
                                            <th>Autor:</th>
                                            <td><?php echo $autor; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Estatura:</th>
                                            <td><?php echo $altura . ' cm'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Color predominante:</th>
                                            <td><?php echo $color; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Forma de la hoja:</th>
                                            <td><?php echo $forma; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tipo de hoja:</th>
                                            <td><?php echo $tipo; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Determinada por:</th>
                                            <td><?php echo $determinado; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Fuente de información:</th>
                                            <td><?php echo $fuente; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr style="padding-bottom: 10px; padding-top: 10px">
                    </div>

                    <!-- GALERIA -->
                    <div class="container-fluid gallery-container" style="margin-top: 10px">
                        <div class="col-md-3">
                            <form action="" id="insertar-galeria" enctype="multipart/form-data">
                                <input style="display: none" type="text" value="<?php echo $id_planta ?>" name="id-planta" id="id-planta">
                                <input type="text" name="creditos" class="form-control" placeholder="Créditos">
                                <br>
                                <select class="form-control" name="id-estado" id="id-estado">
                                    <?php
                                    $sql_estado = "SELECT `idEstadoSalud`, `nombre_estado` FROM `estadosalud` WHERE 1";
                                    $consulta_estado = Conexion::obtener_conexion()->query($sql_estado);

                                    while ($fila_estado = $consulta_estado->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <option value="<?php echo $fila_estado['idEstadoSalud'] ?>"><?php echo $fila_estado['nombre_estado'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <input type="file" name="imagen" required>
                                <br>
                                <button type="submit" class="btn btn-success waves-effect" id="agregar-registro" style="width: 100%">AGREGAR NUEVA IMAGEN</button>
                            </form>
                        </div>
                        <div class="col-md-9" id="tabla-imagenes">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        /*$(document).ready(function () {
         $('#tabla-imagenes').load('tablas/tablaImagenes.php');
         });*/
    </script>

    <script type="text/javascript">
        $(document).ready(function ()
        {
            $.post("tablas/tablaImagenes.php?id=<?php echo $id_planta; ?>", function (htmlexterno) {
                $("#tabla-imagenes").html(htmlexterno);
            });
        });
    </script>

    <script>

        $(document).ready(function () {

            $("#insertar-galeria").submit(insertarImagen);

            function insertarImagen(evento) {
                evento.preventDefault();
                var datos = new FormData($("#insertar-galeria")[0]);
                //$("#respuesta").html("<img src='img/cargando8.gif' height='75'>");

                $.ajax({
                    url: 'app/insertar-galeria.php?id=<?php echo $id_planta; ?>',
                    type: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function (r) {

                        if (r == 1) {
                            $('#tabla-imagenes').load('tablas/tablaImagenes.php?id=<?php echo $id_planta; ?>');
                            alertify.success("Se agregó correctamente");
                        } else if (r == 2) {
                            alertify.error("Fallo del servidor");
                        } else if (r == 3) {
                            alertify.warning("Formato incorrecto");
                        }
                    }
                });
            }
        });

    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
</body>
