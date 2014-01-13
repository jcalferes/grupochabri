<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of proveedores
 *
 * @author Angel Solis
 */
class proveedores {

    private $nombre;
    private $idDireccion;
    private $rfc;
    private $diasCredito;
    private $descuento;

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdDireccion() {
        return $this->idDireccion;
    }

    public function getRfc() {
        return $this->rfc;
    }

    public function getDiasCredito() {
        return $this->diasCredito;
    }

    public function getDescuento() {
        return $this->descuento;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setIdDireccion($idDireccion) {
        $this->idDireccion = $idDireccion;
    }

    public function setRfc($rfc) {
        $this->rfc = $rfc;
    }

    public function setDiasCredito($diasCredito) {
        $this->diasCredito = $diasCredito;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

}
