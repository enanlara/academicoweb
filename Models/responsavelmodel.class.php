<?php

class responsaveismodel extends Model {

    private $resp_disc_id;
    private $resp_prof_siape;
    private $resp_ano;
    private $resp_semestre;

    function __construct($resp_disc_id = null, $resp_prof_siape = null, $resp_ano = null, $resp_semestre = null) {
        $this->resp_disc_id = $resp_disc_id;
        $this->resp_prof_siape = $resp_prof_siape;
        $this->resp_ano = $resp_ano;
        $this->resp_semestre = $resp_semestre;
    }

    function getIdDisciplina() {
        return $this->resp_disc_id;
    }

    function getSiapeProfessor() {
        return $this->resp_prof_siape;
    }

    function getAno() {
        return $this->resp_ano;
    }

    function getSemestre() {
        return $this->resp_semestre;
    }

    function setIdDisciplina($resp_disc_id) {
        $this->resp_disc_id = $resp_disc_id;
    }

    function setSiapeProfessor($resp_prof_siape) {
        $this->resp_prof_siape = $resp_prof_siape;
    }

    function setAno($resp_ano) {
        $this->resp_ano = $resp_ano;
    }

    function setSemestre($resp_semestre) {
        $this->resp_semestre = $resp_semestre;
    }

}
