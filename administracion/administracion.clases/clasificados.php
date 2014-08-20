<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clasificados
 *
 * @author Solis
 */
class clasificados {
    //put your code here
    private $idClasificados;
    private $codigoProducto;
    private $idTipo;
    private $descripcion;
    private $ponerRecomendado;
    private $ponerNovedades;
    public function getIdClasificados() {
        return $this->idClasificados;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPonerRecomendado() {
        return $this->ponerRecomendado;
    }

    public function getPonerNovedades() {
        return $this->ponerNovedades;
    }

    public function setIdClasificados($idClasificados) {
        $this->idClasificados = $idClasificados;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }

    public function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPonerRecomendado($ponerRecomendado) {
        $this->ponerRecomendado = $ponerRecomendado;
    }

    public function setPonerNovedades($ponerNovedades) {
        $this->ponerNovedades = $ponerNovedades;
    }


}
