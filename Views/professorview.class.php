<?php
/**
 * Classe View de Professor
 */
require_once 'minhainterface.class.php';

class ProfessorView extends MinhaInterface
{

    public function montaMeio($professormodel)
    {
        $professoresAdo = new ProfessorAdo();
        $professores = $professoresAdo->lista();

        $profSiape = $professormodel->getProfSiape();
        $profNome = $professormodel->getProfNome();

        $arrayDeBotoes = parent::montaArrayDeBotoes();

        $this->meio = " <div id= 'meio'> 
                            <form method='post' action=''>
                                <select name='profSiape'>";
        if ($professores) {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";

            foreach ($professores as $professor) {
                $selecionado = ($profSiape == $professor->prof_siape) ? ' selected="true" ' : null;
                $this->meio .= "        <option $selecionado value='{$professor->prof_siape}'> {$professor->prof_nome}</option>";
            }
        } else {
            $this->meio .= "        <option value=''> Nenhuma opção selecionada </option>";
        }
        $this->meio .= "        </select>";
        $this->meio .= " 
                                {$arrayDeBotoes['con']}
                                </form>
                                
                                <form method='post' action=''>
                                
                                <br><br>
                                <b>Entre com os dados</b><br>
                                
                
                <br>Siape <input type='text' name='profSiape' value='$profSiape'>
                <br>Nome <input type='text' name='profNome' value='{$profNome}'>
                <br><br>
                ";


        if (is_null($profSiape))
            $this->meio .= "{$arrayDeBotoes['inc']}";
        else
            $this->meio .= "{$arrayDeBotoes['novo']}{$arrayDeBotoes['alt']}{$arrayDeBotoes['exc']}";

        $this->meio .= "</form></div>";
    }

    public function montaTitulo()
    {
        $this->titulo = "Inscrição do professor";
    }

    /*
     * recebe dados inseridos no formulário e retorna a model
     */
    public function getDados()
    {
        $profSiape = $_POST['profSiape'];
        $profNome = (isset($_POST['profNome'])) ? $_POST['profNome'] : null;

        return new professormodel($profSiape, $profNome);
    }

}
