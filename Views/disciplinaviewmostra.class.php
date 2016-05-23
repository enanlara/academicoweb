<?php
/**
 * Description of matriculaviewmostra
 *
 * @author joao
 */

class DisciplinaViewMostra extends MinhaInterface {

    public function montaMeio($disciplinaModel = null) {
        $meio = "<center><b>Dados da inscrição</b></center>";
        
        $meio .="<br>Matricula: " . $matriculaModel ->getmatricula();
        
        $meio .="<br>Nome do aluno: " . $matriculaModel ->getnome();
        
        $this->meio = $meio;
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do discente";
    }

    public function getDados() {
        $matricula = $_POST['matricula'];
        $nome = $_POST['nome'];
        
        return new MatriculaModel ($matricula, $nome);
    }

}

?>