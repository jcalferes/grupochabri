<?php

class dao {

    function consultaProducto() {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, pr.nombre, m.marca, l.costos, p.idProductos \n"
                . "FROM productos p\n"
                . "INNER JOIN listaprecios l ON p.idListaPrecios = l.idListaPrecios\n"
                . "INNER JOIN marcas m ON m.idMarca = p.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor LIMIT 0, 30 ";
        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function consultarMarcas() {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM marcas";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function genera_md5($clave) {
        $codificado = md5($clave);
        return $codificado;
    }

}
