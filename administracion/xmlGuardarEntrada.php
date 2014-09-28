<?php

session_start();

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

class Detalle {

    private $Cantidad;
    private $Unidadmedida;
    private $Codigo;
    private $Descripcion;
    private $Costo;
    private $Importe;
    private $IdFacturaEncabezado;
    private $costoCotizacion;

    public function getCostoCotizacion() {
        return $this->costoCotizacion;
    }

    public function setCostoCotizacion($costoCotizacion) {
        $this->costoCotizacion = $costoCotizacion;
    }

    public function getCantidad() {
        return $this->Cantidad;
    }

    public function getUnidadmedida() {
        return $this->Unidadmedida;
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getCosto() {
        return $this->Costo;
    }

    public function getImporte() {
        return $this->Importe;
    }

    public function getIdFacturaEncabezado() {
        return $this->IdFacturaEncabezado;
    }

    public function setCantidad($Cantidad) {
        $this->Cantidad = $Cantidad;
    }

    public function setUnidadmedida($Unidadmedida) {
        $this->Unidadmedida = $Unidadmedida;
    }

    public function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setCosto($Costo) {
        $this->Costo = $Costo;
    }

    public function setImporte($Importe) {
        $this->Importe = $Importe;
    }

    public function setIdFacturaEncabezado($IdFacturaEncabezado) {
        $this->IdFacturaEncabezado = $IdFacturaEncabezado;
    }

}

//include './administracion.clases/Encabezado.php'
//include './administracion.clases/Detalle.php';
include './administracion.clases/Comprobante.php';
include './administracion.clases/Concepto.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
include_once '../daoconexion/daoConeccion.php';

$idsucursal = $_SESSION["sucursalSesion"];

$detalle = new Detalle();
$encabezado = new Encabezado();
$comprobante = new Comprobante();
$concepto = new Concepto();

$dao = new dao();
$cn = new coneccion();
$cn->Conectarse();

$lafecha = date("d/m/Y");

$encabezado = $_SESSION['objEncabezadoEntrada'];
$arrayDetalleEntrada = $_SESSION['arrayDetalleEntrada'];

$datos = json_decode($_POST['datos']);
$compbt = $datos[1];
$conceptos = $datos[0];

$comprobante->setDescuentoFactura(floatval($compbt->desctFactura));
$comprobante->setDescuentoProntoPago(floatval($compbt->desctProntoPago));
$comprobante->setDescuentoGeneral(floatval($compbt->desctGeneral));
$comprobante->setDescuentoPorProducto(floatval($compbt->desctPorProductos));
$comprobante->setDescuentoTotal(floatval($compbt->desctTotal));
$comprobante->setSda(floatval($compbt->sda));
$comprobante->setConIva(floatval($compbt->iva));
$comprobante->setTotal(floatval($compbt->total));

$rfc = $encabezado->getRfc();
$valido = $dao->validarExistenciaProductoProveedor($rfc);
if ($valido == false) {
    echo 2;
} else {
    $validaCodigo = 1;
    $rechazaCodigo = 0;
    foreach ($conceptos as $concepto) {
        $ads = $concepto->codigo;
        while ($rs = mysql_fetch_array($valido)) {
            if ($ads != $rs['codigoProducto']) {
                $rechazaCodigo = $concepto->codigo;
            } else {
                $validaCodigo = 0;
            }
        }
        mysql_data_seek($valido, 0);

        if ($validaCodigo != 0) {
            echo $rechazaCodigo;
            return false;
        }
    }
    $control = count($conceptos);
    $paso = $dao->superMegaGuardadorEntradas($lafecha, $encabezado, $arrayDetalleEntrada, $comprobante, $conceptos, $control, $idsucursal);
    $cn->cerrarBd();
    if ($paso == false) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
