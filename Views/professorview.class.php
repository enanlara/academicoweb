<?php

require_once 'minhainterface.class.php';

class ProfessorView extends MinhaInterface {

    public function montaMeio($professormodel) {
        $professoresAdo = new ProfessorAdo();
        $professores = $professoresAdo->lista();

        $profSiape = $professormodel->getProfSiape();
        $profNome = $professormodel->getProfNome();

        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>
                                <select name='profSiape'>";
        if ($professores) {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";

            foreach ($professores as $professor) {
                $selecionado = ($profSiape == $professor->prof_siape) ? ' selected="true" ' : null;
                $this->meio .= "        <option $selecionado value='{$professor->prof_siape}'> {$professor->prof_nome}</option>";
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
