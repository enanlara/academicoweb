<?php

require_once 'minhainterface.class.php';

class DisciplinaView extends MinhaInterface {

    public function montaMeio($disciplinamodel) {
        $disciplinaAdo = new DisciplinaAdo();
        $disciplinas = $disciplinaAdo->lista();
        
        $discCodigo = $disciplinamodel->getDiscCodigo();
        $discNome = $disciplinamodel->getDiscNome();
        $discEmenta = $disciplinamodel->getDiscEmenta();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>
                                <select name='discCodigo'>";
        if ($disciplinas) {
            foreach ($disciplinas as $disciplina) {
                $selecionado = ($discCodigo == $disciplina->disc_id) ? ' selected="true" ' : null;
                $this->meio .= "        <option $selecionado value='{$disciplina->curs_id}'> {$disciplina->curs_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                <br><br>
                                <b>Entre com os dados</b><br>
                                <br>
                
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
