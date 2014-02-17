<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encabezado
 *
 * @author Joel
 */
class Encabezado {

    private $folio;
    private $Fecha;
    private $Subtotal;
    private $Total;
    private $Tda;
    private $Rfc;
    private $DescuentoFactura;
    private $DescuentoProntoPago;
    private $DescuentoGeneral;
    private $DescuentoPorProducto;
    private $DescuentoTotal;
    private $Sda;
    private $ConIva;

    public function getFolio() {
        return $this->folio;
    }

    public function getFecha() {
        return $this->Fecha;
    }

    public function getSubtotal() {
        return $this->Subtotal;
    }

    public function getTotal() {
        return $this->Total;
    }

    public function getRfc() {
        return $this->Rfc;
    }

    public function getDescuentoFactura() {
        return $this->DescuentoFactura;
    }

    public function getDescuentoProntoPago() {
        return $this->DescuentoProntoPago;
    }

    public function getDescuentoGeneral() {
        return $this->DescuentoGeneral;
    }

    public function getDescuentoPorProducto() {
        return $this->DescuentoPorProducto;
    }

    public function getDescuentoTotal() {
        return $this->DescuentoTotal;
    }

    public function getSda() {
        return $this->Sda;
    }

    public function getConIva() {
        return $this->ConIva;
    }

    public function setFolio($folio) {
        $this->folio = $folio;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    public function setSubtotal($Subtotal) {
        $this->Subtotal = $Subtotal;
    }

    public function setTotal($Total) {
        $this->Total = $Total;
    }

    public function setRfc($Rfc) {
        $this->Rfc = $Rfc;
    }

    public function setDescuentoFactura($DescuentoFactura) {
        $this->DescuentoFactura = $DescuentoFactura;
    }

    public function setDescuentoProntoPago($DescuentoProntoPago) {
        $this->DescuentoProntoPago = $DescuentoProntoPago;
    }

    public function setDescuentoGeneral($DescuentoGeneral) {
        $this->DescuentoGeneral = $DescuentoGeneral;
    }

    public function setDescuentoPorProducto($DescuentoPorProducto) {
        $this->DescuentoPorProducto = $DescuentoPorProducto;
    }

    public function setDescuentoTotal($DescuentoTotal) {
        $this->DescuentoTotal = $DescuentoTotal;
    }

    public function setSda($Sda) {
        $this->Sda = $Sda;
    }

    public function setConIva($ConIva) {
        $this->ConIva = $ConIva;
    }

    public function getTda() {
        return $this->Tda;
    }

    public function setTda($Tda) {
        $this->Tda = $Tda;
    }

}
