<?php
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';

$titulo = 'PERFIL';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar-perfil.inc.php';
?>
<?php
Conexion::abrir_conexion();
?>

<div class="container" style="margin-top: 60px; margin-bottom: 100px">
    <div class="row">
        <div class="col-md-4" style="margin-bottom: 30px">

            <input type="button" class="btn btn-info btn-block" value="Perfil de usuario" disabled /> 
            <input type="button" class="btn btn-info btn-block" onclick = "location='cambiar-password.php'" value="Cambiar contraseña" /> 
            
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

<!-- Footer -->
<footer class="text-center" style="background-color: #C9C9C9; display: block; height: auto">
    <!--<a class="nav-link js-scroll-trigger" href="#page-top" style="font-size: 50px;">^</a>-->
    <p>Copyright &copy; 2018 - SIBCATIE creado por <a href="https://www.catie.ac.cr/">www.catie.ac.cr</a></p>
</footer>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>