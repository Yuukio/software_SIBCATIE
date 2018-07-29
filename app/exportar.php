<?php

include_once 'conexion2.php';
include_once 'ControlSesion.inc.php';

if (!ControlSesion::sesionIniciada() OR ControlSesion::rolVisitante()) {
    Redireccion::redirigir(SERVIDOR);
}

$usuario_exportar = $_SESSION['idUsuario'];

if (isset($_POST['exportar'])) {
    header('Content-Type:text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="RegistroDeEspecies_SIBCATIE.csv"');

    $salida = fopen('php://output', 'w');

    fputcsv($salida, array('ID', 'REINO', 'DIVISION', 'CLASE', 'ORDEN', 'FAMILIA', 'GENERO', 'EPITETO', 'AUTOR', 'DETERMINADO POR', 'ESTATURA', 'COLOR PREDOMINANTE', 
        'FORMA DE HOJA', 'TIPO DE HOJA', 'REPRODUCCION', 'FUENTE DE INFORMACION', 'FECHA DE INGRESO'));

    $sql = "SELECT planta.idPlanta, planta.idMascara, reino.nombre_reino, division.nombre_division, clase.nombre_clase, orden.nombre_orden,
  familia.nombre_familia, genero.nombre_genero, epiteto.nombre_epiteto, planta.autor, determinadapor.nombre_determinado, planta.altura,
  color.nombre_color, forma.nombre_forma, tipohoja.nombre_hoja, planta.reproduccion, planta.fuente_informacion, planta.fecha_ingreso
  FROM exportar
  LEFT JOIN (planta
  LEFT JOIN reino ON planta.reino_idReino=reino.idReino
  LEFT JOIN division ON planta.division_idDivision=division.idDivision
  LEFT JOIN clase ON planta.clase_idClase=clase.idClase
  LEFT JOIN orden ON planta.orden_idOrden=orden.idOrden
  LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia
  LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
  LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
  LEFT JOIN determinadapor ON planta.DeterminadaPor_idDeterminadaPor=determinadapor.idDeterminadaPor
  LEFT JOIN color ON planta.Color_idColor=color.idColor
  LEFT JOIN forma ON planta.Forma_idForma=forma.idForma
  LEFT JOIN tipohoja ON planta.TipoHoja_idTipoHoja=tipohoja.idTipoHoja)
  ON exportar.Planta_idPlanta=planta.idPlanta
  WHERE exportar.Usuario_idUsuario=$usuario_exportar";

    $exportarCSV = $pdoConn->prepare($sql);
    $exportarCSV->execute();
    while ($fila = $exportarCSV->fetch(PDO::FETCH_ASSOC)) {

        $reproduccion = $fila['reproduccion'];

        if ($reproduccion == 1) {
            $reproduccion = 'Sexual';
        } elseif ($reproduccion == 2) {
            $reproduccion = 'Asexual';
        } elseif ($reproduccion == 3) {
            $reproduccion = 'Sexual y asexual';
        } else {
            $reproduccion = '';
        }

        fputcsv($salida, array(
            $fila['idMascara'],
            $fila['nombre_reino'],
            $fila['nombre_division'],
            $fila['nombre_clase'],
            $fila['nombre_orden'],
            $fila['nombre_familia'],
            $fila['nombre_genero'],
            $fila['nombre_epiteto'],
            $fila['autor'],
            $fila['nombre_determinado'],
            $fila['altura'].' cm',
            $fila['nombre_color'],
            $fila['nombre_forma'],
            $fila['nombre_hoja'],
            $reproduccion,
            $fila['fuente_informacion'],
            $fila['fecha_ingreso']));
    }
} 

