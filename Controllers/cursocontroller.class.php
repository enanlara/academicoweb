<?php

/**
 * Classe Controller de Cursos
 *
 */
require_once "../Views/cursoview.class.php";
require_once "../Models/cursomodel.class.php";
require_once "../Ados/cursoado.class.php";

class CursoController {

    private $cursoView = null;
    private $cursoModel = null;
    private $cursoAdo = null;
    private $acao = null;

    public function __construct() {
        $this->cursoView = new CursoView();
        $this->cursoModel = new CursoModel();
        $this->cursoAdo = new CursoAdo();



        $this->acao = $this->cursoView->getAcao();
        switch ($this->acao) {
            case 'con' :
                $this->buscaCurso();

                break;

            case 'inc' :
                $this->incluiCurso();

                break;

            case 'alt' :
                $this->alteraCurso();

                break;

            case 'exc' :
                $this->excluiCurso();

                break;

            default:

                break;
        }

        $this->cursoView->displayInterface($this->cursoModel);
    }

    public function __destruct() {
        
    }
    /**
     * Busca cursos 
     * 
     */
    private function buscaCurso() {
        $this->cursoModel = $this->cursoView->getDados();

        $this->cursoModel = $this->cursoAdo->buscaCurso($this->cursoModel->getCursId());

        if ($this->cursoModel) {
            //continue
        } else {

            //    $this->cursoModel = new MatriculaModel();
            $this->cursoView->adicionaMsgSucesso($this->cursoAdo->getMensagem());
            return;
        }
    }
    /**
     * Inclui cursos
     * 
     */
    private function incluiCurso() {
        $this->cursoModel = $this->cursoView->getDados();

        if ($this->cursoModel->VerificaObjeto($this->cursoModel)) {} 
        else {
            $this->cursoView->adicionaMsgErro('Preencha todos os campos.');
            return false;
        }

        try {
            if ($this->cursoAdo->insereObjeto($this->cursoModel)) {
                // Limpa os dados
                $this->cursoModel = new cursomodel();
            }
            $this->cursoView->adicionaMsgSucesso($this->cursoAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->cursoView->adicionaMensagem("Erro na inclusão. contate o analista.");
            //descomente para debugar
            //$this->cursoView->adicionaMensagem($e->getMessage());
        }
    }
    /**
     * altera cursos
     */
    private function alteraCurso() {
        $this->cursoModel = $this->cursoView->getDados();

        try {
            $this->cursoAdo->alteraObjeto($this->cursoModel);
            $this->cursoView->adicionaMensagem($this->cursoAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->cursoView->adicionaMensagem($e->getMessage());
        }
    }
    /**
     * exclui cursos
     */
    private function excluiCurso() {
        $this->cursoModel = $this->cursoView->getDados();

        try {
            $this->cursoAdo->excluiObjeto($this->cursoModel);
            $this->cursoView->adicionaMsgSucesso($this->cursoAdo->getMensagem());
            $this->cursoModel = new CursoModel();
        } catch (ErroNoBD $e) {
            $this->cursoView->adicionaMensagem($e->getMessage());
        }
    }

}

?>