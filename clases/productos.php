<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productos
 *
 * @author Angel Solis
 */
class productos {
    private $idProducto;
    private $producto;
    private $idMarca;
    private $proveedor;
    private $idListaPrecios;
    
    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getProveedor() {
        return $this->proveedor;
    }

    public function getIdListaPrecios() {
        return $this->idListaPrecios;
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

    public function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    public function setIdListaPrecios($idListaPrecios) {
        $this->idListaPrecios = $idListaPrecios;
    }

//    private $Referencia;
//    private $Nombre;
//    private $Unidad;
//    private $Descripcion;
//    private $tasaIva;

}
