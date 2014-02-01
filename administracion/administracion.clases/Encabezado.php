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

    private $Fecha;
    private $Subtotal;
    private $Total;
    private $Rfc;
    private $Nombre;
    private $Calle;
    private $Cp;
    private $No;
    private $Estado;
    private $Ciudad;
    private $Colonia;

    public function getCalle() {
        return $this->Calle;
    }

    public function setCalle($Calle) {
        $this->Calle = $Calle;
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

    public function getNombre() {
        return $this->Nombre;
    }

    public function getCp() {
        return $this->Cp;
    }

    public function getNo() {
        return $this->No;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function getCiudad() {
        return $this->Ciudad;
    }

    public function getColonia() {
        return $this->Colonia;
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

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setCp($Cp) {
        $this->Cp = $Cp;
    }

    public function setNo($No) {
        $this->No = $No;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    public function setCiudad($Ciudad) {
        $this->Ciudad = $Ciudad;
    }

    public function setColonia($Colonia) {
        $this->Colonia = $Colonia;
    }

}
