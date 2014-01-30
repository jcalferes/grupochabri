<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Detalles
 *
 * @author Joel
 */
class Detalle {

    private $Unidadmedida;
    private $Subtotal;
    private $Cantidad;
    private $Nombre;
    private $Preciounitario;

    public function getUnidadmedida() {
        return $this->Unidadmedida;
    }

    public function getSubtotal() {
        return $this->Subtotal;
    }

    public function getCantidad() {
        return $this->Cantidad;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getPreciounitario() {
        return $this->Preciounitario;
    }

    public function setUnidadmedida($Unidadmedida) {
        $this->Unidadmedida = $Unidadmedida;
    }

    public function setSubtotal($Subtotal) {
        $this->Subtotal = $Subtotal;
    }

    public function setCantidad($Cantidad) {
        $this->Cantidad = $Cantidad;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setPreciounitario($Preciounitario) {
        $this->Preciounitario = $Preciounitario;
    }

}
