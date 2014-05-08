<?php

class Utilerias {

    function genera_md5($clave) {
        $codificado = md5($clave);
        return $codificado;
    }

    function generarFecha() {
        return date("d/m/Y");
    }

    function truncateFloat($number, $digitos) {
        $raiz = 10;
        $multiplicador = pow($raiz, $digitos);
        $resultado = ((int) ($number * $multiplicador)) / $multiplicador;
        return number_format($resultado, $digitos);
    }



// END FUNCTION
}
?>

