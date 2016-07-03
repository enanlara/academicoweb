<?php
/**
 * Classe view de estudantes
 */
require_once 'minhainterface.class.php';

class EstudanteView extends MinhaInterface
{

    public function montaMeio($estudantesmodel)
    {
        $estudanteAdo = new EstudantesAdo();
        $estudantes = $estudanteAdo->lista();

        $estuMatricula = $estudantesmodel->getEstuMatricula();
        $estuNome = $estudantesmodel->getEstuNome();
        // echo $estudantesmodel->getEstuMatricula();
        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>";

        $this->meio .= "<select name='estuMatricula'>";
        if ($estudantes) {
            foreach ($estudantes as $estudante) {

                $selecionado = ($estuMatricula == $estudante->estu_matricula) ? ' selected="true" ' : null;

                $this->meio .= "        <option $selecionado value='{$estudante->estu_matricula}'> {$estudante->estu_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                </form>
                                <hr>                               
                                <br><br>
                                <form action='' method='post'>
                                <b>Entre com os dados</b><br>
                                <br>
                    <br>Matricula <input type='text' name='estuMatricula' value='{$estuMatricula}' required='true'>                  
                    <br>
                    Nome<input type='text' name='estuNome' value='{$estuNome}' required='true'>
                <br><br>";

        if (is_null($estuMatricula))
            $this->meio .= "{$arrayDeBotoes['inc']}";
        else
            $this->meio .= "{$arrayDeBotoes['novo']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}";

        $this->meio .= "</form></div>";

    }

    public function montaTitulo()
    {
        $this->titulo = "Inscrição do discente";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados()
    {
        $estuMatricula = $_POST['estuMatricula'];
        $estuNome = (isset($_POST['estuNome'])) ? $_POST['estuNome'] : null;

        return new estudantesmodel($estuMatricula, $estuNome);
    }

}
