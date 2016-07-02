<?php
/**
 * Description of matriculaviewmostra
 *
 * @author joao
 */

class DisciplinaViewMostra extends MinhaInterface {

    public function montaMeio($disciplinaModel = null) {
        $meio = "<center><b>Dados da inscrição</b></center>";
        
        $meio .="<br>Matricula: " . $disciplinaModel ->getDiscCodigo();
        
        $meio .="<br>Nome do aluno: " . $disciplinaModel ->getDiscNome();
        
        $meio .="<br>Ementa ". $disciplinaModel->getDiscEmenta();
        
        $this->meio = $meio;
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do discente";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados() {
        
        $discCodigo= $_POST['discCodigo'];
        $discNome = $_POST['discNome'];
        $discEmenta = $_POST['discEmenta'];
        
        return new DisciplinaModel ($discCodigo, $discNome, $discEmenta);
    }

}

?>