<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaccionEncabezados
 *
 * @author Solis
 */
class transaccionEncabezados {
private $fechaTransaccion;
private $idEncabezadoTransaccion;
private $statusAprobacion;
private $statusTransaccion;

public function getFechaTransaccion() {
    return $this->fechaTransaccion;
}

public function getIdEncabezadoTransaccion() {
    return $this->idEncabezadoTransaccion;
}

public function getStatusAprobacion() {
    return $this->statusAprobacion;
}

public function getStatusTransaccion() {
    return $this->statusTransaccion;
}

public function setFechaTransaccion($fechaTransaccion) {
    $this->fechaTransaccion = $fechaTransaccion;
}

public function setIdEncabezadoTransaccion($idEncabezadoTransaccion) {
    $this->idEncabezadoTransaccion = $idEncabezadoTransaccion;
}

public function setStatusAprobacion($statusAprobacion) {
    $this->statusAprobacion = $statusAprobacion;
}

public function setStatusTransaccion($statusTransaccion) {
    $this->statusTransaccion = $statusTransaccion;
}


    
    
    
}
