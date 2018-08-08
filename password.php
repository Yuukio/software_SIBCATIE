<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/conexion2.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';

$titulo = 'CONTRASEÑA';

Conexion::abrir_conexion();

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$usuario_id = $_SESSION['idUsuario'];

include_once 'plantillas/head-dashboard.php';
?>

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

                    <input type="button" class="btn btn-info btn-block" onclick = "location = 'perfil.php'" value="Perfil de usuario" /> 
                    <input type="button" class="btn btn-info btn-block" value="Cambiar contraseña" disabled /> 

                </div>
                <div class="col-md-12">
                    <div class="card" style="padding: 20px">
                        <div class="header" style="margin-bottom: 30px">
                            <h2>
                                Cambiar contraseña de usuario
                            </h2>
                        </div>

                        <form action="" id="form" >
                            <div class="body" id="tabla-registro">
                                <div class="col-md-12" style="padding: 0px">
                                    <label>Contraseña actual</label>
                                    <input type="password" class="form-control" id="pass-antigua" required>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="padding: 15px">
                                        <label>Nueva contraseña</label>
                                        <input type="password" class="form-control" id="pass1" required>
                                        <br>
                                    </div>
                                    <div class="col-md-6" style="padding: 15px">
                                        <label>Repetir contraseña</label>
                                        <input type="password" class="form-control" id="pass2" required>
                                        <br>
                                    </div>
                                </div>
                                <button id="actualizar" class="btn btn-info" type="button">Actualizar</button>
                                <input style="display: none" id="id" type="text" value="<?php echo $usuario_id; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>

        //AGREGAR NOMBRE COMUN
        $('#actualizar').click(function ()
        {
            antigua = $('#pass-antigua').val();
            pass1 = $('#pass1').val();
            pass2 = $('#pass2').val();
            id = $('#id').val();

            console.log(antigua);
            console.log(pass1);
            console.log(pass2);
            console.log(id);

            $.ajax({
                type: "POST",
                url: "app/actualizarPassword.php",
                data: {'pass-antigua': antigua, 'pass1': pass1, 'pass2': pass2, 'id': id},
                success: function (r) {

                    if (r == '1') {
                        alertify.success("Contraseña actualizada.");
                        $('#form')[0].reset();
                    } else if (r == '2') {
                        alertify.error("Error del servidor");
                        $('#form')[0].reset();
                    } else if (r == '3') {
                        alertify.warning("Las contraseña no coincide.");
                        $('#form')[0].reset();
                    } else if (r == '4') {
                        alertify.error("Contraseña actual incorrecta.");
                        $('#form')[0].reset();
                    }
                }
            });
        });

    </script>

</body>

