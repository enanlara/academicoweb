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
                <br>Ementa <input type='text' name='Ementa' value='{$discementa}'>{$arrayDeBotoes['con']}
                    <br>
                <br>Nome <input type='text' name='Nome' value='{$discnome}'>
                    <br>Codigo <input type='hidden' name='Codigo' value='{$disccodigo}'>
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

        return new disciplinamodel($disc_codigo, $disc_nome, $disc_ementa);
    }

}
