<?php

require_once 'minhainterface.class.php';

class MatrizCursoView extends MinhaInterface {

    public function montaMeio($matrizcursomodel) {
        $cursId = $matrizcursomodel->getMatrzCursId();
        $discCodigo = $matrizcursomodel->getMatrzDiscCodigo();
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                    <br>
                <br>Id Do Curso <input type='text' name='cursId' value='{$cursId}'>{$arrayDeBotoes['con']}<br>"
                . "<fieldset>"
                        . "<legend>Disciplinas</legend>";
                if($discCodigo != null ){
                    foreach ($discCodigo as $dados){
                        $this->meio .= " <input type='checkbox' name='discCodigo[]' {$dados->checked} value='{$dados->discCodigo}'> {$dados->discNome}<br>";
                    }
                }
               $this->meio .="</fieldset> <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do curso";
    }

    public function getDados() {
        $cursId = $_POST['cursId'];
        if(isset($_POST['discCodigo'])){
        $discCodigo  =$_POST['discCodigo'];
        }else{
            $discCodigo = null;
        }
        return new MatrizCursoModel($cursId, $discCodigo);
    }

}
