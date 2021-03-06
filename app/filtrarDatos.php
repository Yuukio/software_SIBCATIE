<?php

include ('conexion2.php');

$funcion = $_POST['funcion'];

//******FILTRAR REINO
if ($funcion == 'filtrarReino') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (reino_idReino=$id) AND (revision=1)
                ORDER BY `planta`.`reino_idReino` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR DIVISION
elseif ($funcion == 'filtrarDivision') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (division_idDivision=$id) AND (revision=1)
                ORDER BY `planta`.`division_idDivision` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR CLASE
elseif ($funcion == 'filtrarClase') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (clase_idClase=$id) AND (revision=1)
                ORDER BY `planta`.`clase_idClase` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR ORDEN
elseif ($funcion == 'filtrarOrden') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (orden_idOrden=$id) AND (revision=1)
                ORDER BY `planta`.`orden_idOrden` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR FAMILIA
elseif ($funcion == 'filtrarFamilia') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (familia_idFamilia=$id) AND (revision=1)
                ORDER BY `planta`.`familia_idFamilia` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR GENERO
elseif ($funcion == 'filtrarGenero') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (genero_idGenero=$id) AND (revision=1)
                ORDER BY `planta`.`genero_idGenero` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR EPITETO
elseif ($funcion == 'filtrarEpiteto') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (epiteto_idEpiteto=$id) AND (revision=1)
                ORDER BY `planta`.`epiteto_idEpiteto` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR COLOR
elseif ($funcion == 'filtrarColor') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (color_idColor=$id) AND (revision=1)
                ORDER BY `planta`.`division_idDivision` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR DETERMINADA
elseif ($funcion == 'filtrarDeterminadaPor') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (DeterminadaPor_idDeterminadaPor=$id) AND (revision=1)
                ORDER BY `planta`.`DeterminadaPor_idDeterminadaPor` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR FORMA
elseif ($funcion == 'filtrarForma') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (forma_idForma=$id) AND (revision=1) 
                ORDER BY `planta`.`forma_idForma` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}
//******FILTRAR TIPO DE HOJA
elseif ($funcion == 'filtrarTipoHoja') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE (TipoHoja_idTipoHoja=$id) AND (revision=1)
                ORDER BY `planta`.`TipoHoja_idTipoHoja` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}

//******MOSTRAR LISTA FAVORITOS
elseif ($funcion == 'mostrarFavoritos') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idMascara, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.revision FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                LEFT JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE Usuario_idUsuario=$id 
                ORDER BY `planta`.`` DESC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}

//******MOSTRAR LISTA EXPORTACION
elseif ($funcion == 'filtrarTipoHoja') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.visible FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                INNER JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE TipoHoja_idTipoHoja=$id 
                ORDER BY `planta`.`TipoHoja_idTipoHoja` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}

//******MOSTRAR LISTA OCULTOS
elseif ($funcion == 'filtrarTipoHoja') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT familia.nombre_familia, planta.idPlanta, genero.nombre_genero, epiteto.nombre_epiteto, planta.fecha_ingreso, planta.visible FROM `planta` 
                LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                INNER JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                INNER JOIN familia ON planta.Familia_idFamilia=familia.nombre_familia
                WHERE TipoHoja_idTipoHoja=$id 
                ORDER BY `planta`.`TipoHoja_idTipoHoja` ASC";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute(array($id));
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}

//******MOSTRAR LISTA NOMBRES COMUNES
elseif ($funcion == 'filtrarComun') {
    $id = $_POST["id"];
    
    try {
        $query = "SELECT `nombre_nombre_comun`, `lengua` FROM `nombrecomun` WHERE Planta_idPlanta=2";
        
        $stmt = $pdoConn->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        
    } catch (Exception $e) {
        echo '0';
    }
}

