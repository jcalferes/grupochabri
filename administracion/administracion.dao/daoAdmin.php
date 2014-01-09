<?php

class daoAdmin {

    function mostrarTabla() {
        include '../administracion.clases/productos.php';
//        $productos = new productos();
//        $cn = new coneccion();
//        $sql = "SELECT *\n"
//                . "FROM productos p\n"
//                . "INNER JOIN listaprecios l ON p.idListaPrecios = l.idListaPrecios\n"
//                . "INNER JOIN marcas m ON m.idMarca = p.idMarca\n"
//                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor LIMIT 0, 30 ";
//        $datos = mysql_query($sql, $cn->Conectarse());
        $productos->listaPrecios;
        $tarifa = $productos->listaPrecios->getTarifa();
        echo $tarifa;
    }

}



