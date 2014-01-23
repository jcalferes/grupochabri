<?php

class Direccion {

    private $calle;
    private $numeroexterior;
    private $numerointerior;
    private $cruzamientos;
    private $idpostal;

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
