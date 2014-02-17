<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Concepto
 * @author Joel
 */
class Concepto {

    private $Cantidad;
    private $Unidadmedida;
    private $Codigo;
    private $Descripcion;
    private $Costo;
    private $Importe;
    private $IdFacturaEncabezado;
    private $Cda;
    private $DesctUno;
    private $DesctDos;

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

    public function getCda() {
        return $this->Cda;
    }

    public function getDesctUno() {
        return $this->DesctUno;
    }

    public function getDesctDos() {
        return $this->DesctDos;
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

    public function setCda($Cda) {
        $this->Cda = $Cda;
    }

    public function setDesctUno($DesctUno) {
        $this->DesctUno = $DesctUno;
    }

    public function setDesctDos($DesctDos) {
        $this->DesctDos = $DesctDos;
    }

}
