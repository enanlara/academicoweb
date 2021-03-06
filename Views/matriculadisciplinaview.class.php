<?php
/**
 * classe view de matriculaDisciplina
 */
require_once 'minhainterface.class.php';

class MatriculaDisciplinaView extends MinhaInterface
{

    public function montaMeio($matriculaDisciplinaModel)
    {
        $estudanteAdo = new EstudantesAdo();
        $disciplinaAdo = new DisciplinaAdo();
        $estudantes = $estudanteAdo->lista();
        $disciplinas = $disciplinaAdo->lista();

        $discCodigo = $matriculaDisciplinaModel->getMatrdDiscId();
        $estuMatricula = $matriculaDisciplinaModel->getMatrdEstuMatricula();
        $dataInicial = $matriculaDisciplinaModel->getMatrdDataInicial();
        $dataFinal = $matriculaDisciplinaModel->getMatrdDataFinal();
        $nota = $matriculaDisciplinaModel->getMatrdNota();
        $discStatus = $matriculaDisciplinaModel->getMatrdStatus();
        $readonly = ($estuMatricula) ? 'readonly="true"' : null;

        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio .= "<div id= 'meio'> 
                            <form method='post' action=''>";

        $this->meio .= "
        <label> Nome: </label>
        <select name='estu_matricula'>";
        if ($estudantes) {
            foreach ($estudantes as $estudante) {
                $selecionado = ($estuMatricula == $estudante->estu_matricula) ? ' selected="true" ' : null;
                $this->meio .= "<option value='{$estudante->estu_matricula}'> {$estudante->estu_nome}</option>";
            }
        } else {
            $this->meio .= "<option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "</select>
        <br>
        <label> Disciplina: </label>
        <select name='discCodigo' $readonly>";
        if ($disciplinas) {
            $this->meio .= "<option value=''> Selecione uma disciplina </option>";
            foreach ($disciplinas as $disciplina) {
                $this->meio .= "<option value='{$disciplina->disc_codigo}'> {$disciplina->disc_nome}</option>";
            }
        } else {
            $this->meio .= "<option value=''> Nenhuma disciplina cadastrada </option>";
        }
        $this->meio .= "</select>
        {$arrayDeBotoes['con']}
                <br>
                </form>
                <hr><br>
                <form method='post' action=''>                
                
                <fieldset>
                    <legend>Disciplina</legend>      
                    <label> Matricula: </label>
                    <input type='text' name='estu_matricula' value='$estuMatricula' $readonly>
                    <br>
                    <label> Disciplina: </label>
                    <input type='text' name='discCodigo' value='$discCodigo' $readonly>
        ";

        $this->meio .= "
                    <br><label> Nota: </label>
                        <input type='text' name='discNota' value='{$nota}'>
                    <br><label> Status</label>
                        <select name='discStatus'>";
        foreach ((array(0 => 'Reprovado', 1 => 'Aprovado')) as $key => $value) {
            $selecionado = ($key == $discStatus) ? 'selected="true"' : null;
            $this->meio .= "<option $selecionado value='{$key}'> $value </option>";
        }
        $this->meio .= "
                        </select>
                    <br><label> Data inicial:  </label>
                        <input type='date' name='estuDataInicial' value='$dataInicial'>
                    <br><label> Data Final:  </label>
                        <input type='date' name='estuDataFinal' value='$dataFinal'>";


        $this->meio .= "</fieldset> 
                        <br><br>";

        if (!$estuMatricula && !$nota)
            $this->meio .= "{$arrayDeBotoes['inc']}";
        else if ($estuMatricula && !$nota)
            $this->meio .= "{$arrayDeBotoes['inc']}";
        if ($nota)
            $this->meio .= "{$arrayDeBotoes['novo']}{$arrayDeBotoes['alt']}";


        $this->meio .= "</form></div>";
    }

    public function montaTitulo()
    {
        $this->titulo = "Matriculas por disciplina";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados()
    {
        $estuMatricula = $_POST['estu_matricula'];
        $discCodigo = (isset($_POST['discCodigo'])) ? $_POST['discCodigo'] : null;
        $nota = (isset($_POST['discNota'])) ? $_POST['discNota'] : null;
        $status = (isset($_POST['discStatus'])) ? $_POST['discStatus'] : null;
        $dataInicial = (isset($_POST['estuDataInicial'])) ? $_POST['estuDataInicial'] : null;
        $dataFinal = (isset($_POST['estuDataFinal'])) ? $_POST['estuDataFinal'] : null;

        return new MatriculaDisciplinaModel($estuMatricula, $discCodigo, $dataInicial, $dataFinal, $nota, $status);
    }
}
