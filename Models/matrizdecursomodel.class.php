<?php

class matrizesDeCursos extends Model {

    private $matrz_curs_id;
    private $matrz_disc_codigo;

    function __construct($matrz_curs_id = null, $matrz_disc_codigo = null) {
        $this->matrz_curs_id = $matrz_curs_id;
        $this->matrz_disc_codigo = $matrz_disc_codigo;
    }

    function getMatrz_curs_id() {
        return $this->matrz_curs_id;
    }

    function getMatrz_disc_codigo() {
        return $this->matrz_disc_codigo;
    }

    function setMatrz_curs_id($matrz_curs_id) {
        $this->matrz_curs_id = $matrz_curs_id;
    }

    function setMatrz_disc_codigo($matrz_disc_codigo) {
        $this->matrz_disc_codigo = $matrz_disc_codigo;
    }

}
