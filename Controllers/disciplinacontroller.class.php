<?php

/**
 * Classe Controller de Disciplinas
 *
 * @author Joao Victor <joao.joao.joao>
 */
require_once "../Views/disciplinaview.class.php";
require_once "../Models/disciplinamodel.class.php";
require_once "../Ados/disciplinaado.class.php";

class DisciplinaController {

    private $disciplinaView = null;
    private $disciplinaModel = null;
    private $disciplinaAdo = null;
    private $acao = null;

    public function __construct() {
        $this->disciplinaView = new DisciplinaView();
        $this->disciplinaModel = new DisciplinaModel();
        $this->disciplinaAdo = new DisciplinaAdo();

        $this->acao = $this->disciplinaView->getAcao();
        switch ($this->acao) {
            case 'con' :
                $this->consultaDisciplina();

                break;

            case 'inc' :
                $this->incluiDisciplina();

                break;

            case 'alt' :
                $this->alteraDisciplina();

                break;

            case 'exc' :
                $this->excluiDisciplina();

                break;
        }

        $this->disciplinaView->displayInterface($this->disciplinaModel);
    }

    public function __destruct() {
        
    }
    /**
     * consulta Disciplinas
     * 
     */
    private function consultaDisciplina() {
        $this->disciplinaModel = $this->disciplinaView->getDados();

        $this->disciplinaModel = $this->disciplinaAdo->buscaDisciplinaPeloCodigo($this->disciplinaModel->getDiscCodigo());

        if ($this->disciplinaModel) {
            //continue

        } else {
            
        //    $this->disciplinaModel = new MatriculaModel();
            $this->disciplinaView->adicionaMsgErro($this->disciplinaAdo->getMensagem());
            return;
        }
    }
    /**
     * inclui disciplinas
     */
    private function incluiDisciplina() {
        $this->disciplinaModel = $this->disciplinaView->getDados();

        try {
            if ($this->disciplinaAdo->insereObjeto($this->disciplinaModel)) {
                // Limpa os dados
                $this->disciplinaModel = new DisciplinaModel();
                $this->disciplinaView->adicionaMsgSucesso($this->disciplinaAdo->getMensagem());
            } else  {
                $this->disciplinaView->adicionaMsgErro($this->disciplinaAdo->getMensagem());
            }

        } catch (ErroNoBD $e) {
            $this->disciplinaView->adicionaMsgErro("Erro na inclusão. contate o analista.");
            //descomente para debugar
            //$this->disciplinaView->adicionaMensagem($e->getMessage());
        }
    }
    /**
     * altera disciplinas
     */
    private function alteraDisciplina() {
        $this->disciplinaModel = $this->disciplinaView->getDados();

        try {
            $this->disciplinaAdo->alteraObjeto($this->disciplinaModel);
            $this->disciplinaView->adicionaMsgSucesso($this->disciplinaAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->disciplinaView->adicionaMsgErro($e->getMessage());
        }
    }
    /**
     * exclui disciplinas
     */
    private function excluiDisciplina() {
        $this->disciplinaModel = $this->disciplinaView->getDados();

        try {
            $this->disciplinaAdo->excluiObjeto($this->disciplinaModel);
            $this->disciplinaModel = new DisciplinaModel;
            $this->disciplinaView->adicionaMsgSucesso($this->disciplinaAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->disciplinaView->adicionaMsgErro($e->getMessage());
        }
    }
}

?>