<?php

require_once 'minhainterface.class.php';
require_once '../Ados/disciplinaado.class.php';
require_once '../Ados/professorado.class.php';

class ResponsavelView extends MinhaInterface {

    public function montaMeio($responsavelmodel) {
        $responsaveisAdo = new ResponsavelAdo();
        $arrayDeDisciplinas = new DisciplinaAdo();
        $ArrayDisc = $arrayDeDisciplinas->lista();
        
        $arrayDeProfessores = new ProfessorAdo();
        $arrayProf = $arrayDeProfessores->lista();

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
                    <option value='-1'>Selecione a disciplina</option><br>";
       

        foreach ($ArrayDisc as $disc) {
            if($disc->disc_codigo == $dadosDisc){
                $selected = 'selected';
            }else{
                $selected = '';
            }
            $this->meio .="<option value='{$disc->disc_codigo}' {$selected}>{$disc->disc_nome}</option><br>";
        }

        $this->meio .="</select>{$arrayDeBotoes['con']}
                <br><br>
                Professor Responsavel
                <select name='resp_prof_siape'>
                    <option value='-1'>Selecione o professor</option><br>";
        
            foreach ($arrayProf as $prof) {
                $selected = ($prof->prof_siape == $dadosProf)? 'selected': '';
                $this->meio .= "<option value='{$prof->prof_siape}' {$selected}>{$prof->prof_nome}</option>";
            }
        $this->meio .="</select><br>
                <br>Ano <input type='text' name='resp_ano' value='{$respAno}'>
                    <br><br>
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
