<?php

include_once 'conexion2.php';

$funcion = $_POST['funcion'];

if ($funcion == 'filtrar-busqueda') {

    $familia_id = $_POST['familia-id'];
    $genero_id = $_POST['genero-id'];

    $rojo = $_POST['rojo'];
    $naranja = $_POST['naranja'];
    $amarillo = $_POST['amarillo'];
    $verde = $_POST['verde'];
    $azul = $_POST['azul'];
    $cafe = $_POST['cafe'];
    $rosado = $_POST['rosado'];
    $blanco = $_POST['blanco'];

    /*     * ************************************************ */

    if ($familia_id == 'todos' && $genero_id != 'todos') {
        $familia_and = "";
        $genero_and = "AND planta.Genero_idGenero=$genero_id";
    } else {
        if ($familia_id == 'todos') {
            $familia_and = "";
        } else {
            $familia_and = "AND planta.Familia_idFamilia=$familia_id";
        }

        if ($genero_id == 'todos') {
            $genero_and = "";
        } else {
            $genero_and = "AND planta.Genero_idGenero=$genero_id";
        }
    }

    /*     * ************************************************ */

    if ($rojo == 0 && $naranja == 0 && $amarillo == 0 && $verde == 0 && $azul == 0 && $cafe == 0 && $rosado == 0 && $blanco == 0) {
        $or = "";
    } else {
        $or = " " . "AND (planta.Color_idColor=$rojo OR planta.Color_idColor=$naranja OR planta.Color_idColor=$amarillo OR planta.Color_idColor=$verde OR planta.Color_idColor=$azul
                    OR planta.Color_idColor=$cafe OR planta.Color_idColor=$rosado OR planta.Color_idColor=$blanco)";
    }

    $where = "planta.activo=1 AND planta.visible=1 AND planta.revision=1" . " " . $familia_and . " " . $genero_and;

    try {
        $query = "SELECT planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.idMascara, planta.idPlanta, planta.url_img FROM `planta` 
                    INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero 
                    INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                    WHERE $where $or
                    ORDER BY planta.idMascara";

        $stmt = $pdoConn->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    } catch (Exception $e) {
        echo '0';
    }
}

if ($funcion == 'filtrar-genero') {

    $id = $_POST["familia-filtro"];

    try {
        $query = "SELECT DISTINCT genero.nombre_genero, planta.Genero_idGenero FROM `planta` 
                    INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero
                    WHERE planta.activo=1 AND planta.visible=1 AND planta.revision=1 AND planta.Familia_idFamilia=$id
                    ORDER BY genero.nombre_genero ASC";

        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    } catch (Exception $e) {
        echo '0';
    }
}

if ($funcion == 'todos-genero') {

    $id = $_POST["familia-filtro"];

    try {
        $query = "SELECT DISTINCT genero.nombre_genero, planta.Genero_idGenero FROM `planta` 
                    INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero
                    WHERE planta.activo=1 AND planta.visible=1 AND planta.revision=1
                    ORDER BY genero.nombre_genero ASC";

        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    } catch (Exception $e) {
        echo '0';
    }
}

