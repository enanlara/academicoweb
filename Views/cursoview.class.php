<?php

require_once 'minhainterface.class.php';

class CursoView extends MinhaInterface {

    public function montaMeio($cursomodel) {
        $cursoAdo = new CursoAdo();
        $cursos = $cursoAdo->listaCursos();

        $cursNome = $cursomodel->getCursNome();
        $cursId = $cursomodel->getCursId();
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'>
                            <form method='post' action=''>
                            <label> Cursos: </labe>
                                <select name='cursId'>";
        if ($cursos) {
            $this->meio .= "<option selected value='-1'> Selecione o curso</option>";

            foreach ($cursos as $curso) {
                $selecionado = ($cursId == $curso->curs_id) ? ' selected="true" ' : null;
                $this->meio .= "        <option $selecionado value='{$curso->curs_id}'> {$curso->curs_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Selecione o Curso </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                <br><br>
                                <b>Entre com os dados do curso</b>
                                <br>
                                    
                                <br>Nome    <input type='text' name='cursNome' value='{$cursNome}'>
                                   
                                <br><br>";

        if (is_null($cursId))
            $this->meio .= "{$arrayDeBotoes['inc']}";
        else
            $this->meio .= "{$arrayDeBotoes['novo']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}";

        $this->meio .= "</form></div>";

        // Codigo  <input type='text' name='cursId' value='{$cursId}'>
    }

    public function montaTitulo() {
        $this->titulo = "Inscrição do curso";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados() {
        $cursNome = $_POST['cursNome'];
        $cursId = $_POST['cursId'];

        return new CursoModel($cursId, $cursNome);
    }

}
