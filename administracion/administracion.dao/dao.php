<?php

class dao {

    function comprobarCodigoValido(Producto $p) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE codigoProducto = '" . $p->getCodigoProducto() . "'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $valor = mysql_affected_rows();
        if ($valor > 0) {
            return 1;
            echo 1;
        } else {
            return 0;
            echo 1;
        }
    }

    function mostrarTarifasTabla($codigoProducto) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM tarifas t inner join listaPrecios l on t.idListaPrecio = l.idListaPrecio WHERE codigoProducto = '$codigoProducto'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function guardarGrupo(GrupoProductos $g) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SET AUTOCOMMIT=0;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "BEGIN;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "INSERT INTO grupoProductos(grupoProducto)VALUES ('" . $g->getGrupoProducto() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());



        if ($resultado) {
            echo 'OK';
            echo '';
            $sql = "COMMIT";
            $resultado = mysql_query($sql, $cn->Conectarse());
            return;
        } else {
            echo 'MAL';
            echo '
';
            echo 'SE EJECUTA EL ROOLBACK';
            echo '
';

            $sql = "ROLLBACK;";
            $resultado = mysql_query($sql, $cn->Conectarse());
            return;
        }

        $cn->cerrarBd();
    }

    function consultarGrupos() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM grupoProductos";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultarMedidas() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM unidadesMedidas";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaTableConsulta() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT codigoProducto, cantidad FROM existencias";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function guardarEntradaProducto($cantidad, $idProducto, $existencia) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SET AUTOCOMMIT=0;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "BEGIN;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $fecha = date("d-m-Y ");
        $hora = date('H:i');

        $cantidadInventario = $cantidad + $existencia;
        $sql = "INSERT INTO entradas(cantidad, idSucursal,fecha, hora, codigoProducto)VALUES($cantidad, 1,'$fecha','$hora',$idProducto)";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "UPDATE existencias SET idStatus= 1 WHERE codigoProducto=$idProducto AND idStatus = 2";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "INSERT INTO existencias(cantidad, idSucursal,fechaIngreso,horaIngreso,idStatus,codigoProducto)VALUES($cantidadInventario, 1,'$fecha','$hora',2,$idProducto )";
        $resultado = mysql_query($sql, $cn->Conectarse());

