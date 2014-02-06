<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoProductos
 *
 * @author Angel Solis
 */
class GrupoProductos {

    private $idGrupoProducto;
    private $grupoProducto;

    public function getIdGrupoProducto() {
        return $this->idGrupoProducto;
    }

    public function getGrupoProducto() {
        return $this->nombreProducto;
    }

    public function setIdGrupoProducto($idGrupoProducto) {
        $this->idGrupoProducto = $idGrupoProducto;
    }

    public function setGrupoProducto($nombreProducto) {
        $this->nombreProducto = $nombreProducto;
    }

}
