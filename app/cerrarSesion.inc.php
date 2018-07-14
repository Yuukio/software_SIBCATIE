<?php

include_once 'ControlSesion.inc.php';
include_once 'Conexion.inc.php';
include_once 'config.inc.php';

ControlSesion::cerrarSesion();

header("Location: ../index.php");