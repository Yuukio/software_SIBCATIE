<?php
include_once 'app/Conexion.inc.php';
include_once 'app/conexion2.php';

$titulo = 'FLORA NATIVA';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar-buscar.inc.php';

Conexion::abrir_conexion();
?>

<link href="css/buscar-especies.css" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="color: white; background-image: url(img/nativa2.jpg); text-align: center">
            <h1 style="padding-top: 140px; padding-bottom: 60px; text-align: center">Flora Nativa del los Jardines Botánicos del CATIE</h1>
        </div>
        <div class="col-md-12 col-lg-2" style="background-color: #e9e9e9; border-right: ridge;">

            <!--<form style="margin-top: 20px">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <input class="form-control" type="search" placeholder="Buscar...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-info" type="submit">
                            <i class="material-icons">search</i>
                        </button>
                    </div>
                </div>
            </form>-->

            <h5 style="padding: 10px; padding-top: 30px; text-align: center;">Buscador avanzado</h5>
            <div style="background-color: #00b0e4; height: 2px; margin: 0px 70px 10px 70px"></div>

            <form>
                <label style="padding-top: 10px">Familia</label>
                <select id="select-familia" class="form-control" style="width: 100%">
                    <option value="todos">Todos</option>
                    <?php
                    $sql_familia = "SELECT DISTINCT planta.Familia_idFamilia, familia.nombre_familia FROM `planta` 
                                    INNER JOIN familia ON planta.Familia_idFamilia=familia.idfamilia
                                    WHERE planta.activo=1 AND planta.visible=1 AND planta.revision=1
                                    ORDER BY familia.nombre_familia ASC";
                    $consulta_familia = $pdoConn->prepare($sql_familia);
                    $consulta_familia->execute();

                    while ($fila_familia = $consulta_familia->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo $fila_familia['Familia_idFamilia']; ?>"><?php echo $fila_familia['nombre_familia']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label style="padding-top: 10px">Género</label>

                <div id="todos-genero">
                    <select id="select-genero" class="form-control" style="width: 100%">
                        <option value="todos">Todos</option>
                        <?php
                        $sql_genero = "SELECT DISTINCT genero.nombre_genero, planta.Genero_idGenero FROM `planta` 
                                        INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero
                                        WHERE planta.activo=1 AND planta.visible=1
                                        ORDER BY genero.nombre_genero ASC";
                        $consulta_genero = $pdoConn->prepare($sql_genero);
                        $consulta_genero->execute();

                        while ($fila_genero = $consulta_genero->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option value="<?php echo $fila_genero['Genero_idGenero']; ?>"><?php echo $fila_genero['nombre_genero']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <label style="padding: 10px 0px 10px 0px;">Color</label>

                <div class="container-fluid" style="text-align: center;">
                    <div class="row">
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck rojo">
                                <input type="checkbox" name="rojo" id="rojo" />
                                <span class="checkmark checkmark-rojo"></span>
                            </label>
                        </div>
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck naranja">
                                <input type="checkbox" name="naranja" id="naranja" />
                                <span class="checkmark checkmark-naranja"></span>
                            </label>
                        </div>
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck amarillo">
                                <input type="checkbox" name="amarillo" id="amarillo" />
                                <span class="checkmark checkmark-amarillo"></span>
                            </label>
                        </div>
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck verde">
                                <input type="checkbox" name="verde" id="verde" />
                                <span class="checkmark checkmark-verde"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="container-fluid" style="text-align: center;">
                    <div class="row">
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck azul">
                                <input type="checkbox" name="azul" id="azul" />
                                <span class="checkmark checkmark-azul"></span>
                            </label>
                        </div>
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck morado">
                                <input type="checkbox" name="cafe" id="cafe" />
                                <span class="checkmark checkmark-cafe"></span>
                            </label>
                        </div>
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck rosado">
                                <input type="checkbox" name="rosado" id="rosado" />
                                <span class="checkmark checkmark-rosado"></span>
                            </label>
                        </div>
                        <div style="width: 25%; margin-bottom: 10px">
                            <label class="containerCheck blanco">
                                <input type="checkbox" name="blanco" id="blanco" />
                                <span class="checkmark checkmark-blanco"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="button" id="filtrar-elementos" class="btn btn-block btn-lg btn-info" style="margin-bottom: 20px">FILTRAR</button>
            </form>

            <div style="background-color: #00b0e4; height: 2px; margin: 0px 70px 10px 70px"></div>
            
            <input style="display: none;" id="id-lista" type='text' value=''>

        </div>
        <div class="col-md-12 col-lg-10" id="elementos-busqueda">

        </div>
    </div>
</div>

<!-- Footer -->
<footer class="container-fluid text-center" style="background-color: #C9C9C9">
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

<script>

    $('#filtrar-elementos').click(function ()
    {
        familia_id = $('#select-familia').val();
        genero_id = $('#select-genero').val();

        if ($('#rojo').is(':checked')) {
            rojo = 1;
        } else {
            rojo = 0;
        }

        if ($('#naranja').is(':checked')) {
            naranja = 2;
        } else {
            naranja = 0;
        }

        if ($('#amarillo').is(':checked')) {
            amarillo = 3;
        } else {
            amarillo = 0;
        }

        if ($('#verde').is(':checked')) {
            verde = 4;
        } else {
            verde = 0;
        }

        if ($('#azul').is(':checked')) {
            azul = 5;
        } else {
            azul = 0;
        }

        if ($('#cafe').is(':checked')) {
            cafe = 6;
        } else {
            cafe = 0;
        }

        if ($('#rosado').is(':checked')) {
            rosado = 7;
        } else {
            rosado = 0;
        }

        if ($('#blanco').is(':checked')) {
            blanco = 8;
        } else {
            blanco = 0;
        }

        //**************************************************

        $.ajax({

            type: "POST",
            url: "app/filtrarBusqueda.php",
            data: {'funcion': 'filtrar-busqueda', 'familia-id': familia_id, 'genero-id': genero_id, 'rojo': rojo, 'naranja': naranja, 'amarillo': amarillo, 'verde': verde, 'azul': azul, 'cafe': cafe, 'rosado': rosado, 'blanco': blanco},

            success: function (r) {
                var datos = $.parseJSON(r);
                $("#elementos-busqueda").html("");
                $.each(datos, function (i, item)
                {
                    $("#elementos-busqueda").append("<div class='col-xsa-5 col-sma-5 col-mda-5 col-lga-5' style='padding: 10px; padding-top: 20px'><div style='height: 100%; width: 100%'><div class='card mb-4 box-shadow'><img class='card-img-top' data-src='holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail' alt='Thumbnail [100%x100%]' style='width: 100%; display: block;' src='app/" + item.url_img + "' data-holder-rendered='true'><div class='card-body' style='text-align: center'><div style='text-align: left; margin-bottom: 5px'><h6>" + item.nombre_genero + "</h6><p style='margin-bottom: 0px;'><i>" + item.nombre_epiteto + "</i></p></div><div style='text-align: right; margin-bottom: 10px'><small class='text-muted'>ID - " + item.idMascara + "</small></div><div class='justify-content-between align-items-center'><div class='btn-group' style='text-align: center;'><button type='button' class='btn btn-sm btn-info'><a href='http://localhost/software_SIBCATIE/ver-especie.php?id=" + item.idPlanta + "' style='color: white; text-decoration: none; padding: 6px 0px 6px 0px'>Ver</a></button><form><button type='button' class='btn btn-sm btn-outline-secondary' id='guardar' onclick=\"guardarFavorito('" + item.idPlanta + "')\">Guardar</button><button type='button' class='btn btn-sm btn-outline-secondary' id='exportar' onclick=\"guardarExportar('" + item.idPlanta + "')\">Exportar</button></form></div></div></div></div></div></div>");
                });
            }
        });
    });

</script>

<script>

    $('#select-familia').change(function ()
    {
        familia_id = $('#select-familia').val();

        if (familia_id == 'todos') {
            $("#todos-genero").html("");
            $('#todos-genero').load('tablas/select-genero.php');
        } else {
            $.ajax({
                type: "POST",
                url: "app/filtrarBusqueda.php",
                data: {'funcion': 'filtrar-genero', 'familia-filtro': familia_id},
                success: function (r) {
                    var datos = $.parseJSON(r);
                    $("#select-genero").html("");
                    $("#select-genero").html("<option value='todos'>Todos</option>");
                    $.each(datos, function (i, item)
                    {
                        $("#select-genero").append("<option value='" + item.Genero_idGenero + "'>" + item.nombre_genero + "</option>");
                    });
                }
            });
        }
    });

</script>

<!-- AGREGAR A LISTAS DE USUARIOS -->
<script>
    function guardarFavorito(id) {
        $('#id-lista').val(id);

        id = $('#id-lista').val();

        $.ajax({
            type: "POST",
            url: "app/listas-usuario.php",
            data: {'funcion': 'agregar-favoritos', 'id': id},
            success: function (r) {
                if (r == 1) {
                    alertify.success("Agregado a favoritos");
                } else if (r == 2) {
                    alertify.warning("Debes estar registrado");
                } else {
                    alertify.error("Error del servidor");
                }
            }
        });
    }

    function guardarExportar(id) {
        $('#id-lista').val(id);

        id = $('#id-lista').val();

        $.ajax({
            type: "POST",
            url: "app/listas-usuario.php",
            data: {'funcion': 'agregar-exportar', 'id': id},
            success: function (r) {
                if (r == 1) {
                    alertify.success("Agregado a Exportación");
                } else if (r == 2) {
                    alertify.warning("Debes estar registrado");
                } else {
                    alertify.error("Error del servidor");
                }
            }
        });
    }

</script>





