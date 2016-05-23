<?php
require 'model.class.php';

class ProfessorModel extends Model {

    private $prof_siape;
    private $prof_nome;

    function __construct($prof_siape = null, $prof_nome = null) {
        $this->prof_siape = $prof_siape;
        $this->prof_nome = $prof_nome;
    }

    function getProfSiape() {
        return $this->prof_siape;
    }

    function getProfNome() {
        return $this->prof_nome;
    }

    function setProfSiape($prof_siape) {
        $this->prof_siape = $prof_siape;
    }

    function setProfNome($prof_nome) {
        $this->prof_nome = $prof_nome;
    }

}
