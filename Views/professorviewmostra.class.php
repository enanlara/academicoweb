<?php
/**
 * Description of matriculaviewmostra
 *
 * @author aluno
 */

class ProfessorViewMostra extends MinhaInterface {

    public function montaMeio($matriculaModel = null) {
        $meio = "<center><b>Dados da inscrição</b></center>";
        
        $meio .="<br>Siape: " . $matriculaModel ->getSiape();
        
        $meio .="<br>Nome do Professor: " . $matriculaModel ->getnome();
        
        $this->meio = $meio;
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do professor";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados() {
        $matricula = $_POST['siape'];
        $nome = $_POST['nome'];
        
        return new MatriculaModel ($siape, $nome);
    }

}

?>