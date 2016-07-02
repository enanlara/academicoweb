<?php

require_once 'ado.class.php';


class ProfessorAdo extends ADO
{

    /*
     * Metodo para alterar o professor
     */
    public function alteraObjeto(\Model $objetoModelo)
    {
        $query = "update Professores set prof_nome = ? where prof_siape = ?";

        $arrayDeValores = array($objetoModelo->getProfNome(), $objetoModelo->getProfSiape());

        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("O professor {$objetoModelo->getProfNome()} foi alterado com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao alterar o professor {$objetoModelo->getProfNome()}, contate o analista!");
                return false;
            }
        } catch (PDOException $e) {

            throw new ErroNoBD($e->getMessage());
        }
    }

    /*
     * Listar Professores
     */
    function lista()
    {
        $query = " SELECT * FROM Professores ";

        return parent::lista($query);
    }

    public function consultaArrayDeObjeto()
    {

    }

    public function consultaObjetoPeloId($id)
    {

    }

    /*
     * Excluir Professores
     */
    public function excluiObjeto(\Model $objetoModelo)
    {
        $query = "delete from Professores where prof_siape = ?";

        $arrayDeValores = array($objetoModelo->getProfSiape());

        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("O professor {$objetoModelo->getProfNome()} foi excluido com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao excluir o professro {$objetoModelo->getProfNome()}, contate o analista");
                return false;
            }
        } catch (PDOException $e) {
            throw new ErroNoBD($e->getMessage());
        }
    }

    /*
     * Inserir Professor
     */
    public function insereObjeto(\Model $objetoModelo)
    {

        $query = "insert into Professores (prof_siape, prof_nome) values (?, ?)";
        $arrayDeValores = array($objetoModelo->getProfSiape(), $objetoModelo->getProfNome());
        echo $objetoModelo->getProfSiape();
        try {
            $resultado = parent::executaPs($query, $arrayDeValores);
            if ($resultado) {
                parent::setMensagem("O professor{$objetoModelo->getProfNome()}, foi inserido com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao inserir o Professor {$objetoModelo->getProfNome() }, contate o analista");
                return false;
            }

        } catch (PDOException $e) {
            throw new ErroNoBD($e->getMessage());
        }

    }

    /*
     * Buscar professor pelo siape
     */
    public function buscaPeloSiape($profSiape)
    {
        $query = "select * from Professores where prof_siape = ?";

        try {
            $executou = parent::executaPs($query, array($profSiape));
            if ($executou) {
                $professorArray = parent::leTabelaBD();
                $professorModel = new ProfessorModel($professorArray['prof_siape'], $professorArray['prof_nome']);
                return $professorModel;
            } else {
                parent::setMensagem("Erro no select");
                return false;
            }


        } catch (ErroNoBD $e) {
            parent::setMensagem($e->getMessage());
            return false;
        }
    }


}
