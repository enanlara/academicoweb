<?php

require_once 'ado.class.php';
/**
 * Esta é uma classe de crud de disciplinas com o bd
 */


class DisciplinaAdo extends ADO {

    /**
     * altera disciplina
     * @param objeto model Disciplina
     * @return boolean 
     **/
    public function alteraObjeto(\Model $objetoModelo) {
        $query = "update Disciplinas set disc_nome = ?, disc_ementa = ? where disc_codigo = ?";

        $arrayDeValores = array($objetoModelo->getDiscNome(), $objetoModelo->getDiscEmenta(), $objetoModelo->getDiscCodigo());
        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("A disciplina {$objetoModelo->getDiscNome()} foi alterada com sucesso");
                return true;
            } else {
                parent::setMensagem("Erro ao alterar a disciplina{$objetoModelo->getDiscNome()} contate o analista");
                return false;
            }
        } catch (Exception $ex) {
            throw new ErroNoBD($ex->getMessage());
        }
    }

    public function consultaArrayDeObjeto() {
        
    }

    public function consultaObjetoPeloId($id) {
        
    }

   /**
    * busca todas as disciplinas
    * @return array de Disciplinas
    */
    function lista() {
        $query = " SELECT * FROM Disciplinas ";

        return parent::lista($query);
    }

    /**
     * metodo para listar disciplina por matricula
     * @param matricula a ser consultada
     * @return array
     **/
    function listaDisciplinaPorMatricula($matricula) {
        $query = " 
                 SELECT * FROM Matricula_por_disciplina m 
                 INNER JOIN Disciplinas d ON d.disc_codigo = m.matrd_disc_id
                 WHERE matrd_estu_matricula = {$matricula}";

        return parent::lista($query);
    }

    /**
     * exclui disciplina
     * @param \Model $objetoModelo model de Disciplinas
     * @return boolean
     * @throws ErroNoBD
     */
    public function excluiObjeto(\Model $objetoModelo) {
        $query = "delete from Disciplinas where disc_codigo = ?";
        
        $arrayDeValores = array($objetoModelo->getDiscCodigo());
        
        try {
            $resultado = parent::executaPs($query, $arrayDeValores);
            
            if($resultado){
                parent::setMensagem("A disciplina {$objetoModelo->getDiscNome()} foi excluida com sucesso!");
                return true;
            }  else {
                parent::setMensagem("Erro ao excluir a disciplina {$objetoModelo->getDiscNome()} cotate o analista responsavl!");
                return false;
            }
        } catch (Exception $ex) {
            throw new ErroNoBD($ex->getMessage());  
        }
    }

    /**
     * insere disciplina
     * @param \Model $objetoModelo model de Disciplinas
     * @return boolean
     * @throws ErroNoBD
     */
    public function insereObjeto(\Model $objetoModelo) {
        $query = "insert into Disciplinas (disc_codigo, disc_nome, disc_ementa) values (?,?,?)";

        $arrayDeValores = array($objetoModelo->getDiscCodigo(), $objetoModelo->getDiscNome(), $objetoModelo->getDiscEmenta());
        echo $objetoModelo->getDiscCodigo();
        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("A disciplina {$objetoModelo->getDiscNome()} foi inserida com sucesso");
                return true;
            } else {
                parent::setMensagem("Erro ao inserir a disciplina {$objetoModelo->getDiscNome()} contate o analista responsavel");
                return false;
            }
        } catch (Exception $exc) {
            throw new ErroNoBD($exc->getMessage());
            return false;
        }
    }

    /**
     * busca e retorna disciplina por codigo
     * @param type $discCodigo codigo da disciplina
     * @return boolean
     */
    public function buscaDisciplinaPeloCodigo($discCodigo) {
        $query = "select * from Disciplinas where disc_codigo = ?";

        try {
            $executou = parent::executaPs($query, array($discCodigo));

            if ($executou) {
                $disciplinaArray = parent::leTabelaBD();
                $disciplinaModel = new DisciplinaModel($disciplinaArray['disc_codigo'], $disciplinaArray['disc_nome'], $disciplinaArray['disc_ementa']);
                return $disciplinaModel;
                
            } else {
                parent::setMensagem("Erro no select");
                return false;
            }
        } catch (Exception $ex) {
            parent::setMensagem($ex->getMessage());
            return FALSE;
        }
    }
    

}
