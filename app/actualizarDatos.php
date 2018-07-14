<?php

include ('conexion2.php');

$funcion = $_POST['funcion'];

// ********ACTUALIZAR REINO
if ($funcion == 'actualizarReino') {
    $nombre_reino = $_POST["n_reino"];
    $id_reino = $_POST["id_reino"];
    try {
        $query = "UPDATE `reino` SET `nombre_reino`= '$nombre_reino' WHERE idReino='$id_reino'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_reino));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR DIVISION
elseif ($funcion == 'actualizarDivision') {
    $nombre_division = $_POST["n_division"];
    $id_division = $_POST["id_division"];
    try {
        $query = "UPDATE `division` SET `nombre_division`= '$nombre_division' WHERE idDivision='$id_division'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_division));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR CLASE
elseif ($funcion == 'actualizarClase') {
    $nombre_clase = $_POST["n_clase"];
    $id_clase = $_POST["id_clase"];
    try {
        $query = "UPDATE `clase` SET `nombre_clase`= '$nombre_clase' WHERE idClase='$id_clase'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_clase));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR ORDEN
elseif ($funcion == 'actualizarOrden') {
    $nombre_orden = $_POST["n_orden"];
    $id_orden = $_POST["id_orden"];
    try {
        $query = "UPDATE `orden` SET `nombre_orden`= '$nombre_orden' WHERE idOrden='$id_orden'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_orden));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR FAMILIA
elseif ($funcion == 'actualizarFamilia') {
    $nombre_familia = $_POST["n_familia"];
    $id_familia = $_POST["id_familia"];
    try {
        $query = "UPDATE `familia` SET `nombre_familia`= '$nombre_familia' WHERE idFamilia='$id_familia'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_familia));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR GENERO
elseif ($funcion == 'actualizarGenero') {
    $nombre_genero = $_POST["n_genero"];
    $id_genero = $_POST["id_genero"];
    try {
        $query = "UPDATE `genero` SET `nombre_genero`= '$nombre_genero' WHERE idGenero='$id_genero'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_genero));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR EPITETO
elseif ($funcion == 'actualizarEpiteto') {
    $nombre_epiteto = $_POST["n_epiteto"];
    $id_epiteto = $_POST["id_epiteto"];
    try {
        $query = "UPDATE `epiteto` SET `nombre_epiteto`= '$nombre_epiteto' WHERE idEpiteto='$id_epiteto'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_epiteto));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR COLOR
elseif ($funcion == 'actualizarColor') {
    $nombre_color = $_POST["n_color"];
    $id_color = $_POST["id_color"];
    try {
        $query = "UPDATE `color` SET `nombre_color`= '$nombre_color' WHERE idColor='$id_color'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_color));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR DETERMINACION
elseif ($funcion == 'actualizarDeterminado') {
    $nombre_determinado = $_POST["n_determinado"];
    $id_determinado = $_POST["id_determinado"];
    try {
        $query = "UPDATE `determinadapor` SET `nombre_determinado`= '$nombre_determinado' WHERE idDeterminadaPor='$id_determinado'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_determinado));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR FORMA
elseif ($funcion == 'actualizarForma') {
    $nombre_forma = $_POST["n_forma"];
    $id_forma = $_POST["id_forma"];
    try {
        $query = "UPDATE `forma` SET `nombre_forma`= '$nombre_forma' WHERE idForma='$id_forma'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_forma));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR TIPO DE HOJA
elseif ($funcion == 'actualizarTipo') {
    $nombre_tipo = $_POST["n_tipo"];
    $id_tipo = $_POST["id_tipo"];
    try {
        $query = "UPDATE `tipohoja` SET `nombre_hoja`= '$nombre_tipo' WHERE idTipoHoja='$id_tipo'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_tipo));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR USO
elseif ($funcion == 'actualizarUso') {
    $nombre_uso = $_POST["n_uso"];
    $id_uso = $_POST["id_uso"];
    try {
        $query = "UPDATE `uso` SET `nombre_uso`= '$nombre_uso' WHERE idUso='$id_uso'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_uso));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********ACTUALIZAR ESTADO DE USO
elseif ($funcion == 'actualizarEstado') {
    $nombre_estado = $_POST["n_estado"];
    $id_estado = $_POST["id_estado"];
    try {
        $query = "UPDATE `estadosalud` SET `nombre_estado`= '$nombre_estado' WHERE idEstadoSalud='$id_estado'";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($nombre_estado));
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********PONER OCULTO
elseif ($funcion == 'ponerOcultos') {
    $oculto = $_POST["oculto"];
    try {

        $query = "UPDATE `planta` SET `visible`= 1 WHERE idPlanta = ?";
        $stmt = $pdoConn->prepare($query);

        for ($i = 0; $i < sizeof($oculto); $i++) {
            $stmt->execute(array($oculto[$i]));
        }
        
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}