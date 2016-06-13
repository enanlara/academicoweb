<?php

require_once 'ado.class.php';

class ErroNoBD extends Exception {
    
}

class MatriculaCursoAdo extends ADO {

    public function alteraObjeto(\Model $objetoModelo) {
        $this->excluiObjeto($objetoModelo);
        $this->insereObjeto($objetoModelo);

    }
    public function verificaEstudante($objetoModel){
        $query = "select * from Matriculas_por_curso where matrc_estu_matricula = {$objetoModel->getMatrcEstuMatricula()} ";
        
        $resultado = parent::executaQuery($query);
        if($resultado){
            if(parent::qtdeLinhas() == 0){
                return false;
            }else{
                return true;
            }
        }
        
    }

    
    public function consultaMatriculaCurso($estuId){
        $query = "select * from Matriculas_por_curso where matrc_estu_matricula = {$estuId}";
        echo $query;
        $resultado = parent::executaQuery($query);
        if($resultado){
            $arrayDeResultado = parent::leTabelaBD();
            $matriculaPorCurso = new MatriculaCursoModel($arrayDeResultado['matrc_curs_id'], $arrayDeResultado['matrc_estu_matricula'], $arrayDeResultado['matrc_data_inicial'], $arrayDeResultado['matrc_data_final']);
            return $matriculaPorCurso;
        }else{
            parent::setMensagem("Erro no select, contate o analista responsavel!!");
            return false;
        }
    }

    
    public function excluiObjeto(\Model $objetoModelo) {
        $query = "delete from Matriculas_por_curso where matrc_estu_matricula = {$objetoModelo->getMatrcEstuMatricula()}";
        echo $query;
        try {
            $executou = parent::executaQuery($query);
            if ($executou) {
                echo 'eu estou aqui';
                parent::setMensagem("A matriz foi excluida com sucesso");
                return true;
            } else {
                parent::setMensagem("Não foi possivel excluir a matriz");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

    public function insereObjeto(\Model $objetoModelo) {
        if($this->verificaEstudante($objetoModelo)){
            parent::setMensagem("Erro , Estudante ja esta matriculado em um Curso!!!");
            return false;
        }
        
        $query = "insert into Matriculas_por_curso values ("
                . "{$objetoModelo->getMatrcCursId()}, "
                . "{$objetoModelo->getMatrcEstuMatricula()}, "
                . "'{$objetoModelo->getMatrcDataInicial()}',"
                . "'{$objetoModelo->getMatrcDataFinal()}' "
                . ")";        

        try {
            
            $resultado = parent::executaQuery($query);
            if ($resultado) {
                parent::setMensagem("A matriz foi inserida com sucesso");
                return true;
            } else {
                parent::setMensagem("Erro ao inserir a Matriz");
                return false;
            }
        } catch (PDOException $e) {
            throw ErroNoBD($e->getMessage());
        }
    }

    public function consultaObjetoPeloId($id) {
        
    }

    public function consultaArrayDeObjeto() {
        
    }

//put your code here
}
