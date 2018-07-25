<?php

date_default_timezone_set('America/Costa_Rica');
include_once 'conexion2.php';
include_once 'ControlSesion.inc.php';

//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$id_usuario = $_SESSION['idUsuario'];

$funcion = $_POST['funcion'];

// ********INSERTAR REINO
if ($funcion == 'insertarReino') {
    $nombre_reino = $_POST["n_reino"];
    try {
        $query = "INSERT INTO reino (nombre_reino) VALUES (?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_reino));

        $sql_reino = "SELECT `idReino` FROM reino ORDER BY `idReino` DESC LIMIT 1";

        $consulta_reino = $pdoConn->prepare($sql_reino);
        $consulta_reino->execute();

        $fila = $consulta_reino->fetch(PDO::FETCH_ASSOC);

        $id_reino = $fila['idReino'];

        $registro = 'Reino. ' . str_pad($id_reino, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_division = "SELECT `idDivision` FROM division ORDER BY `idDivision` DESC LIMIT 1";

        $consulta_division = $pdoConn->prepare($sql_division);
        $consulta_division->execute();

        $fila = $consulta_division->fetch(PDO::FETCH_ASSOC);

        $id_division = $fila['idDivision'];

        $registro = 'Division. ' . str_pad($id_division, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_clase = "SELECT `idClase` FROM clase ORDER BY `idClase` DESC LIMIT 1";

        $consulta_clase = $pdoConn->prepare($sql_clase);
        $consulta_clase->execute();

        $fila = $consulta_clase->fetch(PDO::FETCH_ASSOC);

        $id_clase = $fila['idClase'];

        $registro = 'Clase. ' . str_pad($id_clase, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_orden = "SELECT `idOrden` FROM orden ORDER BY `idOrden` DESC LIMIT 1";

        $consulta_orden = $pdoConn->prepare($sql_orden);
        $consulta_orden->execute();

        $fila = $consulta_orden->fetch(PDO::FETCH_ASSOC);

        $id_orden = $fila['idOrden'];

        $registro = 'Orden. ' . str_pad($id_orden, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_familia = "SELECT `idFamilia` FROM familia ORDER BY `idFamilia` DESC LIMIT 1";

        $consulta_familia = $pdoConn->prepare($sql_familia);
        $consulta_familia->execute();

        $fila = $consulta_familia->fetch(PDO::FETCH_ASSOC);

        $id_familia = $fila['idFamilia'];

        $registro = 'Familia. ' . str_pad($id_familia, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_genero = "SELECT `idGenero` FROM genero ORDER BY `idGenero` DESC LIMIT 1";

        $consulta_genero = $pdoConn->prepare($sql_genero);
        $consulta_genero->execute();

        $fila = $consulta_genero->fetch(PDO::FETCH_ASSOC);

        $id_genero = $fila['idGenero'];

        $registro = 'Genero. ' . str_pad($id_genero, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_epiteto = "SELECT `idEpiteto` FROM epiteto ORDER BY `idEpiteto` DESC LIMIT 1";

        $consulta_epiteto = $pdoConn->prepare($sql_epiteto);
        $consulta_epiteto->execute();

        $fila = $consulta_epiteto->fetch(PDO::FETCH_ASSOC);

        $id_epiteto = $fila['idEpiteto'];

        $registro = 'Epiteto. ' . str_pad($id_epiteto, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_color = "SELECT `idColor` FROM color ORDER BY `idColor` DESC LIMIT 1";

        $consulta_color = $pdoConn->prepare($sql_color);
        $consulta_color->execute();

        $fila = $consulta_color->fetch(PDO::FETCH_ASSOC);

        $id_color = $fila['idColor'];

        $registro = 'Color. ' . str_pad($id_color, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_determinado = "SELECT `idDeterminadaPor` FROM determinadapor ORDER BY `idDeterminadaPor` DESC LIMIT 1";

        $consulta_determinado = $pdoConn->prepare($sql_determinado);
        $consulta_determinado->execute();

        $fila = $consulta_determinado->fetch(PDO::FETCH_ASSOC);

        $id_determinado = $fila['idDeterminadaPor'];

        $registro = 'Determinacion. ' . str_pad($id_determinado, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_forma = "SELECT `idForma` FROM forma ORDER BY `idForma` DESC LIMIT 1";

        $consulta_forma = $pdoConn->prepare($sql_forma);
        $consulta_forma->execute();

        $fila = $consulta_forma->fetch(PDO::FETCH_ASSOC);

        $id_forma = $fila['idForma'];

        $registro = 'Forma. ' . str_pad($id_forma, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_tipo = "SELECT `idTipoHoja` FROM tipohoja ORDER BY `idTipoHoja` DESC LIMIT 1";

        $consulta_tipo = $pdoConn->prepare($sql_tipo);
        $consulta_tipo->execute();

        $fila = $consulta_tipo->fetch(PDO::FETCH_ASSOC);

        $id_tipo = $fila['idTipoHoja'];

        $registro = 'Tipo de hoja. ' . str_pad($id_tipo, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_uso = "SELECT `idUso` FROM uso ORDER BY `idUso` DESC LIMIT 1";

        $consulta_uso = $pdoConn->prepare($sql_uso);
        $consulta_uso->execute();

        $fila = $consulta_uso->fetch(PDO::FETCH_ASSOC);

        $id_uso = $fila['idUso'];

        $registro = 'Uso. ' . str_pad($id_uso, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

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

        $sql_estado = "SELECT `idEstadoSalud` FROM estadosalud ORDER BY `idEstadoSalud` DESC LIMIT 1";

        $consulta_estado = $pdoConn->prepare($sql_estado);
        $consulta_estado->execute();

        $fila = $consulta_estado->fetch(PDO::FETCH_ASSOC);

        $id_estado = $fila['idEstadoSalud'];

        $registro = 'Estado de salud. ' . str_pad($id_estado, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();

        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********INSERTAR COMUN
elseif ($funcion == 'insertarNombreComun') {
    $comun = $_POST["comun"];
    $lengua = $_POST['lengua'];
    $id_comun = $_POST['id-comun'];

    $datos_comun = $comun . ' ' . $lengua . ' ' . $id_comun;

    try {
        $query = "INSERT INTO `nombrecomun`(`nombre_nombre_comun`, `lengua`, `Planta_idPlanta`) VALUES (?, ?, ?)";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($comun, $lengua, $id_comun));

        /*$sql_comun = "SELECT `idNombreComun` FROM nombrecomun ORDER BY `idNombreComun` DESC LIMIT 1";

        $consulta_comun = $pdoConn->prepare($sql_comun);
        $consulta_comun->execute();

        $fila = $consulta_comun->fetch(PDO::FETCH_ASSOC);

        $id_comun = $fila['idNombreComun'];

        $registro = 'Nombre comun. ' . str_pad($id_comun, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO `historial`(`fecha_historial`, `registro`, `accion`, `Usuario_idUsuario`)
                VALUES (NOW(), '$registro', 'Nuevo registro', $id_usuario)";
        $stmt = $pdoConn->prepare($sql);
        $stmt->execute();*/

        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}