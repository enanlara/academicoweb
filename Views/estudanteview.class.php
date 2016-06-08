<?php

require_once 'minhainterface.class.php';

class EstudanteView extends MinhaInterface {

    public function montaMeio($estudantesmodel) {
        $estudanteAdo = new EstudantesAdo();
        $estudantes   = $estudanteAdo->lista();
        
        $estuMatricula = $estudantesmodel->getEstuMatricula();
        $estuNome = $estudantesmodel->getEstuNome();
       // echo $estudantesmodel->getEstuMatricula();
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>";

        /* if ($estudantes) {
            foreach ($estudantes as $estudante) {

                $selecionado = ($estuMatricula == $estudante->estu_matricula) ? ' selected="true" ' : null;

                $this->meio .= "        <option $selecionado value='{$estudante->estu_matricula}'> {$estudante->estu_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>"; */
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                <br><br>
                                <b>Entre com os dados</b><br>
                                <br>
                <br>Matricula <input type='text' name='estuMatricula' value='{$estuMatricula}'>
                    
                    <br>
                    <input type='text' name='estuNome' value='{$estuNome}'>
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
