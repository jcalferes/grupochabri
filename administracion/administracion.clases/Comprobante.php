<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comprobante
 *
 * @author Joel
 */
class Comprobante {

    private $Folio;
    private $Fecha;
    private $FechaMovimiento;
    private $Rfc;
    private $DescuentoFactura;
    private $DescuentoProntoPago;
    private $DescuentoGeneral;
    private $DescuentoPorProducto;
    private $DescuentoTotal;
    private $Subtotal;
    private $Sda;
    private $ConIva;
    private $Total;

    public function getFolio() {
        return $this->Folio;
    }

    public function getFecha() {
        return $this->Fecha;
    }

    public function getFechaMovimiento() {
        return $this->FechaMovimiento;
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

    public function getSubtotal() {
        return $this->Subtotal;
    }

    public function getSda() {
        return $this->Sda;
    }

    public function getConIva() {
        return $this->ConIva;
    }

    public function getTotal() {
        return $this->Total;
    }

    public function setFolio($Folio) {
        $this->Folio = $Folio;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    public function setFechaMovimiento($FechaMovimiento) {
        $this->FechaMovimiento = $FechaMovimiento;
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

    public function setSubtotal($Subtotal) {
        $this->Subtotal = $Subtotal;
    }

    public function setSda($Sda) {
        $this->Sda = $Sda;
    }

    public function setConIva($ConIva) {
        $this->ConIva = $ConIva;
    }

    public function setTotal($Total) {
        $this->Total = $Total;
    }

}
