<?php

require_once 'ado.class.php';

class ErroNoBD extends Exception {
    
}

class CursoAdo extends ADO {

    public function alteraObjeto(\Model $objetoModelo) {
        $curs_nome = $objetoModelo->getNome();

        $query = "update Cursos set curs_nome= '{$curs_nome}'";
        
         try {
            $resultado = parent::executaQuery($query);

            if ($resultado) {
                parent::setMensagem("O curso {$curs_nome} foi alterado com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao alterar curso, contate do administrador do sistema!");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

    public function consultaArrayDeObjeto() {
        
    }

    public function buscaCurso($nome) {
        $query = "select curs_nome from Cursos where curs_id = {$nome}";
        try{
            $resultado = parent::executaQuery($query);
            if($resultado){
                return true;
            }  else {
                parent::setMensagem("Erro ao buscar curso");
                return false;
            }
        }  catch (PDOException $e){
            throw new ErroNoBD($e->getMessage());
        }
    }

    public function excluiObjeto(\Model $objetoModelo) {
        $curs_id = $objetoModelo->getCursId();
        $curs_nome = $objetoModelo->getCursNome();
         
        $query = "delete from Cursos where curs_id = {$curs_id}"; 
        
         try {
            $resultado = parent::executaQuery($query);

            if ($resultado) {
                parent::setMensagem("O curso {$curs_nome} foi excluido com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao excluir curso, contate do administrador do sistema!");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

    public function insereObjeto(\Model $objetoModelo) {
        $curs_nome = $objetoModelo->getCursNome();

        $query = "insert into Cursos (curs_nome) values ('{$curs_nome}')";

        try {
            $resultado = parent::executaQuery($query);

            if ($resultado) {
                parent::setMensagem("O curso {$curs_nome} foi inserido com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao inserir curso, contate do administrador do sistema!");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

    public function consultaObjetoPeloId($id) {
        
    }

}
