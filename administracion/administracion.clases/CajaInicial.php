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
    private $cajaCerrada;
    private $cantidadCaja;
    private $cantidadSistema;
    private $observaciones;
    private $cuadroCaja;

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

    function getCajaCerrada() {
        return $this->cajaCerrada;
    }

    function getCantidadCaja() {
        return $this->cantidadCaja;
    }

    function getCantidadSistema() {
        return $this->cantidadSistema;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function setCajaCerrada($cajaCerrada) {
        $this->cajaCerrada = $cajaCerrada;
    }

    function setCantidadCaja($cantidadCaja) {
        $this->cantidadCaja = $cantidadCaja;
    }

    function setCantidadSistema($cantidadSistema) {
        $this->cantidadSistema = $cantidadSistema;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
    function getCuadroCaja() {
        return $this->cuadroCaja;
    }

    function setCuadroCaja($cuadroCaja) {
        $this->cuadroCaja = $cuadroCaja;
    }


    
    
}
