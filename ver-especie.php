<?php
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';

$titulo = 'ESPECIE';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar-buscar.inc.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_planta = $_GET['id'];
} else {
    Redireccion::redirigir(RUTA_BUSCAR_ESPECIES);
}

Conexion::abrir_conexion();

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
$nombre_cientifico = $genero . ' ' . $epiteto;
?>

<link href="css/buscar-especies.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
<link rel="stylesheet" href="css/compact-gallery.css">

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
    .icono{
        top: -3px !important;
    }

</style>


<body class="theme-red">

    <div class="col-md-12" style="color: white; background-image: url(img/nativa2.jpg); text-align: center">
        <h1 style="padding-top: 140px; padding-bottom: 60px; text-align: center"><?php echo $nombre_cientifico; ?></h1>
    </div>

    <div class="container-fluid" style="padding: 30px">
        <div class="row">

            <div class="col-lg-7 col-md-12">
                <div class="card">

                    <div class="header" style="height: 80px">
                        <div class="row">
                            <div style="width: 80%; padding-left: 15px">
                                <h1 style="margin-left: 12px">ID: 	<?php echo $idMascara; ?></h1>
                            </div>
                            <div style="width: 20%; padding-right: 20px">
                                <a href="javascript:history.go(-1);" class="btn bg-light-blue waves-effect" style="opacity: 1; float: right">
                                    <i class="material-icons">keyboard_return</i>
                                    <span class="icono" style="font-size: 16px">Regresar</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="body" style="margin-top: 22px">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-7">
                                    <img src="<?php echo 'app/' . $url ?>" style="max-width: 100%">
                                </div>

                                <div class="col-md-5" style="padding-left: 40px; padding-right: 40px">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">

                <div class="card">

                    <div class="header" style="height: 80px">
                        <a href="javascript:history.go(-1);" class="btn bg-orange waves-effect" style="opacity: 1; float: right">
                            <i class="material-icons">save</i>
                            <span class="icono" style="font-size: 16px">Agregar a favoritos</span>
                        </a>
                    </div>

                    <div class="body" style="padding-left: 30px; padding-right: 30px">

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
                                <tr>
                                    <th>Reproducción:</th>
                                    <?php
                                    if ($reproduccion == 1) {
                                        $reproduccion = 'Sexual';
                                    } elseif ($reproduccion == 2) {
                                        $reproduccion = 'Asexual';
                                    } elseif ($reproduccion == 3) {
                                        $reproduccion = 'Sexual y asexual';
                                    } else {
                                        $reproduccion = '';
                                    }
                                    ?>
                                    <td><?php echo $reproduccion; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-lg-12 col-md-12" >
                <div class="card">
                    <div class="header" style="text-align: center;">
                        <h3>Galería de imágenes</h3>
                    </div>
                    <div class="body">
                        <section class="gallery-block compact-gallery">
                            <div class="container">
                                <div class="row no-gutters">

                                    <?php
                                    $sql_img = "SELECT imagen.id, imagen.cretido, imagen.url, imagen.fecha_imagen, estadosalud.nombre_estado FROM `imagen` 
				                    LEFT JOIN estadosalud ON imagen.estado_idEstado=estadosalud.idEstadoSalud
				                    WHERE imagen.planta_idPlanta=$id_planta";

                                    $consulta_img = $pdoConn->query($sql_img);

                                    while ($fila_img = $consulta_img->fetch(PDO::FETCH_ASSOC)) {

                                        $id = $fila_img['id'];
                                        $creditos = $fila_img['cretido'];
                                        $url = $fila_img['url'];
                                        $estado = $fila_img['nombre_estado'];
                                        $fecha = $fila_img['fecha_imagen'];
                                        ?>

                                        <div class="col-md-6 col-lg-4 item zoom-on-hover">
                                            <a class="lightbox" href="app/<?php echo $url; ?>">
                                                <img class="img-fluid image" src="app/<?php echo $url; ?>">
                                                <span class="description">
                                                    <span class="description-heading">Autor: <?php echo $creditos ?></span>
                                                    <span class="description-body"><?php echo $estado ?></span>
                                                </span>
                                            </a>
                                        </div>

									    <?php
									}
									?>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.compact-gallery', {animation: 'slideIn'});
    </script>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>
