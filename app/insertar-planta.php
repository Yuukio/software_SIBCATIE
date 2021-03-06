<?php

date_default_timezone_set('America/Costa_Rica');
include_once '../app/conexion2.php';
include_once 'ControlSesion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$id_usuario = $_SESSION['idUsuario'];

//$reino = $_POST["id-reino"];
$reino = $_POST["id-reino"];
$division = $_POST["id-division"];
$clase = $_POST["id-clase"];
$orden = $_POST["id-orden"];
$familia = $_POST["id-familia"];
$genero = $_POST["id-genero"];
$epiteto = $_POST["id-epiteto"];
$determinado = $_POST["id-determinado"];
$color = $_POST["id-color"];
$forma = $_POST["id-forma"];
$tipo = $_POST["id-tipo"];
$autor = $_POST["autor"];
$fuente = $_POST["fuente"];
$altura = $_POST["altura"];

if ($altura <= 0) {
    $altura = 0;
}

//****** REPRODUCCION ********
if (isset($_POST["sexual"])) {
    $sexual = 1;
} else {
    $sexual = 0;
}

if (isset($_POST["asexual"])) {
    $asexual = 1;
} else {
    $asexual = 0;
}

$reproduccion = 0;

if ($sexual == 0 && $asexual == 0) {
    $reproduccion = 0;
} elseif ($sexual == 1 && $asexual == 0) {
    $reproduccion = 1;
} elseif ($sexual == 0 && $asexual == 1) {
    $reproduccion = 2;
} elseif ($sexual == 1 && $asexual == 1) {
    $reproduccion = 3;
}

//****** REVISION Y VISIBLE ********
if (isset($_POST["revision"])) {
    $revision = 1;
} else {
    $revision = 0;
}

if (isset($_POST["visible"])) {
    $visible = 1;
} else {
    $visible = 0;
}

//****** ID MASCARA ********
$sql_id = "SELECT idMascara, fecha_ingreso FROM planta ORDER BY idPlanta DESC LIMIT 1";
$consulta = $pdoConn->query($sql_id);
$fila = $consulta->fetch(PDO::FETCH_ASSOC);

$id = $fila['idMascara'];
$id = substr($id, -3);

$fecha_registro = $fila['fecha_ingreso'];
$fecha = date("Y-m-d");

if ($fecha == $fecha_registro) {
    $id = $id + 1;
} elseif ($fecha > $fecha_registro || $id == 0 || $id == NULL) {
    $id = 1;
}

$date = explode('-', $fecha);
$anno = $date[0];
$mes = $date[1];
$dia = $date[2];

$id = str_pad($id, 3, "0", STR_PAD_LEFT);
$mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
$dia = str_pad($dia, 2, "0", STR_PAD_LEFT);

$idMascara = $anno . $mes . $dia . $id;

//****** INSERTANDO ********
$imagen = $_FILES["imagen"];
$temporal = $_FILES["imagen"]["tmp_name"];

$ruta = "fotos/" . $idMascara . '-' . $imagen["name"];

$sql = "INSERT INTO planta (idMascara, reino_idReino, division_idDivision, clase_idClase, orden_idOrden, Familia_idFamilia, Genero_idGenero,
        Epiteto_idEpiteto, autor, fuente_informacion, altura, Color_idColor, Forma_idForma, TipoHoja_idTipoHoja, DeterminadaPor_idDeterminadaPor,
        url_img, reproduccion, revision, visible, fecha_ingreso)
        VALUES ($idMascara, $reino, $division, $clase, $orden, $familia, $genero, $epiteto, '$autor', '$fuente', $altura, $color, $forma,
        $tipo, $determinado, '$ruta', $reproduccion, $revision, $visible, NOW())";

$stmt = $pdoConn->prepare($sql);
$stmt->execute();

$directorio = 'fotos/';

if ($imagen["type"] == "image/jpg" || $imagen["type"] == "image/jpeg" || $imagen["type"] == "image/png") {

    if (!file_exists($directorio)) {
        mkdir("fotos/", 0777);
    }

    $insertado = move_uploaded_file($imagen["tmp_name"], $ruta);

    if ($insertado) {
        //carga correcta
        $sql_planta = "SELECT `idMascara` FROM planta ORDER BY `idPlanta` DESC LIMIT 1";

        $consulta_planta = $pdoConn->prepare($sql_planta);
        $consulta_planta->execute();

        $fila_planta = $consulta_planta->fetch(PDO::FETCH_ASSOC);

        $id_planta = $fila_planta['idMascara'];

        $registro = 'Planta. ' . $id_planta;

        $sql_historial = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt_historial = $pdoConn->prepare($sql_historial);
        $stmt_historial->execute();

        echo '1';
    } else {
        //falló el servidor
        echo '2';
    }
} else {
    //formato incorrecto
    echo '3';
}
?>