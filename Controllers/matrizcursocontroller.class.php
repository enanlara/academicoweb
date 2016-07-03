<?php

/**
 * Classe Controller MatrizCurso
 */
require_once '../Views/matrizcursoview.class.php';
require_once '../Models/matrizdecursomodel.class.php';
require_once '../Ados/matrizdecursoado.class.php';
require_once '../Ados/cursoado.class.php';

class matrizCursoController {

    private $matrizCursoView = null;
    private $matrizCursoModel = null;
    private $matrizCursoAdo = null;
    private $acao = null;

    public function __construct() {
        
        $this->matrizCursoView = new MatrizCursoView();
        $this->matrizCursoModel = new MatrizCursoModel();
        $this->matrizCursoAdo = new MatrizCursoAdo();

        $this->acao = $this->matrizCursoView->getAcao();
        switch ($this->acao) {
            case 'con' :
                $this->consultaMatrizCurso();

                break;

            case 'inc' :
                $this->incluimatrizCurso();

                break;

            case 'alt' :
                $this->alteraMatrizCurso();

                break;

            case 'exc' :
                $this->excluimatrizCurso();

                break;
            default :
                $this->buscaDisciplinas();
        }

        $this->matrizCursoView->displayInterface($this->matrizCursoModel);
    }

    public function __destruct() {
        
    }
/**
 * Consulta matrizCurso
 * 
 */
    private function consultaMatrizCurso() {
        $this->matrizCursoModel = $this->matrizCursoView->getDados();

        $this->matrizCursoModel->setMatrzDiscCodigo($this->matrizCursoAdo->consultaMatriz($this->matrizCursoModel->getMatrzCursId()));
        if ($this->matrizCursoModel) {
            //continue
        } else {
            //  $this->matrizCursoModel = new MatriculaModel();
            $this->matrizCursoView->adicionaMensagem($this->matrizCursoAdo->getMensagem());
            return;
        }
    }
/**
 * busca Disciplinas
 * 
 */
    private function buscaDisciplinas() {

        $this->matrizCursoModel->setMatrzDiscCodigo($this->matrizCursoAdo->consultaArrayDeObjeto());
        if ($this->matrizCursoModel) {
            //continue
        } else {
            //  $this->matrizCursoModel = new MatriculaModel();
            $this->matrizCursoView->adicionaMensagem($this->matrizCursoAdo->getMensagem());
            return;
        }
    }
/**
 * inclui matriz
 * 
 */
    private function incluimatrizCurso() {
        $this->matrizCursoModel = $this->matrizCursoView->getDados();

        if ($this->matrizCursoModel->VerificaObjeto($this->matrizCursoModel)) {}
        else {
            $this->matrizCursoView->adicionaMsgErro('Preencha todos os campos.');
            return false;
        }
        
        try {
            if ($this->matrizCursoAdo->insereObjeto($this->matrizCursoModel)) {
                // Limpa os dados
                $this->matrizCursoModel = new MatrizCursoModel();
            }
            $this->matrizCursoView->adicionaMensagem($this->matrizCursoAdo->getMensagem());
            $this->buscaDisciplinas();
        } catch (ErroNoBD $e) {
            $this->matrizCursoView->adicionaMensagem("Erro na inclusão. contate o analista.");
            //descomente para debugar
            //$this->matrizCursoView->adicionaMensagem($e->getMessage());
        }
    }
/**
 * altera matriz
 */
    private function alteraMatrizCurso() {
        $this->matrizCursoModel = $this->matrizCursoView->getDados();

        try {
            $this->matrizCursoAdo->alteraObjeto($this->matrizCursoModel);
            $this->matrizCursoView->adicionaMsgSucesso("A matriz foi alterada com sucesso");
            $this->consultaMatrizCurso();
        } catch (ErroNoBD $e) {
            $this->matrizCursoView->adicionaMensagem($e->getMessage());
        }
    }
/**
 * exclui matriz
 */
    private function excluimatrizCurso() {
        $this->matrizCursoModel = $this->matrizCursoView->getDados();

        try {
            $this->matrizCursoAdo->excluiObjeto($this->matrizCursoModel);
            $this->buscaDisciplinas();
            $this->matrizCursoView->adicionaMensagem($this->matrizCursoAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->matrizCursoView->adicionaMensagem($e->getMessage());
        }
    }

}
