<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CajaInicial
 *
 * @author Usuario
 */
class CajaInicial {
    private $idCajaIncial;
    private $fecha;
    private $ingreso;
    private $idSucursal;
    
    
    public function getIdCajaIncial() {
        return $this->idCajaIncial;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getIngreso() {
        return $this->ingreso;
    }

    public function getIdSucursal() {
        return $this->idSucursal;
    }

    public function setIdCajaIncial($idCajaIncial) {
        $this->idCajaIncial = $idCajaIncial;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setIngreso($ingreso) {
        $this->ingreso = $ingreso;
    }

    public function setIdSucursal($idSucursal) {
        $this->idSucursal = $idSucursal;
    }


    
}
