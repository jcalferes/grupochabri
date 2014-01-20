<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listaPrecios
 *
 * @author Angel Solis
 */
class ListaPrecio {

    private $idListaPrecios;
    private $NombreListaPrecio;
  

    public function getIdListaPrecios() {
        return $this->idListaPrecios;
    }
    
    public function setIdListaPrecios($idListaPrecios) {
        $this->idListaPrecios = $idListaPrecios;
    }
    
    public function getNombreListaPrecio() {
        return $this->NombreListaPrecio;
    }

    public function setNombreListaPrecio($NombreListaPrecio) {
        $this->NombreListaPrecio = $NombreListaPrecio;
    }
}
