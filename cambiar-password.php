<?php
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';
include_once 'app/Redireccion.inc.php';
$titulo = 'CONTRASEÑA';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar-perfil.inc.php';

Conexion::abrir_conexion();

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

$usuario_id = $_SESSION['idUsuario'];

if (isset($_POST['enviar'])) {
    $password = $_POST['pass-antigua'];

    $sql = "SELECT password FROM usuario WHERE idUsuario=$usuario_id";
    $consulta = $pdoConn->prepare($sql);
    $consulta->execute();

    $fila = $consulta->fetch(PDO::FETCH_ASSOC);
    $password_encriptada = $fila['password'];

    if ($_POST['pass-antigua'] != '') {//hay algo en la contrasena antigua?
        if (password_verify($password, $password_encriptada)) {//es correcta la contrasena?
            if ($_POST['pass1'] != '' && $_POST['pass2'] != '') {//estan las dos pass llenas?
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];

                if ($pass1 == $pass2) {//coinciden las dos contrasenas?
                    try {
                        $pass_nueva = password_hash($pass1, PASSWORD_DEFAULT);
                        $sql_insertar = "UPDATE usuario SET `password`='$pass_nueva' WHERE idUsuario=$usuario_id";
                        $insertar = $pdoConn->prepare($sql_insertar);
                        $insertar->execute();
                        echo '<script language="javascript">alertify.success("Contraseña actualizada.");;</script>';
                    } catch (Exception $exc) {
                        $validacion = 1; //error del servidor
                        echo '<script language="javascript">alertify.error("Error del servidor");;</script>';
                    }
                } else {
                    $validacion = 2; //contrasenas no coinciden
                    echo '<script language="javascript">alertify.warning("Las contraseña no coincide.");;</script>';
                }
            } else {
                echo '<script language="javascript">alertify.warning("Debe llenar todos los campos.");;</script>';
            }
        } else {
            echo '<script language="javascript">alertify.error("Contraseña actual incorrecta.");;</script>';
        }
    } else {
        echo '<script language="javascript">alertify.warning("Debe llenar los campos.");;</script>';
    }
}
?>

<div class="container-fluid" style="margin-top: 40px; margin-bottom: 100px">
    <div class="row">
        <div class="col-md-2 col-md-offset-2"></div>
        <div class="col-md-2" style="margin-bottom: 40px">

            <h4 style="text-align: center;">Listas de Usuarios</h4>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 15px 10px 15px"></div>
            <input type="button" class="btn btn-info btn-block" onclick = "location = 'lista-favoritos.php'" value="Favoritos" /> 
            <input type="button" class="btn btn-info btn-block" onclick = "location = 'lista-exportar.php'" value="Exportar" /> 

            <h4 style="text-align: center; margin-top: 20px">Configuración</h4>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 15px 10px 15px"></div>
            <input type="button" class="btn btn-info btn-block" value="Cambiar contraseña" disabled />
            
        </div>
        <div class="col-md-6" style="padding-left: 30px; margin-bottom: 74px">
            <div class="card" style="padding: 20px">
                <div class="header" style="margin-bottom: 30px">
                    <h2>
                        Cambiar contraseña de usuario
                    </h2>
                </div>

                <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="body" id="tabla-registro">
                        <div class="col-md-12" style="padding: 0px">
                            <label>Contraseña actual</label>
                            <input type="password" class="form-control" name="pass-antigua">
                            <div id="incorrecta"></div>
                            <br>
                        </div>
                        <div style="background-color: #00b0e4; height: 2px; margin: 20px 70px 20px 70px"></div>
                        <div class="row">
                            <div class="col-md-6" style="padding: 15px">
                                <label>Nueva contraseña</label>
                                <input type="password" class="form-control" name="pass1">
                                <br>
                            </div>
                            <div class="col-md-6" style="padding: 15px">
                                <label>Repetir contraseña</label>
                                <input type="password" class="form-control" name="pass2">
                                <br>
                            </div>
                        </div>
                        <button class="btn btn-info" type="submit" name="enviar" id="enviar">Actualizar</button>
                    </div>
                </form>

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
        $('#elementos-busqueda').load('tablas/elementos-busqueda.php');
    });
</script>