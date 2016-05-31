<?php

require_once 'ado.class.php';

class ErroNoBD extends Exception {
    
}

class CursoAdo extends ADO {

    public function alteraObjeto(\Model $objetoModelo) {

        $query = "update Cursos set curs_nome= ? where curs_id = ?";
        
         try {
             $arrayDeDados = array($objetoModelo->getCursNome(), $objetoModelo->getCursId());
            $resultado = parent::executaPs($query, $arrayDeDados);

            if ($resultado) {
                parent::setMensagem("O curso {$objetoModelo->getCursNome()} foi alterado com sucesso!");
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
    
    function listaCursos() {
        $query = " SELECT * FROM Cursos";

        try {
            $linhas = parent::executaQuery($query);

            while ($linhas = parent::leTabelaBD(5)) {
                $arrayObjeto [] = clone ($linhas);
            }
            
            return $arrayObjeto;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function buscaCurso($nome) {
        $query = "select * from Cursos where curs_id = {$nome}";
        try{
            $resultado = parent::executaQuery($query);
            if($resultado){
                $cursoArray = parent::leTabelaBD();
                $cursoModel = new CursoModel($cursoArray['curs_id'], $cursoArray['curs_nome']);
                return $cursoModel;
            }  else {
                parent::setMensagem("Erro ao buscar curso");
                return false;
            }
        }  catch (PDOException $e){
            throw new ErroNoBD($e->getMessage());
        }
    }

    public function excluiObjeto(\Model $objetoModelo) {
        
         //echo ;
        $query = "delete from Cursos where curs_id = {$objetoModelo->getCursId()}"; 
        //echo $query;
        
         try {
            $resultado = parent::executaQuery($query);

            if ($resultado) {
                parent::setMensagem("O curso {$objetoModelo->getCursNome()} foi excluido com sucesso!");
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
