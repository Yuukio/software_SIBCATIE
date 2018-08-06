<?php
include_once '../app/conexion2.php';
?>

<select id="select-genero" class="form-control" style="width: 100%">
    <option value="todos">Todos</option>
    <?php
    $sql_genero = "SELECT DISTINCT genero.nombre_genero, planta.Genero_idGenero FROM `planta` 
                    INNER JOIN genero ON planta.Genero_idGenero=genero.idGenero
                    WHERE planta.activo=1 AND planta.visible=1 AND planta.revision
                    ORDER BY genero.nombre_genero ASC";
    $consulta_genero = $pdoConn->prepare($sql_genero);
    $consulta_genero->execute();

    while ($fila_genero = $consulta_genero->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value="<?php echo $fila_genero['Genero_idGenero']; ?>"><?php echo $fila_genero['nombre_genero']; ?></option>
        <?php
    }
    ?>
</select>