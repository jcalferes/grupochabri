<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of marcas
 *
 * @author Angel Solis
 */
class Marca {

    private $idMarca;
    private $marca;

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setIdMarca($idMarca) {
        $this->idMarca = $idMarca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

}
