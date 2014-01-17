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


}
