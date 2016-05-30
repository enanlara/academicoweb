<?php
/**
 * Description of matriculaviewmostra
 *
 * @author aluno
 */

class CursoViewMostra extends MinhaInterface {

    public function montaMeio($matriculaModel = null) {
        $meio = "<center><b>Dados da inscrição</b></center>";
        
        $meio .="<br>Matricula: " . $matriculaModel ->getCursId();
        
        $meio .="<br>Nome do aluno: " . $matriculaModel ->getCursNome();
        
        $this->meio = $meio;
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do discente";
    }

    public function getDados() {
        $matricula = $_POST['cursId'];
        $nome = $_POST['cursNome'];
        
        return new CursoModel($matricula, $nome);
    }

}

?>