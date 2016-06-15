<?php

require_once 'minhainterface.class.php';

class MatriculaDisciplinaView extends MinhaInterface
{

    public function montaMeio($matriculaDisciplinaModel)
    {
        $estudanteAdo = new EstudantesAdo();
        $disciplinaAdo = new DisciplinaAdo();
        $estudantes = $estudanteAdo->lista();
        $disciplinas = $disciplinaAdo->lista();

        $estuMatricula = $matriculaDisciplinaModel->getMatrdEstuMatricula();
        $dataInicial = $matriculaDisciplinaModel->getMatrdDataInicial();
        $dataFinal = $matriculaDisciplinaModel->getMatrdDataFinal();

        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio .= "<div id= 'meio'> 
                            <form method='post' action=''>";

        $this->meio .= "
        <label> Matricula: </label>
        <select name='estu_matricula'>";
        if ($estudantes) {
            foreach ($estudantes as $estudante) {
                $selecionado = ($estuMatricula == $estudante->estu_matricula) ? ' selected="true" ' : null;
                $this->meio .= "<option value='{$estudante->estu_matricula}'> {$estudante->estu_nome}</option>";
            }
        } else {
            $this->meio .= "<option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "</select>";

        $this->meio .= " {$arrayDeBotoes['con']}
                <br>";


        $this->meio .= "
                </form>
                <hr><br>
                <form method='post' action=''>
                <input type='hidden' name='estu_matricula' value='$estuMatricula'>
                
                <fieldset>
                    <legend>Disciplinas</legend>";

        $this->meio .= "
        <label> Disciplina: </label>";
        if ($disciplinas) {
            foreach ($disciplinas as $disciplina) {
                $this->meio .= "<input type='checkbox' name='discCodigo' value='{$disciplina->disc_codigo}'> {$disciplina->disc_nome} </input>";
            }
        } else {
            $this->meio .= "<p> Nenhuma disciplina cadastrada </p>";
        }

        $this->meio .= "
                    <br><label> Status </label>
                    <br><label> Data inicial:  </label>
                        <input type='text' name='estuDataInicial' value=''>
                    <br><label> Data Final:  </label>
                        <input type='text' name='estuDataFinal' value=''>";


        $this->meio .= "</fieldset> 
                        <br><br>";

        if ($estuMatricula) {
            $this->meio .= "{$arrayDeBotoes['alt']} </form></div>";
        } else {
            $this->meio .= "{$arrayDeBotoes['inc']}";
        }
        
        $this->meio .= "</form></div>";
    }

    public function montaTitulo()
    {
        $this->titulo = "Matriculas por disciplina";
    }

    public function getDados()
    {
        $estuMatricula = $_POST['estu_matricula'];
        $discCodigo = (isset($_POST['discCodigo'])) ? $_POST['discCodigo'] : null;
        $dataInicial = (isset($_POST['estuDataInicial'])) ? $_POST['estuDataInicial']  : null;
        $dataFinal = (isset($_POST['estuDataFinal'])) ? $_POST['estuDataFinal'] : null;

        return new MatriculaDisciplinaModel($discCodigo, $estuMatricula, $dataInicial, $dataFinal);
    }
}
