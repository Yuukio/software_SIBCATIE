<?php
date_default_timezone_set('America/Costa_Rica');
include ('conexion2.php');

$funcion = $_POST['funcion'];

// ********INSERTAR REINO
if ($funcion == 'insertarReino') {
    $nombre_reino = $_POST["n_reino"];
    try {
        $query = "INSERT INTO reino (nombre_reino) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_reino));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR DIVISION
elseif ($funcion == 'insertarDivision') {
    $nombre_division = $_POST["n_division"];
    try {
        $query = "INSERT INTO division (nombre_division) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_division));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR CLASE
elseif ($funcion == 'insertarClase') {
    $nombre_clase = $_POST["n_clase"];
    try {
        $query = "INSERT INTO clase (nombre_clase) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_clase));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR ORDEN
elseif ($funcion == 'insertarOrden') {
    $nombre_orden = $_POST["n_orden"];
    try {
        $query = "INSERT INTO orden (nombre_orden) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_orden));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR FAMILIA
elseif ($funcion == 'insertarFamilia') {
    $nombre_familia = $_POST["n_familia"];
    try {
        $query = "INSERT INTO familia (nombre_familia) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_familia));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR GENERO
elseif ($funcion == 'insertarGenero') {
    $nombre_genero = $_POST["n_genero"];
    try {
        $query = "INSERT INTO genero (nombre_genero) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_genero));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR EPITETO
elseif ($funcion == 'insertarEpiteto') {
    $nombre_epiteto = $_POST["n_epiteto"];
    try {
        $query = "INSERT INTO epiteto (nombre_epiteto) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_epiteto));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR COLOR
elseif ($funcion == 'insertarColor') {
    $nombre_color = $_POST["n_color"];
    try {
        $query = "INSERT INTO color (nombre_color) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_color));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR DETERMINACION
elseif ($funcion == 'insertarDeterminado') {
    $nombre_determinado = $_POST["n_determinado"];
    try {
        $query = "INSERT INTO determinadapor (nombre_determinado) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_determinado));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR FORMA
elseif ($funcion == 'insertarForma') {
    $nombre_forma = $_POST["n_forma"];
    try {
        $query = "INSERT INTO forma (nombre_forma) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_forma));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR TIPO DE HOJA
elseif ($funcion == 'insertarTipoHoja') {
    $nombre_tipohoja = $_POST["n_tipohoja"];
    try {
        $query = "INSERT INTO tipohoja (nombre_hoja) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_tipohoja));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}
// ********INSERTAR USO
elseif ($funcion == 'insertarUso') {
    $nombre_uso = $_POST["n_uso"];
    try {
        $query = "INSERT INTO uso (nombre_uso) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_uso));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR ESTADO DE SALUD
elseif ($funcion == 'insertarEstadoSalud') {
    $nombre_estadosalud = $_POST["n_estadosalud"];
    try {
        $query = "INSERT INTO estadosalud (nombre_estado) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_estadosalud));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}
// ********INSERTAR REGISTRO
elseif ($funcion == 'insertarRegistro') {

    $id_reino = $_POST["reino"] != 'Indefinido' ? $_POST["reino"] : null;
    $id_division = $_POST["division"] != 'Indefinido' ? $_POST["division"] : null;
    $id_clase = $_POST["clase"] != 'Indefinido' ? $_POST["clase"] : null;
    $id_orden = $_POST["orden"] != 'Indefinido' ? $_POST["orden"] : null;
    $id_familia = $_POST["familia"] != 'Indefinido' ? $_POST["familia"] : null;
    $id_genero = $_POST["genero"] != 'Indefinido' ? $_POST["genero"] : null;
    $id_epiteto = $_POST["epiteto"] != 'Indefinido' ? $_POST["epiteto"] : null;
    $id_determinado = $_POST["determinado"] != 'Indefinido' ? $_POST["determinado"] : null;
    $id_color = $_POST["color"] != 'Indefinido' ? $_POST["color"] : null;
    $id_forma = $_POST["forma"] != 'Indefinido' ? $_POST["forma"] : null;
    $id_tipo = $_POST["tipo"] != 'Indefinido' ? $_POST["tipo"] : null;
    $autor = $_POST["autor"] != 'Indefinido' ? $_POST["autor"] : null;
    $fuente = $_POST["fuente"] != 'Indefinido' ? $_POST["fuente"] : null;
    $altura = $_POST["altura"] != 'Indefinido' ? $_POST["altura"] : null;

    //**********CREAR EL ID MASCARA
    $sql_id = "SELECT idPlanta, fecha_ingreso FROM planta ORDER BY idPlanta DESC LIMIT 1";
    $consulta = $pdoConn->query($sql_id);
    $fila = $consulta->fetch(PDO::FETCH_ASSOC);

    $id = $fila['idPlanta'];
    $fecha_registro = $fila['fecha_ingreso'];
    $fecha = date("Y-m-d");

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

    //**********NOMBRE CIENTIFICO
    $nombre_cientifico = $id_genero . ' ' . $id_epiteto;

    //**********REPRODUCCION, VISIBLE Y REVISION
    $visible = $_POST['visible'];
    $revision = $_POST['revision'];

    $sexual = $_POST["sexual"];
    $asexual = $_POST["asexual"];

    $reproduccion = 0;

    if ($sexual == 1 && $asexual == 0) {
        $reproduccion = 1;
    } elseif ($sexual == 0 && $asexual == 1) {
        $reproduccion = 2;
    } elseif ($asexual == 1 && $asexual == 1) {
        $reproduccion = 3;
    } elseif ($sexual == 0 && $asexual == 0) {
        $reproduccion = 0;
    }

    if (strpos($nombre_cientifico, 'Indefinido') !== false) {
        $nombre_cientifico = null;
    }

    try {
        $query = "INSERT INTO `planta`(`idMascara`, `Familia_idFamilia`, `Genero_idGenero`, `Epiteto_idEpiteto`, `fecha_ingreso`, "
                . "`fuente_informacion`, `altura`, `autor`, `Forma_idForma`, `Color_idColor`, `TipoHoja_idTipoHoja`, "
                . "`DeterminadaPor_idDeterminadaPor`, `orden_idOrden`, `clase_idClase`, `reino_idReino`, "
                . "`division_idDivision`, `nombre_cientifico`, `reproduccion`, `visible`, `revision`) "
                . "VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($idMascara, $id_familia, $id_genero, $id_epiteto, $fuente, $altura, $autor, $id_forma, $id_color, $id_tipo,
            $id_determinado, $id_orden, $id_clase, $id_reino, $id_division, $nombre_cientifico, $reproduccion, $visible, $revision));

        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}
// ********INSERTAR COMUN
elseif ($funcion == 'insertarNombreComun') {
    $nombre_comun = $_POST["n_comun"];
    try {
        $query = "INSERT INTO estadosalud (nombre_estado) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_comun));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}