<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 * @author Joel
 */
class Usuario {

    private $tipousuario;
    private $usuario;
    private $nombre;
    private $paterno;
    Private $Materno;
    private $pass;

    public function getTipousuario() {
        return $this->tipousuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPaterno() {
        return $this->paterno;
    }

    public function getMaterno() {
        return $this->Materno;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setTipousuario($tipousuario) {
        $this->tipousuario = $tipousuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPaterno($paterno) {
        $this->paterno = $paterno;
    }

    public function setMaterno($Materno) {
        $this->Materno = $Materno;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

}
