<?php

require 'model.class.php';

class MatriculaDisciplinaModel extends Model
{

    private $MatrdEstuMatricula, $MatrdDiscId, $MatrdNota, $MatrdStatus, $MatrdDataInicial, $MatrdDataFinal;

    /**
     * matriculaPorDisciplina constructor.
     * @param $MatrdEstuMatricula
     * @param $MatrdDiscId
     * @param $MatrdNota
     * @param $MatrdStatus
     * @param $MatrdDataInicial
     * @param $MatrdDataFinal
     */
    public function __construct($MatrdEstuMatricula = null, $MatrdDiscId = null, $MatrdNota = null, $MatrdStatus = null, $MatrdDataInicial = null, $MatrdDataFinal = null)
    {
        $this->MatrdEstuMatricula = $MatrdEstuMatricula;
        $this->MatrdDiscId = $MatrdDiscId;
        $this->MatrdNota = $MatrdNota;
        $this->MatrdStatus = $MatrdStatus;
        $this->MatrdDataInicial = $MatrdDataInicial;
        $this->MatrdDataFinal = $MatrdDataFinal;
    }

    /**
     * @return mixed
     */
    public function getMatrdEstuMatricula()
    {
        return $this->MatrdEstuMatricula;
    }

    /**
     * @param mixed $MatrdEstuMatricula
     */
    public function setMatrdEstuMatricula($MatrdEstuMatricula)
    {
        $this->MatrdEstuMatricula = $MatrdEstuMatricula;
    }

    /**
     * @return mixed
     */
    public function getMatrdDiscId()
    {
        return $this->MatrdDiscId;
    }

    /**
     * @param mixed $MatrdDiscId
     */
    public function setMatrdDiscId($MatrdDiscId)
    {
        $this->MatrdDiscId = $MatrdDiscId;
    }

    /**
     * @return mixed
     */
    public function getMatrdNota()
    {
        return $this->MatrdNota;
    }

    /**
     * @param mixed $MatrdNota
     */
    public function setMatrdNota($MatrdNota)
    {
        $this->MatrdNota = $MatrdNota;
    }

    /**
     * @return mixed
     */
    public function getMatrdStatus()
    {
        return $this->MatrdStatus;
    }

    /**
     * @param mixed $MatrdStatus
     */
    public function setMatrdStatus($MatrdStatus)
    {
        $this->MatrdStatus = $MatrdStatus;
    }

    /**
     * @return mixed
     */
    public function getMatrdDataInicial()
    {
        return $this->MatrdDataInicial;
    }

    /**
     * @param mixed $MatrdDataInicial
     */
    public function setMatrdDataInicial($MatrdDataInicial)
    {
        $this->MatrdDataInicial = $MatrdDataInicial;
    }

    /**
     * @return mixed
     */
    public function getMatrdDataFinal()
    {
        return $this->MatrdDataFinal;
    }

    /**
     * @param mixed $MatrdDataFinal
     */
    public function setMatrdDataFinal($MatrdDataFinal)
    {
        $this->MatrdDataFinal = $MatrdDataFinal;
    }

}
