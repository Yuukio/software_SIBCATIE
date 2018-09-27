<?php

include_once 'Conexion.inc.php';
include_once 'conexion2.php';
include_once 'ControlSesion.inc.php';

$titulo = 'CONSULTA';

Conexion::abrir_conexion();

function form_mail($sPara, $sAsunto, $sTexto, $sDe) {
    $bHayFicheros = 0;
    $sCabeceraTexto = "";
    $sAdjuntos = "";

    if ($sDe)
        $sCabeceras = "From:" . $sDe . "\n";
    else
        $sCabeceras = "";
    $sCabeceras .= "MIME-version: 1.0\n";
    foreach ($_POST as $sNombre => $sValor)
        $sTexto = $sTexto . "\n" . $sNombre . " = " . $sValor;

    foreach ($_FILES as $vAdjunto) {
        if ($bHayFicheros == 0) {
            $bHayFicheros = 1;
            $sCabeceras .= "Content-type: multipart/mixed;";
            $sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

            $sCabeceraTexto = "----_Separador-de-mensajes_--\n";
            $sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
            $sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

            $sTexto = $sCabeceraTexto . $sTexto;
        }
        if ($vAdjunto["size"] > 0) {
            $sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
            $sAdjuntos .= "Content-type: " . $vAdjunto["type"] . ";name=\"" . $vAdjunto["name"] . "\"\n";
            ;
            $sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
            $sAdjuntos .= "Content-disposition: attachment;filename=\"" . $vAdjunto["name"] . "\"\n\n";

            $oFichero = fopen($vAdjunto["tmp_name"], 'r');
            $sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
            $sAdjuntos .= chunk_split(base64_encode($sContenido));
            fclose($oFichero);
        }
    }

    if ($bHayFicheros)
        $sTexto .= $sAdjuntos . "\n\n----_Separador-de-mensajes_----\n";
    return(mail($sPara, $sAsunto, $sTexto, $sCabeceras));
}

//cambiar aqui el email 
if (form_mail("ruisu.08@gmail.com", $_POST[asunto], "Los datos introducidos en el formulario son:\n\n", $_POST[email])) {
    ?>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <div class="container-fluid" style="padding-top: 100px">
        
        <div style="text-align: center;">
            <img src="../img/check-circle.gif" width="200" style="max-width: 100%" alt="">
            <br>
            <br>
        </div>
        
        <div class="jumbotron" style="text-align: center">
            
            <h1>Su consulta ha sido enviada con éxito.</h1>
            <br>
            <br>
            <a href="javascript:history.go(-1);" class="btn bg-info btn-lg" style="opacity: 1">
                <span style="color: white">Regresar</span>
            </a>
        </div>

    </div>

    <?php
}

include_once '../plantillas/documento-cierre.inc.php';

?>