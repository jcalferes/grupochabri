<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entradas
 *
 * @author Usuario
 */
class Entradas {
private $idEntrada;
private $idProducto;
private $cantidad;
private $fecha;
private $idSucursal;
private $codigoProducto;
private $usuario;


public function getIdEntrada() {
    return $this->idEntrada;
}

public function setIdEntrada($idEntrada) {
    $this->idEntrada = $idEntrada;
}

public function getIdProducto() {
    return $this->idProducto;
}

public function setIdProducto($idProducto) {
    $this->idProducto = $idProducto;
}

public function getCantidad() {
    return $this->cantidad;
}

public function setCantidad($cantidad) {
    $this->cantidad = $cantidad;
}

public function getFecha() {
    return $this->fecha;
}

public function setFecha($fecha) {
    $this->fecha = $fecha;
}

public function getIdSucursal() {
    return $this->idSucursal;
}

public function setIdSucursal($idSucursal) {
    $this->idSucursal = $idSucursal;
}

public function getCodigoProducto() {
    return $this->codigoProducto;
}

public function setCodigoProducto($codigoProducto) {
    $this->codigoProducto = $codigoProducto;
}

public function getUsuario() {
    return $this->usuario;
}

public function setUsuario($usuario) {
    $this->usuario = $usuario;
}
}

?>
