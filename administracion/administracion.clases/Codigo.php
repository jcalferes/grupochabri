<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Codigo
 *
 * @author Usuario
 */
class Codigo {

    private $codigo;
    private $cantidad;
    private $producto;
    private $costo;

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

}

?>
