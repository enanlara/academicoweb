<?php

require_once 'minhainterface.class.php';

class MatriculaCursoView extends MinhaInterface {

    public function montaMeio($matriculaCursoModel) {
        $cursoAdo = new CursoAdo();
        $estudanteAdo      = new EstudantesAdo();
        $cursos = $cursoAdo->listaCursos();
        $estudantes = $estudanteAdo->lista();       
        $cursId = $matriculaCursoModel->getMatrcCursId();
        $estuMatricula = $matriculaCursoModel->getMatrcEstuMatricula();
        $dataInicial = $matriculaCursoModel->getMatrcDataInicial();
        $dataFinal = $matriculaCursoModel->getMatrcDataFinal();
        
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>
                                Estudante <select name='estu_matricula'>";
        
        if ($estudantes) {
                        $this->meio .= "<option value=''> Nenhuma opção selecionada </option>";

            foreach ($estudantes as $estudante) {
                $selecionado = ($estuMatricula == $estudante->estu_matricula) ? ' selected="true" ' : null;
                $this->meio .= "<option $selecionado value='{$estudante->estu_matricula}'> {$estudante->estu_nome}</option>";
            }
        } else {
            $this->meio .= "<option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "</select> {$arrayDeBotoes['con']}<br>";
        
        $this->meio .= "<br> Curso
                                <select name='cursId'>";
        if ($cursos) {
                        $this->meio .= "<option value=''> Nenhuma opção selecionada </option>";

            foreach ($cursos as $curso) {
                
                $selecionado = ($cursId == $curso->curs_id) ? ' selected="true" ' : null;

                $this->meio .= "        <option {$selecionado} value='{$curso->curs_id}'> {$curso->curs_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " <br><br><br>               
                <fieldset>
                        <legend>Alunos</legend>";

        

        $this->meio .= " <br><label> Data inicial:  </label>
                            <input type='date' name='estuDataInicial' value='{$dataInicial}'>
                        <br><label> Data Final:  </label>
                            <input type='date' name='estuDataFinal' value='{$dataFinal}'>";
        
        $this->meio .= "</fieldset> <br><br>
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}
            </form></div>";
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do curso";
    }

    public function getDados() {
        $cursId = $_POST['cursId'];
        $estuMatricula = $_POST['estu_matricula'];
        $dataIni = $_POST['estuDataInicial'];
        $dataFin = $_POST['estuDataFinal'];
        
        return new MatriculaCursoModel($cursId, $estuMatricula, $dataIni, $dataFin);
    }

}
