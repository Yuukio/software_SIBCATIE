<?php
include_once '../app/conexion2.php';
?>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>
</head>

<body>
    <div class="container">
        <div class=" col-md-6">

            <form action="" id="insertar-imagen" enctype="multipart/form-data">
                <br>
                <br>
                <h1 style="text-align: center">Prueba de Formulario con Imagen por Ajax</h1>
                <br>
                <br>
                <label>Nombre de Imagen</label>
                <input type="text" class="form-control" name="nombre" required>
                <br>
                <label>Selección</label>
                <select name="seleccion" id="seleccion" class="form-control">
                    <option value="">...</option>
                    <option value="1">Uno</option>
                    <option value="2">Dos</option>
                    <option value="3">Tres</option>
                </select>
                <br>
                <label>Imagen</label>
                <input type="file" class="form-control" name="imagen">
                <br>
                <input type="submit" class="form-control btn btn-success" value="Enviar Imagen">
                <br>
                <br>
            </form>

            <div id="respuesta" style="text-align: center"></div>

        </div>

        <div class="col-md-offset-1 col-md-4">
            <br>
            <br>
            <h1 style="text-align: center">Tabla de Formulario con Imagen por Ajax</h1>
            <br>
            <br>
            <div class="col-md-12" id="tabla-imagen">

            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabla-imagen').load('tablaImagen.php');
        });
    </script>

    <script>

        $(document).ready(function () {

            $("#insertar-imagen").submit(insertarImagen);

            function insertarImagen(evento) {
                evento.preventDefault();
                var datos = new FormData($("#insertar-imagen")[0]);
                $("#respuesta").html("<img src='cargando.gif' height='250'>");

                $.ajax({
                    url: 'insertar-imagen.php',
                    type: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function (datos) {
                        $('#tabla-imagen').load('tablaImagen.php');
                        $("#respuesta").html(datos);
                    }
                });
            }
        });

    </script>




</body>

