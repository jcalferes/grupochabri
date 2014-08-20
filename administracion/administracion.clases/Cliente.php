<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cliente
 *
 * @author Solis
 */
class Cliente {

    private $nombre;
    private $idDireccion;
    private $rfc;
    private $diasCredito;
    private $desctfactura;
    private $desctprontopago;
    private $email;
    private $tipoCliente;

    public function getTipoCliente() {
        return $this->tipoCliente;
    }

    public function setTipoCliente($tipoCliente) {
        $this->tipoCliente = $tipoCliente;
    }

    
    public function getNombre() {
        return $this->nombre;
    }

    public function getIdDireccion() {
        return $this->idDireccion;
    }

    public function getRfc() {
        return $this->rfc;
    }

    public function getDiasCredito() {
        return $this->diasCredito;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setIdDireccion($idDireccion) {
        $this->idDireccion = $idDireccion;
    }

    public function setRfc($rfc) {
        $this->rfc = $rfc;
    }

    public function setDiasCredito($diasCredito) {
        $this->diasCredito = $diasCredito;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDesctfactura() {
        return $this->desctfactura;
    }

    public function getDesctprontopago() {
        return $this->desctprontopago;
    }

    public function setDesctfactura($desctfactura) {
        $this->desctfactura = $desctfactura;
    }

    public function setDesctprontopago($desctprontopago) {
        $this->desctprontopago = $desctprontopago;
    }

    //put your code here
}
