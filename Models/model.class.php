<?php

class Model
{

    function VerificaObjeto($objeto)
    {

        foreach ($objeto as $atributo) {
            if (is_null($atributo) || $atributo == '') {
                return false;
            }
        }

        return true;
    }

}
