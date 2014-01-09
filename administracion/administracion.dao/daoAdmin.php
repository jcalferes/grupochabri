<?php

include '../daoconexion/daoConeccion.php';
include '../../Productos.php';

class daoAdmin {

    function mostrarTabla() {

        $prr = new Productos();
//        $cn = new coneccion();
//        $sql = "SELECT *\n"
//                . "FROM productos p\n"
//                . "INNER JOIN listaprecios l ON p.idListaPrecios = l.idListaPrecios\n"
//                . "INNER JOIN marcas m ON m.idMarca = p.idMarca\n"
//                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor LIMIT 0, 30 ";
//        $datos = mysql_query($sql, $cn->Conectarse());
        $prr->listaPrecios;
        $tarifa = $prr->listaPrecios->getTarifa();
        echo $tarifa;
    }

}
