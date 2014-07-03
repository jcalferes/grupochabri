<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tiposProducto
 *
 * @author Solis
 */
class tiposProducto {
private $idTiposProducto;
private $idGrupoProducto;
private $TiposProducto;
public function getIdTiposProducto() {
    return $this->idTiposProducto;
}

public function getIdGrupoProducto() {
    return $this->idGrupoProducto;
}

public function getTiposProducto() {
    return $this->TiposProducto;
}

public function setIdTiposProducto($idTiposProducto) {
    $this->idTiposProducto = $idTiposProducto;
}

public function setIdGrupoProducto($idGrupoProducto) {
    $this->idGrupoProducto = $idGrupoProducto;
}

public function setTiposProducto($TiposProducto) {
    $this->TiposProducto = $TiposProducto;
}


        
}
