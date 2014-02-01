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
    private $id;
    private $Nombre;
    private $Preciounitario;
    private $IdFacturaEncabezado;

    public function getUnidadmedida() {
        return $this->Unidadmedida;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSubtotal() {
        return $this->Subtotal;
    }

    public function getIdFacturaEncabezado() {
        return $this->IdFacturaEncabezado;
    }

    public function setIdFacturaEncabezado($IdFacturaEncabezado) {
        $this->IdFacturaEncabezado = $IdFacturaEncabezado;
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
