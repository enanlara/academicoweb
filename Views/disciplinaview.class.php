<?php
/**
 * Classe view de Disciplinas
 */
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
                                <select name='discCodigoSelect'>";
        if ($disciplinas) {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";

            foreach ($disciplinas as $disciplina) {
                $selecionado = ($discCodigo == $disciplina->disc_codigo) ? ' selected="true" ' : null;
                $this->meio .= "        <option $selecionado value='{$disciplina->disc_codigo}'> {$disciplina->disc_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>{$arrayDeBotoes['con']}";

        $this->meio .= " 
                            <form method='post' action=''>
                                
                                <br><br>
                                <b>Entre com os dados da disciplina</b>
                                <br>
                    Codigo <input type='text' name='discCodigo' value='$discCodigo'><br>                
                <br>Nome <input type='text' name='discNome' value='{$discNome}'> <br>
                    <br>Ementa <input type='text' name='discEmenta' value='{$discEmenta}'>
                <br><br>";

        if (is_null($discCodigo))
            $this->meio .= "{$arrayDeBotoes['inc']}";
        else
            $this->meio .= "{$arrayDeBotoes['novo']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}";

        $this->meio .= "</form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição da Disciplina";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */    
    public function getDados() {
        
        $discCodigo = $_POST['discCodigo'];
        $discNome = $_POST['discNome'];
        $discEmenta = $_POST['discEmenta'];
        if($discCodigo == ''){
            $discCodigo = $_POST['discCodigoSelect'];
        }
        echo $discCodigo;

        return new DisciplinaModel($discCodigo, $discNome, $discEmenta);
    }

}
