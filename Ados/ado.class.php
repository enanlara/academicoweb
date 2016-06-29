<?php

//class ErroNoBD extends Exception {

//cd }

require_once '../Ados/bancodedadospdo.class.php';

abstract class ADO extends BancoDeDadosPdo
{

    private $mensagem = null;

    function getMensagem()    
    {
        return $this->mensagem;
    }

    function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    function lista($query)
    {
        try {
            if ($linhas = parent::executaQuery($query)) {

                while ($linhas = parent::leTabelaBD(5)) {
                    $arrayObjeto [] = clone ($linhas);
                }

                $arrayObjeto = (isset($arrayObjeto)) ? $arrayObjeto : false;

                return $arrayObjeto;
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    abstract public function consultaObjetoPeloId($id);

    abstract public function consultaArrayDeObjeto();

    abstract public function insereObjeto(Model $objetoModelo);

    abstract public function alteraObjeto(Model $objetoModelo);

    abstract public function excluiObjeto(Model $objetoModelo);
}

?>

