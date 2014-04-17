<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Detalles
 *
 * @author Joel
 */
class Detalle {

    private $Cantidad;
    private $Unidadmedida;
    private $Codigo;
    private $Descripcion;
    private $Costo;
    private $Importe;
    private $IdFacturaEncabezado;
    private $costoCotizacion;

    public function getCostoCotizacion() {
        return $this->costoCotizacion;
    }

    public function setCostoCotizacion($costoCotizacion) {
        $this->costoCotizacion = $costoCotizacion;
    }

        
    public function getCantidad() {
        return $this->Cantidad;
    }

    public function getUnidadmedida() {
        return $this->Unidadmedida;
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getCosto() {
        return $this->Costo;
    }

    public function getImporte() {
        return $this->Importe;
    }

    public function getIdFacturaEncabezado() {
        return $this->IdFacturaEncabezado;
    }

    public function setCantidad($Cantidad) {
        $this->Cantidad = $Cantidad;
    }

    public function setUnidadmedida($Unidadmedida) {
        $this->Unidadmedida = $Unidadmedida;
    }

    public function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setCosto($Costo) {
        $this->Costo = $Costo;
    }

    public function setImporte($Importe) {
        $this->Importe = $Importe;
    }

    public function setIdFacturaEncabezado($IdFacturaEncabezado) {
        $this->IdFacturaEncabezado = $IdFacturaEncabezado;
    }

}
