<?php

/**
 * Classe View da inscrição de ouvintes.
 *
 * @author Elymar Pereira Cabral <elymar.cabral@ifg.edu.br>
 */
require_once "../Views/responsavelview.class.php";
require_once "../Views/responsavelviewmostra.class.php";
require_once "../Models/responsavelmodel.class.php";
require_once "../Ados/responsavelado.class.php";
//require "../Ados/professorado.class.php";

class ResponsavelController {

    private $responsavelView = null;
    private $responsavelModel = null;
    private $responsavelAdo = null;
    private $disciplinaAdo = null;
    private $professorAdo = null;
    private $acao = null;

    public function __construct() {


        $this->responsavelView = new ResponsavelView();
        $this->responsavelModel = new ResponsavelModel();
        $this->responsavelAdo = new ResponsavelAdo();
        //$this->disciplinaAdo = new DisciplinaAdo();
        //$this->professorAdo = new ProfessorAdo();

        $this->acao = $this->responsavelView->getAcao();
        switch ($this->acao) {
            case 'con' :
                $this->consultaResponsavel();

                break;

            case 'inc' :
                $this->incluiResponsavel();

                break;

            case 'alt' :
                $this->alteraResponsavel();

                break;

            case 'exc' :
                $this->excluiResponsavel();

                break;
            default :
                $this->buscaDados();
        }
        $this->responsavelView->displayInterface($this->responsavelModel);
    }

    public function __destruct() {
        
    }

    private function consultaResponsavel() {
        $this->responsavelModel = $this->responsavelView->getDados();

        $this->responsavelModel = $this->responsavelAdo->buscaPeloSiape($this->responsavelModel->getProfSiape());

        if ($this->responsavelModel) {
            //continue
        } else {
            //  $this->responsavelModel = new MatriculaModel();
            $this->responsavelView->adicionaMensagem($this->responsavelAdo->getMensagem());
            return;
        }
    }

    private function incluiResponsavel() {
        $this->responsavelModel = $this->responsavelView->getDados();
        if($this->responsavelModel->getDisc() == '-1' || $this->responsavelModel->getProf()){
            $this->responsavelView->adicionaMensagem("Selecione uma Disciplina!!!");
            
        }
        

        try {
            if ($this->responsavelAdo->insereObjeto($this->responsavelModel)) {
                // Limpa os dados
                $this->responsavelModel = new responsavelmodel();
                                $this->buscaDados();

            }
            $this->responsavelView->adicionaMensagem($this->responsavelAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->responsavelView->adicionaMensagem("Erro na inclusão. contate o analista.");
            //descomente para debugar
            //$this->responsavelView->adicionaMensagem($e->getMessage());
        }
    }

    private function alteraResponsavel() {
        $this->responsavelModel = $this->responsavelView->getDados();

        try {
            $this->responsavelAdo->alteraObjeto($this->responsavelModel);
            $this->responsavelView->adicionaMensagem($this->responsavelAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->responsavelView->adicionaMensagem($e->getMessage());
        }
    }

    private function excluiResponsavel() {
        $this->responsavelModel = $this->responsavelView->getDados();

        try {
            $this->responsavelAdo->excluiObjeto($this->responsavelModel);
            $this->responsavelView->adicionaMensagem($this->responsavelAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->responsavelView->adicionaMensagem($e->getMessage());
        }
    }

    private function buscaDados() {
        try {
            $this->responsavelModel->setDisc($this->responsavelAdo->buscaDisciplina());
            $this->responsavelModel->setProf($this->responsavelAdo->buscaProfessor());
            //var_dump($this->responsavelAdo->buscaProfessor());
        } catch (ErroNoBD $e) {
            $this->responsavelView->adicionaMensagem($e->getMessage());
        }
    }

}

?>