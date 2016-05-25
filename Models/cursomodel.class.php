<?php
require_once 'model.class.php';

class CursoModel extends Model {

    private $curs_id;
    private $curs_nome;

    function __construct($curs_id = null, $curs_nome = null) {
        $this->curs_id = $curs_id;
        $this->curs_nome = $curs_nome;
        
    }

    function getCursId() {
        return $this->curs_id;
    }

    function getCursNome() {
        return $this->curs_nome;
    }

    function setCursId($curs_id) {
        $this->curs_id = $curs_id;
    }

    function setCursNome($curs_nome) {
        $this->curs_nome = $curs_nome;
    }

}
