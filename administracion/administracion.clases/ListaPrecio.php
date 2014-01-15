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
 private $Tarifa;
 private $costos;
 public function getIdListaPrecios() {
     return $this->idListaPrecios;
 }

 public function getTarifa() {
     return $this->Tarifa;
 }

 public function getCostos() {
     return $this->costos;
 }

 public function setIdListaPrecios($idListaPrecios) {
     $this->idListaPrecios = $idListaPrecios;
 }

 public function setTarifa($Tarifa) {
     $this->Tarifa = $Tarifa;
 }

 public function setCostos($costos) {
     $this->costos = $costos;
 }


}
