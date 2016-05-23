<?php

class disciplinamodel extends Model {

    private $disc_codigo;
    private $disc_nome;
    private $disc_ementa;

    function __construct($disc_codigo = null, $disc_nome = null, $disc_ementa = null) {
        $this->disc_codigo = $disc_codigo;
        $this->disc_nome = $disc_nome;
        $this->disc_ementa = $disc_ementa;
    }

    function getCodigo() {
        return $this->disc_codigo;
    }

    function getNome() {
        return $this->disc_nome;
    }

    function getEmenta() {
        return $this->disc_ementa;
    }

    function setCodigo($disc_codigo) {
        $this->disc_codigo = $disc_codigo;
    }

    function setNome($disc_nome) {
        $this->disc_nome = $disc_nome;
    }

    function setEmenta($disc_ementa) {
        $this->disc_ementa = $disc_ementa;
    }

}
