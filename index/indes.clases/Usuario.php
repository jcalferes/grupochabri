<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Joel
 */
class Usuario {

    private $nombre;
    private $pass;

    public function getNombre() {
        return $this->nombre;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

}
