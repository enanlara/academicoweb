<?php

require_once 'minhainterface.class.php';

class MatriculaDisciplinaView extends MinhaInterface
{

    public function montaMeio($matriculaDisciplinaModel)
    {
        $estudanteAdo = new EstudantesAdo();
        $disciplinaAdo = new DisciplinaAdo();
        $estudantes = $estudanteAdo->lista();

        $estuMatricula = $matriculaDisciplinaModel->getMatrc_estu_matricula();
        $dataInicial = $matriculaDisciplinaModel->getMatrc_data_inicial();
        $dataFinal = $matriculaDisciplinaModel->getMatrc_data_final();

        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = "<div id= 'meio'> 
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

        $this->meio .= " 
                {$arrayDeBotoes['con']}
                <br><br><br>";

        if ($estuMatricula) {
            $disciplinas = $disciplinaAdo->listaDisciplinaPorMatricula($estuMatricula);

            var_dump($disciplinas);
            die();
            $this->meio = "
                <fieldset>
                    <legend>Disciplinas</legend>";

            foreach ($disciplinas as $key => $disciplina) {
                $this->meio .= "
                    <br><label> Data inicial:  </label>
                        <input type='text' name='estuDataInicial' value=''>
                    <br><label> Data Final:  </label>
                        <input type='text' name='estuDataFinal' value=''>";
            }

            $this->meio .= "</fieldset> 
                        <br><br>";
        }

        $this->meio .= "
                {$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}
            </form></div>";
    }

    public function montaTitulo()
    {
        $this->titulo = "Matriculas por disciplina";
    }

    public function getDados()
    {
        $cursId = $_POST['cursId'];
        $estuMatricula = $_POST['estu_matricula'];
        $dataInicial = $_POST['estuDataInicial'];
        $dataFinal = $_POST['estuDataFinal'];

        return new MatriculaDisciplinaModel($cursId, $estuMatricula, $dataInicial, $dataFinal);
    }
}
