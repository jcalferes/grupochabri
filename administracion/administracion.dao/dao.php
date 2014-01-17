<?php

class dao {
    
    function guardarProducto(){
        
        
    }
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

    function consultarListaPrecios() {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM listaprecios";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function consultarProveedores() {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM proveedores";

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

    function guardarMarca(Marca $t) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO marcas(marca)VALUES ('" . $t->getMarca() . "')";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarDireccion(direccion $t) {
//        session_start();
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO direcciones(calle, numeroExterior, numeroInterior, codigoPostal, colonia )VALUES ('" . $t->getCalle() . "','" . $t->getNumeroexterior() . "','" . $t->getNumerointerior() . "','" . $t->getPostal() . "','" . $t->getColonia() . "');";
        $sql2 = "SELECT LAST_INSERT_ID() ID;";
        mysql_query($sql, $cn->Conectarse());
        $dato = mysql_query($sql2, $cn->Conectarse());
        while ($rs = mysql_fetch_array($dato)) {
            $id = $rs["ID"];
        }
        $_SESSION['iddireccion'] = $id;
        $cn->cerrarBd();
    }

    function guardarProveedor(proveedores $t) {
//        include '../daoconexion/daoConeccion.php'; Esta comentado por que ya se incluyo en guardarDireccion
        $cn = new coneccion();
        $sql = "INSERT INTO proveedores(nombre, idDireccion, rfc, diasCredito, descuento)VALUES ('" . $t->getNombre() . "','" . $t->getIdDireccion() . "','" . $t->getRfc() . "','" . $t->getDiasCredito() . "','" . $t->getDescuento() . "');";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

}

?>