 <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encabezado
 *
 * @author Joel
 */
class Encabezado {

    private $Folio;
    private $Fecha;
    private $Subtotal;
    private $Total;
    private $Rfc;

    public function getFolio() {
        return $this->Folio;
    }

    public function getFecha() {
        return $this->Fecha;
    }

    public function getSubtotal() {
        return $this->Subtotal;
    }

    public function getTotal() {
        return $this->Total;
    }

    public function getRfc() {
        return $this->Rfc;
    }

    public function setFolio($Folio) {
        $this->Folio = $Folio;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    public function setSubtotal($Subtotal) {
        $this->Subtotal = $Subtotal;
    }

    public function setTotal($Total) {
        $this->Total = $Total;
    }

    public function setRfc($Rfc) {
        $this->Rfc = $Rfc;
    }

}
