<?php

require_once 'minhainterface.class.php';

class DisciplinaView extends MinhaInterface {

    public function montaMeio($disciplinamodel) {
        $discCodigo = $disciplinamodel->getDiscCodigo();
        $discNome = $disciplinamodel->getDiscNome();
        $discEmenta = $disciplinamodel->getDiscEmenta();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                <br>Codigo <input type='text' name='discCodigo' value='{$discCodigo}'>{$arrayDeBotoes['con']}
                    <br>
                <br>Nome <input type='text' name='discNome' value='{$discNome}'>
                    <br>Ementa <input type='text' name='discEmenta' value='{$discEmenta}'>
                <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição da Disciplina";
    }

    public function getDados() {
        $discCodigo = $_POST['discCodigo'];
        $discNome = $_POST['discNome'];
        $discEmenta = $_POST['discEmenta'];

        return new DisciplinaModel($discCodigo, $discNome, $discEmenta);
    }



 

}
