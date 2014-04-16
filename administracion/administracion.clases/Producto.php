<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producto
 *
 * @author Angel Solis
 */
class Producto {

    private $idProducto;
    private $producto;
    private $idMarca;
    private $idProveedor;
    private $idListaPrecios;
    private $codigoProducto;
    private $cantidadMaxima;
    private $cantidadMinima;
    private $idUnidadMedida;
    private $idGrupoProducto;
    private $cantidad;
    private $cbarras;
    
    public function getCbarras() {
        return $this->cbarras;
    }

    public function setCbarras($cbarras) {
        $this->cbarras = $cbarras;
    }

    
    public function getIdUnidadMedida() {
        return $this->idUnidadMedida;
    }

    public function getIdGrupoProducto() {
        return $this->idGrupoProducto;
    }

    public function setIdUnidadMedida($idUnidadMedida) {
        $this->idUnidadMedida = $idUnidadMedida;
    }

    public function setIdGrupoProducto($idGrupoProducto) {
        $this->idGrupoProducto = $idGrupoProducto;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getIdProveedor() {
        return $this->idProveedor;
    }

    public function getIdListaPrecios() {
        return $this->idListaPrecios;
    }

    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }

    public function setIdMarca($idMarca) {
        $this->idMarca = $idMarca;
    }

    public function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    public function setIdListaPrecios($idListaPrecios) {
        $this->idListaPrecios = $idListaPrecios;
    }

    public function setCodigoProducto($codigoProducto) {
        $this->codigoProducto = $codigoProducto;
    }

    public function getCantidadMaxima() {
        return $this->cantidadMaxima;
    }

    public function getCantidadMinima() {
        return $this->cantidadMinima;
    }

    public function setCantidadMaxima($cantidadMaxima) {
        $this->cantidadMaxima = $cantidadMaxima;
    }

    public function setCantidadMinima($cantidadMinima) {
        $this->cantidadMinima = $cantidadMinima;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

}
