<?php

class Utilerias {

    function generarFecha() {
        return date("d-m-Y ");
    }

    /**
     * funcion para convertir un numero a decimal con X digitos
     * @param String $number
     * @param Int $digitos cantidad de digitos a mostrar
     * @return Float
     */
    function truncateFloat($number, $digitos) {
        $raiz = 10;
        $multiplicador = pow($raiz, $digitos);
        $resultado = ((int) ($number * $multiplicador)) / $multiplicador;
        return number_format($resultado, $digitos);
    }

}

?>
