<?php
/**
 * Description of matriculaviewmostra
 *
 * @author aluno
 */

class MatrizCursoViewMostra extends MinhaInterface {

    public function montaMeio($matrizModel = null) {
        $meio = "<center><b>Dados da inscrição</b></center>";
        
        $meio .="<br>Matricula: " . $matrizModel ->getMatrzCursId();
        
        $meio .="<br>Nome do aluno: " . $matrizModel ->getMatrzDiscCodigo();
        
        $this->meio = $meio;
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do discente";
    }

    public function getDados() {
        $cursId = $_POST['cursId'];
        $discCodigo = $_POST['discCodigo'];
        
        return new MatrizCursoModel ($cursId, $discCodigo);
    }

}

?>