<?php

require_once 'ado.class.php';

class EstudantesAdo extends ADO {

    public function consultaArrayDeObjeto() {
        
    }

    public function consultaObjetoPeloId($id) {
        
    }

    function lista() {
        $query = " SELECT * FROM Estudantes ";

        return parent::lista($query);
    }

    public function insereObjeto(\Model $objetoModelo) {
        $query = "insert into Estudantes (estu_matricula, estu_nome) "
                . "               values (?,?)";
        
        $arrayDeValores = array($objetoModelo->getEstuMatricula(), $objetoModelo->getEstuNome());

        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("O estudante {$objetoModelo->getEstuNome()} foi inserido com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao inserir o estudante {$objetoModelo->getEstuNome()}, contate do administrador do sistema!");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

    public function buscaMatriculaPelaMatricula($estuMatricula) {
        
        $query = "Select * from Estudantes where estu_matricula = ?";

        try {
            $executou = parent::executaPs($query, array($estuMatricula));

            if ($executou) {
                $estudanteArray = parent::leTabelaBD();
                $estudanteModel = new EstudantesModel($estudanteArray['estu_matricula'], $estudanteArray['estu_nome']);
                
                return $estudanteModel;
            } else {
                parent::setMensagem("Erro no select.");
                return false;
            }
        } catch (ErroNoBD $exc) {
            parent::setMensagem($exc->getMessage());
            return false;
        }
    }

    public function alteraObjeto(\Model $estudanteModel) {
        $query = "update Estudantes "
                . "  set estu_nome = ? "
                . "where estu_matricula = ? ";

        $arrayDeValores = array($estudanteModel->getEstuNome(), $estudanteModel->getEstuMatricula());

        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("O estudante {$estudanteModel->getEstuNome()} foi alterado com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao alterar o estudante {$estudanteModel->getEstuNome()}, contate do administrador do sistema!");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

    public function excluiObjeto(\Model $objetoModelo) {
        $query = "delete from Estudantes "
                . "where estu_matricula = ? ";

        $arrayDeValores = array($objetoModelo->getEstuMatricula());

        try {
            $resultado = parent::executaPs($query, $arrayDeValores);

            if ($resultado) {
                parent::setMensagem("O estudante {$objetoModelo->getEstuNome()} foi excluído com sucesso!");
                return true;
            } else {
                parent::setMensagem("Erro ao excluir o estudante {$objetoModelo->getEstuNome()}, contate do administrador do sistema!");
                return false;
            }
        } catch (PDOException $exc) {
            throw new ErroNoBD($exc->getMessage());
        }
    }

}
