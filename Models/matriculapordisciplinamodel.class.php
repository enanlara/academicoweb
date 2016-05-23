<?php

class matriculaPorDisciplina extends Model {

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

    function getMatrc_curs_id() {
        return $this->matrc_curs_id;
    }

    function getMatrc_estu_matricula() {
        return $this->matrc_estu_matricula;
    }

    function getMatrc_data_inicial() {
        return $this->matrc_data_inicial;
    }

    function getMatrc_data_final() {
        return $this->matrc_data_final;
    }

    function setMatrc_curs_id($matrc_curs_id) {
        $this->matrc_curs_id = $matrc_curs_id;
    }

    function setMatrc_estu_matricula($matrc_estu_matricula) {
        $this->matrc_estu_matricula = $matrc_estu_matricula;
    }

    function setMatrc_data_inicial($matrc_data_inicial) {
        $this->matrc_data_inicial = $matrc_data_inicial;
    }

    function setMatrc_data_final($matrc_data_final) {
        $this->matrc_data_final = $matrc_data_final;
    }

}
