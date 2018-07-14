<?php

include_once 'app/Conexion.inc.php';
include_once 'app/Genero.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/Colores.inc.php';
include_once 'app/Continente.inc.php';
include_once 'app/DeterminadaPor.inc.php';
include_once 'app/Epiteto.inc.php';
include_once 'app/EstadoSaludo.inc.php';
include_once 'app/Familia.inc.php';
include_once 'app/Forma.inc.php';
include_once 'app/TipoHoja.inc.php';
include_once 'app/Uso.inc.php';
include_once 'app/ZonaCardinal.inc.php';

include_once 'app/RepositorioGenero.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioColores.inc.php';
include_once 'app/RepositorioContinente.inc.php';
include_once 'app/RepositorioDeterminadaPor.inc.php';
include_once 'app/RepositorioEpiteto.php';
include_once 'app/RepositorioEstadoSalud.inc.php';
include_once 'app/RepositorioFamilia.inc.php';
include_once 'app/RepositorioForma.inc.php';
include_once 'app/RepositorioTipoHoja.inc.php';
include_once 'app/RepositorioUso.inc.php';
include_once 'app/RepositorioZonaCardinal.inc.php';

Conexion::abrir_conexion();

/* * ****USUARIO */
for ($i = 0; $i < 50; $i++) {
    $nombre = sa(10);
    $apellido = sa(8);
    $email = sa(5) . '@' . sa(3) . '.com';
    $nombre_usuario = sa(6);
    $password = password_hash('123456', PASSWORD_DEFAULT);
    $telefono = 88888888;

    $usuario = new Usuario('', $nombre, $apellido, $email, $nombre_usuario, $password, '', '', '', $telefono);

    RepositorioUsuario::insertarUsuario(Conexion::obtener_conexion(), $usuario);
}
/* * ***GENERO */
for ($i = 0; $i < 30; $i++) {
    $nombre_genero = sa(15);

    $genero = new Genero('', $nombre_genero);

    RepositorioGenero::insertarGenero(Conexion::obtener_conexion(), $genero);
}

/* * ***EPITETO */
for ($i = 0; $i < 30; $i++) {
    $nombre_epiteto = sa(10);
    $referencia = sa(2) . '.' . sa(10);

    $epiteto = new Epiteto('', $nombre_epiteto, $referencia);

    RepositorioEpiteto::insertarEpiteto(Conexion::obtener_conexion(), $epiteto);
}

/* * ***COLOR */
for ($i = 0; $i < 10; $i++) {
    $nombre_color = sa(10);

    $color = new Colores('', $nombre_color);

    RepositorioColor::insertarColor(Conexion::obtener_conexion(), $color);
}

/* * ***DETERMINADA POR */
for ($i = 0; $i < 15; $i++) {
    $nombre_determinada = sa(15);

    $determinada_por = new DeterminadaPor('', $nombre_determinada, '');

    RepositorioDeterminadaPor::insertarDeterminadaPor(Conexion::obtener_conexion(), $determinada_por);
}

/* * ***ESTADO SALUD */
for ($i = 0; $i < 1; $i++) {

    $nombre_estado1 = '1- Apariencia muy saludable (80-100%)';
    $nombre_estado2 = '2- Apariencia 60-80% saludable';
    $nombre_estado3 = '3- Apariencia 40-60% saludable';
    $nombre_estado4 = '4-Apariencia 20-40% saludable';
    $nombre_estado5 = '5- Apariencia hasta un 29% saludable (poco saludable)';

    $estado_salud1 = new EstadoSaludo('', $nombre_estado1);
    $estado_salud2 = new EstadoSaludo('', $nombre_estado2);
    $estado_salud3 = new EstadoSaludo('', $nombre_estado3);
    $estado_salud4 = new EstadoSaludo('', $nombre_estado4);
    $estado_salud5 = new EstadoSaludo('', $nombre_estado5);

    RepositorioEstadoSalud::insertarEstadoSalud(Conexion::obtener_conexion(), $estado_salud1);
    RepositorioEstadoSalud::insertarEstadoSalud(Conexion::obtener_conexion(), $estado_salud2);
    RepositorioEstadoSalud::insertarEstadoSalud(Conexion::obtener_conexion(), $estado_salud3);
    RepositorioEstadoSalud::insertarEstadoSalud(Conexion::obtener_conexion(), $estado_salud4);
    RepositorioEstadoSalud::insertarEstadoSalud(Conexion::obtener_conexion(), $estado_salud5);
}

/* * ***FAMILIA */
for ($i = 0; $i < 50; $i++) {
    $nombre_familia = sa(15);

    $familia = new Familia('', $nombre_familia);

    RepositorioFamilia::insertarFamilia(Conexion::obtener_conexion(), $familia);
}

/* * ***FORMA */
for ($i = 0; $i < 10; $i++) {
    $nombre_forma = sa(10);
    $caracteristicas = lorem();

    $forma = new Forma('', $nombre_forma, $caracteristicas);

    RepositorioForma::insertarForma(Conexion::obtener_conexion(), $forma);
}

/* * ***TIPO HOJA */
for ($i = 0; $i < 10; $i++) {
    $nombre_hoja = sa(10);
    $forma = sa(8);

    $hoja = new TipoHoja('', $nombre_hoja, $forma);

    RepositorioTipoHoja::insertarTipoHoja(Conexion::obtener_conexion(), $hoja);
}

/* * ***ZONA CARDINAL */
for ($i = 0; $i < 4; $i++) {
    $nombre_cardinal = sa(10);

    $cardinal = new ZonaCardinal('', $nombre_cardinal);

    RepositorioZonaCardinal::insertarZonaCardinal(Conexion::obtener_conexion(), $cardinal);
}

/* * ***CONTINENTE */
for ($i = 0; $i < 1; $i++) {

    $continente1 = new Continente('', 'America');
    $continente2 = new Continente('', 'Africa');
    $continente3 = new Continente('', 'Asia');
    $continente4 = new Continente('', 'Europa');
    $continente5 = new Continente('', 'Oceania');

    RepositorioContinente::insertarContinente(Conexion::obtener_conexion(), $continente1);
    RepositorioContinente::insertarContinente(Conexion::obtener_conexion(), $continente2);
    RepositorioContinente::insertarContinente(Conexion::obtener_conexion(), $continente3);
    RepositorioContinente::insertarContinente(Conexion::obtener_conexion(), $continente4);
    RepositorioContinente::insertarContinente(Conexion::obtener_conexion(), $continente5);
}

/* * ***USO */
for ($i = 0; $i < 20; $i++) {
    $nombre_uso = sa(10);

    $uso = new Uso('', $nombre_uso);

    RepositorioUso::insertarUso(Conexion::obtener_conexion(), $uso);
}

function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }

    return $string_aleatorio;
}

function lorem() {

    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id tristique enim, vel venenatis erat.';

    return $lorem;
}
