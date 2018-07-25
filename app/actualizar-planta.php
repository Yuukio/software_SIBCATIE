<?php

date_default_timezone_set('America/Costa_Rica');
include_once '../app/conexion2.php';

//$reino = $_POST["id-reino"];
$reino = ($_POST["id-reino-a"] == "Indefinido") ? 0 : $_POST['id-reino-a'];
$division = ($_POST["id-division-a"] == "Indefinido") ? 0 : $_POST["id-division-a"];
$clase = ($_POST["id-clase-a"] == "Indefinido") ? 0 : $_POST["id-clase-a"];
$orden = ($_POST["id-orden-a"] == "Indefinido") ? 0 : $_POST["id-orden-a"];
$familia = ($_POST["id-familia-a"] == "Indefinido") ? 0 : $_POST["id-familia-a"];
$genero = ($_POST["id-genero-a"] == "Indefinido") ? 0 : $_POST["id-genero-a"];
$epiteto = ($_POST["id-epiteto-a"] == "Indefinido") ? 0 : $_POST["id-epiteto-a"];
$determinado = ($_POST["id-determinado-a"] == "Indefinido") ? 0 : $_POST["id-determinado-a"];
$color = ($_POST["id-color-a"] == "Indefinido") ? 0 : $_POST["id-color-a"];
$forma = ($_POST["id-forma-a"] == "Indefinido") ? 0 : $_POST["id-forma-a"];
$tipo = ($_POST["id-tipo-a"] == "Indefinido") ? 0 : $_POST["id-tipo-a"];
$autor = $_POST["autor-a"];
$fuente = $_POST["fuente-a"];
$altura = $_POST["altura-a"];
$id_planta = $_POST["id-planta"];
$imagen = $_FILES["imagen-a"];
$directorio = 'fotos/';
$sentencia = 0;
$reproduccion = 0;

if ($altura <= 0) {
    $altura = 0;
}

//****** REPRODUCCION ********
if (isset($_POST["sexual-a"])) {
    $sexual = 1;
} else {
    $sexual = 0;
}

if (isset($_POST["asexual-a"])) {
    $asexual = 1;
} else {
    $asexual = 0;
}

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
if (isset($_POST["revision-a"])) {
    $revision = 1;
} else {
    $revision = 0;
}

if (isset($_POST["visible-a"])) {
    $visible = 1;
} else {
    $visible = 0;
}

$sql = "SELECT url_img, idMascara FROM planta WHERE idPlanta=$id_planta";
$consulta = $pdoConn->query($sql);
$fila = $consulta->fetch(PDO::FETCH_ASSOC);

$ruta_vieja = $fila["url_img"];
$id_mascara = $fila["idMascara"];

if ($imagen["name"] != '') {//HAY IMAGEN NUEVA??
    if ($imagen["type"] == "image/jpg" || $imagen["type"] == "image/jpeg" || $imagen["type"] == "image/png") {//TIENE EL FORMATO CORRECTO
        $temporal = $imagen["tmp_name"];
        $ruta = "fotos/" . $id_mascara . '-' . $imagen["name"];

        if (!file_exists($directorio)) {
            mkdir("fotos/", 0777);
        }

        $cargar_imagen = move_uploaded_file($imagen["tmp_name"], $ruta);

        if ($cargar_imagen) {
            $sentencia = 1; //paras al sql
        } else {
            $sentencia = 3;
        }
    } else {
        $sentencia = 0; //formato incorrecto
    }
} else {
    if ($ruta_vieja != '') {//EXISTE UNA RUTA VIEJA??
        $ruta = $ruta_vieja;
    } else {//NO EXISTE UNA RUTA VIEJA
        $ruta = '';
    }
    $sentencia = 1;
}

if ($sentencia == 1) {
    try {
        $sql_update = "UPDATE `planta` SET `Familia_idFamilia`=$familia,`Genero_idGenero`=$genero,`Epiteto_idEpiteto`=$epiteto,`fuente_informacion`='$fuente',
                    `altura`=$altura,`autor`='$autor',`Forma_idForma`=$forma,`Color_idColor`=$color,`TipoHoja_idTipoHoja`=$tipo,`reproduccion`=$reproduccion,
                    `DeterminadaPor_idDeterminadaPor`=$determinado,`visible`=$visible,`revision`=$revision,`orden_idOrden`=$orden,`clase_idClase`=$clase,
                    `reino_idReino`=$reino,`division_idDivision`=$division, `url_img`='$ruta' WHERE idPlanta=$id_planta";

        $stmt = $pdoConn->prepare($sql_update);
        $stmt->execute();
        $sentencia = 2; //se inserto la ruta nueva en la tabla
        echo '1';//correcto
    } catch (Exception $exc) {
        $sentencia = 3; //error en el servidor
        echo '2';
    }
} elseif ($sentencia == 0) {
    echo '0';//formato incorrecto
}

//BORRAR IMAGEN VIEJA SI Y SOLO SI: EXISTE, SI SE INSERTO LA NUEVA RUTA EN BD Y SE CARGO LA IMAGEN AL SERVIDOR
if ($sentencia == 2 && $ruta_vieja != '' && $ruta_vieja != $ruta) {
    if (file_exists($ruta_vieja)) {
        unlink($ruta_vieja);
    }
}




