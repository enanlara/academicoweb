<?php
require_once 'model.class.php';

class ResponsavelModel extends Model
{

    private $resp_disc;
    private $resp_prof;
    private $resp_ano;
    private $resp_semestre;

    function __construct($resp_disc = null, $resp_prof = null, $resp_ano = null, $resp_semestre = null)
    {
        $this->resp_disc = $resp_disc;
        $this->resp_prof = $resp_prof;
        $this->resp_ano = $resp_ano;
        $this->resp_semestre = $resp_semestre;

    }

    function getDisc()
    {
        return $this->resp_disc;
    }

    function getProf()
    {
        return $this->resp_prof;
    }

    function getAno()
    {
        return $this->resp_ano;
    }

    function getSemestre()
    {
        return $this->resp_semestre;
    }

    function setDisc($resp_disc)
    {
        $this->resp_disc = $resp_disc;
    }

    function setProf($resp_prof)
    {
        $this->resp_prof = $resp_prof;
    }

    function setAno($resp_ano)
    {
        $this->resp_ano = $resp_ano;
    }

    function setSemestre($resp_semestre)
    {
        $this->resp_semestre = $resp_semestre;
    }

}
