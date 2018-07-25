<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$titulo = 'Home';
include_once 'plantillas/head-dashboard.php';
?>

<link rel="stylesheet" href="css/tableexport.min.css">

<body class="theme-red">

    <?php
    $listas = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <section class="content" style="padding-left: 20px; padding-right: 20px">

        <ul class="nav nav-tabs" style="text-align: center; font-size: 20px; margin-left: 20px; margin-right: 20px">
            <li class="active" style="float: none; display: inline-block; zoom: 1"><a data-toggle="tab" href="#favoritos">Lista de Favoritos</a></li>
            <li style="float: none; display: inline-block; zoom: 1"><a data-toggle="tab" href="#exportacion">Lista de Exportación</a></li>
        </ul>

        <div class="tab-content" id="tabla-listas">


        </div>

    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabla-listas').load('tablas/tablasListas.php');
        });
    </script>

    <script type="text/javascript" src="js/export/tableexport.min.js"></script>

    <script>
        $('table').tableExport();
    </script>
</body>