/*
//Incluimos librería y archivo de conexión
if (isset($_POST['exportar'])) {

    require 'PHPExcel.php';

//Consulta
    $sql = "SELECT planta.idPlanta, planta.idMascara, reino.nombre_reino, division.nombre_division, clase.nombre_clase, orden.nombre_orden, 
            familia.nombre_familia, genero.nombre_genero, epiteto.nombre_epiteto, planta.autor, determinadapor.nombre_determinado, planta.altura, 
            color.nombre_color, forma.nombre_forma, tipohoja.nombre_hoja, planta.reproduccion, planta.fuente_informacion, planta.fecha_ingreso 
            FROM exportar
                LEFT JOIN (planta
                    LEFT JOIN reino ON planta.reino_idReino=reino.idReino
                    LEFT JOIN division ON planta.division_idDivision=division.idDivision
                    LEFT JOIN clase ON planta.clase_idClase=clase.idClase
                    LEFT JOIN orden ON planta.orden_idOrden=orden.idOrden
                    LEFT JOIN familia ON planta.Familia_idFamilia=familia.idFamilia
                    LEFT JOIN genero ON planta.Genero_idGenero=genero.idGenero
                    LEFT JOIN epiteto ON planta.Epiteto_idEpiteto=epiteto.idEpiteto
                    LEFT JOIN determinadapor ON planta.DeterminadaPor_idDeterminadaPor=determinadapor.idDeterminadaPor
                    LEFT JOIN color ON planta.Color_idColor=color.idColor
                    LEFT JOIN forma ON planta.Forma_idForma=forma.idForma
                    LEFT JOIN tipohoja ON planta.TipoHoja_idTipoHoja=tipohoja.idTipoHoja) 
                ON exportar.Planta_idPlanta=planta.idPlanta
                WHERE exportar.Usuario_idUsuario=$usuario_exportar";

    $exportarCSV = $pdoConn->prepare($sql);
    $exportarCSV->execute();
    $fila = 7; //Establecemos en que fila inciara a imprimir los datos

    $gdImage = imagecreatefrompng('../img/sibcatie-logo.png'); //Logotipo
//Objeto de PHPExcel
    $objPHPExcel = new PHPExcel();

//Propiedades de Documento
    $objPHPExcel->getProperties()->setCreator("SIBCATIE")->setDescription("Registro de Especies");

//Establecemos la pestaña activa y nombre a la pestaña
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle("Registros");

    $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
    $objDrawing->setName('Logotipo');
    $objDrawing->setDescription('Logotipo');
    $objDrawing->setImageResource($gdImage);
    $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
    $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
    $objDrawing->setHeight(100);
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

    $estiloTituloReporte = array(
        'font' => array(
            'name' => 'Arial',
            'bold' => true,
            'italic' => false,
            'strike' => false,
            'size' => 13
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    );

    $estiloTituloColumnas = array(
        'font' => array(
            'name' => 'Arial',
            'bold' => true,
            'size' => 10,
            'color' => array(
                'rgb' => 'FFFFFF'
            )
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '538DD5')
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    );

    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray(array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    ));

    $objPHPExcel->getActiveSheet()->getStyle('A1:Q4')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A6:Q6')->applyFromArray($estiloTituloColumnas);

    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE PRODUCTOS');
    $objPHPExcel->getActiveSheet()->mergeCells('B3:D3');

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('A6', 'ID');
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('B6', 'REINO');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('C6', 'DIVISIÓN');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('D6', 'CLASE');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('E6', 'ORDEN');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('F6', 'FAMILIA');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('G6', 'GÉNERO');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('H6', 'EPÍTETO');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('I6', 'AUTOR');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('J6', 'DETERMINADA POR');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('K6', 'ESTATURA');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('L6', 'COLOR PREDOMINANTE');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('M6', 'FORMA DE HOJA');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('N6', 'TIPO DE HOJA');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('O6', 'REPRODUCCIÓN');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('P6', 'FUENTE DE INFORMACIÓN');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('Q6', 'FECHA DE INGRESO');


//Recorremos los resultados de la consulta y los imprimimos
    while ($rows = $resultado->fetch_assoc()) {

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $rows['nombre_reino']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $rows['nombre_division']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $rows['nombre_clase']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $rows['nombre_orden']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $rows['nombre_familia']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $rows['nombre_genero']);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $rows['nombre_epiteto']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $rows['autor']);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $rows['nombre_determinado']);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $rows['altura']);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $rows['nombre_color']);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $rows['nombre_forma']);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $rows['nombre_hoja']);
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $rows['reproduccion']);
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $rows['fuente_informacion']);
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $rows['fecha_registro']);
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $fila, '=P' . $fila . '*Q' . $fila);

        $fila++; //Sumamos 1 para pasar a la siguiente fila
    }

    $fila = $fila - 1;

    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:E" . $fila);

    $filaGrafica = $fila + 2;

// definir origen de los valores
    $values = new PHPExcel_Chart_DataSeriesValues('Number', 'Productos!$D$7:$D$' . $fila);

// definir origen de los rotulos
    $categories = new PHPExcel_Chart_DataSeriesValues('String', 'Productos!$B$7:$B$' . $fila);


    $writer->save('php://output');
}
?>
*/