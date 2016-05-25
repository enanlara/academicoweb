<?php
require_once 'model.class.php';
class DisciplinaModel extends Model {

    private $disc_codigo;
    private $disc_nome;
    private $disc_ementa;

    function __construct($disc_codigo = null, $disc_nome = null, $disc_ementa = null) {
        $this->disc_codigo = $disc_codigo;
        $this->disc_nome = $disc_nome;
        $this->disc_ementa = $disc_ementa;
    }

    function getDiscCodigo() {
        return $this->disc_codigo;
    }

    function getDiscNome() {
        return $this->disc_nome;
    }

    function getDiscEmenta() {
        return $this->disc_ementa;
    }

    function setDiscCodigo($disc_codigo) {
        $this->disc_codigo = $disc_codigo;
    }

    function setDiscNome($disc_nome) {
        $this->disc_nome = $disc_nome;
    }

    function setDiscEmenta($disc_ementa) {
        $this->disc_ementa = $disc_ementa;
    }

}
