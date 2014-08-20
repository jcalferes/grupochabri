<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Maquina
 *
 * @author Solis
 */
class Maquina {
    private $idMaquina;
    private $nombreMaquina;
    public function getIdMaquina() {
        return $this->idMaquina;
    }

    public function getNombreMaquina() {
        return $this->nombreMaquina;
    }

    public function setIdMaquina($idMaquina) {
        $this->idMaquina = $idMaquina;
    }

    public function setNombreMaquina($nombreMaquina) {
        $this->nombreMaquina = $nombreMaquina;
    }


}
