<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$titulo = 'Registros';
include_once 'plantillas/head-dashboard.php';
?>

<body class="theme-red">

    <?php
    $registros = "active";
    
    include_once 'plantillas/cargar-pantalla.php';
    include_once 'plantillas/barra-superior.php';
    include_once 'plantillas/menu-lateral.php';
    ?>

    <!-- Centro del Contenido-->
    <section class="content">
        <div class="container-fluid">

            <!--**********REGISTRO DE ESPECIES****************************-->
            <div class="card">
                <div class="header">
                    <h2>
                        REGISTRO DE ESPECIES
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown" style="vertical-align: top; margin-right: 10px; top: -5px">
                            <div class="btn-group" role="group">
                                <button type="submit" name="favoritos" id="favoritos" class="btn btn-info waves-effect">Favorito</button>
                                <button type="button" name="exportar" id="exportar" class="btn btn-info waves-effect">Exportar</button>
                                <button type="submit" name="ocultar" id="ocultar" class="btn btn-info waves-effect">Ocultar</button>                                    
                                <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#modalRegistroPlanta">Agregar</button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-info waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Listas
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal" data-target="#modalFavoritos">Lista de Favoritos</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal" data-target="#modalExcel">Lista de Excel</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block" data-toggle="modal" data-target="#modalOcultos">Lista de Ocultos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Familia</th>
                                    <th>Género</th>
                                    <th>Epíteto</th>
                                    <th>Ingreso</th>
                                    <th>Visible</th>
                                    <th>Opciones</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Familia</th>
                                    <th>Género</th>
                                    <th>Epíteto</th>
                                    <th>Ingreso</th>
                                    <th>Visible</th>
                                    <th>Opciones</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $sql = "SELECT P.idPlanta, P.autor, P.fecha_ingreso, P.fuente_informacion, P.altura, P.reproduccion, P.visible, P.revision, Fa.nombre_familia, 
                                            Ge.nombre_genero, Ep.nombre_epiteto, Fo.nombre_forma, Co.nombre_color, De.nombre_determinado, Ti.nombre_hoja 
                                            FROM planta P 
                                            INNER JOIN familia Fa ON P.Familia_idFamilia = Fa.idFamilia
                                            INNER JOIN genero Ge ON P.Genero_idGenero = Ge.idGenero
                                            INNER JOIN epiteto Ep ON P.Epiteto_idEpiteto = Ep.idEpiteto
                                            INNER JOIN forma Fo ON P.Forma_idForma = Fo.idForma
                                            INNER JOIN color Co ON P.Color_idColor = Co.idColor
                                            INNER JOIN tipohoja Ti ON P.TipoHoja_idTipoHoja = Ti.idTipoHoja
                                            INNER JOIN determinadapor De ON P.DeterminadaPor_idDeterminadaPor = De.idDeterminadaPor
                                            WHERE p.revision=1";

                                $consulta = Conexion::obtener_conexion()->query($sql);

                                while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {

                                    $nombre_cientifico = $fila['nombre_genero'] . ' ' . $fila['nombre_epiteto'];
                                    $revision = $fila['revision'];
                                    $visible = $fila['visible'];

                                    /* ingreso de id mascara */
                                    $id = $fila['idPlanta'];

                                    $fecha = $fila['fecha_ingreso'];
                                    $fecha = explode('-', $fecha);
                                    $anno = $fecha[0];
                                    $mes = $fecha[1];
                                    $dia = $fecha[2];

                                    $id_nuevo = str_pad($id, 4, "0", STR_PAD_LEFT);

                                    $idMasc = $anno . $mes . $dia . $id_nuevo;

                                    /* ingreso de iconos de revision */
                                    if ($revision == 0) {

                                        $revision = '<a style="color: #E74C3C">
                                                            <i class="material-icons">close</i>
                                                        </a>
                                                        ';
                                    } else {
                                        $revision = '<a style="color: #27AE60">
                                                            <i class="material-icons">check</i>
                                                        </a>
                                                        ';
                                    }

                                    /* ingreso de iconos de visible */
                                    if ($visible == 0) {

                                        $visible = '<a style="color: #E74C3C">
                                                            <i class="material-icons">visibility_off</i>
                                                        </a>
                                                        ';
                                    } else {
                                        $visible = '<a style="color: #27AE60">
                                                            <i class="material-icons">visibility</i>
                                                        </a>
                                                        ';
                                    }

                                    /* asignando en tabla */
                                    ?>
                                    <tr valign="top">
                                        <td><?php echo $idMasc ?></td> 
                                        <td><?php echo $fila['nombre_familia'] ?></td>
                                        <td><?php echo $fila['nombre_genero'] ?></td>
                                        <td><?php echo $fila['nombre_epiteto'] ?></td>
                                        <td><?php echo $fila['fecha_ingreso'] ?></td>
                                        <td style="text-align:center; width: 5px;"><?php echo $visible ?></td>
                                        <td style="text-align:center;">
                                            <a href="#" style="color: #17c4cb">
                                                <i class="material-icons" data-toggle="modal" data-target="#modalVer">search</i>
                                            </a>
                                            <i>&nbsp;</i>
                                            <a href="#" style="color: #ffc122">
                                                <i class="material-icons" data-toggle="modal" data-target="#modalActualizar">edit</i>
                                            </a>
                                            <i>&nbsp;</i>
                                            <a href="#" style="color: #2a445f">
                                                <i class="material-icons" data-toggle="modal" data-target="#modalFotos">playlist_add</i>
                                            </a>
                                            <i>&nbsp;</i>
                                            <a href="#" style="color: #ff6d3a">
                                                <i class="material-icons" data-toggle="modal" data-target="#modalComun">add_a_photo</i>
                                            </a>
                                        </td>
                                        <td style="text-align:center;">
                                            <input type="checkbox" name="seleccion[]" value="<?php echo $id ?>"/>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ******************************* REGISTROR DE PLANTA ************************************************** -->

            <!-- Modal REGISTRAR NUEVA PLANTA -->
            <div class="modal fade" id="modalRegistroPlanta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="defaultModalLabel">Agregar un nuevo Registro</h4>
                        </div>

                        <form id="fmr-estadosalud">
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <h4 style="text-align: center">TAXONOMÍA</h4>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="pl-reino">Reino</label>
                                        <select id="id-reino" name="id-reino" class="form-control">
                                            <?php
                                            $sql = "SELECT nombre_reino, idReino FROM reino ORDER BY nombre_reino";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idReino'] ?>"><?php echo $fila['nombre_reino'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pl-division">División</label>
                                        <select class="form-control" name="id-division" id="id-division">
                                            <?php
                                            $sql = "SELECT nombre_division, idDivision FROM division ORDER BY nombre_division";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option value="<?php echo $fila['idDivision'] ?>">Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idDivision'] ?>"><?php echo $fila['nombre_division'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pl-clase">Clase</label>
                                        <select class="form-control" name="id-clase" id="id-clase">
                                            <?php
                                            $sql = "SELECT nombre_clase, idClase FROM clase ORDER BY nombre_clase";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idClase'] ?>"><?php echo $fila['nombre_clase'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Orden</label>
                                        <select class="form-control" name="id-orden" id="id-orden">
                                            <?php
                                            $sql = "SELECT nombre_orden, idOrden FROM orden ORDER BY nombre_orden";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idOrden'] ?>"><?php echo $fila['nombre_orden'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-3">
                                        <label>Familia</label>
                                        <select class="form-control" name="id-familia" id="id-familia">
                                            <?php
                                            $sql = "SELECT nombre_familia, idFamilia FROM familia ORDER BY nombre_familia";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idFamilia'] ?>"><?php echo $fila['nombre_familia'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Género</label>
                                        <select class="form-control" name="id-genero" id="id-genero">
                                            <?php
                                            $sql = "SELECT nombre_genero, idGenero FROM genero ORDER BY nombre_genero";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idGenero'] ?>"><?php echo $fila['nombre_genero'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Epíteto</label>
                                        <select class="form-control" name="id-epiteto" id="id-epiteto">
                                            <?php
                                            $sql = "SELECT nombre_epiteto, idEpiteto FROM epiteto ORDER BY nombre_epiteto";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idEpiteto'] ?>"><?php echo $fila['nombre_epiteto'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Autor</label>
                                        <input type="text" class="form-control" id="autor" name="autor">
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding-top: 20px">
                                    <h4 style="text-align: center">CARACTERÍSTICAS</h4>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Fuente de información</label>
                                        <input type="text" class="form-control" id="fuente" name="fuente">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estatura</label>
                                        <input type="text" class="form-control" id="altura" name="altura">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Color</label>
                                        <select class="form-control" name="id-color" id="id-color">
                                            <?php
                                            $sql = "SELECT nombre_color, idColor FROM color ORDER BY nombre_color";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idColor'] ?>"><?php echo $fila['nombre_color'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-4">
                                        <label>Forma de la Hoja</label>
                                        <select class="form-control" name="id-forma" id="id-forma">
                                            <?php
                                            $sql = "SELECT nombre_forma, idForma FROM forma";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idForma'] ?>"><?php echo $fila['nombre_forma'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tipo de Hoja</label>
                                        <select class="form-control" name="id-tipo" id="id-tipo">
                                            <?php
                                            $sql = "SELECT nombre_hoja, idTipoHoja FROM tipohoja";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idTipoHoja'] ?>"><?php echo $fila['nombre_hoja'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Determinación</label>
                                        <select class="form-control" name="id-determinado" id="id-determinado">
                                            <?php
                                            $sql = "SELECT nombre_determinado, idDeterminadaPor FROM determinadapor";

                                            $consulta = Conexion::obtener_conexion()->query($sql);
                                            ?>
                                            <option>Indefinido</option>
                                            <?php
                                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $fila['idDeterminadaPor'] ?>"><?php echo $fila['nombre_determinado'] ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <hr style=" margin-bottom: 10px !important; margin-top: 25px !important">

                                <div class="row" style="padding-top: 15px">
                                    <div class="col-md-6">
                                        <label>Nombre común</label>
                                        <div class="row">
                                            <div class="col-md-10 col-xs-10">
                                                <input type="text" class="form-control" id="comun" name="comun">
                                            </div>
                                            <div class="col-md-2 col-xs-2" style="margin-left: -20px">
                                                <button type="submit" name="agregar-comun" id="agregar-comun" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <label>Reproducción</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>Sexual</label>
                                            <label class="switch"><input type="checkbox" id="a-reproduccion" name="a-reproduccion"><span class="slider round"></span></label>
                                            <label>Asexual</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <label>Identificado</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>No</label>
                                            <label class="switch"><input type="checkbox" id="revision" name="revision"><span class="slider round"></span></label>
                                            <label>Sí</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <label>Visible</label>
                                        <div class="row centrar" style="text-align: center; padding-top: 8px">
                                            <label>No</label>
                                            <label class="switch"><input type="checkbox" id="visible" name="visible"><span class="slider round"></span></label>
                                            <label>Sí</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-link waves-effect" style="margin-right: 100px">BORRAR</button>
                                <button type="button" class="btn btn-link waves-effect" id="agregar-registro">AGREGAR</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" aria-label="Close">CERRAR</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        //CREAR NUEVO REGISTRO
        $('#agregar-registro').click(function ()
        {
            id_reino = $('#id-reino').val();
            id_division = $('#id-division').val();
            id_clase = $('#id-clase').val();
            id_orden = $('#id-orden').val();
            id_familia = $('#id-familia').val();
            id_genero = $('#id-genero').val();
            id_epiteto = $('#id-epiteto').val();
            id_determinado = $('#id-determinado').val();
            id_color = $('#id-color').val();
            id_forma = $('#id-forma').val();
            id_tipo = $('#id-tipo').val();
            autor = $('#autor').val();
            fuente = $('#fuente').val();
            altura = $('#altura').val();
            revision = $('#revision').val();
            visible = $('#visible').val();

            if (id_familia == "Indefinido")
            {
                alertify.warning('Debe seleccionar al menos el campo Familia');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarRegistro', 'reino': id_reino, 'division': id_division, 'clase': id_clase, 'orden': id_orden, 'familia': id_familia,
                        'genero': id_genero, 'epiteto': id_epiteto, 'determinado': id_determinado, 'color': id_color, 'forma': id_forma, 'tipo': id_tipo, 'autor': autor,
                        'fuente': fuente, 'altura': altura, 'revision': revision, 'visible': visible},
                    success: function (r) {

                        if (r == 1) {
                            //console.log(r);
                            //alert("Agregado con éxito");
                            alertify.success("Registro agregado");

                        } else {
                            //console.log(r);
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

        //AGREGAR NOMBRE COMUN
        $('#agregar-comun').click(function ()
        {
            nombre_comun = $('#comun').val();
            if (!nombre_comun)
            {
                alertify.warning('Debe agregar un nombre común');
            } else
            {

                $.ajax({
                    type: "POST",
                    url: "app/insertarDatos.php",
                    data: {'funcion': 'insertarNombreComun', 'n_comun': nombre_comun},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Agregado con éxito");

                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });
    </script>

    <script>

        //***** OCULTAR PLANTA
        /*$('#ocultar').click(function ()
         {
         id_seleccion = $('#seleccion').val();
         if (!id_seleccion)
         {
         alert('No se selecciono ningun campo');
         } else
         {
         $.ajax({
         type: "POST",
         url: "app/ocultarDatos.php",
         data: {'funcion': 'ocultarRegistro', 'id_planta': id_seleccion},
         success: function (r) {
         
         if (r == 1) {
         alert("Enviados correctamente");
         } else {
         alert("Error del servidor");
         }
         }
         });
         }
         });*/

    </script>


    <!--AGREGAR NOMBRE COMUN-->
    <script>

        $('#ocultar').click(function ()
        {
            var checked = [];
            $("input[name='seleccion[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });

            if (checked.length == 0)
            {
                alertify.warning('No ha seleccionado ninguna casilla');
            } else
            {
                $.ajax({
                    type: "POST",
                    url: "app/actualizarDatos.php",
                    data: {'funcion': 'ponerOcultos', 'oculto': checked},
                    success: function (r) {

                        if (r == 1) {
                            alertify.success("Ocultos correctamente");
                        } else {
                            alertify.error("Error del servidor");
                        }
                    }
                });
            }
        });

    </script>

    <?php
    //include_once './plantillas/modal.inc.php';
    ?>
    <!-- #FINAL# Centro del Contenido-->

    <?php
    Conexion::cerrar_conexion();
    ?>

</body>
</html>