<?php

class Direccion {

    private $calle;
    private $numeroexterior;
    private $numerointerior;
    private $cruzamientos;
    private $idpostal;
    private $idDireccion;
    private $colonia;
    private $estado;
    private $ciudad;
    private $postal;

    public function getPostal() {
        return $this->postal;
    }

    public function setPostal($postal) {
        $this->postal = $postal;
    }

        public function getColonia() {
        return $this->colonia;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function setColonia($colonia) {
        $this->colonia = $colonia;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    
    public function getIdDireccion() {
        return $this->idDireccion;
    }

    public function setIdDireccion($idDireccion) {
        $this->idDireccion = $idDireccion;
    }

    public function getCalle() {
        return $this->calle;
    }

    public function setCalle($calle) {
        $this->calle = $calle;
    }

    public function getNumeroexterior() {
        return $this->numeroexterior;
    }

    public function setNumeroexterior($numeroexterior) {
        $this->numeroexterior = $numeroexterior;
    }

    public function getNumerointerior() {
        return $this->numerointerior;
    }

    public function setNumerointerior($numerointerior) {
        $this->numerointerior = $numerointerior;
    }

    public function getCruzamientos() {
        return $this->cruzamientos;
    }

    public function setCruzamientos($cruzamientos) {
        $this->cruzamientos = $cruzamientos;
    }

    public function getIdPostal() {
        return $this->idpostal;
    }

    public function setIdPostal($idpostal) {
        $this->idpostal = $idpostal;
    }

}
