<?php


/**
 * Classe Controller de matriculaCurso
 *
 * 
 */
require_once '../Views/matriculacursoview.class.php';
//require_once '../Views/matriculacursoviewmostra.class.php';
require_once '../Models/matriculadecursomodel.class.php';
require_once '../Ados/matriculadecursoado.class.php';
require_once '../Ados/estudanteado.class.php';
require_once '../Ados/cursoado.class.php';

class MatriculaCursoController
{

    private $matriculaCursoView = null;
    private $matriculaCursoModel = null;
    private $matriculaCursoAdo = null;
    private $acao = null;

    public function __construct()
    {


        $this->matriculaCursoView = new MatriculaCursoView();
        $this->matriculaCursoModel = new MatriculaCursoModel();
        $this->matriculaCursoAdo = new MatriculaCursoAdo();

        $this->acao = $this->matriculaCursoView->getAcao();
        switch ($this->acao) {
            case 'con' :
                $this->consultaMatriculaCurso();

                break;

            case 'inc' :
                $this->incluimatriculaCurso();

                break;

            case 'alt' :
                $this->alteraMatriculaCurso();

                break;

            case 'exc' :
                $this->excluimatriculaCurso();

                break;
            default :
                //$this->buscaDisciplinas();
                break;
        }

        $this->matriculaCursoView->displayInterface($this->matriculaCursoModel);
    }

    public function __destruct()
    {

    }
/**
 * consulta matricual curso
 * 
 */
    private function consultaMatriculaCurso()
    {
        $this->matriculaCursoModel = $this->matriculaCursoView->getDados();


        $this->matriculaCursoModel = $this->matriculaCursoAdo->consultaMatriculaCurso($this->matriculaCursoModel->getMatrcEstuMatricula());
        if ($this->matriculaCursoModel) {
            //continue

        } else {
            //  $this->matriculaCursoModel = new MatriculaModel();
            $this->matriculaCursoView->adicionaMensagem($this->matriculaCursoAdo->getMensagem());
            return;
        }
    }
    /**
     * busca disciplinas
     * 
     */
    private function buscaDisciplinas()
    {

        $this->matriculaCursoModel = $this->matriculaCursoAdo->consultaArrayDeObjeto();
        if ($this->matriculaCursoModel) {
            //continue
        } else {
            //  $this->matriculaCursoModel = new MatriculaModel();
            $this->matriculaCursoView->adicionaMensagem($this->matriculaCursoAdo->getMensagem());
            return;
        }
    }
/**
 * inclui matricula curso
 * 
 */
    private function incluimatriculaCurso()
    {

        $this->matriculaCursoModel = $this->matriculaCursoView->getDados();

        if ($this->matriculaCursoModel->VerificaObjeto($this->matriculaCursoModel)) {}
        else {
            $this->matriculaCursoView->adicionaMsgErro('Preencha todos os campos.');
            return false;
        }
        
        try {
            if ($this->matriculaCursoAdo->insereObjeto($this->matriculaCursoModel)) {
                // Limpa os dados
                $this->matriculaCursoModel = new MatriculaCursoModel();
            }
            $this->matriculaCursoView->adicionaMensagem($this->matriculaCursoAdo->getMensagem());

        } catch (ErroNoBD $e) {
            $this->matriculaCursoView->adicionaMensagem("Erro na inclusão. contate o analista.");
            //descomente para debugar
            //$this->matriculaCursoView->adicionaMensagem($e->getMessage());
        }
    }
/**
 * altera matriculacurso
 */
    private function alteraMatriculaCurso()
    {
        $this->matriculaCursoModel = $this->matriculaCursoView->getDados();

        try {
            $this->matriculaCursoAdo->alteraObjeto($this->matriculaCursoModel);
            $this->matriculaCursoView->adicionaMsgSucesso("A matricula foi alterada com sucesso");
            $this->consultaMatriculaCurso();
        } catch (ErroNoBD $e) {
            $this->matriculaCursoView->adicionaMensagem($e->getMessage());
        }
    }
/**
 * exclui matricula curso
 */
    private function excluimatriculaCurso()
    {
        echo 'kjsdflkasfjlkas;';
        $this->matriculaCursoModel = $this->matriculaCursoView->getDados();

        try {
            $this->matriculaCursoAdo->excluiObjeto($this->matriculaCursoModel);
            //$this->buscaDisciplinas();
            $this->matriculaCursoModel = new MatriculaCursoModel;
            $this->matriculaCursoView->adicionaMensagem($this->matriculaCursoAdo->getMensagem());
        } catch (ErroNoBD $e) {
            $this->matriculaCursoView->adicionaMensagem($e->getMessage());
        }
    }

}
