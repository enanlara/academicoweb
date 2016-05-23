<?php

require_once 'minhainterface.class.php';

class EstudanteView extends MinhaInterface {

    public function montaMeio($estudantesmodel) {
        $estuMatricula = $estudantesmodel->getEstuMatricula();
        $estuNome = $estudantesmodel->getEstuNome();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                <br>Matricula <input type='text' name='estuMatricula' value='{$estuMatricula}'>{$arrayDeBotoes['con']}
                    <br>
                <br>Nome <input type='text' name='estuNome' value='{$estuNome}'>
                <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do discente";
    }

    public function getDados() {
        $estuMatricula = $_POST['estuMatricula'];
        $estuNome = $_POST['estuNome'];

        return new estudantesmodel($estuMatricula, $estuNome);
    }

}
