<?php

class Model {

    //put your code here

    function VerificaObjeto($objeto) {
        
        foreach ($objeto as $atributo) {           
            if (is_null($atributo) || $atributo == '') {
                return false;
            }
        }
    }

}
