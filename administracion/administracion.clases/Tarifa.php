<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tarifas
 *
 * @author Angel Solis
 */
class Tarifa {

    private $idTarifa;
    private $tarifa;
    private $idProducto;
    private $idListaPrecio;
    private $porcentajeUtilidad;
    public function getPorcentajeUtilidad() {
        return $this->porcentajeUtilidad;
    }

    public function setPorcentajeUtilidad($porcentajeUtilidad) {
        $this->porcentajeUtilidad = $porcentajeUtilidad;
    }

        
    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getIdListaPrecio() {
        return $this->idListaPrecio;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setIdListaPrecio($idListaPrecio) {
        $this->idListaPrecio = $idListaPrecio;
    }

    
    public function getIdTarifa() {
        return $this->idTarifa;
    }

    public function getTarifa() {
        return $this->tarifa;
    }

    public function setIdTarifa($idTarifa) {
        $this->idTarifa = $idTarifa;
    }

    public function setTarifa($tarifa) {
        $this->tarifa = $tarifa;
    }

}
