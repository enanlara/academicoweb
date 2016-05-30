<?php
require_once 'model.class.php';
class MatrizCursoModel extends Model {

    private $matrz_curs_id;
    private $matrz_disc_codigo;

    function __construct($matrz_curs_id = null, $matrz_disc_codigo = null) {
        $this->matrz_curs_id = $matrz_curs_id;
        $this->matrz_disc_codigo = $matrz_disc_codigo;
    }

    function getMatrzCursId() {
        return $this->matrz_curs_id;
    }

    function getMatrzDiscCodigo() {
        return $this->matrz_disc_codigo;
    }

    function setMatrzCursId($matrz_curs_id) {
        $this->matrz_curs_id = $matrz_curs_id;
    }

    function setMatrzDiscCodigo($matrz_disc_codigo) {
        $this->matrz_disc_codigo = $matrz_disc_codigo;
    }

}
