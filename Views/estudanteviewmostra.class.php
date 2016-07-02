<?php
/**
 * Description of matriculaviewmostra
 *
 * @author aluno
 */

class EstudanteViewMostra extends MinhaInterface {

    public function montaMeio($matriculaModel = null) {
        $meio = "<center><b>Dados da inscrição</b></center>";
        
        $meio .="<br>Matricula: " . $matriculaModel ->getmatricula();
        
        $meio .="<br>Nome do aluno: " . $matriculaModel ->getnome();
        
        $this->meio = $meio;
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do discente";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados() {
        $matricula = $_POST['matricula'];
        $nome = $_POST['nome'];
        
        return new MatriculaModel ($matricula, $nome);
    }

}

?>