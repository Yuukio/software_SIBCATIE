<?php

class Uso {

    private $idUso;
    private $nombre_uso;

    public function __construct($idUso, $nombre_uso) {
        $this->idUso = $idUso;
        $this->nombre_uso = $nombre_uso;
    }

    public function getIdUso() {
        return $this->idUso;
    }

    public function getNombreUso() {
        return $this->nombre_uso;
    }

    public function setNombreUso($nombre_uso) {
        $this->nombre_uso = $nombre_uso;
    }

}
