<?php
/**
 * classe view de MatrizCurso
 */
require_once 'minhainterface.class.php';

class MatrizCursoView extends MinhaInterface
{

    public function montaMeio($matrizcursomodel)
    {
        $cursoAdo = new CursoAdo();
        $cursos = $cursoAdo->listaCursos();

        $cursId = $matrizcursomodel->getMatrzCursId();
        $discCodigo = $matrizcursomodel->getMatrzDiscCodigo();
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>
                            <label> Cursos: </labe>
                                <select name='cursId'>";
        if ($cursos) {
            foreach ($cursos as $curso) {

                $selecionado = ($cursId == $curso->curs_id) ? ' selected="true" ' : null;

                $this->meio .= "        <option $selecionado value='{$curso->curs_id}'> {$curso->curs_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                <br><br><br>       
                            </form>
                            
                            <form method='post' action=''>
                            <input type='hidden' value='$cursId' name='cursId'>
                <fieldset>
                        <legend>Disciplinas</legend>";
        if ($discCodigo != null) {
            foreach ($discCodigo as $dados) {
                $this->meio .= " <input type='checkbox' name='discCodigo[]' {$dados->checked} value='{$dados->discCodigo}'> {$dados->discNome}<br>";
            }
        }
        $this->meio .= "</fieldset><br><br>";

        if ($discCodigo)
            $this->meio .= "{$arrayDeBotoes['inc']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}";

        $this->meio .= "</form></div>";

    }

    public function montaTitulo()
    {
        $this->titulo = "Inscrição do curso";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados()
    {
        $cursId = $_POST['cursId'];
        if (isset($_POST['discCodigo'])) {
            $discCodigo = $_POST['discCodigo'];
        } else {
            $discCodigo = null;
        }
        return new MatrizCursoModel($cursId, $discCodigo);
    }

}
