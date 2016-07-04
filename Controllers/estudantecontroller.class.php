<?php

/**
 * Classe Controller de Estudantes
 *
 * 
 */
require_once "../Views/estudanteview.class.php";
require_once "../Models/estudantemodel.class.php";
require_once "../Ados/estudanteado.class.php";

class EstudanteController
{

    private $estudanteView = null;
    private $estudanteModel = null;
    private $estudanteAdo = null;
    private $acao = null;

    public function __construct()
    {
        $this->estudanteView = new EstudanteView();
        $this->estudanteModel = new EstudantesModel();
        $this->estudanteAdo = new EstudantesAdo();

        $this->acao = $this->estudanteView->getAcao();
        switch ($this->acao) {
            case 'con' :
                $this->consultaMatricula();

                break;

            case 'inc' :
                $this->incluiEstudante();

                break;

            case 'alt' :
                $this->alteraEstudante();

                break;

            case 'exc' :
                $this->excluiEstudante();

                break;
        }

        $this->estudanteView->displayInterface($this->estudanteModel);
    }

    public function __destruct()
    {

    }
    /**
     * consulta estudante pela matricula
     * 
     */
    private function consultaMatricula()
    {

        $this->estudanteModel = $this->estudanteView->getDados();
        $this->estudanteModel = $this->estudanteAdo->buscaMatriculaPelaMatricula($this->estudanteModel->getEstuMatricula());
        // print_r($this->estudanteModel);            
        if ($this->estudanteModel) {
            //continue

        } else {

            //    $this->estudanteModel = new MatriculaModel();
            $this->estudanteView->adicionaMsgErro($this->estudanteAdo->getMensagem());
            return;
        }
    }
    /**
     * inclui estudantes
     * 
     */
    private function incluiEstudante()
    {
        $this->estudanteModel = $this->estudanteView->getDados();

        if ($this->estudanteModel->VerificaObjeto($this->estudanteModel)) {
        } else {
            $this->estudanteView->adicionaMsgErro('Preencha todos os campos');
            return false;
        }

        try {
            if ($this->estudanteAdo->insereObjeto($this->estudanteModel)) {
                // Limpa os dados
                $this->estudanteModel = new estudantesmodel();
                $this->estudanteView->adicionaMsgSucesso($this->estudanteAdo->getMensagem());
            } else {
                $this->estudanteView->adicionaMsgErro($this->estudanteAdo->getMensagem());
            }

        } catch (ErroNoBD $e) {
            $this->estudanteView->adicionaMsgErro("Erro na inclusão. contate o analista.");
            //descomente para debugar
            //$this->estudanteView->adicionaMensagem($e->getMessage());
        }
    }
    /**
     * altera estudantes
     */
    private function alteraEstudante()
    {
        $this->estudanteModel = $this->estudanteView->getDados();

        try {
            $this->estudanteAdo->alteraObjeto($this->estudanteModel);
            $this->estudanteView->adicionaMsgSucesso($this->estudanteAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->estudanteView->adicionaMsgErro($e->getMessage());
        }
    }
    /**
     * exclui estudantes
     */
    private function excluiEstudante()
    {
        $this->estudanteModel = $this->estudanteView->getDados();

        try {
            $this->estudanteAdo->excluiObjeto($this->estudanteModel);
            $this->estudanteView->adicionaMsgSucesso($this->estudanteAdo->getMensagem());
            $this->estudanteModel = new EstudantesModel();
        } catch (ErroNoBD $e) {
            $this->estudanteView->adicionaMsgErro($e->getMessage());
        }
    }
}

?>