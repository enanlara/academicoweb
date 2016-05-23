<?php

require_once 'model.class.php';

class EstudantesModel extends Model {
    private $estuMatricula;
    private $estuNome;

    function __construct($estuMatricula = NULL, $estuNome = NULL) {
        $this->estuMatricula = $estuMatricula;
        $this->estuNome = $estuNome;
    }

    function getEstuMatricula() {
        return $this->estuMatricula;
    }

    function getEstuNome() {
        return $this->estuNome;
    }

    function setEstuMatricula($estuMatricula) {
        $this->estuMatricula = $estuMatricula;
    }

    function setEstuNome($estuNome) {
        $this->estuNome = $estuNome;
    }

}
