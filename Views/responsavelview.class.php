<?php

require_once 'minhainterface.class.php';

class ResponsavelView extends MinhaInterface {

    public function montaMeio($responsavelmodel) {
        $responsaveisAdo = new ResponsavelAdo();
        $responsaveis = $responsaveisAdo->lista();
        
        $dadosProf = $responsavelmodel->getProf();
        $dadosDisc = $responsavelmodel->getDisc();
        $respAno = $responsavelmodel->getAno();
        $respSemestre = $responsavelmodel->getSemestre();

        $arrayDeBotoes = parent::montaArrayDeBotoes();
        $sem1 = null;
        $sem2 = null;
        if ($respSemestre == 1) {
            $sem1 = 'selected';
        } else if ($respSemestre == 2) {
            $sem2 = 'selected';
        }

        $this->meio = " 
            <div id= 'meio'> <form method='post' action=''>
                <b>Entre com os dados</b> <br>
                Disciplina
                <select name='resp_disc_id'>
                    <option value='-1'>Selecione a disciplina</option>";

        if ($dadosDisc != null && $dadosDisc != '-1') {
            foreach ($dadosDisc as $disc) {
                $this->meio .="<option value='{$disc->discCodigo}'>{$disc->discNome}</option>";
            }
        }
        $this->meio .="</select>{$arrayDeBotoes['con']}
                <br>
                Professor Responsavel
                <select name='resp_prof_siape'>
                    <option value='-1'>Selecione o professor</option>";
        if ($dadosProf != null && $dadosProf != '-1')
            foreach ($dadosProf as $prof) {
                $this->meio .= "<option value='{$prof->profSiape}'>{$prof->profNome}</option>";
            }
        $this->meio .="</select>
                <br>Ano <input type='text' name='resp_ano' value='{$respAno}'>
                    <br>
                Semestre    
                <select name='resp_semestre'>
                    <option value='-1'>Selecione o semestre</option>
                    <option value='1' {$sem1}>1</option>
                    <option value='2' {$sem2}>2</option>
                </select>
                    
                <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição da Disciplina";
    }

    public function getDados() {
        $disc = $_POST['resp_disc_id'];
        $prof = $_POST['resp_prof_siape'];
        $respAno = $_POST['resp_ano'];
        $respSemestre = $_POST['resp_semestre'];

        return new ResponsavelModel($disc, $prof, $respAno, $respSemestre);
    }

}
