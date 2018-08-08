<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/conexion2.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$usuario = $_SESSION['idUsuario'];

$sql = "SELECT nombre, apellido, telefono FROM usuario WHERE idUsuario=$usuario";
$consulta = $pdoConn->prepare($sql);
$consulta->execute();
$fila = $consulta->fetch(PDO::FETCH_ASSOC);

$nombre = $fila['nombre'];
$apellido = $fila['apellido'];
$telefono = $fila['telefono'];

$titulo = 'Home';
include_once 'plantillas/head-dashboard.php';
?>

<link rel="stylesheet" href="css/tableexport.min.css">

<body class="theme-red">

    <?php
    $perfil = "active";

    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <section class="content">

        <div class="container" style="padding: 30px">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 30px">

                    <input type="button" class="btn btn-info btn-block" value="Perfil de usuario" disabled /> 
                    <input type="button" class="btn btn-info btn-block" onclick = "location = 'password.php'" value="Cambiar contraseña" /> 

                </div>
                <div class="col-md-12">
                    <div class="card" style="padding: 20px">
                        <div class="header">
                            <h2>
                                Editar perfil de usuario
                            </h2>
                        </div>
                        <div class="body" id="tabla-registro">
                            <div class="col-md-12" style="padding: 0px">
                                <label>Nombre</label>
                                <input type="text" class="form-control" placeholder="<?php 
                                    if($nombre == ''){
                                        echo 'Aun no ha ingresado un nombre';
                                    }else{
                                        echo $nombre;
                                    }
                                 ?>" disabled>
                                <br>
                            </div>
                            <div class="col-md-12" style="padding: 0px">
                                <label>Apellido</label>
                                <input type="text" class="form-control" placeholder="<?php 
                                    if($apellido == ''){
                                        echo 'Aun no ha ingresado un apellido';
                                    }else{
                                        echo $apellido;
                                    }
                                ?>" disabled>
                                <br>
                            </div>
                            <div class="col-md-12" style="padding: 0px">
                                <label>Teléfono</label>
                                <input id="telefono" type="tel" class="form-control" placeholder="<?php 
                                    if($telefono == ''){
                                        echo 'Aun no ha ingresado un número telefónico';
                                    }else{
                                        echo $telefono;
                                    }
                                ?>">
                                <br>
                            </div>
                            <button type="button" id="actualizar" class="btn btn-info">Actualizar</button>
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

    <script>
        $('#actualizar').click(function ()
        {
            telefono = $('#telefono').val();

            $.ajax({
                type: "POST",
                url: "app/actualizarDatos.php",
                data: {'funcion': 'actualizarTelefono', 'telefono': telefono},
                success: function (r) {

                    if (r == 1) {
                        alertify.success("Actualizado con éxito");
                    } else {
                        alertify.error("Error del servidor");
                    }
                }
            });
            //}
        });
    </script>


</body>