//        $sql = "UPDATE productos SET idExistencia= '" . mysql_insert_id() . "' Where codigoProducto=$idProducto";
//        $resultado = mysql_query($sql, $cn->Conectarse());

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


        $cn->cerrarBd();
    }

    function consultaExistencia($producto) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM existencias  WHERE codigoProducto = $producto AND idStatus = 2";
        $resultado = mysql_query($sql, $cn->Conectarse());


        return $resultado;
    }

    function consultarCosto($idProducto) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos p INNER JOIN costos c ON p.idProducto = c.codigoProducto WHERE p.idProducto = $idProducto ";
        $resultado = mysql_query($sql, $cn->Conectarse());
        while ($rs = mysql_fetch_array($resultado)) {
            $costo = $rs["costo"];
        }
        return $costo;
    }

    function consultarTarifa($listaProducto, $idProducto) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql2 = "SELECT * FROM productos p INNER JOIN Tarifas t ON p.idProducto = t. codigoProducto WHERE p.idProducto = $idProducto AND t.idListaPrecio = $listaProducto";
        $resultado2 = mysql_query($sql2, $cn->Conectarse());
        while ($rs = mysql_fetch_array($resultado2)) {
            $tarifa = $rs["tarifa"];
        }

        return $tarifa;
    }

    function VerificarProducto($producto) {
        include_once '../daoconexion/daoConeccion.php';
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
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
//        $sql = "SELECT *\n"
//    . "FROM productos p\n"
//    . "Right Join tarifas t ON t.codigoProducto = p.idProducto\n"
//    . "Right Join listaPrecios l ON l.idListaPrecio = t.idListaPrecio LIMIT 0, 30 ";
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo,l.nombreListaPrecio, t.tarifa\n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN tarifas t ON t.codigoProducto = p.idProducto\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.idProducto\n"
                . "INNER JOIN listaprecios l ON l.idListaPrecio = t.idListaPrecio "
                . "WHERE t.idListaPrecio = " . $t->getIdTarifa() . " LIMIT 0, 30 ";
        $resultado = mysql_query($sql, $cn->Conectarse());
        return $resultado;
        $cn->cerrarBd();
    }

    function guardarTarifa(Tarifa $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO tarifas(codigoProducto, tarifa, idListaPrecio)VALUES('" . $t->getIdProducto() . "','" . $t->getTarifa() . "','" . $t->getIdListaPrecio() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarProducto(Producto $p, Costo $c, Tarifa $t) {
        session_start();
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SET AUTOCOMMIT=0;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "BEGIN;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "INSERT INTO productos(producto, idMarca, idProveedor, codigoProducto,cantidadMaxima, cantidadMinima)VALUES('" . $p->getProducto() . "','" . $p->getIdMarca() . "','" . $p->getIdProveedor() . "', '" . $p->getCodigoProducto() . "', '" . $p->getCantidadMaxima() . "', '" . $p->getCantidadMinima() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $id = mysql_insert_id();
        $sql = "INSERT INTO costos(costo, codigoProducto)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $lista = $t->getIdListaPrecio();

        foreach ($lista as $valor) {
            $pieces = explode("-", $valor);

            if ($pieces[0] !== " ") {
                if ($pieces[0] !== "") {
                    if ($pieces[0] !== null) {
                        $sql = "INSERT INTO tarifas(codigoProducto, tarifa, idListaPrecio, idStatus)VALUES('" . $p->getCodigoProducto() . "','$pieces[0]','$pieces[1]','2')";
                        $resultado = mysql_query($sql, $cn->Conectarse());
                    } else {
                        echo 'mal';
                    }
                } else {
                    echo 'mal';
                }
            } else {
                echo 'mal';
            }
        }


        if ($resultado) {

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
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.idProducto \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto";

        $datos = mysql_query($sql, $cn->Conectarse());
//        while ($rs = mysql_fetch_array($dato)) {
//            $id = $rs[1];
//        }

        return $datos;
    }

    function consultaMarca() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM marcas";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaProveedor() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM proveedores";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaListaPrecio() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM listaprecios order by idListaPrecio ASC";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultarListaPrecios() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT concat_ws('-', nombreListaPrecio, idListaPrecio) as fusion, idListaPrecio FROM listaprecios";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function consultarProveedores() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM proveedores";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function consultarMarcas() {
        include_once '../daoconexion/daoConeccion.php';
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
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO marcas(marca)VALUES ('" . $t->getMarca() . "')";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarDireccion(Direccion $t) {
        session_start();
        include_once '../daoconexion/daoConeccion.php';
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
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO proveedores(nombre, idDireccion, rfc, diasCredito, descuento)VALUES('" . $t->getNombre() . "','" . $t->getIdDireccion() . "','" . $t->getRfc() . "','" . $t->getDiasCredito() . "','" . $t->getDescuento() . "');";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarListaPrecio(ListaPrecio $t) {
        include_once '../daoconexion/daoConeccion.php';
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
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT idcpostales, cp, asenta, estado, ciudad FROM cpostales WHERE cp = $t";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function obtenerEntradas() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select * from productos p 
            inner join  entradas e 
            on e.codigoProducto = p.codigoProducto";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function obtenerInformacionProducto($codigoProducto) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, pr.nombre, m.marca FROM productos p
               inner join proveedores pr
               on p.idProveedor = pr.idProveedor
               inner join marcas m
               on m.idMarca = p.idMarca
               WHERE codigoProducto='$codigoProducto'";
        try {
            $rs = mysql_query($sql, $cn->Conectarse());
        } catch (mysqli_sql_exception $e) {
            $rs = $e->getMessage();
        }
        return $rs;
    }

    function guardarEntradas(Entradas $entradas) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        $MySQLEntradas = "INSERT INTO entradas(usuario, cantidad, fecha, codigoProducto) VALUES ('" . $entradas->getUsuario() . "','" . $entradas->getCantidad() . "','" . $entradas->getFecha() . "','" . trim($entradas->getCodigoProducto()) . "')";
        $MySQLExistencias = "INSERT INTO existencias (cantidad, idSucursal, codigoProducto) VALUES ('" . $entradas->getCantidad() . "','1', '" . $entradas->getCodigoProducto() . "')";
        mysql_query("START TRANSACTION;");
        $entradas = mysql_query($MySQLEntradas);
        if ($entradas == false) {
            mysql_query("ROLLBACK;");
        } else {
            $existencias = mysql_query($MySQLExistencias);
            if ($existencias == false) {
                mysql_query("ROLLBACK;");
            } else {
                mysql_query("COMMIT;");
            }
        }
        $cn->cerrarBd();
    }

    function obtieneTodosProductos($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto, p.producto FROM PRODUCTOS p\n"
                . " INNER JOIN proveedores pr on pr.idProveedor = p.idProveedor\n"
                . " WHERE pr.rfc='$rfc'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function buscarProducto(Producto $p, $proveedor) {
        include '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $MySQL = "SELECT p.codigoproducto, producto, costo  FROM productos p
               inner join proveedores pr
               on p.idProveedor = pr.idProveedor
               inner join marcas m
               on m.idMarca = p.idMarca
	       inner join costos cost
	       on p.codigoProducto = cost.codigoProducto
               WHERE p.codigoProducto='" . $p->getCodigoProducto() . "'
               and pr.idProveedor='" . $proveedor . "';";
        $rs = mysql_query($MySQL, $cn->Conectarse());
        $cn->cerrarBd();
        return $rs;
    }

//===================Para guardar XMl entrada===================================
    function validarExistenciaProductoProveedor($rfc) {
        $sql = "SELECT producto, codigoProducto FROM productos p"
                . " INNER JOIN proveedores pr"
                . " WHERE pr.rfc = '$rfc'";
        $valor = mysql_query($sql);
        return $valor;
    }

    function superMegaGuardadorEntradas($lafecha, Encabezado $encabezado, $arrayDetalleEntrada, Comprobante $comprobante, $conceptos, $control) {
        $detalle = new Detalle();
        $concepto = new Concepto();
        //======================================================================
        //Empieza guardar encabezado
        $sqlEncabezadoGuardar = "INSERT INTO facturaencabezados (fechaEncabezado, subtotalEncabezado, totalEncabezado, rfcEncabezado, folioEncabezado, fechaMovimiento)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $encabezado->getTotal() . "','" . $encabezado->getRfc() . "','" . $encabezado->getFolio() . "','$lafecha')";
        $sqlEncabezadoId = "SELECT LAST_INSERT_ID() ID;";
        mysql_query("START TRANSACTION;");
        $ctrlEnzabezadoGuardar = mysql_query($sqlEncabezadoGuardar);
        if ($ctrlEnzabezadoGuardar == false) {
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlEncabezadoId = mysql_query($sqlEncabezadoId);
            if ($ctrlEncabezadoId == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlEncabezadoId)) {
                    $idEncabezado = $rs["ID"];
                }
            }
        }
        //Terminar guardar encabezado
        //Variables necesarias: $idEncabezado
        //======================================================================
        //Empieza guardar comprobante
        $sqlComprobanteGuardar = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $comprobante->getSda() . "','" . $encabezado->getRfc() . "','" . $comprobante->getDescuentoFactura() . "','" . $comprobante->getDescuentoProntoPago() . "','" . $comprobante->getDescuentoGeneral() . "','" . $comprobante->getDescuentoPorProducto() . "','" . $comprobante->getDescuentoTotal() . "','" . $comprobante->getConIva() . "','" . $comprobante->getTotal() . "','" . $encabezado->getFolio() . "','XML','$lafecha')"; //Forzado TIPO
        $sqlComprobanteId = "SELECT LAST_INSERT_ID() ID;";
        $ctrlComprobanteGuardar = mysql_query($sqlComprobanteGuardar);
        if ($ctrlComprobanteGuardar == false) {
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlComprobanteId = mysql_query($sqlComprobanteId);
            if ($ctrlComprobanteId == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlComprobanteId)) {
                    $idComprobante = $rs["ID"];
                }
            }
        }
        //Terminar guardar comprobante
        //Variables necesarias: $idComprobante
        //======================================================================
        for ($i = 0; $i < $control; $i++) {
            //Comienza guardar detalle
            $detalle = $arrayDetalleEntrada[$i];
            $sqlDetalleGuardar = "INSERT INTO facturadetalles (unidadMedidaDetalle, importeDetalle, cantidadDetalle, codigoDetalle, descripcionDetalle, costoDetalle, idFacturaEncabezados) "
                    . "VALUES ('" . $detalle->getUnidadmedida() . "','" . $detalle->getImporte() . "','" . $detalle->getCantidad() . "','" . $detalle->getCodigo() . "','" . $detalle->getDescripcion() . "','" . $detalle->getCosto() . "','$idEncabezado')";
            $ctrlDetalleGuardar = mysql_query($sqlDetalleGuardar);
            if ($ctrlDetalleGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
            }
            //Terminar guardar detalle
            //==================================================================
            //Comienza validar producto en existencia
            $cantidad = 0;
            $cpto = $conceptos[$i];
            $sqlConceptoValidarExistencia = "SELECT cantidad FROM existencias"
                    . " WHERE codigoProducto = '$cpto->codigo'";
            $control = mysql_query($sqlConceptoValidarExistencia);
            if ($control == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($control)) {
                    $cantidad = $rs["cantidad"];
                }
            }
            //Terminar validar producto en existencia
            //Variables necesarias: $cantidad
            //==================================================================
            //Comienza actulizar costo
            $sqlTraerCosto = "SELECT costo, idCosto FROM costos "
                    . " WHERE codigoProducto = '$cpto->codigo' AND status = '1'";
            $ctrlTraerCosto = mysql_query($sqlTraerCosto);
            if ($ctrlTraerCosto == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlTraerCosto)) {
                    $costoViejo = $rs["costo"];
                    $idDondeSalioCosto = $rs["idCosto"];
                }
            }
            if ($costoViejo != $cpto->cda) {
                $costoCalculo = $costoViejo + $cpto->cda;
                $cantidadCalculo = $cantidad + $detalle->getCantidad();

                $costoPromedio = $costoCalculo / $cantidadCalculo;

                $sqlInsertaNuevoCosto = "INSERT INTO costos (costo, codigoProducto, fechaMovimiento, status)"
                        . " VALUES ('$costoPromedio','$cpto->codigo','$lafecha','1')";
                $sqlActulizarViejoCosto = "UPDATE costos SET status = '2'"
                        . " WHERE codigoProducto = '$cpto->codigo' AND idCosto = '$idDondeSalioCosto'";
                $ctrlInsertaNuevoCosto = mysql_query($sqlInsertaNuevoCosto);
                if ($ctrlInsertaNuevoCosto == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                } else {
                    $ctrlActulizarViejoCosto = mysql_query($sqlActulizarViejoCosto);
                    if ($ctrlActulizarViejoCosto == false) {
                        mysql_query("ROLLBACK;");
                        return false;
                    } 
                }
            } 
            //Terminar actulizar costo
            //==================================================================
            //Comienza Actulizar existencia
            $nuevacantidad = $cantidad + $detalle->getCantidad();
            $sqlActulizaExistencia = "UPDATE existencias SET cantidad = '$nuevacantidad'"
                    . " WHERE codigoProducto = '$cpto->codigo'";
            $ctrlActulizaExistencia = mysql_query($sqlActulizaExistencia);
            if ($ctrlActulizaExistencia == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
            }
            //Terminar Actulizar existencia
            //==================================================================
            //Comienza guardar entrada
            $sqlEntradasGuardar = "INSERT INTO entradas (usuario, cantidad, fecha, codigoProducto, idSucursal) "
                    . " VALUES ('Joel','" . $detalle->getCantidad() . "','$lafecha','$cpto->codigo','1')"; //Forzado usuaro e idSucursal
            $ctrlEntradasGuardar = mysql_query($sqlEntradasGuardar);
            if ($ctrlEntradasGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                mysql_query("COMMIT;");
            }
            //Terminar guardar entrada
        }//Cierre FOR
    }//Cierre de la funcion
    //==============================================================================
}//Cierre DAO
?>
