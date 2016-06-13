<?php

require 'model.class.php';

class MatriculaCursoModel extends Model {

    private $matrc_curs_id;
    private $matrc_estu_matricula;
    private $matrc_data_inicial;
    private $matrc_data_final;

    function __construct($matrc_curs_id = null, $matrc_estu_matricula = null, $matrc_data_inicial = null, $matrc_data_final = null) {
        $this->matrc_curs_id = $matrc_curs_id;
        $this->matrc_estu_matricula = $matrc_estu_matricula;
        $this->matrc_data_inicial = $matrc_data_inicial;
        $this->matrc_data_final = $matrc_data_final;
    }

    function getMatrcCursId() {
        return $this->matrc_curs_id;
    }

    function getMatrcEstuMatricula() {
        return $this->matrc_estu_matricula;
    }

    function getMatrcDataInicial() {
        return $this->matrc_data_inicial;
    }

    function getMatrcDataFinal() {
        return $this->matrc_data_final;
    }

    function setMatrcCursId($matrc_curs_id) {
        $this->matrc_curs_id = $matrc_curs_id;
    }

    function setMatrcEstuMatricula($matrc_estu_matricula) {
        $this->matrc_estu_matricula = $matrc_estu_matricula;
    }

    function setMatrcDataInicial($matrc_data_inicial) {
        $this->matrc_data_inicial = $matrc_data_inicial;
    }

    function setMatrcDatafinal($matrc_data_final) {
        $this->matrc_data_final = $matrc_data_final;
    }

}
