<?php

include_once 'ControlSesion.inc.php';
include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'conexion2.php';
include_once 'Redireccion.inc.php';


//VALIDAR INICIO DE SESION
if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

Conexion::abrir_conexion();

$funcion = $_POST['funcion'];

$id_usuario = $_SESSION['idUsuario'];

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

// ********ACTUALIZAR REGISTRO
elseif ($funcion == 'actualizarRegistro') {
    $id_reino_r = $_POST["reino"] != 'Indefinido' ? $_POST["reino"] : null;
    $id_division_r = $_POST["division"] != 'Indefinido' ? $_POST["division"] : null;
    $id_clase_r = $_POST["clase"] != 'Indefinido' ? $_POST["clase"] : null;
    $id_orden_r = $_POST["orden"] != 'Indefinido' ? $_POST["orden"] : null;
    $id_familia_r = $_POST["familia"] != 'Indefinido' ? $_POST["familia"] : null;
    $id_genero_r = $_POST["genero"] != 'Indefinido' ? $_POST["genero"] : null;
    $id_epiteto_r = $_POST["epiteto"] != 'Indefinido' ? $_POST["epiteto"] : null;
    $id_determinado_r = $_POST["determinado"] != 'Indefinido' ? $_POST["determinado"] : null;
    $id_color_r = $_POST["color"] != 'Indefinido' ? $_POST["color"] : null;
    $id_forma_r = $_POST["forma"] != 'Indefinido' ? $_POST["forma"] : null;
    $id_tipo_r = $_POST["tipo"] != 'Indefinido' ? $_POST["tipo"] : null;
    $autor_r = $_POST["autor"] != 'Indefinido' ? $_POST["autor"] : null;
    $fuente_r = $_POST["fuente"] != 'Indefinido' ? $_POST["fuente"] : null;
    $altura_r = $_POST["altura"] != 'Indefinido' ? $_POST["altura"] : null;
    $id_planta_r = $_POST['id-planta'];

    //**********REPRODUCCION, VISIBLE Y REVISION
    $visible_r = $_POST['visible'];
    $revision_r = $_POST['revision'];

    $sexual_r = $_POST["sexual"];
    $asexual_r = $_POST["asexual"];

    $reproduccion_r = 0;

    if ($sexual_r == 1 && $asexual_r == 0) {
        $reproduccion_r = 1;
    } elseif ($sexual_r == 0 && $asexual_r == 1) {
        $reproduccion_r = 2;
    } elseif ($asexual_r == 1 && $asexual_r == 1) {
        $reproduccion_r = 3;
    } elseif ($sexual_r == 0 && $asexual_r == 0) {
        $reproduccion_r = 0;
    }

    //$usuario = $_SESSION['nombre_usuario'];
    
    //Agregar una advertencia de actualizacion en cada tabla

    $datos_prueba = $id_reino_r . '*' .
            $id_division_r . '*' .
            $id_clase_r . '*' .
            $id_orden_r . '*' .
            $id_familia_r . '*' .
            $id_genero_r . '*' .
            $id_epiteto_r . '*' .
            $autor_r . '*' .
            $fuente_r . '*' .
            $altura_r . '*' .
            $id_color_r . '*' .
            $id_forma_r . '*' .
            $id_tipo_r . '*' .
            $id_determinado_r . '*' .
            $reproduccion_r . '*' .
            $revision_r . '*' .
            $visible_r . '*' .
            $id_planta_r;

    //$usuario = $_SESSION['nombre_usuario'];

    try {
        $query = "UPDATE `planta` SET `Familia_idFamilia`='$id_familia_r',`Genero_idGenero`='$id_genero_r',`Epiteto_idEpiteto`='$id_epiteto_r', "
                . "`fuente_informacion`='$fuente_r',`altura`='$altura_r',`autor`='$autor_r',`Forma_idForma`='$id_forma_r',`Color_idColor`='$id_color_r',"
                . "`TipoHoja_idTipoHoja`='$id_tipo_r',`reproduccion`='$reproduccion_r',`DeterminadaPor_idDeterminadaPor`='$id_determinado_r',"
                . "`visible`='$visible_r',`revision`='$revision_r',`orden_idOrden`='$id_orden_r',`clase_idClase`='$id_clase_r',`reino_idReino`='$id_reino_r',"
                . "`division_idDivision`='$id_division_r' WHERE idPlanta='$id_planta_r'";

        $stmt = $pdoConn->prepare($query);
        $stmt->execute();

        echo '1';
        //echo $usuario;
    } catch (PDOException $e) {
        //echo $datos_prueba;
        //print 'ERROR' . $e->getMessage();
        echo '0';
        //echo $usuario;
    }
}

// ********AGREGAR A OCULTO
elseif ($funcion == 'ponerOcultos') {
    $seleccion = $_POST["seleccion"];
    try {

        $query = "UPDATE `planta` SET `visible`= 0 WHERE idPlanta = ?";
        $stmt = $pdoConn->prepare($query);

        for ($i = 0; $i < sizeof($seleccion); $i++) {
            $stmt->execute(array($seleccion[$i]));
        }

        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}

// ********AGREGAR A FAVORITOS
elseif ($funcion == 'ponerFavoritos') {
    $seleccion = $_POST["seleccion"];
    try {

        $query = "INSERT INTO `favorito`(`Planta_idPlanta`, `Usuario_idUsuario`) VALUES (?, '$id_usuario')";
        $stmt = $pdoConn->prepare($query);

        for ($i = 0; $i < sizeof($seleccion); $i++) {
            $stmt->execute(array($seleccion[$i]));
        }

        echo '1';
    } catch (Exception $e) {
        echo '0';
    }
}