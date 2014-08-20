<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of imagen
 *
 * @author Solis
 */
class imagen {
    private $idImagen;
    private $ruta;
    private $codigoProducto;
    public function getIdImagen() {
        return $this->idImagen;
    }

    public function getRuta() {
        return $this->ruta;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function setIdImagen($idImagen) {
        $this->idImagen = $idImagen;
    }

    public function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }


    
}
