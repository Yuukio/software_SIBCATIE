<?php
date_default_timezone_set('America/Costa_Rica');
include ('app/conexion2.php');

/* $id = 3;
  $fecha_registro = '2018-07-15';
  $fecha = date("Y-m-d");

  if ($fecha_registro == $fecha) {
  $id = $id + 1;
  } else {
  $id = 1;
  }

  $id = str_pad($id, 3, "0", STR_PAD_LEFT);

  $date = explode('-', $fecha);
  $anno = $date[0];
  $mes = $date[1];
  $dia = $date[2];

  $idMascara = $anno . $mes . $dia . $id;

  echo $fecha;
  echo "<br>";
  echo $anno . $mes . $dia;
  echo "<br>";
  echo $fecha_registro;
  echo "<br>";
  echo $id;
  echo "<br>";
  echo $idMascara; */


//**********CREAR EL ID MASCARA
$sql_id = "SELECT idPlanta, fecha_ingreso FROM planta ORDER BY idPlanta DESC LIMIT 1";
$consulta = $pdoConn->query($sql_id);
$fila = $consulta->fetch(PDO::FETCH_ASSOC);

$id = $fila['idPlanta'];
$fecha_registro = $fila['fecha_ingreso'];
$fecha = date("Y-m-d");
$fecha_actual = date("Y-m-d");

if ($fecha == $fecha_registro) {
    $id = $id + 1;
} elseif ($fecha > $fecha_registro) {
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

echo $fecha;
echo '<br>';
echo $fecha_registro;
echo '<br>';
echo $idMascara;
echo '<br>';
echo $fecha_actual;
echo '<br>';

$hoy = getdate();
print_r($hoy);
?>