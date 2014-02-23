<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Costo
 *
 * @author Angel Solis
 */
class Costo {
    private $idCosto;
    private $costo;
    private $folioProducto;
    private $idProducto;
    
    public function getFolioProducto() {
        return $this->folioProducto;
    }

    public function setFolioProducto($folioProducto) {
        $this->folioProducto = $folioProducto;
    }

        public function getIdCosto() {
        return $this->idCosto;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdCosto($idCosto) {
        $this->idCosto = $idCosto;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }


    
}
