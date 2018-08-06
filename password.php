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

        <div class="container-fluid" style="margin-top: 60px; margin-bottom: 100px">
            <div class="row">
                <div class="col-md-4" style="margin-bottom: 30px">

                    <input type="button" class="btn btn-info btn-block" onclick = "location = 'perfil.php'" value="Perfil de usuario" /> 
                    <input type="button" class="btn btn-info btn-block" value="Cambiar contraseña" disabled /> 

                </div>
                <div class="col-md-8">
                    <div class="card" style="padding: 20px">
                        <div class="header">
                            <h2>
                                Editar perfil de usuario
                            </h2>
                        </div>
                        <div class="body" id="tabla-registro">
                            <div class="col-md-12" style="padding: 0px">
                                <label>Nombre</label>
                                <input type="text" class="form-control">
                                <br>
                            </div>
                            <div class="col-md-12" style="padding: 0px">
                                <label>Apellido</label>
                                <input type="text" class="form-control">
                                <br>
                            </div>
                            <div class="col-md-12" style="padding: 0px">
                                <label>Teléfono</label>
                                <input type="tel" class="form-control">
                                <br>
                            </div>
                            <button class="btn btn-info">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabla-listas').load('tablas/tablasListas.php');
        });
    </script>


</body>