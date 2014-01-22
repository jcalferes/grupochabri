<?php

class Direccion {

    private $calle;
    private $numeroexterior;
    private $numerointerior;
    private $idpostal;

//    private $postal;
//    private $colonia;

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

    public function getIdPostal() {
        return $this->idpostal;
    }

    public function setIdPostal($idpostal) {
        $this->idpostal = $idpostal;
    }

//    public function getPostal() {
//        return $this->postal;
//    }
//
//    public function setPostal($postal) {
//        $this->postal = $postal;
//    }
//
//    public function getColonia() {
//        return $this->colonia;
//    }
//
//    public function setColonia($colonia) {
//        $this->colonia = $colonia;
//    }
}