/* //INSERTAR RUTA IMAGEN
  $sql = "SELECT url_img, idMascara FROM planta WHERE idPlanta=$id_planta";
  $consulta = $pdoConn->query($sql);
  $fila = $consulta->fetch(PDO::FETCH_ASSOC);

  $ruta_vieja = $fila["url_img"];
  $id_mascara = $fila["idMascara"];

  echo $ruta_vieja . ' ****** ';

  if ($imagen["name"] == '') { //EL INPUT FILE ES VACIO??
  echo 'no hay imagen nueva *** ';
  if ($ruta_vieja != NULL) { //LA RUTA VIEJA ESTA VACIA?
  echo 'si hay imagen vieja *** ';
  $ruta = $ruta_vieja; //NO - RUTA NUEVA ES IGUAL A LA RUTA VIEJA
  echo 'ruta es igual a ruta vieja *** ';
  } else {
  echo 'no hay imagen vieja *** ';
  $ruta = NULL; //SI - RUTA NUEVA ES IGUAL A NULL
  echo 'ruta es igual a null *** ';
  }
  $sentencia = 1;
  } elseif ($imagen["type"] == "image/jpg" || $imagen["type"] == "image/jpeg" || $imagen["type"] == "image/png") { //TIENE EL FORMATO CORRECTO

  echo 'formato correcto *** ';
  if (!file_exists($directorio)) { //NO - EXISTE DIRECTORIO DE LAS FOTOS

  echo 'no existe directorio pero se creo *** ';
  mkdir("fotos/", 0777); //NO - CREAR DIRECTORIO
  } else {
  echo 'si existe directorio *** ';
  }

  //HAY IMAGEN Y TIENE FORMATO CORRECTO - PONER RUTA DE NUEVA IMAGEN
  $imagen = $_FILES["imagen-a"];
  $temporal = $imagen["tmp_name"];
  $ruta = "fotos/" . $id_mascara . '-' . $imagen["name"];
  echo 'imagen insertada a nueva ruta *** ';
  $sentencia = 1;
  } else {
  $sentencia = 0;
  }

  /*$sql_update = "UPDATE `planta` SET `Familia_idFamilia`=$familia,`Genero_idGenero`=$genero,`Epiteto_idEpiteto`=$epiteto,`fuente_informacion`=$fuente,
  `altura`=$altura,`autor`='$autor',`Forma_idForma`=$forma,`Color_idColor`=$color,`TipoHoja_idTipoHoja`=$tipo,`reproduccion`=$reproduccion,
  `DeterminadaPor_idDeterminadaPor`=$determinado,`visible`=$visible,`revision`=$revision,`orden_idOrden`=$orden,`clase_idClase`=$clase,
  `reino_idReino`=$reino,`division_idDivision`=$division,`url_img`='$ruta' WHERE idPlanta=$id_planta";

  $stmt = $pdoConn->prepare($sql_update);
  $stmt->execute();

  /* if ($sentencia == 1) {

  try {
  echo $ruta . ' ****** ';

  $sql_update = "UPDATE `planta` SET `Familia_idFamilia`=$familia,`Genero_idGenero`=$genero,`Epiteto_idEpiteto`=$epiteto,`fuente_informacion`=$fuente,
  `altura`=$altura,`autor`='$autor',`Forma_idForma`=$forma,`Color_idColor`=$color,`TipoHoja_idTipoHoja`=$tipo,`reproduccion`=$reproduccion,
  `DeterminadaPor_idDeterminadaPor`=$determinado,`visible`=$visible,`revision`=$revision,`orden_idOrden`=$orden,`clase_idClase`=$clase,
  `reino_idReino`=$reino,`division_idDivision`=$division,`url_img`='$ruta' WHERE idPlanta=$id_planta";

  $stmt = $pdoConn->prepare($sql_update);
  $stmt->execute();

  $sentencia = 2;
  echo 'se actualizo correctamente *** '; //ACTUALIZADO EXITOSO
  } catch (Exception $exc) {
  $sentencia = 0;
  echo 'error del servidor'; //ERROR DEL SERVIDOR
  }
  } elseif ($sentencia == 0) {
  echo 'formato incorrecto *** ';
  }

  if ($sentencia == 2 && $ruta != $ruta_vieja && $ruta != NULL) { //SE EJECUTO CORRECTAMENTE EL SQL??
  echo 'si hubo ruta nueva que mover *** ';
  move_uploaded_file($imagen["tmp_name"], $ruta); //SI - MOVER IMAGEN A NUEVA RUTA
  echo 'mover imagen a ruta nueva *** ';
  $sentencia = 3;
  } else {
  echo 'no hubo una ruta nueva por mover *** ';
  }

  if ($sentencia == 3 && $ruta_vieja != NULL) { // SE MOVIO LA IMAGEN CORRECTAMENTE Y EXISTE UNA RUTA DE IMAGEN VIEJA??
  echo 'se movio correctamente la imagen *** ';
  if (file_exists($ruta_vieja)) { //EXISTE LA IMAGEN??
  echo 'si existe la imagen en el directorio *** ';
  unlink($ruta_vieja); //SI - BORRAR IMAGEN VIEJA
  echo 'se borro la imagen vieja *** ';
  }
  } else {
  echo 'no hay imagen vieja por borrar *** ';
  }
 */

/* echo $reino . '-' . $division . '-' . $clase . '-' . $orden . '-' . $familia . '-' . $genero . '-' . $epiteto . '-' . $determinado . '-' .
  $color . '-' . $forma . '-' . $tipo . '-' . $autor . '-' . $fuente . '-' . $altura . '-' . $id_planta . '-' . $reproduccion . '-' .
  $visible . '-' . $revision . ' *** ' . $ruta_vieja . ' *** ' . $ruta; */

//echo ' ****** ' . $ruta;
?>