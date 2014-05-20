<?php

class dao {

    function consultaOrdenesLista($tipo) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM xmlcomprobantes x INNER JOIN sucursales s ON s.idSucursal = x.idSucursal Where x.tipoComprobante = '$tipo'";
        $sql = mysql_query($sql, $cn->Conectarse());
//        $cn->cerrarBd();
        return $sql;
    }

    function modificaPedido($folio) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE xmlcomprobantes set statusOrden = '1' WHERE idXmlComprobante = '$folio'";
        $sql = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function consultaEmail($proveedor) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sqlrfc = "SELECT idProveedor FROM proveedores WHERE rfc = '$proveedor' ";
        $datos = mysql_query($sqlrfc, $cn->Conectarse());

        while ($fila = mysql_fetch_array($datos)) {
            $valor = $fila["idProveedor"];
        }
        $sql = "SELECT email, idEmail FROM emails WHERE idPropietario = '$valor' AND tipoPropietario = 'PROVEEDOR'";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function obtenerOrdenCompra($folio, $comprobante) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SELECT * FROM xmlcomprobantes x "
                . "INNER JOIN xmlconceptos xc ON x.idXmlComprobante = xc.idXmlComprobante  WHERE x.idXmlComprobante = '$folio' AND tipoComprobante = '$comprobante' ";
        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function mostrarDetallesTransferencias2($sucu, $detalle) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto,p.producto, t.costo, e.cantidad as cantidadTotal, t.cantidad FROM transacciondetalles t INNER JOIN productos p ON p.codigoProducto = t.codigo INNER JOIN existencias e ON p.codigoProducto = e.codigoProducto WHERE  idEncabezadoTransaccion = '$detalle' and e.idSucursal = '$sucu' ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function dondeInicie($idsucursal) {
        $sql = "SELECT sucursal FROM sucursales WHERE idSucursal = '$idsucursal' ";
        $rs = mysql_query($sql);
        return $rs;
    }

    function cambiarEstatusCancelarTransferencia($aceptacion) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE requisicionencabezados set estatusRequisicion = '3', statusAprobacion = '4' WHERE idEncabezadoRequisicion = '$aceptacion'";
        $sql = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function cambiarEstatusTransferencia($aceptacion) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE requisicionencabezados set estatusRequisicion = '6' WHERE idEncabezadoRequisicion = '$aceptacion'";
        $sql = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarTransferenciaPedido($datos, $lafecha, $idsucursal, $sucursal, $transf) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");

        $sqlencabezado = "INSERT INTO transaccionencabezados(fechatransaccion,statusAprobacion,statustransaccion,idSucursalEmisor, idSucursalReceptor) VALUES('$lafecha','5','5','$idsucursal','$sucursal')";
        $sqlid = "SELECT LAST_INSERT_ID() ID;";
        $sqlrequisicion = "UPDATE requisicionencabezados set statusAprobacion = '6' WHERE idEncabezadoRequisicion = '$transf'";

        $sqlencabezado = mysql_query($sqlencabezado, $cn->Conectarse());
        if ($sqlencabezado == false) {
            mysql_query("ROLLBACK;");
        } else {

            $sqlid = mysql_query($sqlid, $cn->Conectarse());
            if ($sqlid == false) {
                mysql_query("ROLLBACK;");
            } else {
                while ($rs = mysql_fetch_array($sqlid)) {
                    $sqlid = $rs["ID"];
                    foreach ($datos as $valor) {
                        if ($valor->codigo !== NULL && $valor->cantidad > 0) {
                            $sqldetalles = "INSERT INTO transacciondetalles(idEncabezadoTransaccion,codigo, cantidad, costo) values('$sqlid','$valor->codigo','$valor->cantidad',' $valor->costo')";
                            $sqldetalles = mysql_query($sqldetalles, $cn->Conectarse());
                        }
                        mysql_data_seek($sqlid, 0);
                        if ($sqldetalles == false) {
                            mysql_query("ROLLBACK;");
                            echo'backtransaccion';
                        } else {
                            $sqlentradas = "INSERT INTO entradas(codigoProducto, cantidad,fecha,idSucursal,usuario) values('$valor->codigo','$valor->cantidad','$lafecha','$sucursal','usuario')";
                            $sqlentradas = mysql_query($sqlentradas, $cn->Conectarse());
                            echo'algo';
                            if ($sqlentradas == false) {
                                mysql_query("ROLLBACK;");
                                echo'backentradas';
                            } else {
                                $sqlsalidas = "INSERT INTO salidas(codigoProducto, cantidad,fecha,idSucursal,usuario) values('$valor->codigo','$valor->cantidad','$lafecha','$idsucursal','usuario')";
                                $sqlsalidas = mysql_query($sqlsalidas, $cn->Conectarse());
                                echo'algo';

                                if ($sqlsalidas == false) {
                                    mysql_query("ROLLBACK;");
                                    echo'backsalidas';
                                } else {
                                    $sqlexistenciasSalida = "UPDATE  existencias SET cantidad= cantidad - $valor->cantidad WHERE codigoProducto = '$valor->codigo' AND idSucursal = '$idsucursal'";
                                    $sqlexistenciasSalida = mysql_query($sqlexistenciasSalida, $cn->Conectarse());
                                    if ($sqlexistenciasSalida == false) {
                                        mysql_query("ROLLBACK;");
                                    } else {
                                        $sqlexistenciasentrada = "UPDATE  existencias SET cantidad= cantidad + $valor->cantidad WHERE codigoProducto = '$valor->codigo' AND idSucursal = '$sucursal'";
                                        $sqlexistenciasentrada = mysql_query($sqlexistenciasentrada, $cn->Conectarse());
                                        if ($sqlexistenciasentrada == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            echo 'bien';
                                        }
                                    }
                                }
                            }
                            $sqlrequisicion = mysql_query($sqlrequisicion, $cn->Conectarse());
                            if ($sqlrequisicion == false) {
                                mysql_query("ROLLBACK;");
                            } else {
                                echo 'bien';
                            }
                        }
                    }
                }
            }
        }
        mysql_query("COMMIT;");
        $cn->cerrarBd();
    }

    function consultaPedidosR($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idEncabezadoRequisicion,st.status as prr,st2.status as plop,st2.idStatus,t.fechaRequisicion,s.sucursal, s.idSucursal FROM requisicionencabezados t INNER JOIN sucursales s ON s.idSucursal = t.idSucursalEmisor INNER JOIN status st ON st.idStatus = t.estatusRequisicion INNER JOIN status st2 ON st2.idStatus = t.statusAprobacion INNER JOIN sucursales s2 ON s2.idSucursal = t.idSucursalReceptor   WHERE idSucursalReceptor = $idSucursal  ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function mostrarDetallesRequisicion($sucursal, $detalle, $sucu) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto,p.producto, t.costo, e.cantidad as cantidadTotal, t.cantidad FROM requisiciondetalles t INNER JOIN productos p ON p.codigoProducto = t.codigo INNER JOIN existencias e ON p.codigoProducto = e.codigoProducto WHERE  idEncabezadoRequisicion = '$detalle' and e.idSucursal = '$sucu' ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaRequisicion($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idEncabezadoRequisicion,st.status as prr,st.idStatus as idStatusTransf, st2.idStatus as idStatusAceptacion,st2.status as plop,t.fechaRequisicion,s2.sucursal,s2.idSucursal FROM requisicionencabezados t INNER JOIN sucursales s ON s.idSucursal = t.idSucursalEmisor INNER JOIN status st ON st.idStatus = t.estatusRequisicion INNER JOIN status st2 ON st2.idStatus = t.statusAprobacion INNER JOIN sucursales s2 ON s2.idSucursal = t.idSucursalReceptor   WHERE idSucursalEmisor = $idSucursal  ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function guardarRequisicionPedido($datos, $fecha, $sucursal, $sucursal2) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");

        $sqlencabezado = "INSERT INTO requisicionencabezados(fecharequisicion,statusAprobacion,estatusRequisicion,idSucursalEmisor, idSucursalReceptor) VALUES('$fecha','5','5','$sucursal','$sucursal2')";
        $sqlid = "SELECT LAST_INSERT_ID() ID;";


        $sqlencabezado = mysql_query($sqlencabezado, $cn->Conectarse());
        if ($sqlencabezado == false) {
            mysql_query("ROLLBACK;");
        } else {

            $sqlid = mysql_query($sqlid, $cn->Conectarse());
            if ($sqlid == false) {
                mysql_query("ROLLBACK;");
            } else {
                while ($rs = mysql_fetch_array($sqlid)) {
                    $sqlid = $rs["ID"];
                    foreach ($datos as $valor) {
                        if ($valor->codigo !== NULL && $valor->cantidad > 0) {
                            $sqldetalles = "INSERT INTO requisiciondetalles(idEncabezadoRequisicion,codigo, cantidad, costo) values('$sqlid','$valor->codigo','$valor->cantidad',' $valor->costo')";
                            $sqldetalles = mysql_query($sqldetalles, $cn->Conectarse());
                        }
                        mysql_data_seek($sqlid, 0);
                        if ($sqldetalles == false) {
                            mysql_query("ROLLBACK;");
                        } else {
                            echo'bien';
                        }
                    }
                }
            }
        }
        mysql_query("COMMIT;");
    }

    function consultaPedidos($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idEncabezadoTransaccion,st.status as prr,st2.status as plop,t.fechaTransaccion,s2.sucursal FROM transaccionencabezados t INNER JOIN sucursales s ON s.idSucursal = t.idSucursalEmisor INNER JOIN status st ON st.idStatus = t.statusTransaccion INNER JOIN status st2 ON st2.idStatus = t.statusAprobacion INNER JOIN sucursales s2 ON s2.idSucursal = t.idSucursalReceptor   WHERE idSucursalReceptor = $idSucursal  ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function mostrarDetallesTransferencias($sucursal, $detalle) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto,p.producto, t.costo, e.cantidad as cantidadTotal, t.cantidad FROM requisiciondetalles t INNER JOIN productos p ON p.codigoProducto = t.codigo INNER JOIN existencias e ON p.codigoProducto = e.codigoProducto WHERE  idEncabezadoRequisicion = '$detalle' and e.idSucursal = '$sucursal' ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaTransferencias($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idEncabezadoTransaccion,st.status as prr,st2.status as plop,t.fechaTransaccion,s2.sucursal FROM transaccionencabezados t INNER JOIN sucursales s ON s.idSucursal = t.idSucursalEmisor INNER JOIN status st ON st.idStatus = t.statusTransaccion INNER JOIN status st2 ON st2.idStatus = t.statusAprobacion INNER JOIN sucursales s2 ON s2.idSucursal = t.idSucursalReceptor   WHERE idSucursalEmisor = $idSucursal  ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaSucursales($sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM sucursales WHERE idSucursal <> '$sucursal'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function guardarTranferenciaPedido($datos, $fecha, $sucursal, $sucursal2) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");

        $sqlencabezado = "INSERT INTO transaccionencabezados(fechaTransaccion,statusAprobacion,statusTransaccion,idSucursalEmisor, idSucursalReceptor) VALUES('$fecha','5','5','$sucursal','$sucursal2')";
        $sqlid = "SELECT LAST_INSERT_ID() ID;";


        $sqlencabezado = mysql_query($sqlencabezado, $cn->Conectarse());
        if ($sqlencabezado == false) {
            mysql_query("ROLLBACK;");
        } else {

            $sqlid = mysql_query($sqlid, $cn->Conectarse());
            if ($sqlid == false) {
                mysql_query("ROLLBACK;");
            } else {
                while ($rs = mysql_fetch_array($sqlid)) {
                    $sqlid = $rs["ID"];
                    foreach ($datos as $valor) {
                        if ($valor->codigo !== NULL && $valor->cantidad > 0) {
                            $sqldetalles = "INSERT INTO transacciondetalles(idEncabezadoTransaccion,codigo, cantidad, costo) values('$sqlid','$valor->codigo','$valor->cantidad',' $valor->costo')";
                            $sqldetalles = mysql_query($sqldetalles, $cn->Conectarse());
                        }
                        mysql_data_seek($sqlid, 0);
                        if ($sqldetalles == false) {
                            mysql_query("ROLLBACK;");
                        } else {
                            echo'bien';
                        }
                    }
                }
            }
        }
        mysql_query("COMMIT;");
    }

    function buscarCodigo($codigo, $sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        echo '';
        $sql = "SELECT * FROM productos p INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto INNER JOIN costos c ON c.codigoProducto = p.codigoProducto WHERE p.codigoProducto = '$codigo' AND c.status = '1' AND c.idSucursal = '$sucursal' AND e.idSucursal = '$sucursal' ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function eliminaMaquinas($listaMaquinas) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        foreach ($listaMaquinas as $valor) {
            $sql = "update maquinas set idStatus='2' Where idMaquina ='$valor'";
            $marcas = mysql_query($sql, $cn->Conectarse());
            if ($marcas == false) {
                mysql_query("ROLLBACK;");
            } else {
                echo'bien';
            }
        }
        mysql_query("COMMIT;");
    }

    function consultaMaquina() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM maquinas Where idStatus='1'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function guardarMaquina(Maquina $m) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO maquinas(nombreMaquina,idStatus)VALUES ('" . $m->getNombreMaquina() . "','1')";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function eliminaCliente($listaClientes) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        foreach ($listaClientes as $valor) {
            $sql = "UPDATE clientes SET idStatus='2' WHERE idCliente ='$valor'";
            $proveedores = mysql_query($sql, $cn->Conectarse());
            if ($proveedores == false) {
                mysql_query("ROLLBACK;");
            } else {
                echo'bien';
            }
        }
        mysql_query("COMMIT;");
    }

    function verificandoCliente($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM clientes p INNER JOIN direcciones d ON p.idDireccion = d.idDireccion INNER JOIN cpostales c ON c.idcpostales = d.idcpostales WHERE rfc= '$rfc'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $band = mysql_affected_rows();
        if ($band < 1) {
            return 0;
        } else {
            return $datos;
        }
    }

    function consultaCliente() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM clientes WHERE idStatus = '1'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function eliminaListaPrecio($listaPrecios) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        foreach ($listaPrecios as $valor) {
            $sql = "update listaprecios set idStatus='2' Where idListaPrecio ='$valor'";
            $lista = mysql_query($sql, $cn->Conectarse());
            if ($lista == false) {
                mysql_query("ROLLBACK;");
            } else {
                $sql = "update tarifas set idStatus='2' Where idListaPrecio ='$valor'";
                $lista = mysql_query($sql, $cn->Conectarse());
                if ($lista == false) {
                    mysql_query("ROLLBACK;");
                } else {
                    echo'bien';
                }
            }
        }
        mysql_query("COMMIT;");
    }

    function eliminaProveedor($listaProveedores) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        foreach ($listaProveedores as $valor) {
            $sql = "update proveedores set idStatus='2' Where idProveedor ='$valor'";
            $proveedores = mysql_query($sql, $cn->Conectarse());
            if ($proveedores == false) {
                mysql_query("ROLLBACK;");
            } else {
                echo'bien';
            }
        }
        mysql_query("COMMIT;");
    }

    function eliminaProductos($listaProductos) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        foreach ($listaProductos as $valor) {
            $sql = "update productos set idStatus='2' Where codigoProducto ='$valor'";
            $productos = mysql_query($sql, $cn->Conectarse());
            if ($productos == false) {
                mysql_query("ROLLBACK;");
            } else {
                echo'bien';
            }
        }
        mysql_query("COMMIT;");
    }

    function eliminaMarcas($listaMarcas) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        foreach ($listaMarcas as $valor) {
            $sql = "update marcas set idStatus='2' Where idMarca ='$valor'";
            $marcas = mysql_query($sql, $cn->Conectarse());
            if ($marcas == false) {
                mysql_query("ROLLBACK;");
            } else {
                echo'bien';
            }
        }
        mysql_query("COMMIT;");
    }

