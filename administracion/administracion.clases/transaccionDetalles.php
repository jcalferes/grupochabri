<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaccionDetalles
 *
 * @author Solis
 */
class transaccionDetalles {
    private $cantidad;
    private $codigo;
    private $costo;
    private $descripcion;
    private $idDetalleTransaccion;
    private $idEncabezadoTransferencia;
    
    public function getCantidad() {
        return $this->cantidad;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdDetalleTransaccion() {
        return $this->idDetalleTransaccion;
    }

    public function getIdEncabezadoTransferencia() {
        return $this->idEncabezadoTransferencia;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIdDetalleTransaccion($idDetalleTransaccion) {
        $this->idDetalleTransaccion = $idDetalleTransaccion;
    }

    public function setIdEncabezadoTransferencia($idEncabezadoTransferencia) {
        $this->idEncabezadoTransferencia = $idEncabezadoTransferencia;
    }


    
    
    
    
}
