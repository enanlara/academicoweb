<?php

require_once 'ado.class.php';


class ErroNoBD extends Exception {
    
}

class ResponsavelAdo extends ADO {

    function lista() {
        $query = " SELECT * FROM Responsaveis ";

        return parent::lista($query);
    }

    public function alteraObjeto(\Model $objetoModelo) {
        
    }

    public function consultaArrayDeObjeto() {
        
    }

    public function consultaObjetoPeloId($id) {
        
    }

    public function excluiObjeto(\Model $objetoModelo) {
        
    }

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
