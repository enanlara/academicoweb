<?php

require_once 'minhainterface.class.php';

class MatriculaCursoView extends MinhaInterface {

    public function montaMeio($matriculaCursoModel) {
        $cursoAdo = new CursoAdo();
        $estudanteAdo      = new EstudantesAdo();
        $cursos = $cursoAdo->listaCursos();
        $estudantes = $estudanteAdo->lista();       

        $cursId = $matriculaCursoModel->getMatrc_curs_id();
        $estuMatricula = $matriculaCursoModel->getMatrc_estu_matricula();
        $dataInicial = $matriculaCursoModel->getMatrc_data_inicial();
        $dataFinal = $matriculaCursoModel->getMatrc_data_final();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>
                                <select name='cursId'>";
        $this->meio .= " <select name='estu_matricula'> ";
        
        if ($estudantes) {
            foreach ($estudantes as $estudante) {
                $selecionado = ($estuMatricula == $estudante->estu_matricula) ? ' selected="true" ' : null;
                $this->meio .= "        <option value='{$estudante->estu_matricula}'> {$estudante->estu_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        
        if ($cursos) {
            foreach ($cursos as $curso) {
                
                $selecionado = ($cursId == $curso->curs_id) ? ' selected="true" ' : null;

                $this->meio .= "        <option {$selecionado} value='{$curso->curs_id}'> {$curso->curs_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                <br><br><br>               
                <fieldset>
                        <legend>Alunos</legend>";

        

        $this->meio .= " <br><label> Data inicial:  </label>
                            <input type='text' name='estuDataInicial' value=''>
                        <br><label> Data Final:  </label>
                            <input type='text' name='estuDataFinal' value=''>";
        
        $this->meio .= "</fieldset> <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do curso";
    }

    public function getDados() {
        $cursId = $_POST['cursId'];
        $estuMatricula = $_POST['estu_matricula'];
        $dataInicial = $_POST['estuDataInicial'];
        $dataFinal = $_POST['estuDataFinal'];
        
        return new MatriculaCursoModel($cursId, $estuMatricula, $dataInicial, $dataFinal);
    }

}
