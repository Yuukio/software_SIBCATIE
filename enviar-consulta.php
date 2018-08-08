<?php
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';

$titulo = 'LISTAS';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar-perfil.inc.php';
include_once 'app/Redireccion.inc.php';

if (!ControlSesion::sesionIniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

Conexion::abrir_conexion();
?>

<div class="container" style="margin-top: 50px; margin-bottom: 100px">

    <div class="row">

        <div class="col-md-12" style="text-align: center; margin-bottom: 30px">
            <h1>Realizar consulta</h1>
            <p>Realiza una consulta a los expertos botánicos enviando una fotografía tomada en el campus del CATIE Costa Rica que sea desconocida para tí y no la encuentras en SIBCATIE.</p>
        </div>

        <div class="col-md-12" style="padding: 0px 130px 0px 130px; margin-bottom: 30px">
            <div style="background-color: #00b0e4; height: 2px"></div>
        </div>


        <div class="col-md-12">

            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 15px">
                                <label>Nombre</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-md-6" style="margin-top: 15px">
                                <label>Fotografía</label>
                                <br>
                                <input type="file">
                            </div>

                            <div class="col-md-12">
                            	<br>
                                <label>Consulta</label>
                                <textarea class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-12">
                            	<br>
                            	<button class="btn btn-info btn-lg btn-block">ENVIAR CONSULTA</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

<!-- Footer -->
<footer class="text-center" style="background-color: #C9C9C9; display: block; height: auto">
    <!--<a class="nav-link js-scroll-trigger" href="#page-top" style="font-size: 50px;">^</a>-->
    <p>Copyright &copy; 2018 - SIBCATIE creado por <a href="https://www.catie.ac.cr/">www.catie.ac.cr</a></p>
</footer>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>