<?php

class dao {

    function guardarProducto(Producto $p) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO productos(producto, idMarca, idProveedor, codigoProducto)VALUES (UPPER('" . $p->getProducto() . "','" . $p->getIdMarca() . "','" . $p->getIdProveedor() . "', '" . $p->getCodigoProducto() . "'))";
        $sql2 = "SELECT LAST_INSERT_ID() ID;";
        mysql_query($sql, $cn->Conectarse());
         $dato = mysql_query($sql2, $cn->Conectarse());
        while ($rs = mysql_fetch_array($dato)) {
            $id = $rs[0];
        }
        
          $_SESSION['idProducto'] = $id;
        $cn->cerrarBd();
       
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
        while ($rs = mysql_fetch_array($dato)) {
            $id = $rs[1];
        }

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
        $sql = "INSERT INTO marcas(marca)VALUES (UPPER('" . $t->getMarca() . "'))";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarDireccion(Direccion $t) {
        session_start();
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

    function guardarProveedor(Proveedor $t) {
        $cn = new coneccion();
        $sql = "INSERT INTO proveedores(nombre, idDireccion, rfc, diasCredito, descuento)VALUES ('" . $t->getNombre() . "','" . $t->getIdDireccion() . "','" . $t->getRfc() . "','" . $t->getDiasCredito() . "','" . $t->getDescuento() . "');";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarListaPrecio(ListaPrecio $t) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
//        try {
        $sql = "INSERT INTO listaprecios (nombreListaPrecio) VALUES ('" . $t->getNombreListaPrecio() . "')";
        $vl = mysql_query($sql, $cn->Conectarse());
        if ($vl === false) {
            $control = 0;
        } else {
            $control = 1;
        }
//        } catch (Exception $e) {
//            $mens = "Error al insertar: " . $e;
//        }
        return $control;
        $cn->cerrarBd();
    }

}

?>
