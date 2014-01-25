<?php

class dao {

    function consultarCosto($idProducto) {
//        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos p INNER JOIN costos c ON p.idProducto = c.idProducto WHERE p.idProducto = $idProducto ";
        $resultado = mysql_query($sql, $cn->Conectarse());
        while ($rs = mysql_fetch_array($resultado)) {
            $costo = $rs["costo"];
        }
        return $costo;
    }

    function consultarTarifa($listaProducto, $idProducto) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql2 = "SELECT * FROM productos p INNER JOIN Tarifas t ON p.idProducto = t. idProducto WHERE p.idProducto = $idProducto AND t.idListaPrecio = $listaProducto";
        $resultado2 = mysql_query($sql2, $cn->Conectarse());
        while ($rs = mysql_fetch_array($resultado2)) {
            $tarifa = $rs["tarifa"];
        }

        return $tarifa;
    }

    function VerificarProducto($producto) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE producto = '$producto'";
        $resultado = mysql_query($sql, $cn->Conectarse());
        if (mysql_affected_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function consultaTarifas(Tarifa $t) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
//        $sql = "SELECT *\n"
//    . "FROM productos p\n"
//    . "Right Join tarifas t ON t.idProducto = p.idProducto\n"
//    . "Right Join listaPrecios l ON l.idListaPrecio = t.idListaPrecio LIMIT 0, 30 ";
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo,l.nombreListaPrecio, t.tarifa\n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN tarifas t ON t.idProducto = p.idProducto\n"
                . "INNER JOIN costos c ON c.idProducto = p.idProducto\n"
                . "INNER JOIN listaprecios l ON l.idListaPrecio = t.idListaPrecio "
                . "WHERE t.idListaPrecio = " . $t->getIdTarifa() . " LIMIT 0, 30 ";
        $resultado = mysql_query($sql, $cn->Conectarse());
        return $resultado;
        $cn->cerrarBd();
    }

    function guardarTarifa(Tarifa $t) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO tarifas(idProducto, tarifa, idListaPrecio)VALUES('" . $t->getIdProducto() . "','" . $t->getTarifa() . "','" . $t->getIdListaPrecio() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarProducto(Producto $p, Costo $c) {
        session_start();
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SET AUTOCOMMIT=0;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "BEGIN;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "INSERT INTO productos(producto, idMarca, idProveedor, codigoProducto)VALUES('" . $p->getProducto() . "','" . $p->getIdMarca() . "','" . $p->getIdProveedor() . "', '" . $p->getCodigoProducto() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $id = mysql_insert_id();
        $sql = "INSERT INTO costos(costo, idProducto)VALUES('" . $c->getCosto() . "','" . mysql_insert_id() . "' )";
        $resultado = mysql_query($sql, $cn->Conectarse());

        if ($resultado) {
            echo 'OK';
            echo '';
            $sql = "COMMIT";
            $resultado = mysql_query($sql, $cn->Conectarse());
        } else {
            echo 'MAL';
            echo '
';
            echo 'SE EJECUTA EL ROOLBACK';
            echo '
';

            $sql = "ROLLBACK;";
            $resultado = mysql_query($sql, $cn->Conectarse());
        }

        $_SESSION['idProducto'] = $id;
        $cn->cerrarBd();
    }

    function consultaProducto() {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.idProducto \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.idProducto = p.idProducto LIMIT 0, 30 ";

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
        $sql = "INSERT INTO marcas(marca)VALUES ('" . $t->getMarca() . "')";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarDireccion(Direccion $t) {
        session_start();
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO direcciones(calle, numeroExterior, numeroInterior, cruzamientos, idcpostales)VALUES ('" . $t->getCalle() . "','" . $t->getNumeroexterior() . "','" . $t->getNumerointerior() . "','" . $t->getCruzamientos() . "','" . $t->getIdPostal() . "');";
        $sql2 = "SELECT LAST_INSERT_ID() ID;";
        $x = mysql_query($sql, $cn->Conectarse());
        $dato = mysql_query($sql2, $cn->Conectarse());
        while ($rs = mysql_fetch_array($dato)) {
            $id = $rs["ID"];
        }
        $_SESSION['iddireccion'] = $id;
        $cn->cerrarBd();
        return $x;
    }

    function guardarProveedor(Proveedor $t) {
        $cn = new coneccion();
        $sql = "INSERT INTO proveedores(nombre, idDireccion, rfc, diasCredito, descuento)VALUES('" . $t->getNombre() . "','" . $t->getIdDireccion() . "','" . $t->getRfc() . "','" . $t->getDiasCredito() . "','" . $t->getDescuento() . "');";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarListaPrecio(ListaPrecio $t) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO listaprecios (nombreListaPrecio) VALUES ('" . $t->getNombreListaPrecio() . "')";
        $vl = mysql_query($sql, $cn->Conectarse());
        if ($vl === false) {
            $control = 0;
        } else {
            $control = 1;
        }
        $cn->cerrarBd();
        return $control;
    }

    function obtieneDireccion($t) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT idcpostales, cp, asenta, estado, ciudad FROM cpostales WHERE cp = $t";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function obtenerEntradas() {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select * from productos p 
            inner join  entradas e 
            on e.codigoProducto = p.codigoProducto";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function obtenerInformacionProducto($codigoProducto) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, pr.nombre, m.marca FROM productos p
               inner join proveedores pr
               on p.idProveedor = pr.idProveedor
               inner join marcas m
               on m.idMarca = p.idMarca
               WHERE codigoProducto='$codigoProducto'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

}

?>
