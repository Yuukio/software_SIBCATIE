<?php
include_once 'app/Conexion.inc.php';

$titulo = 'FLORA NATIVA';

include_once 'plantillas/documento-declaracion.inc.php';
?>
<?php
Conexion::abrir_conexion();
?>

<body id="page-top" data-spy="scroll" data-target=".navbar" data-offset="60">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg" style="background-color: black">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img  src="img/sibcatie-logo.png">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item" style="padding-right: 30px">
                        <a class="regresar-home" href="index.php">Home</a>
                    </li>
                    <li class="nav-item" style="padding-right: 30px">
                        <a class="regresar-home" href="index.php">Secciones</a>
                    </li>
                    <li class="nav-item" style="padding-right: 30px">
                        <a class="regresar-home" href="index.php">listas</a>
                    </li>
                    <li class="nav-item">
                        <a class="regresar-home" href="index.php">Perfil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="color: white; height: 160px; background-color: #1d1f21; text-align: center">
                <h1 style="padding-top: 60px; padding-bottom: 60px">Flora Nativa del Jardín Botánico del CATIE</h1>
            </div>
            <div class="col-md-2" style="background-color: #C9C9C9">
                <h5 style="text-align: center; padding: 10px; padding-top: 30px">Filtros de Búsqueda</h5>
                <hr style="background-color: #1d1f21;">
                <label style="padding-top: 10px">Reino</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Reino 1</option>
                    <option>Reino 2</option>
                    <option>Reino 3</option>
                    <option>Reino 4</option>
                </select>
                <label style="padding-top: 10px">División</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>División 1</option>
                    <option>División 2</option>
                    <option>División 3</option>
                    <option>División 4</option>
                </select>
                <label style="padding-top: 10px">Clase</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Clase 1</option>
                    <option>Clase 2</option>
                    <option>Clase 3</option>
                    <option>Clase 4</option>
                </select>
                <label style="padding-top: 10px">Orden</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Orden 1</option>
                    <option>Orden 2</option>
                    <option>Orden 3</option>
                    <option>Orden 4</option>
                </select>
                <label style="padding-top: 10px">Familia</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Familia 1</option>
                    <option>Familia 2</option>
                    <option>Familia 3</option>
                    <option>Familia 4</option>
                </select>
                <label style="padding-top: 10px">Género</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Género 1</option>
                    <option>Género 2</option>
                    <option>Género 3</option>
                    <option>Género 4</option>
                </select>
                <label style="padding-top: 10px">Epíteto</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Epíteto 1</option>
                    <option>Epíteto 2</option>
                    <option>Epíteto 3</option>
                    <option>Epíteto 4</option>
                </select>
                <label style="padding-top: 10px">Color</label>
                <select class="form-control" style="width: 100%">
                    <option>...</option>
                    <option>Color 1</option>
                    <option>Color 2</option>
                    <option>Color 3</option>
                    <option>Color 4</option>
                </select>
            </div>
            <div class="col-md-10">
                <div class="container-fluid">
                    <div class="row">



                        <?php
                        $sql_mostrar = "SELECT genero.nombre_genero, epiteto.nombre_epiteto, planta.idMascara, planta.idPlanta FROM `planta` INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto";

                        $consulta_mostra = Conexion::obtener_conexion()->query($sql_mostrar);

                        while ($fila_muestra = $consulta_mostra->fetch(PDO::FETCH_ASSOC)) {

                            $id_muestra = $fila_muestra['idPlanta'];

                            $id_muestra_nuevo = str_pad($id_muestra, 4, "0", STR_PAD_LEFT);

                            echo'

                            <div class="col-md-2 centrar" style="padding: 10px; padding-top: 20px">
                                <div style="height: 100%; width: 100%">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x100%]" style="width: 100%; display: block;" src="img/image-gallery/1.jpg" data-holder-rendered="true">
                                        <div class="card-body" style="text-align: center">

                                            <h6>' . $fila_muestra['nombre_genero'] . '</h6>
                                            <p><i>' . $fila_muestra['nombre_epiteto'] . '</i></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Guardar</button>
                                                </div>
                                                <small class="text-muted">' . 'ID - ' . $id_muestra_nuevo . '</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once './plantillas/documento-cierre.inc.php';
    ?>