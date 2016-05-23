<?php

require_once 'minhainterface.class.php';

class ProfessorView extends MinhaInterface {

    public function montaMeio($professormodel) {
        $profSiape = $professormodel->getProfSiape();
        $profNome = $professormodel->getProfNome();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                <br>Siape <input type='text' name='profSiape' value='{$profSiape}'>{$arrayDeBotoes['con']}
                    <br>
                <br>Nome <input type='text' name='profNome' value='{$profNome}'>
                <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do professor";
    }

    public function getDados() {
        $profSiape = $_POST['profSiape'];
        $profNome = $_POST['profNome'];

        return new professormodel($profSiape, $profNome);
    }

}
