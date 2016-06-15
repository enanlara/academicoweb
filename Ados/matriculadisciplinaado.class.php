<?php

require_once 'ado.class.php';

class ErroNoBD extends Exception {
    
}

class MatriculaDisciplinaAdo extends ADO {

    public function alteraObjeto(\Model $objetoModelo) {
        $this->excluiObjeto($objetoModelo);
        $this->insereObjeto($objetoModelo);

    }

    public function consultaArrayDeObjeto() {
        $query = "select disc_codigo, disc_nome from Disciplinas";
        try {
            $executou = parent::executaQuery($query);
            if ($executou) {
                $arrayDeDisciplinas = null;
                while ($linha = parent::leTabelaBD($executou)) {
                    $disc = new stdClass();
                    $disc->discCodigo = $linha['disc_codigo'];
                    $disc->discNome = $linha['disc_nome'];
                    $disc->checked = null;
                    $arrayDeDisciplinas[] = $disc;
                }
                return $arrayDeDisciplinas;
            } else {
                parent::setMensagem("Erro no select.");
                return false;
            }
        } catch (ErroNoBD $exc) {
            parent::setMensagem($exc->getMessage());
            return false;
        }
    }

    public function consultaObjetoPeloId($id) {
        $query = "select mc.matrz_disc_codigo, d.disc_nome from Matrizes_de_cursos mc, Disciplinas d "
                . "where mc.matrz_disc_codigo = d.disc_codigo and"
                . " mc.matrz_curs_id = {$id}";

        try {
            $executou = parent::executaQuery($query);
            echo '<br>' . $query . '<br>';
            if ($executou) {
                $arrayDeDisciplinas = null;
                while ($linha = parent::leTabelaBD($executou)) {
                    $disc = new stdClass();
                    $disc->discCodigo = $linha['matrz_disc_codigo'];
                    $disc->discNome = $linha['disc_nome'];
                    $disc->checked = null;

                    $arrayDeDisciplinas[] = $disc;
                }
                return $arrayDeDisciplinas;
            }
        } catch (Exception $ex) {
            
        }
    }

    public function consultaMatriz($id) {
        $arrayDiscSelecionadas = null;

        $queryMatriz = "select matrz_disc_codigo from Matrizes_de_cursos where matrz_curs_id = {$id} ";
        try {
            $executou = parent::executaQuery($queryMatriz);
            if ($executou) {
                while ($linha = parent::leTabelaBD()) {
                    $arrayDiscSelecionadas[] = $linha['matrz_disc_codigo'];
                }
            }
        } catch (PDOException $e) {
            
        }

        $query = "select disc_codigo, disc_nome from Disciplinas";
        try {
            $executou = parent::executaQuery($query);
            if ($executou) {
                $arrayDeDisciplinas = null;
                while ($linha = parent::leTabelaBD($executou)) {
                    $disc = new stdClass();
                    $disc->discCodigo = $linha['disc_codigo'];
                    $disc->discNome = $linha['disc_nome'];
                    if ($arrayDiscSelecionadas == null) {
                        $disc->checked = null;
                    } elseif (in_array($linha['disc_codigo'], $arrayDiscSelecionadas)) {
                        $disc->checked = "checked";
                    } else {
                        $disc->checked = null;
                    }
                    $arrayDeDisciplinas[] = $disc;
                }
                return $arrayDeDisciplinas;
            }
        } catch (PDOException $e) {
            throw new ErroNoBD($e->getMessage());
        }
    }

    public function excluiObjeto(\Model $objetoModelo) {
        $query = "delete from Matrizes_de_cursos where matrz_curs_id = {$objetoModelo->getMatrzCursId()}";
        try {
            $executou = parent::executaQuery($query);
            if ($executou) {
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
        echo '<pre>';
        print_r($objetoModelo);
        echo '</pre>';

        $query = "insert into Matriculas_por_curso values ("
                . "{$objetoModelo->getMatrdDiscId()}, "
                . "{$objetoModelo->getMatrdEstuMatricula()}, "
                . "'{$objetoModelo->getMatrdDataInicial()}',"
                . "'{$objetoModelo->getMatrdDataFinal()}' "
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

//put your code here
}