//    function editarDireccion(Direccion $t) {
//        session_start();
//        include_once '../daoconexion/daoConeccion.php';
//        $cn = new coneccion();
//        $sql = "update direcciones set calle='" . $t->getCalle() . "', numeroExterior='" . $t->getNumeroexterior() . "', numeroInterior='" . $t->getNumerointerior() . "', cruzamientos='" . $t->getCruzamientos() . "', ciudad = '" . $t->getCiudad() . "', estado = '" . $t->getEstado() . "', colonia = '" . $t->getColonia() . "',codigoPostal='" . $t->getPostal() . "' WHERE idDireccion= '" . $t->getIdDireccion() . "'";
////        $sql2 = "SELECT LAST_INSERT_ID() ID;";
//        $x = mysql_query($sql, $cn->Conectarse());
//////        $dato = mysql_query($sql2, $cn->Conectarse());
////        while ($rs = mysql_fetch_array($dato)) {
////            $id = $rs["ID"];
////        }
//        $_SESSION['iddireccion'] = $t->getIdDireccion();
//        $cn->cerrarBd();
//        return $x;
//    }
//    function editarProveedor(Proveedor $t) {
//        include_once '../daoconexion/daoConeccion.php';
//        $cn = new coneccion();
//        $sql = "UPDATE proveedores set nombre='" . $t->getNombre() . "', idDireccion='" . $t->getIdDireccion() . "',  diasCredito='" . $t->getDiasCredito() . "', email='" . $t->getEmail() . "', descuentoPorFactura='" . $t->getDesctfactura() . "', descuentoPorProntoPago='" . $t->getDesctprontopago() . "', tipoProveedor='" . $t->getTipoProveedor() . "', idStatus='1' WHERE rfc='" . $t->getRfc() . "';";
//        mysql_query($sql, $cn->Conectarse());
//        $cn->cerrarBd();
//    }

    function verificandoProveedor($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM proveedores p INNER JOIN direcciones d ON p.idDireccion = d.idDireccion WHERE rfc= '$rfc'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $band = mysql_affected_rows();
        if ($band < 1) {
            return 0;
        } else {
            return $datos;
        }
    }

    function editarProducto(Producto $p, Costo $c, Tarifa $t, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sqlCostos = "UPDATE costos set status = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idSucursal= '$idSucursal' ";
        $sqlProductos = "UPDATE productos set producto = '" . $p->getProducto() . "',idMarca= '" . $p->getIdMarca() . "',idProveedor= '" . $p->getIdProveedor() . "',cantidadMaxima= '" . $p->getCantidadMaxima() . "',cantidadMinima= '" . $p->getCantidadMinima() . "',idGrupoProducto= '" . $p->getIdGrupoProducto() . "',idUnidadMedida= '" . $p->getIdUnidadMedida() . "',idStatus='1' WHERE codigoProducto = '" . $p->getCodigoProducto() . "'";
        $fecha = date("d/m/Y h:i");
        $sqlCostoNuevo = "INSERT INTO costos(costo, codigoProducto,fechaMovimiento, status, idSucursal)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "','$fecha','1','$idSucursal')";

        mysql_query("START TRANSACTION;");
        $producto = mysql_query($sqlProductos, $cn->Conectarse());
        if ($producto == false) {
            mysql_query("ROLLBACK;");
        } else {
            $costos = mysql_query($sqlCostos, $cn->Conectarse());
            if ($costos == false) {
                mysql_query("ROLLBACK;");
            } else {
                $costosNuevo = mysql_query($sqlCostoNuevo, $cn->Conectarse());
                if ($costosNuevo == false) {
                    mysql_query("ROLLBACK;");
                } else {

                    $lista = $t->getIdListaPrecio();

                    foreach ($lista as $valor) {
                        $pieces = explode("-", $valor);
                        if ($cont == 0) {
                            if ($pieces[0] !== " ") {
                                if ($pieces[0] !== "") {
                                    if ($pieces[0] !== null) {
                                        $tarifa = $pieces[0];
                                        $listaPrecio = $pieces[1];
                                        $cont = 1;
//                        $sql = "INSERT INTO tarifas(codigoProducto, tarifa, idListaPrecio, idStatus,porcentaUtilidad)VALUES('" . $p->getCodigoProducto() . "','$pieces[0]','$pieces[1]','2',2)";
//                        $resultado = mysql_query($sql, $cn->Conectarse());
                                    } else {
                                        echo 'mal';
                                    }
                                } else {
                                    $verificaExistecia = "SELECT * from tarifas WHERE idListaPrecio = $pieces[1] and codigoProducto = '" . $p->getCodigoProducto() . "' AND idStatus = '1' AND idSucursal = '$idSucursal' ";
                                    $Existencia = mysql_query($verificaExistecia, $cn->Conectarse());
                                    $band = mysql_affected_rows();
                                    if ($band > 0) {
                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $pieces[1] AND idSucursal = '$idSucursal'";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            echo 'bien';
                                        }
                                    } else {
                                        echo 'mal';
                                    }
                                }
                            } else {
                                echo 'mal';
                            }
                        } else {
                            if ($pieces[0] !== " ") {
                                if ($pieces[0] !== "") {
                                    if ($pieces[0] !== null) {

                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $listaPrecio AND idSucursal ='$idSucursal'";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            $sqlTarifas = "INSERT INTO tarifas(codigoProducto, porcentaUtilidad, idListaPrecio, idStatus,tarifa, fechaMovimientoTarifa,idSucursal)VALUES('" . $p->getCodigoProducto() . "','$tarifa','$listaPrecio','1','$pieces[0]','$fecha','$idSucursal')";
                                            $tarifas = mysql_query($sqlTarifas, $cn->Conectarse());
                                            if ($tarifas == false) {
                                                mysql_query("ROLLBACK;");
                                            } else {
                                                echo 'BIEN';
                                            }
                                            $cont = 0;
                                        }
                                    } else {
                                        echo 'mal';
                                    }
                                } else {
                                    $verificaExistecia = "SELECT * tarifas WHERE idListaPrecio = $pieces[1] and codigoProducto = '" . $p->getCodigoProducto() . "' AND idStatus = '1' ";
                                    $Existencia = mysql_query($verificaExistecia, $cn->Conectarse());
                                    $band = mysql_affected_rows();
                                    if ($band > 0) {
                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $pieces[1] AND idSucursal = '$idSucursal'";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            echo 'bien';
                                        }
                                    } else {
                                        echo 'mal';
                                    }
                                    echo 'mal';
                                }
                            } else {
                                echo 'mal';
                            }
                        }
                    }
                    mysql_query("COMMIT;");
                }
            }
        }
        $cn->cerrarBd();
    }

    function consultandoProductoPorCodigo($codigo, $sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto, p.codigoBarrasProducto, p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.codigoBarrasProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto "
                . "WHERE c.status=1  and c.idSucursal = '$sucursal' and e.idSucursal = '$sucursal' and p.codigoProducto = '$codigo'";
        $datos = mysql_query($sql, $cn->Conectarse());
        if ($datos == false) {
            $datos = mysql_error();
            $rs = 0;
        } else {
            $rs = $datos;
        }
        return $rs;
    }

    function consultandoProductoPorCodigoBarras($codigo, $sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.codigoBarrasProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida, e.cantidad \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                . " INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto where c.status=1 and p.codigoBarrasProducto = '$codigo'  and c.idSucursal = '$sucursal' and e.idSucursal = '$sucursal'";
        $datos = mysql_query($sql, $cn->Conectarse());
        if ($datos == false) {
            $datos = mysql_error();
            $rs = 0;
        } else {
            $rs = $datos;
        }
        return $rs;
    }

    function comprobarCodigoValido($codigo) {

        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE codigoProducto = '$codigo'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $valor = mysql_affected_rows();
        if ($valor > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function comprobarCodigoBarrasValido($codigo) {

        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE codigoBarrasProducto = '$codigo'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $valor = mysql_affected_rows();
        if ($valor > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function mostrarTarifasTabla($codigoProducto, $sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT l.nombreListaPrecio, c.costo, t.porcentaUtilidad, l.idListaPrecio, t.tarifa FROM tarifas t inner join listaprecios l on t.idListaPrecio = l.idListaPrecio inner join costos c on c.codigoProducto = t.codigoProducto WHERE t.codigoProducto  = '$codigoProducto' AND c.status='1' AND t.idStatus =  '1' AND c.idSucursal =  '$sucursal' AND t.idSucursal = '$sucursal'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $validacion = mysql_affected_rows();
        if ($validacion == false) {
            return 0;
        } else {
            return $datos;
        }
    }

    function guardarGrupo(GrupoProductos $g) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        $sql = "INSERT INTO grupoproductos(grupoProducto)VALUES ('" . $g->getGrupoProducto() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        if ($resultado == false) {
            $resultado = mysql_error();
            echo $resultado;
            $sql = "ROLLBACK;";
            $resultado = mysql_query($sql, $cn->Conectarse());
        } else {
            echo"OK";
            mysql_query("COMMIT;");
        }
        $cn->cerrarBd();
    }

    function consultarGrupos() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM grupoproductos";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultarMedidas() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM unidadesmedidas";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaTableConsulta() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT codigoProducto, cantidad FROM existencias";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $datos = mysql_query($sql, $cn->Conectarse());
        $revisar = mysql_affected_rows();
        if ($revisar > 0) {
            return $datos;
        } else {
            return 0;
        }
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
        $sql = "SELECT * FROM existencias  WHERE codigoProducto = $producto";
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
        $sql = "INSERT INTO tarifas(codigoProducto, tarifa, idListaPrecio, idSucursal)VALUES('" . $t->getIdProducto() . "','" . $t->getTarifa() . "','" . $t->getIdListaPrecio() . "','1')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarProducto(Producto $p, Costo $c, Tarifa $t, $idSucursal) {

        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cont = 0;
        mysql_query("START TRANSACTION;");

        $sucursales = "SELECT * FROM sucursales WHERE idSucursal <> '$idSucursal'";
        $sucursales = mysql_query($sucursales, $cn->Conectarse());
        while ($rs = mysql_fetch_assoc($sucursales)) {
            $sucursal = $rs["idSucursal"];
            $sqlexistencias = "INSERT INTO existencias(cantidad,codigoProducto,idSucursal)VALUES('0','" . $p->getCodigoProducto() . "','$sucursal')";
            $fecha = date("d/m/Y h:i");
            $sqlcostos = "INSERT INTO costos(costo, codigoProducto,fechaMovimiento, status, idSucursal)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "','$fecha','1','$sucursal')";
            $sqlexistencias = mysql_query($sqlexistencias, $cn->Conectarse());
            if ($sqlexistencias == false) {
                mysql_query("ROLLBACK;");
            } else {
                $sqlcostos = mysql_query($sqlcostos, $cn->Conectarse());
                if ($sqlcostos == false) {
                    mysql_query("ROLLBACK;");
                } else {
                    
                }
            }
        }
        $sql = "INSERT INTO existencias(cantidad,codigoProducto,idSucursal)VALUES('0','" . $p->getCodigoProducto() . "','$idSucursal')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        if ($resultado == false) {
            mysql_query("ROLLBACK;");
        } else {
            $sql = "INSERT INTO productos(producto, idMarca, idProveedor, codigoBarrasProducto, codigoProducto,cantidadMaxima, cantidadMinima,idGrupoProducto, idUnidadMedida,idStatus)VALUES('" . $p->getProducto() . "','" . $p->getIdMarca() . "','" . $p->getIdProveedor() . "', '" . $p->getCbarras() . "' , '" . $p->getCodigoProducto() . "', '" . $p->getCantidadMaxima() . "', '" . $p->getCantidadMinima() . "', '" . $p->getIdGrupoProducto() . "', '" . $p->getIdUnidadMedida() . "','1')";
            $resultado = mysql_query($sql, $cn->Conectarse());
            if ($resultado == false) {
                mysql_query("ROLLBACK;");
            } else {
                $id = mysql_insert_id();
                $fecha = date("d/m/Y h:i");
                $sql = "INSERT INTO costos(costo, codigoProducto,fechaMovimiento, status, idSucursal)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "','$fecha','1','$idSucursal')";
                $resultado = mysql_query($sql, $cn->Conectarse());
                if ($resultado == false) {
                    mysql_query("ROLLBACK;");
                } else {

                    $lista = $t->getIdListaPrecio();

                    foreach ($lista as $valor) {
                        $pieces = explode("-", $valor);
                        if ($cont == 0) {
                            if ($pieces[0] !== " ") {
                                if ($pieces[0] !== "") {
                                    if ($pieces[0] !== null) {
                                        $tarifa = $pieces[0];
                                        $listaPrecio = $pieces[1];
                                        $cont = 1;
//                        $sql = "INSERT INTO tarifas(codigoProducto, tarifa, idListaPrecio, idStatus,porcentaUtilidad)VALUES('" . $p->getCodigoProducto() . "','$pieces[0]','$pieces[1]','2',2)";
//                        $resultado = mysql_query($sql, $cn->Conectarse());
                                    } else {
                                        echo 'mal';
                                    }
                                } else {
                                    echo 'mal';
                                }
                            } else {
                                echo 'mal';
                            }
                        } else {
                            if ($pieces[0] !== " ") {
                                if ($pieces[0] !== "") {
                                    if ($pieces[0] !== null) {
                                        $sql = "INSERT INTO tarifas(codigoProducto, porcentaUtilidad, idListaPrecio, idStatus,tarifa,fechaMovimientoTarifa,idSucursal)VALUES('" . $p->getCodigoProducto() . "','$tarifa','$listaPrecio','1','$pieces[0]','$fecha','$idSucursal')";
                                        $resultado = mysql_query($sql, $cn->Conectarse());
                                        if ($resultado == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            $cont = 0;
                                        }
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
                    }
                }
            }
        }

        mysql_query("COMMIT;");





        $_SESSION['idProducto'] = $id;
        $cn->cerrarBd();
    }

    function actualizaExsitenciaGranel($idsucursal, Producto $producto, $contenido, $cuantos, $original) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        //===Sacar existencia===================================================
        $sql = "SELECT * FROM existencias WHERE codigoProducto = '$original' AND idSucursal = '$idsucursal'";
        mysql_query("START TRANSACTION;");
        $ctrl = mysql_query($sql, $cn->Conectarse());
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            while ($rs = mysql_fetch_array($ctrl)) {
                $existencia = $rs["cantidad"];
            }
        }
        //===Restar existencia==================================================
        $nuevaexistencia = $existencia - $cuantos;
        //===Actualizar existencia==============================================
        $sql = "UPDATE existencias SET cantidad = '$nuevaexistencia' WHERE codigoProducto = '$original' AND idSucursal = '$idsucursal'";
        $ctrl = mysql_query($sql, $cn->Conectarse());
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //===Actualizar existencia granel=======================================
        $sql = "UPDATE existencias SET cantidad = '$contenido' WHERE codigoProducto='" . $producto->getCodigoProducto() . "' AND idSucursal ='$idsucursal'";
        $ctrl = mysql_query($sql, $cn->Conectarse());
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //===Respalda contenido==================================================
        $sql = "INSERT INTO agranel (codigoAgranel, cantidad) VALUES ('" . $producto->getCodigoProducto() . "','$contenido')";
        $ctrl = mysql_query($sql, $cn->Conectarse());
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        mysql_query("COMMIT;");
        $cn->cerrarBd();
    }

    function consultaProducto($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto, e.idSucursal \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                . " INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto where status=1 and p.idStatus = '1' AND c.idSucursal = '$idSucursal' AND e.idSucursal = '$idSucursal'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $validando = mysql_affected_rows();
        if ($validando >= 0) {

//        while ($rs = mysql_fetch_array($dato)) {
//            $id = $rs[1];
//        }

            return $datos;
        } else {
            return 0;
        }
    }

    function consultaMarca() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM marcas Where idStatus='1'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaProveedor() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM proveedores WHERE idStatus = '1'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultaListaPrecio() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM listaprecios WHERE idStatus='1' order by idListaPrecio ASC";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function consultarListaPrecios() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT concat_ws('-', nombreListaPrecio, idListaPrecio) as fusion, idListaPrecio FROM listaprecios Where idStatus='1'";

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

    function guardarMarca(Marca $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO marcas(marca,idStatus)VALUES ('" . $t->getMarca() . "','1')";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarProveedor(Proveedor $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO proveedores(nombre, idDireccion, rfc, diasCredito, email, descuentoPorFactura, descuentoPorProntoPago, tipoProveedor, idStatus)VALUES('" . $t->getNombre() . "','" . $t->getIdDireccion() . "','" . $t->getRfc() . "','" . $t->getDiasCredito() . "','" . $t->getEmail() . "','" . $t->getDesctfactura() . "','" . $t->getDesctprontopago() . "','" . $t->getTipoProveedor() . "','1');";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarListaPrecio(ListaPrecio $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO listaprecios (nombreListaPrecio,idStatus) VALUES ('" . $t->getNombreListaPrecio() . "','1')";
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

    function obtenerEntradas($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select * from productos p 
            inner join  existencias e 
            on e.codigoProducto = p.codigoProducto 
            WHERE idSucursal = '" . $idSucursal . "'";
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
//        $MySQLExistencias = "INSERT INTO existencias (cantidad, idSucursal, codigoProducto) VALUES ('" . $entradas->getCantidad() . "','1', '" . $entradas->getCodigoProducto() . "')";
        $mysqlUpdateExistencias = "UPDATE existencias set cantidad = '" . $entradas->getCantidad() . "' WHERE codigoProducto='" . trim($entradas->getCodigoProducto()) . "' and idSucursal ='" . $entradas->getIdSucursal() . "'";
        mysql_query("START TRANSACTION;");
        $entradas = mysql_query($MySQLEntradas);
        if ($entradas == false) {
            mysql_query("ROLLBACK;");
        } else {
            $existencias = mysql_query($mysqlUpdateExistencias);
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
        $sql = "SELECT p.codigoProducto, p.producto FROM productos p\n"
                . " INNER JOIN proveedores pr on pr.idProveedor = p.idProveedor\n"
                . " WHERE pr.rfc='$rfc'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function obtieneDireccionDeProveedor($id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM direcciones WHERE idDireccion = '$id'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function buscarProducto(Producto $p, $proveedor) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $MySQL = "SELECT p.codigoproducto, producto, costo  FROM productos p
               inner join proveedores pr
               on p.idProveedor = pr.idProveedor
               inner join marcas m
               on m.idMarca = p.idMarca
	       inner join costos cost
	       on p.codigoProducto = cost.codigoProducto
               WHERE p.codigoProducto='" . $p->getCodigoProducto() . "'
               and pr.rfc='" . $proveedor . "';";
        $rs = mysql_query($MySQL, $cn->Conectarse());
        $cn->cerrarBd();
        return $rs;
    }

    function buscarProductoGral(Producto $p, $proveedor, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $MySQL = "SELECT p.codigoproducto, producto, tar.tarifa ,ex.cantidad   FROM productos p
               inner join proveedores pr
               on p.idProveedor = pr.idProveedor
               inner join marcas m
               on m.idMarca = p.idMarca
	       inner join costos cost
	       on p.codigoProducto = cost.codigoProducto
               inner join existencias ex
               on p.codigoProducto = ex.codigoProducto
               inner join tarifas  tar
               on p.codigoProducto = tar.codigoProducto
               inner join listaPrecios li
               on tar.idListaPrecio = li.idListaPrecio
               WHERE p.codigoProducto='" . $p->getCodigoProducto() . "'and li.nombreListaPrecio='MENUDEO' and tar.idStatus='1' and tar.idSucursal='$idSucursal' and cost.idSucursal ='$idSucursal' and cost.status = '1' and ex.idSucursal= '$idSucursal'";
        $rs = mysql_query($MySQL, $cn->Conectarse());
        $cn->cerrarBd();
        return $rs;
    }

    function buscarProductoVentas(Codigo $c, $idSucursal) {
        $MySQL = "SELECT p.codigoproducto, producto, costo  FROM productos p
                  inner join proveedores pr
                  on p.idProveedor = pr.idProveedor
                  inner join marcas m
                  on m.idMarca = p.idMarca
	          inner join costos cost
	          on p.codigoProducto = cost.codigoProducto
                  WHERE p.codigoProducto='" . $c->getCodigo() . "'"
                . " and  cost.idSucursal  = '" . $idSucursal . "' "
                . " and cost.status = 1";
        $rs = mysql_query($MySQL);
        return $rs;
    }

//===================Para guardar XMl entrada===================================
    function validarExistenciaProductoProveedor($rfc) {
        $sql = "SELECT producto, codigoProducto FROM productos p"
                . " INNER JOIN proveedores pr ON pr.idProveedor  = p.idProveedor"
                . " WHERE pr.rfc = '$rfc'";
        $valor = mysql_query($sql);
        $rs = mysql_fetch_array($valor);
        if ($rs == false) {
            return false;
        } else {
            mysql_data_seek($valor, 0);
            return $valor;
        }
    }

    function MiniGuardadorSalidas(Encabezado $encabezadoSalida, $arrayDetalleSalida, $lafecha, $idSucursal) {
        $detalle = new Detalle();
        //Guardar encabezado salida
        $sqlEncabezadoGuardar = "INSERT INTO facturaencabezados (fechaEncabezado, subtotalEncabezado, totalEncabezado, rfcEncabezado, folioEncabezado, fechaMovimiento, idTipoMovimiento, idSucursal)"
                . " VALUES ('" . $encabezadoSalida->getFecha() . "','" . $encabezadoSalida->getSubtotal() . "','" . $encabezadoSalida->getTotal() . "','" . $encabezadoSalida->getRfc() . "','" . $encabezadoSalida->getFolio() . "','$lafecha','2','$idSucursal')";
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
        foreach ($arrayDetalleSalida as $detalle) {
            //Guardar ddetalles
            $sqlDetalleGuardar = "INSERT INTO facturadetalles (unidadMedidaDetalle, importeDetalle, cantidadDetalle, codigoDetalle, descripcionDetalle, costoDetalle, idFacturaEncabezados) "
                    . "VALUES ('" . $detalle->getUnidadmedida() . "','" . $detalle->getImporte() . "','" . $detalle->getCantidad() . "','" . $detalle->getCodigo() . "','" . $detalle->getDescripcion() . "','" . $detalle->getCosto() . "','$idEncabezado')";
            $ctrlDetalleGuardar = mysql_query($sqlDetalleGuardar);
            if ($ctrlDetalleGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //==================================================================
            //Comienza validar producto en existencia
            $cantidad = 0;
            $sqlConceptoValidarExistencia = "SELECT cantidad FROM existencias"
                    . " WHERE codigoProducto = '" . $detalle->getCodigo() . "' AND idSucursal = '$idSucursal'";
            $ctrlConceptoValidarExistencia = mysql_query($sqlConceptoValidarExistencia);
            if ($ctrlConceptoValidarExistencia == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlConceptoValidarExistencia)) {
                    $cantidad = $rs["cantidad"];
                }
            }
            //Terminar validar producto en existencia
            //Variables necesarias: $cantidad
            //==================================================================
            //Comienza Actulizar existencia
            $nuevacantidad = $cantidad - $detalle->getCantidad();
            $sqlActulizaExistencia = "UPDATE existencias SET cantidad = '$nuevacantidad'"
                    . " WHERE codigoProducto = '" . $detalle->getCodigo() . "' AND idSucursal = '$idSucursal'";
            $ctrlActulizaExistencia = mysql_query($sqlActulizaExistencia);
            if ($ctrlActulizaExistencia == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //Terminar Actulizar existencia
            //==================================================================
        }
        mysql_query("COMMIT;");
    }

    function superMegaGuardadorEntradas($lafecha, Encabezado $encabezado, $arrayDetalleEntrada, Comprobante $comprobante, $conceptos, $control, $idSucursal, $tipo, $usuario) {
        $detalle = new Detalle();
        //======================================================================
        //Empieza guardar encabezado
        $sqlEncabezadoGuardar = "INSERT INTO facturaencabezados (fechaEncabezado, subtotalEncabezado, totalEncabezado, rfcEncabezado, folioEncabezado, fechaMovimiento, idTipoMovimiento, idSucursal)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $encabezado->getTotal() . "','" . $encabezado->getRfc() . "','" . $encabezado->getFolio() . "','$lafecha','1','$idSucursal')";
        $sqlEncabezadoId = "SELECT LAST_INSERT_ID() ID;";
        mysql_query("START TRANSACTION;");
        $ctrlEnzabezadoGuardar = mysql_query($sqlEncabezadoGuardar);
        if ($ctrlEnzabezadoGuardar == false) {
            $error = mysql_error();
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
        $sqlComprobanteGuardar = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento, idSucursal)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $comprobante->getSda() . "','" . $encabezado->getRfc() . "','" . $comprobante->getDescuentoFactura() . "','" . $comprobante->getDescuentoProntoPago() . "','" . $comprobante->getDescuentoGeneral() . "','" . $comprobante->getDescuentoPorProducto() . "','" . $comprobante->getDescuentoTotal() . "','" . $comprobante->getConIva() . "','" . $comprobante->getTotal() . "','" . $encabezado->getFolio() . "','$tipo','$lafecha','$idSucursal')";
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
            $cpto = $conceptos[$i];
            //Comienza guardar detalle
            $detalle = $arrayDetalleEntrada[$i];
            $sqlDetalleGuardar = "INSERT INTO facturadetalles (unidadMedidaDetalle, importeDetalle, cantidadDetalle, codigoDetalle, descripcionDetalle, costoDetalle, idFacturaEncabezados) "
                    . "VALUES ('" . $detalle->getUnidadmedida() . "','" . $detalle->getImporte() . "','" . $detalle->getCantidad() . "','" . $cpto->codigoConcepto . "','" . $detalle->getDescripcion() . "','" . $detalle->getCosto() . "','$idEncabezado')";
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
            if ($tipo !== "PEDIDO CLIENTE" && $tipo !== "Orden Compra") {
                $sqlConceptoValidarExistencia = "SELECT cantidad FROM existencias"
                        . " WHERE codigoProducto = '$cpto->codigoConcepto' AND idSucursal = '$idSucursal'";
                $ctrlConceptoValidarExistencia = mysql_query($sqlConceptoValidarExistencia);
                if ($ctrlConceptoValidarExistencia == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                } else {
                    while ($rs = mysql_fetch_array($ctrlConceptoValidarExistencia)) {
                        $cantidad = $rs["cantidad"];
                    }
                }
            }
            //Terminar validar producto en existencia
            //Variables necesarias: $cantidad
            //==================================================================
            //Comienza guardar xml concepto
            $importe = 0;
            $codigo = 0;
            $cda = 0;
            $desctuno = 0;
            $desctdos = 0;

            if (isset($cpto->importeConcepto)) {
                $importe = $cpto->importeConcepto;
            }
            if (isset($cpto->codigoConcepto)) {
                $codigo = $cpto->codigoConcepto;
            }
            if (isset($cpto->cdaConcepto)) {
                $cda = $cpto->cdaConcepto;
            }
            if (isset($cpto->desctUnoConcepto)) {
                $desctuno = $cpto->desctUnoConcepto;
            }
            if (isset($cpto->desctDosConcepto)) {
                $desctdos = $cpto->desctDosConcepto;
            }
            if (isset($cpto->costoCotizacion)) {
                $cotizacion = $cpto->costoCotizacion;
            }
            $sqlConceptoGuardar = "INSERT INTO xmlconceptos (unidadMedidaConcepto, importeConcepto, cantidadConcepto, codigoConcepto, descripcionConcepto, precioUnitarioConcepto, idXmlComprobante, cdaConcepto, desctUnoConcepto, desctDosConcepto,costoCotizacion)"
                    . " VALUES ('" . $detalle->getUnidadmedida() . "','$importe','" . $detalle->getCantidad() . "','$codigo','" . $detalle->getDescripcion() . "','" . $detalle->getCosto() . "','$idComprobante','$cda','$desctuno','$desctdos','$cotizacion')";
            $ctrlConceptoGuardar = mysql_query($sqlConceptoGuardar);
            if ($ctrlConceptoGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //Terminar guardar xml concepto
            //==================================================================
            //Comienza actulizar costo
            if ($tipo !== "PEDIDO CLIENTE" && $tipo !== "Orden Compra") {
                $sqlTraerCosto = "SELECT costo, idCosto FROM costos "
                        . " WHERE codigoProducto = '$cpto->codigoConcepto' AND status = '1' AND idSucursal = '$idSucursal'";
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
                if ($costoViejo != $cpto->cdaConcepto) {
                    $totalViejo = $cantidad * $costoViejo;
                    $totalNuevo = $cpto->cdaConcepto * $detalle->getCantidad();
                    $totalFinal = $totalViejo + $totalNuevo;
                    $cantidadFinal = $cantidad + $detalle->getCantidad();
                    $costoPromedio = $totalFinal / $cantidadFinal;
                    $sqlInsertaNuevoCosto = "INSERT INTO costos (costo, codigoProducto, fechaMovimiento, status,idSucursal)"
                            . " VALUES ('$costoPromedio','$cpto->codigoConcepto','$lafecha','1','$idSucursal')";
                    $sqlActulizarViejoCosto = "UPDATE costos SET status = '2'"
                            . " WHERE codigoProducto = '$cpto->codigoConcepto' AND idCosto = '$idDondeSalioCosto' AND idSucursal = '$idSucursal'";
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
                        . " WHERE codigoProducto = '$cpto->codigoConcepto' AND idSucursal = '$idSucursal' ";
                $ctrlActulizaExistencia = mysql_query($sqlActulizaExistencia);
                if ($ctrlActulizaExistencia == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                }
                //Terminar Actulizar existencia
                //==================================================================
                //Comienza guardar entrada
                $sqlEntradasGuardar = "INSERT INTO entradas (usuario, cantidad, fecha, codigoProducto, idSucursal) "
                        . " VALUES ('$usuario','" . $detalle->getCantidad() . "','$lafecha','$cpto->codigoConcepto','$idSucursal')";
                $ctrlEntradasGuardar = mysql_query($sqlEntradasGuardar);
                if ($ctrlEntradasGuardar == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                }
                //Terminar guardar entrada
            }
        }//Cierre FOR
        mysql_query("COMMIT;");
        error_reporting(0);
        return $idComprobante;
    }

    //============================================== Todo para usuarios ============
    function mostrarTipoUsuario() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM tiposusuarios";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            return 1;
        } else {
            return $rs;
        }
    }

    function guardarUsuario(Usuario $usuario, $idsucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO usuarios (usuario, nombre, apellidoPaterno, apellidoMaterno, password, idtipousuario, idSucursal)"
                . "VALUES ('" . $usuario->getUsuario() . "','" . $usuario->getNombre() . "','" . $usuario->getPaterno() . "','" . $usuario->getMaterno() . "','" . $usuario->getPass() . "','" . $usuario->getTipousuario() . "','$idsucursal')";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            return 1;
        } else {
            return 0;
        }
    }

    function consultarExistenciaUsuario($usuario) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM usuarios WHERE usuario= '$usuario'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $rs = mysql_affected_rows();
        if ($rs == 0) {
            return 0;
        } else {
            return $datos;
        }
    }

    function editarUsuario(Usuario $usuario, $idsucursal, $id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE usuarios SET usuario='" . $usuario->getUsuario() . "', nombre='" . $usuario->getNombre() . "', apellidoPaterno='" . $usuario->getPaterno() . "', apellidoMaterno='" . $usuario->getMaterno() . "', password='" . $usuario->getPass() . "', idtipousuario='" . $usuario->getTipousuario() . "' WHERE idUsuario = '$id' and idSucursal = '$idsucursal'";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            $error = mysql_error();
            return 1;
        } else {
            return 0;
        }
        $cn->cerrarBd();
    }

    function eliminarUsuario($id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "DELETE FROM usuarios WHERE idUsuario = '$id'";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            return 1;
        } else {
            return 0;
        }
        $cn->cerrarBd();
    }

    function consultaUsuario($sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM usuarios WHERE idSucursal = $sucursal";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    //==================Nuevo Guardar Proveedor=================================
    function superGuardadorProveedores(Proveedor $proveedor, Direccion $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails) {
        //Guardando la direccion
        $sqlDireccion = "INSERT INTO direcciones (calle, numeroExterior, numeroInterior, cruzamientos, postal, colonia, ciudad, estado) VALUES ('" . $direccion->getCalle() . "','" . $direccion->getNumeroexterior() . "','" . $direccion->getNumerointerior() . "','" . $direccion->getCruzamientos() . "','" . $direccion->getPostal() . "','" . $direccion->getColonia() . "','" . $direccion->getCiudad() . "','" . $direccion->getEstado() . "')";
        $sqlDireccionId = "SELECT LAST_INSERT_ID() ID;";
        mysql_query("START TRANSACTION;");
        $ctrlDireccionGuardar = mysql_query($sqlDireccion);
        if ($ctrlDireccionGuardar == false) {
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlDireccionId = mysql_query($sqlDireccionId);
            if ($ctrlDireccionId == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlDireccionId)) {
                    $idDireccion = $rs["ID"];
                }
            }
        }
        //Guardando Proveedor
        $sqlProveedor = "INSERT INTO proveedores (nombre, idDireccion, rfc, diasCredito, descuentoPorFactura, descuentoPorProntoPago, tipoProveedor, idStatus) VALUES ('" . $proveedor->getNombre() . "','$idDireccion','" . $proveedor->getRfc() . "','" . $proveedor->getDiasCredito() . "','" . $proveedor->getDesctfactura() . "','" . $proveedor->getDesctprontopago() . "','" . $proveedor->getTipoProveedor() . "','1')";
        $sqlProveedorId = "SELECT LAST_INSERT_ID() ID;";
        $ctrlProveedoGuardar = mysql_query($sqlProveedor);
        if ($ctrlProveedoGuardar == false) {
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlProveedorId = mysql_query($sqlProveedorId);
            if ($ctrlProveedorId == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlProveedorId)) {
                    $idProveedor = $rs["ID"];
                }
            }
        }
        //Guardando Telefonos
        for ($i = 0; $i < $ctrltelefonos; $i++) {
            $sqlTelefonos = "INSERT INTO telefonos (telefono, idPropietario, tipoPropietario) VALUES ('$telefonos[$i]','$idProveedor','PROVEEDOR')";
            $ctrlTelefonoGuardar = mysql_query($sqlTelefonos);
            if ($ctrlTelefonoGuardar == false) {
                $rs = mysql_error();
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        //Guardar Emails
        for ($i = 0; $i < $ctrlemails; $i++) {
            $sqlEmails = "INSERT INTO emails (email, idPropietario, tipoPropietario) VALUES ('$emails[$i]','$idProveedor','PROVEEDOR')";
            $ctrlEmailsGuardar = mysql_query($sqlEmails);
            if ($ctrlEmailsGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    //==================Sacar datos del proveedor===============================
    function puleaProveedor($rfc) {
        $sql = "SELECT nombre, rfc, diasCredito, descuentoPorFactura, descuentoPorProntoPago, tipoProveedor FROM proveedores WHERE rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function puleaDireccion($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT d.calle, d.numeroExterior, d.numeroInterior, d.cruzamientos, d.postal, d.colonia, d.ciudad, d.estado FROM proveedores p INNER JOIN direcciones d ON p.idDireccion = d.idDireccion WHERE p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function puleaTelefono($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idTelefonos, t.telefono FROM proveedores p INNER JOIN telefonos t ON p.idProveedor = t.idPropietario WHERE t.tipoPropietario = 'PROVEEDOR' AND p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function puleaEmails($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT e.idEmail, e.email FROM proveedores p INNER JOIN emails e ON p.idProveedor = e.idPropietario WHERE e.tipoPropietario = 'PROVEEDOR' AND p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function puleaTelefonoC($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idTelefonos, t.telefono FROM clientes p INNER JOIN telefonos t ON p.idCliente = t.idPropietario WHERE t.tipoPropietario = 'CLIENTE' AND p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function puleaEmailsC($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT e.idEmail, e.email FROM clientes p INNER JOIN emails e ON p.idCliente = e.idPropietario WHERE e.tipoPropietario = 'CLIENTE' AND p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function eliminartTelefonos($id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "DELETE FROM telefonos WHERE idTelefonos = '$id'";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            $rs = 00;
        }
        $cn->cerrarBd();
        return $rs;
    }

    function eliminarEmails($id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "DELETE FROM emails WHERE idEmail = '$id'";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            $rs = 01;
        }
        $cn->cerrarBd();
        return $rs;
    }

    //==========================================================================

    function superEditorProveedores(Proveedor $proveedor, Direccion $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails) {
        //Sacar id proveedor
        $sqlIdProveedor = "SELECT idProveedor, idDireccion FROM proveedores WHERE rfc = '" . $proveedor->getRfc() . "'";
        mysql_query("START TRANSACTION;");
        $ctrlIdProveedor = mysql_query($sqlIdProveedor);
        if ($ctrlIdProveedor == false) {
            $ctrlIdProveedor = mysql_error();
            mysql_query("ROLLBACK;");
        } else {
            while ($rs = mysql_fetch_array($ctrlIdProveedor)) {
                $idProveedor = $rs["idProveedor"];
                $idDireccion = $rs["idDireccion"];
            }
        }
        //Editar Proveedor
        $sqlEditarProveedor = "UPDATE proveedores SET nombre='" . $proveedor->getNombre() . "' , diasCredito='" . $proveedor->getDiasCredito() . "' , descuentoPorFactura='" . $proveedor->getDesctfactura() . "' , descuentoPorProntoPago='" . $proveedor->getDesctprontopago() . "' WHERE idProveedor='$idProveedor'";
        $ctrlEditarProveedor = mysql_query($sqlEditarProveedor);
        if ($ctrlEditarProveedor == false) {
            $ctrlEditarProveedor = mysql_error();
            mysql_query("ROLLBACK;");
        }
        //Editar direccion
        $sqlEditarEditarDireccion = "UPDATE direcciones  SET calle='" . $direccion->getCalle() . "', numeroExterior='" . $direccion->getNumeroexterior() . "', numeroInterior='" . $direccion->getNumerointerior() . "', cruzamientos='" . $direccion->getCruzamientos() . "', postal='" . $direccion->getPostal() . "', colonia='" . $direccion->getColonia() . "', ciudad='" . $direccion->getCiudad() . "', estado='" . $direccion->getEstado() . "' WHERE idDireccion= '$idDireccion'";
        $ctrlEditarDireccion = mysql_query($sqlEditarEditarDireccion);
        if ($ctrlEditarDireccion == false) {
            $ctrlEditarDireccion = mysql_error();
            mysql_query("ROLLBACK;");
        }
        //Editar agregar telefonos
        if ($ctrltelefonos <= 0) {
            
        } else {
            for ($i = 0; $i < $ctrltelefonos; $i++) {
                $sqlTelefonos = "INSERT INTO telefonos (telefono, idPropietario, tipoPropietario) VALUES ('$telefonos[$i]','$idProveedor','PROVEEDOR')";
                $ctrlTelefonoGuardar = mysql_query($sqlTelefonos);
                if ($ctrlTelefonoGuardar == false) {
                    $rs = mysql_error();
                    mysql_query("ROLLBACK;");
                    return false;
                }
            }
        }
        //Editar agregar emails
        if ($ctrlemails <= 0) {
            
        } else {
            for ($i = 0; $i < $ctrlemails; $i++) {
                $sqlEmails = "INSERT INTO emails (email, idPropietario, tipoPropietario) VALUES ('$emails[$i]','$idProveedor','PROVEEDOR')";
                $ctrlEmailsGuardar = mysql_query($sqlEmails);
                if ($ctrlEmailsGuardar == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                }
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    //==================Nuevo Guardar Cliente=================================
    function superGuardadorClientes(Proveedor $proveedor, Direccion $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails) {
        //Guardando la direccion
        $sqlDireccion = "INSERT INTO direcciones (calle, numeroExterior, numeroInterior, cruzamientos, postal, colonia, ciudad, estado) VALUES ('" . $direccion->getCalle() . "','" . $direccion->getNumeroexterior() . "','" . $direccion->getNumerointerior() . "','" . $direccion->getCruzamientos() . "','" . $direccion->getPostal() . "','" . $direccion->getColonia() . "','" . $direccion->getCiudad() . "','" . $direccion->getEstado() . "')";
        $sqlDireccionId = "SELECT LAST_INSERT_ID() ID;";
        mysql_query("START TRANSACTION;");
        $ctrlDireccionGuardar = mysql_query($sqlDireccion);
        if ($ctrlDireccionGuardar == false) {
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlDireccionId = mysql_query($sqlDireccionId);
            if ($ctrlDireccionId == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlDireccionId)) {
                    $idDireccion = $rs["ID"];
                }
            }
        }
        //Guardando Proveedor
        $sqlProveedor = "INSERT INTO clientes (nombre, idDireccion, rfc, diasCredito, descuentoPorFactura, descuentoPorProntoPago, tipoCliente, idStatus, credito) VALUES ('" . $proveedor->getNombre() . "','$idDireccion','" . $proveedor->getRfc() . "','" . $proveedor->getDiasCredito() . "','" . $proveedor->getDesctfactura() . "','" . $proveedor->getDesctprontopago() . "','" . $proveedor->getTipoProveedor() . "','1','" . $proveedor->getCredito() . "')";
        $sqlProveedorId = "SELECT LAST_INSERT_ID() ID;";
        $ctrlProveedoGuardar = mysql_query($sqlProveedor);
        if ($ctrlProveedoGuardar == false) {
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlProveedorId = mysql_query($sqlProveedorId);
            if ($ctrlProveedorId == false) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrlProveedorId)) {
                    $idCliente = $rs["ID"];
                }
            }
        }
        //Guardando Telefonos
        for ($i = 0; $i < $ctrltelefonos; $i++) {
            $sqlTelefonos = "INSERT INTO telefonos (telefono, idPropietario, tipoPropietario) VALUES ('$telefonos[$i]','$idCliente','CLIENTE')";
            $ctrlTelefonoGuardar = mysql_query($sqlTelefonos);
            if ($ctrlTelefonoGuardar == false) {
                $rs = mysql_error();
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        //Guardar Emails
        for ($i = 0; $i < $ctrlemails; $i++) {
            $sqlEmails = "INSERT INTO emails (email, idPropietario, tipoPropietario) VALUES ('$emails[$i]','$idCliente','CLIENTE')";
            $ctrlEmailsGuardar = mysql_query($sqlEmails);
            if ($ctrlEmailsGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    //==========================================================================
    function superEditorClientes(Proveedor $proveedor, Direccion $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails) {
        //Sacar id proveedor
        $sqlIdProveedor = "SELECT idCliente, idDireccion FROM clientes WHERE rfc = '" . $proveedor->getRfc() . "'";
        mysql_query("START TRANSACTION;");
        $ctrlIdProveedor = mysql_query($sqlIdProveedor);
        if ($ctrlIdProveedor == false) {
            $ctrlIdProveedor = mysql_error();
            mysql_query("ROLLBACK;");
        } else {
            while ($rs = mysql_fetch_array($ctrlIdProveedor)) {
                $idProveedor = $rs["idCliente"];
                $idDireccion = $rs["idDireccion"];
            }
        }
        //Editar Proveedor
        $sqlEditarProveedor = "UPDATE clientes SET nombre='" . $proveedor->getNombre() . "' , diasCredito='" . $proveedor->getDiasCredito() . "' , descuentoPorFactura='" . $proveedor->getDesctfactura() . "' , descuentoPorProntoPago='" . $proveedor->getDesctprontopago() . "', credito = '" . $proveedor->getCredito() . "' WHERE idCliente='$idProveedor'";
        $ctrlEditarProveedor = mysql_query($sqlEditarProveedor);
        if ($ctrlEditarProveedor == false) {
            $ctrlEditarProveedor = mysql_error();
            mysql_query("ROLLBACK;");
        }
        //Editar direccion
        $sqlEditarEditarDireccion = "UPDATE direcciones  SET calle='" . $direccion->getCalle() . "', numeroExterior='" . $direccion->getNumeroexterior() . "', numeroInterior='" . $direccion->getNumerointerior() . "', cruzamientos='" . $direccion->getCruzamientos() . "', postal='" . $direccion->getPostal() . "', colonia='" . $direccion->getColonia() . "', ciudad='" . $direccion->getCiudad() . "', estado='" . $direccion->getEstado() . "' WHERE idDireccion= '$idDireccion'";
        $ctrlEditarDireccion = mysql_query($sqlEditarEditarDireccion);
        if ($ctrlEditarDireccion == false) {
            $ctrlEditarDireccion = mysql_error();
            mysql_query("ROLLBACK;");
        }
        //Editar agregar telefonos
        if ($ctrltelefonos <= 0) {
            
        } else {
            for ($i = 0; $i < $ctrltelefonos; $i++) {
                $sqlTelefonos = "INSERT INTO telefonos (telefono, idPropietario, tipoPropietario) VALUES ('$telefonos[$i]','$idProveedor','CLIENTE')";
                $ctrlTelefonoGuardar = mysql_query($sqlTelefonos);
                if ($ctrlTelefonoGuardar == false) {
                    $rs = mysql_error();
                    mysql_query("ROLLBACK;");
                    return false;
                }
            }
        }
        //Editar agregar emails
        if ($ctrlemails <= 0) {
            
        } else {
            for ($i = 0; $i < $ctrlemails; $i++) {
                $sqlEmails = "INSERT INTO emails (email, idPropietario, tipoPropietario) VALUES ('$emails[$i]','$idProveedor','CLIENTE')";
                $ctrlEmailsGuardar = mysql_query($sqlEmails);
                if ($ctrlEmailsGuardar == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                }
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    //===================Sacando datos cliente =================================
    function cpuleaProveedor($rfc) {
        $sql = "SELECT nombre, rfc, credito, diasCredito, descuentoPorFactura, descuentoPorProntoPago, tipoCliente FROM clientes WHERE rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function cpuleaDireccion($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT d.calle, d.numeroExterior, d.numeroInterior, d.cruzamientos, d.postal, d.colonia, d.ciudad, d.estado FROM clientes p INNER JOIN direcciones d ON p.idDireccion = d.idDireccion WHERE p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function cpuleaTelefono($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT t.idTelefonos, t.telefono FROM clientes p INNER JOIN telefonos t ON p.idCliente = t.idPropietario WHERE t.tipoPropietario = 'CLIENTE' AND p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function cpuleaEmails($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT e.idEmail, e.email FROM clientes p INNER JOIN emails e ON p.idCliente = e.idPropietario WHERE e.tipoPropietario = 'CLIENTE' AND p.rfc = '$rfc'";
        $rs = mysql_query($sql);
        $datos = mysql_affected_rows();
        if ($rs == false) {
            $rs = mysql_error();
        } else {
            if ($datos > 0) {
                
            } else {
                $rs = false;
            }
        }
        return $rs;
    }

    function obtenerDatosAgranel($codigo) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT cantidad FROM agranel WHERE codigoAgranel = '$codigo'";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            $rs = mysql_error();
        }
        return $rs;
    }

//    function verificaProductoGranel($codigo, $sucursal) {
//        
//        include_once '../daoconexion/daoConeccion.php';
//        $cn = new coneccion();
//        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.idProducto,  p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida \n"
//                . "FROM productos p \n"
//                . "INNER JOIN marcas m ON p.idMarca = m.idMarca \n"
//                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor \n"
//                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto \n"
//                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto \n"
//                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto \n"
//                . "WHERE c.status = 1 AND p.codigoProducto = '$codigo' AND c.idSucursal = '$sucursal' AND e.idSucursal = '$sucursal'";
//        $datos = mysql_query($sql, $cn->Conectarse());
//        if ($datos == false) {
//            $datos = mysql_error();
//            $rs = 0;
//        } else {
//            $rs = $datos;
//        }
//        return $rs;
//       
////        include_once '../daoconexion/daoConeccion.php';
////        $cn = new coneccion();
////        $sql = "SELECT * FROM productos WHERE codigoProducto = '$codigo'";
////        mysql_query($sql, $cn->Conectarse());
////        $band = mysql_affected_rows();
////        if ($band < 1) {
////            $valida = 0;
////        } else {
////            $valida = 1;
////        }
////        return $valida;
//    }
    function editarProductoGranel(Producto $p, Costo $c, Tarifa $t, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sqlCostos = "UPDATE costos set status = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idSucursal= '$idSucursal' ";
        $sqlProductos = "UPDATE productos set producto = '" . $p->getProducto() . "',idMarca= '" . $p->getIdMarca() . "',idProveedor= '" . $p->getIdProveedor() . "',cantidadMaxima= '1',cantidadMinima= '0',idGrupoProducto= '" . $p->getIdGrupoProducto() . "',idUnidadMedida= '" . $p->getIdUnidadMedida() . "',idStatus='1' WHERE codigoProducto = '" . $p->getCodigoProducto() . "'";
        $fecha = date("d/m/Y h:i");
        $sqlCostoNuevo = "INSERT INTO costos(costo, codigoProducto,fechaMovimiento, status, idSucursal)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "','$fecha','1','$idSucursal')";

        mysql_query("START TRANSACTION;");
        $producto = mysql_query($sqlProductos, $cn->Conectarse());
        if ($producto == false) {
            mysql_query("ROLLBACK;");
        } else {
            $costos = mysql_query($sqlCostos, $cn->Conectarse());
            if ($costos == false) {
                mysql_query("ROLLBACK;");
            } else {
                $costosNuevo = mysql_query($sqlCostoNuevo, $cn->Conectarse());
                if ($costosNuevo == false) {
                    mysql_query("ROLLBACK;");
                } else {

                    $lista = $t->getIdListaPrecio();

                    foreach ($lista as $valor) {
                        $pieces = explode("-", $valor);
                        if ($cont == 0) {
                            if ($pieces[0] !== " ") {
                                if ($pieces[0] !== "") {
                                    if ($pieces[0] !== null) {
                                        $tarifa = $pieces[0];
                                        $listaPrecio = $pieces[1];
                                        $cont = 1;
                                    } else {
                                        echo 'mal';
                                    }
                                } else {
                                    $verificaExistecia = "SELECT * from tarifas WHERE idListaPrecio = $pieces[1] and codigoProducto = '" . $p->getCodigoProducto() . "' AND idStatus = '1' AND idSucursal = '$idSucursal' ";
                                    $Existencia = mysql_query($verificaExistecia, $cn->Conectarse());
                                    $band = mysql_affected_rows();
                                    if ($band > 0) {
                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $pieces[1] AND idSucursal = '$idSucursal'";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            echo 'bien';
                                        }
                                    } else {
                                        echo 'mal';
                                    }
                                }
                            } else {
                                echo 'mal';
                            }
                        } else {
                            if ($pieces[0] !== " ") {
                                if ($pieces[0] !== "") {
                                    if ($pieces[0] !== null) {

                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $listaPrecio AND idSucursal ='$idSucursal'";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            $sqlTarifas = "INSERT INTO tarifas(codigoProducto, porcentaUtilidad, idListaPrecio, idStatus,tarifa, fechaMovimientoTarifa,idSucursal)VALUES('" . $p->getCodigoProducto() . "','$tarifa','$listaPrecio','1','$pieces[0]','$fecha','$idSucursal')";
                                            $tarifas = mysql_query($sqlTarifas, $cn->Conectarse());
                                            if ($tarifas == false) {
                                                mysql_query("ROLLBACK;");
                                            } else {
                                                echo 'BIEN';
                                            }
                                            $cont = 0;
                                        }
                                    } else {
                                        echo 'mal';
                                    }
                                } else {
                                    $verificaExistecia = "SELECT * tarifas WHERE idListaPrecio = $pieces[1] and codigoProducto = '" . $p->getCodigoProducto() . "' AND idStatus = '1' ";
                                    $Existencia = mysql_query($verificaExistecia, $cn->Conectarse());
                                    $band = mysql_affected_rows();
                                    if ($band > 0) {
                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $pieces[1] AND idSucursal = '$idSucursal'";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            echo 'bien';
                                        }
                                    } else {
                                        echo 'mal';
                                    }
                                    echo 'mal';
                                }
                            } else {
                                echo 'mal';
                            }
                        }
                    }
                    mysql_query("COMMIT;");
                }
            }
        }
        $cn->cerrarBd();
    }

    function consultaGranel($idsucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto, p.producto, e.cantidad FROM productos p "
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto "
                . "INNER JOIN agranel a ON a.codigoAgranel = p.codigoProducto "
                . "WHERE e.idSucursal = '$idsucursal'";
        $ctrl = mysql_query($sql, $cn->Conectarse());
        if ($ctrl == false) {
            $ctrl = mysql_error();
            $ctrl = false;
        }
        return $ctrl;
    }

    function verificaProductoGranel($codigog, $idsucursal) {
        $sql = "SELECT p.producto, e.cantidad, a.cantidad AS contenido FROM productos p "
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto "
                . "INNER JOIN agranel a ON a.codigoAgranel = p.codigoProducto "
                . "WHERE e.idSucursal = '$idsucursal' AND p.codigoProducto = '$codigog'";
        $datos = mysql_query($sql);
        $ctrl = mysql_affected_rows();
        if ($datos == false) {
            $ctrl = mysql_error();
        } else {
            if ($ctrl < 1) {
                $datos = false;
            }
        }
        return $datos;
    }

    function verificaProductoPadre($codigo, $idsucursal) {
        $sql = "SELECT p.producto, e.cantidad FROM productos p "
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto "
                . "WHERE e.idSucursal = '$idsucursal' AND p.codigoProducto = '$codigo'";
        $datos = mysql_query($sql);
        $ctrl = mysql_affected_rows();
        if ($datos == false) {
            $ctrl = mysql_error();
        } else {
            if ($ctrl < 1) {
                $datos = false;
            }
        }
        return $datos;
    }

    function incrementaGranel($codigo, $codigog, $contenido, $idsucursal) {
        //=== Sacar existencia producto padre
        $sql = "SELECT cantidad FROM existencias WHERE codigoProducto = '$codigo' AND  idSucursal = '$idsucursal'";
        $ctrl = mysql_query($sql);
        mysql_query("START TRANSACTION;");
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            while ($rs = mysql_fetch_array($ctrl)) {
                $cantidad = $rs["cantidad"];
            }
        }
        //=== Restar existencia 
        $nuevacantidad = $cantidad - 1;
        //=== Actulizar existencia producto padre
        $sql = "UPDATE existencias SET cantidad = '$nuevacantidad' WHERE codigoProducto = '$codigo' AND  idSucursal = '$idsucursal'";
        $ctrl = mysql_query($sql);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //=== Sacar existencia prodcuto granel
        $sql = "SELECT cantidad FROM existencias WHERE codigoProducto = '$codigog' AND  idSucursal = '$idsucursal'";
        $ctrl = mysql_query($sql);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            while ($rs = mysql_fetch_array($ctrl)) {
                $cantidadg = $rs["cantidad"];
            }
        }
        //=== Incrementar existencia granel
        $nuevaexistencia = $cantidadg + $contenido;
        //=== Actulizar existencia producto hijo
        $sql = "UPDATE existencias SET cantidad = '$nuevaexistencia' WHERE codigoProducto = '$codigog' AND idSucursal = '$idsucursal'";
        $ctrl = mysql_query($sql);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        mysql_query("COMMIT;");
        return true;
    }

    function dameTarifas(Codigo $c, $idSucursal) {
        $sql = "select nombreListaPrecio, porcentaUtilidad from tarifas  t
                inner join listaprecios lp
                on lp.idListaPrecio  = t.idListaPrecio
                where codigoProducto = '" . $c->getCodigo() . "' 
                and t.idStatus='" . $idSucursal . "'";
        $datos = mysql_query($sql);
        if ($datos == false) {
            $datos = mysql_error();
        }
        return $datos;
    }

    function consultaBuscador($idsucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto, p.producto, m.marca, pr.nombre  AS proveedor, g.grupoProducto, ex.cantidad AS existencia, tf.tarifa AS menudeo\n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN existencias ex ON ex.codigoProducto =  p.codigoProducto\n"
                . "INNER JOIN tarifas tf ON tf.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto WHERE p.idStatus = '1' AND ex.idSucursal = '$idsucursal' AND tf.idListaPrecio = '2' AND tf.idSucursal='$idsucursal'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $validando = mysql_affected_rows();
        if ($validando >= 0) {
            return $datos;
        } else {
            return 0;
        }
    }

    function consultaInformacionProductosMasivos($codigoProducto, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $total = count($codigoProducto);
        foreach ($codigoProducto as $value) {

            $MySQL = "SELECT p.codigoproducto, producto, tar.tarifa ,ex.cantidad, cost.costo   FROM productos p
               inner join proveedores pr
               on p.idProveedor = pr.idProveedor
               inner join marcas m
               on m.idMarca = p.idMarca
	       inner join costos cost
	       on p.codigoProducto = cost.codigoProducto
               inner join existencias ex
               on p.codigoProducto = ex.codigoProducto
               inner join tarifas  tar
               on p.codigoProducto = tar.codigoProducto
               inner join listaPrecios li
               on tar.idListaPrecio = li.idListaPrecio
               WHERE p.codigoProducto='" . $value . "'and li.nombreListaPrecio='MENUDEO' and tar.idStatus='1' and tar.idSucursal='1' and cost.idSucursal ='1' and cost.status = '1' and ex.idSucursal= '1'";
            $rs = mysql_query($MySQL, $cn->Conectarse());
            while ($resultSet = mysql_fetch_array($rs, MYSQL_ASSOC)) {
                $datos[] = array($resultSet);
            }
        }
        $cn->cerrarBd();
        return $datos;
    }

    function mostrarTiposPagos() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM tipospagos";
        $rs = mysql_query($sql, $cn->Conectarse());
        if ($rs == false) {
            return 1;
        } else {
            return $rs;
        }
    }

    function consultarDatosAbonos($folio, $sucursal) {
        $sql = "SELECT * FROM xmlComprobantes xc "
                . "INNER JOIN clientes cl ON xc.rfcComprobante = cl.rfc "
                . "WHERE folioComprobante = '$folio' AND idSucursal = '$sucursal' AND tipoComprobante = 'CREDITO'";
        $datos = mysql_query($sql);
        if ($datos == false) {
            $datos = 1;
        }
        return $datos;
    }

    function consultarAbonos($folio) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM abonos a "
                . "INNER JOIN tiposPagos t ON a.idTipoPago = t.idTipoPago "
                . "WHERE folioComprobante = '$folio'";
        $datos = mysql_query($sql, $cn->Conectarse());
        if ($datos == false) {
            $datos = 1;
        }
        return $datos;
    }

    function guardarAbono($folio, $sucursal, $fecha, $monto, $tipopago, $referencia, $observ, $liquida, $saldo) {
        //====================== Sacar rfc del cliente =========================
        $sql = "SELECT rfcComprobante FROM xmlComprobantes WHERE idSucursal = '$sucursal' AND folioComprobante = '$folio'";
        $ctrl = mysql_query($sql);
        mysql_query("START TRANSACTION;");
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            while ($rs = mysql_fetch_array($ctrl)) {
                $rfc = $rs["rfcComprobante"];
            }
        }
        //====================== Sacar el id del abono anterior ================
        $sql = "SELECT * FROM abonos WHERE rfcCliente = '$rfc' AND statusSaldo = '1'";
        $ctrl = mysql_query($sql);
        $rows = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($rows != 0) {
                while ($rs = mysql_fetch_array($ctrl)) {
                    $id = $rs["idAbonos"];
                }
                $bandera = 1;
            } else {
                $bandera = 0;
            }
        }
        //====================== Actualizar status abono =======================
        if ($bandera != 0) {
            $sql = "UPDATE abonos SET statusSaldo = '2' WHERE idAbonos = '$id'";
            $ctrl = mysql_query($sql);
            if ($ctrl == false) {
                $ctrl = mysql_error();
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        //====================== Guardando abono ===============================
        $sql = "INSERT INTO abonos (rfcCliente, importe, idTipoPago, referencia, idSucursal, folioComprobante, fechaAbono, observaciones, saldo, statusSaldo) "
                . "VALUES ('$rfc', '$monto', '$tipopago', '$referencia', '$sucursal', '$folio', '$fecha', '$observ', '$saldo', '1')";
        $ctrl = mysql_query($sql);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //====================== Actulizar xmlconceptos ========================
        if ($liquida != "false") {
            $sql = "UPDATE xmlComprobantes SET statusOrden = '7' WHERE folioComprobante = '$folio'";
            $ctrl = mysql_query($sql);
            if ($ctrl == false) {
                $ctrl = mysql_error();
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    function consultarDeudores() {
        $sql = "SELECT c.rfc, c.nombre, x.folioComprobante, c.credito, a.saldo FROM xmlcomprobantes x "
                . "INNER JOIN clientes c ON  c.rfc = x.rfcComprobante "
                . "INNER JOIN abonos a ON a.folioComprobante = x.folioComprobante "
                . "WHERE x.tipoComprobante = 'CREDITO' AND a.statusSaldo = '1' AND x.statusOrden = '5'";
        $datos = mysql_query($sql);
        if ($datos == false) {
            $datos = mysql_error();
            $datos = 0;
        }
        return $datos;
    }

}
