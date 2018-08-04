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

<div class="container-fluid" style="margin-top: 40px; margin-bottom: 100px">

    <div class="row">

        <div class="col-md-2 col-md-offset-2"></div>
        <div class="col-md-2" style="margin-bottom: 40px">

            <h4 style="text-align: center;">Listas de Usuarios</h4>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 15px 10px 15px"></div>
            <input type="button" class="btn btn-info btn-block" onclick = "location = 'lista-favoritos.php'" value="Favoritos" /> 
            <input type="button" class="btn btn-info btn-block" value="Exportar" disabled /> 

            <h4 style="text-align: center; margin-top: 20px">Configuración</h4>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 15px 10px 15px"></div>
            <input type="button" class="btn btn-info btn-block" onclick = "location = 'cambiar-password.php'" value="Cambiar contraseña"/>
            <div style="background-color: #00b0e4; height: 2px; margin: 30px 70px 30px 70px"></div>

            <h1 style="text-align: center;">Exportar</h1><br>

            <div style="text-align: center; padding-right: 50px; padding-left: 50px">
                <button class="btn btn-danger btn-sm btn-block">
                    Eliminar de la lista
                </button>
                <button class="btn btn-info btn-sm btn-block">
                    Exportar a Excel
                </button>
            </div>

        </div>
        <div class="col-md-6">
            <div class="body" id="tabla-registro">

            </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla-registro').load('tablas/tablaExportar-usuario.php');
    });
</script>