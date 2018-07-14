<?php

include ('conexion2.php');

$funcion = $_POST['funcion'];

// ********ACTUALIZAR REINO
if ($funcion == 'ocultarRegistro') {
    $id_planta = $_POST["id_planta"];
    try {
        foreach ($id_planta as $planta) {
            $query = "UPDATE `planta` SET `visible`= 0 WHERE idReino='$planta'";
            $stmt = $pdoConn->prepare($query);
            $stmt->execute(array($planta));
        }
        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}