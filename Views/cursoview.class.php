<?php

require_once 'minhainterface.class.php';

class CursoView extends MinhaInterface {

    public function montaMeio($cursomodel) {
        echo 'df';
        $cursNome = $cursomodel->getCursNome();
        $cursId = $cursomodel->getCursId();
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                    <br>
                <br>Nome <input type='text' name='cursNome' value='{$cursNome}'>{$arrayDeBotoes['con']}
                    <input type='hidden' name='cursId' value='{$cursId}'>
                <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do curso";
    }

    public function getDados() {
        $cursNome = $_POST['cursNome'];
        $cursId = $_POST['cursId'];

        return new CursoModel($cursId, $cursNome);
    }

}
