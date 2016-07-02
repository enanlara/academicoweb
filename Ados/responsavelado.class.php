<?php

require_once 'ado.class.php';


class ErroNoBD extends Exception {
    
}

class ResponsavelAdo extends ADO {

    /*
     * Lista responsaveis
     */
    function lista() {
        $query = " SELECT * FROM Responsaveis ";

        return parent::lista($query);
    }

    /*
     * Altera Responsavel
     */
    public function alteraObjeto(\Model $objetoModelo) {
        $query = "update Responsaveis set resp_prof_siape = ?, resp_ano = ?, resp_semestre = ? where resp_disc_id = ?";
        try {
            $arrayDeDados = array($objetoModelo->getProf(), $objetoModelo->getAno(), $objetoModelo->getSemestre(), $objetoModelo->getDisc());
            $resultado = parent::executaPs($query, $arrayDeDados);
        if($resultado){
            parent::setMensagem("A responsabilidade foi alterada com sucesso!");
            return true;
        }else{
            parent::setMensagem("Erro ao alterar a responsabilidade, Contate o analista");
            return false;
        }
                    
            
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
            
        }
        }

    public function consultaArrayDeObjeto() {
        
    }

    /*
     * Consulta responsavel pelo id
     */
    public function consultaObjetoPeloId($id) {
        $query = "select * from Responsaveis where resp_disc_id = '{$id}'";
        $resultado = parent::executaQuery($query);
        if($resultado){
            $responsavelArray = parent::leTabelaBD();
            $responsavelModel = new ResponsavelModel($responsavelArray['resp_disc_id'], $responsavelArray['resp_prof_siape'], $responsavelArray['resp_ano'], $responsavelArray['resp_semestre']);

            return $responsavelModel;
        }else{
            parent::setMensagem("Erro no select");
            return false;
        }
        
    }

    /*
     * Exclui Responsavel
     */
    public function excluiObjeto(\Model $objetoModelo) {
        $query = "delete from Responsaveis where resp_disc_id = {$objetoModelo->getDisc()}";
        $resultado = parent::executaQuery($query);
        
        if($resultado){
            parent::setMensagem("A responsabilidade foi excluida com sucesso!");
            return true;
        }else{
            parent::setMensagem("Erro ao excluir a resposabilidade, contate o analista!");
            return false;
        }
        
    }

    /*
     * Insere responsavel
     */
    public function insereObjeto(\Model $objetoModelo) {
        $query = "insert into Responsaveis values (?,?,?,?)";
        
        try{
            $arrayDeDados = array($objetoModelo->getDisc(), $objetoModelo->getProf(), $objetoModelo->getAno(), $objetoModelo->getSemestre());
            $executou = parent::executaPs($query, $arrayDeDados);
            foreach ($arrayDeDados as $a){
                echo $a.'<br>';
            }
            
            if($executou){
                parent::setMensagem("O responsavel foi inserido com sucesso!");
                return true;
            }  else {
                parent::setMensagem("Erro ao inserir o responsavel!");
                return false;
            }
            
        }  catch (PDOException $e){
            throw new ErroNoBD($e->getMessage());
        }
        
    }

    /*
     * Busca professores
     */
    public function buscaProfessor() {
        $query = "select * from Professores ";

        try {
            $executou = parent::executaQuery($query);

            if ($executou) {
                $arrayDeProfessores = null;
                while ($linha = parent::leTabelaBD($executou)) {
                    $prof = new stdClass();
                    $prof->profSiape = $linha['prof_siape'];
                    $prof->profNome = $linha['prof_nome'];
                    $arrayDeProfessores[] = $prof;
                } 
                return $arrayDeProfessores;
            } else {
                parent::setMensagem("Não foi possivel buscar os professores!");
                return false;
            }
        } catch (ErroNoBD $e) {
            parent::setMensagem($e->getMessage());
            return false;
        }
    }

    /*
     * Busca disciplinas
     */
    public function buscaDisciplina() {
        $query = "select * from Disciplinas ";

        try {
            $executou = parent::executaQuery($query);

            if ($executou) {
                $arrayDeDisciplinas = null;
                while ($linha = parent::leTabelaBD($executou)) {
                    $disc = new stdClass();
                    $disc->discCodigo = $linha['disc_codigo'];
                    $disc->discNome = $linha['disc_nome'];
                    $arrayDeDisciplinas[] = $disc;
                } 
                return $arrayDeDisciplinas;
            } else {
                parent::setMensagem("Não foi possivel buscar as disciplinas");
                return false;
            }
        } catch (ErroNoBD $e) {
            parent::setMensagem($e->getMessage());
            return false;
        }
    }

//put your code here
}
