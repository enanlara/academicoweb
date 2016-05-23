<?php

require_once 'minhainterface.class.php';

class CursoView extends MinhaInterface {

    public function montaMeio($cursomodel) {
        echo 'df';
        $cursNome = $cursomodel->getCursNome();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                    <br>
                <br>Nome <input type='text' name='cursNome' value='{$cursNome}'>{$arrayDeBotoes['con']}
                <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do curso";
    }

    public function getDados() {
        $cursNome = $_POST['cursNome'];

        return new CursoModel( $cursNome);
    }

}
