<?php

class dao {

    function eliminandoImagenes($idImagen, $imagen) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $borrarImagenes = "DELETE FROM imagenes WHERE idImagen = '$idImagen'";


        $datos = mysql_query($borrarImagenes, $cn->Conectarse());
        $ruta = "../subidas/";
        $fusion = $ruta . $imagen;
        unlink($fusion);
    }

    function buscarImagenes($cp) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SELECT * FROM imagenes WHERE codigoProducto = '$cp'";
        $datos2 = mysql_query($sql, $cn->Conectarse());
        return $datos2;
    }

    function consultaClasificados() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SELECT * FROM clasificados c INNER JOIN productos p ON c.codigoProducto = p.codigoProducto INNER JOIN imagenes i ON i.codigoProducto = p.codigoProducto INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto inner join tiposproducto tp on c.idTipo = tp.idTiposProducto group by p.codigoProducto";
        $datos2 = mysql_query($sql, $cn->Conectarse());
        return $datos2;
    }

    function obtenerImagenesDisponibles(clasificados $clasificados) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $numeros = array("0", "1", "2", "3", "4");
        $obtenerImagenes = "SELECT * FROM imagenes WHERE codigoProducto = '" . $clasificados->getCodigoProducto() . "'";
        $datos = mysql_query($obtenerImagenes, $cn->Conectarse());
        while ($rs = mysql_fetch_array($datos)) {
            $cadena = $rs["ruta"];
            $cdn = explode('-_-', $cadena);
            $cdn2 = explode('.', $cdn[1]);
            unset($numeros[$cdn2[0]]);
        }
        $numeros = array_values($numeros);
        return $numeros;
    }

    function borrarImagenes($imagenes, clasificados $c) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $total = count($imagenes);
        foreach ($imagenes as $value) {
            $idImagen = $value->idImagen;
            $imagen = $value->imagen;
            $borrarImagenes = "DELETE FROM imagenes WHERE idImagen = '$idImagen'";


            $datos = mysql_query($borrarImagenes, $cn->Conectarse());
            $ruta = "../subidas/";
            $fusion = $ruta . $imagen;
            unlink($fusion);
        }
//        $obtenerImagenes="SELECT * FROM imagenes WHERE $c->codigoProducto";
//          $datos = mysql_query($obtenerImagenes, $cn->Conectarse());
//           
//            return $datos;
//        $cn->cerrarBd();
//        return $datos;
    }

    function edtitarClasificados(clasificados $clasificados, $nombres) {
        include_once '../daoconexion/daoConeccion.php';
        mysql_query("START TRANSACTION;");
        $cn = new coneccion();
//        $numeros = array("0", "1", "2", "3", "4");
//        $obtenerImagenes = "SELECT * FROM imagenes WHERE codigoProducto = '" . $clasificados->getCodigoProducto() . "'";
//        $datos = mysql_query($obtenerImagenes, $cn->Conectarse());
//        while ($rs = mysql_fetch_array($datos)) {
//            $cadena = $rs["ruta"];
//            $cdn = explode('-_-', $cadena);
//            $cdn2 = explode('.', $cdn[1]);
//            unset($numeros[$cdn2[0]]);
//        }
//        $numeros = array_values($numeros);
//      
        $sqlClasificados = "UPDATE clasificados set  idTipo = '" . $clasificados->getIdTipo() . "' ,descripcion = '" . $clasificados->getDescripcion() . "',ponerRecomendado = '" . $clasificados->getPonerRecomendado() . "',ponerNovedades = '" . $clasificados->getPonerNovedades() . "' WHERE codigoProducto = '" . $clasificados->getCodigoProducto() . "'";
        $sqlClasificados = mysql_query($sqlClasificados, $cn->Conectarse());

        if ($sqlClasificados == false) {
            mysql_query("ROLLBACK;");
        } else {
            if (count($nombres) > 0) {
                foreach ($nombres as $value) { // aqui comenzamos la insercion de imagenes
                    $nombre = $value;
                    $sqlImagenes = "INSERT INTO imagenes(ruta,codigoProducto) VALUES('$nombre', '" . $clasificados->getCodigoProducto() . "')";
                    $sqlImagenes = mysql_query($sqlImagenes, $cn->Conectarse());
                    if ($sqlImagenes == false) {
                        mysql_query("ROLLBACK;");
                    } else {
//                        mysql_query("COMMIT;");
                    }
                }
            } else {
                
            }
        } mysql_query("COMMIT;");
    }

    function guardarClasificados(clasificados $clasificados, $nombres) {
        include_once '../daoconexion/daoConeccion.php';

        $cn = new coneccion();
        mysql_query("START TRANSACTION;");
        $sqlClasificados = "INSERT INTO clasificados(codigoProducto,idTipo,descripcion,ponerRecomendado,ponerNovedades)VALUES ('" . $clasificados->getCodigoProducto() . "','" . $clasificados->getIdTipo() . "','" . $clasificados->getDescripcion() . "','" . $clasificados->getPonerRecomendado() . "','" . $clasificados->getPonerNovedades() . "')";
        $sqlClasificados = mysql_query($sqlClasificados, $cn->Conectarse());

        if ($sqlClasificados == false) {
            mysql_query("ROLLBACK;");
        } else {
            foreach ($nombres as $value) {
                $nombre = $value;
                $sqlImagenes = "INSERT INTO imagenes(ruta,codigoProducto) VALUES('$nombre', '" . $clasificados->getCodigoProducto() . "')";
                $sqlImagenes = mysql_query($sqlImagenes, $cn->Conectarse());
                if ($sqlImagenes == false) {
                    mysql_query("ROLLBACK;");
                } else {
                    mysql_query("COMMIT;");
                }
            }
        }


        $cn->cerrarBd();
    }

    function comprobarCodigoValido2($codigo) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE codigoProducto = '$codigo'";

        $datos = mysql_query($sql, $cn->Conectarse());
        $contando = mysql_affected_rows();
        if ($contando > 0) {
            $sql = "SELECT * FROM clasificados c INNER JOIN productos p ON c.codigoProducto = p.codigoProducto INNER JOIN imagenes i ON i.codigoProducto = p.codigoProducto INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto WHERE p.codigoProducto = '$codigo'";
            $datos2 = mysql_query($sql, $cn->Conectarse());
            $contando = mysql_affected_rows();
            if ($contando > 0) {
                return $datos2;
            } else {
                return $datos;
            }
            return $datos2;
        } else {
            return 0;
        }
    }

    function consultarTiposProducto($idGrupo) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM tiposproducto Where idGrupoProducto = '$idGrupo'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function actualizarOrdenCompra($folio, $comprobante, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE xmlcomprobantes set statusOrden = '6' WHERE idXmlComprobante = '$folio' AND tipoCOmprobante='$comprobante' AND idSucursal = '$idSucursal'";
        $sql = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function obtenerDatosCliente($idCliente) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();

        $sql = "SELECT * FROM usuarios u INNER JOIN clientes c ON c.idUsuario = u.idUsuario
                INNER JOIN	direcciones d ON c.idDireccion = c.idDireccion 
                WHERE u.idUsuario = '$idCliente'";
        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function guardarAgentes($idproveedor, $nombre, $telefonos, $emails, $ctrltelefonos, $ctrlemails) {
        $sql = "INSERT INTO agentes (nombre, idProveedor) VALUES ('$nombre','$idproveedor')";
        $sql2 = "SELECT LAST_INSERT_ID() ID;";
        $ctrl = mysql_query($sql);
        mysql_query("START TRANSACTION;");
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrl2 = mysql_query($sql2);
            if ($ctrl2 == false) {
                $ctrl2 = mysql_error();
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrl2)) {
                    $idProveedor = $rs["ID"];
                }
            }
        }
        //Guardando Telefonos
        for ($i = 0; $i < $ctrltelefonos; $i++) {
            $sqlTelefonos = "INSERT INTO telefonos (telefono, idPropietario, tipoPropietario) VALUES ('$telefonos[$i]','$idProveedor','AGENTE')";
            $ctrlTelefonoGuardar = mysql_query($sqlTelefonos);
            if ($ctrlTelefonoGuardar == false) {
                $rs = mysql_error();
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        //Guardar Emails
        for ($i = 0; $i < $ctrlemails; $i++) {
            $sqlEmails = "INSERT INTO emails (email, idPropietario, tipoPropietario) VALUES ('$emails[$i]','$idProveedor','AGENTE')";
            $ctrlEmailsGuardar = mysql_query($sqlEmails);
            if ($ctrlEmailsGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    function consultaOrdenesLista($tipo, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        if ($tipo == "ORDEN COMPRA") {
            $sql = "SELECT * FROM xmlcomprobantes x INNER JOIN sucursales s ON s.idSucursal = x.idSucursal INNER JOIN proveedores p ON x.rfcComprobante  = p.rfc Where x.tipoComprobante = '$tipo' and s.idSucursal = '$idSucursal'";
        } else {
            $sql = "SELECT * FROM xmlcomprobantes x INNER JOIN sucursales s ON s.idSucursal = x.idSucursal Where x.tipoComprobante = '$tipo'";
        }
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

    function obtenerOrdenCompra($folio, $comprobante, $idsucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        if ($comprobante == "PEDIDO CLIENTE") {
            $sql = "SELECT * FROM xmlcomprobantes x 
INNER JOIN xmlconceptos xc ON x.idXmlComprobante = xc.idXmlComprobante 
INNER JOIN productos p ON p.codigoProducto = xc.codigoConcepto 
INNER JOIN clientes c ON c.rfc = x.rfcComprobante
INNER JOIN direcciones d ON d.idDireccion = c.idDireccion
WHERE x.folioComprobante = '$folio' AND x.tipoComprobante = '$comprobante' and idSucursal = '$idsucursal' ";
        } else {
            $sql = "SELECT * FROM xmlcomprobantes x "
                    . "INNER JOIN xmlconceptos xc ON x.idXmlComprobante = xc.idXmlComprobante  "
                    . "INNER JOIN productos p ON p.codigoProducto = xc.codigoConcepto WHERE x.folioComprobante = '$folio' AND tipoComprobante = '$comprobante' AND idSucursal = '$idsucursal' ";
        }

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function mostrarDetallesTransferencias2($sucu, $detalle) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto,p.producto, t.costo, e.cantidad as cantidadTotal, t.cantidad FROM requisiciondetalles t INNER JOIN productos p ON p.codigoProducto = t.codigo INNER JOIN existencias e ON p.codigoProducto = e.codigoProducto WHERE  idEncabezadorequisicion = '$detalle' and e.idSucursal = '$sucu' ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function dondeInicie($idsucursal, $usuario) {
        $sql = "SELECT * FROM sucursales s "
                . "INNER JOIN usuarios u "
                . "WHERE u.usuario = '$usuario' AND s.idSucursal = '$idsucursal'";
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
        $sql = "SELECT t.idEncabezadoRequisicion,st.status as prr,st2.status as plop,st2.idStatus,t.fechaRequisicion,s.sucursal, s.idSucursal,t.estatusRequisicion, t.statusAprobacion FROM requisicionencabezados t INNER JOIN sucursales s ON s.idSucursal = t.idSucursalEmisor INNER JOIN status st ON st.idStatus = t.estatusRequisicion INNER JOIN status st2 ON st2.idStatus = t.statusAprobacion INNER JOIN sucursales s2 ON s2.idSucursal = t.idSucursalReceptor   WHERE idSucursalReceptor = $idSucursal  ";
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

    function mostrarDetallesTransferenciasAceptadas($sucursal, $detalle) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto,p.producto, t.costo, e.cantidad as cantidadTotal, t.cantidad FROM transacciondetalles t INNER JOIN productos p ON p.codigoProducto = t.codigo INNER JOIN existencias e ON p.codigoProducto = e.codigoProducto WHERE  idEncabezadoTransaccion = '$detalle' and e.idSucursal = '$sucursal' ";
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
        $sql = "SELECT * FROM sucursales WHERE idSucursal <> '$sucursal' Order by idSucursal ASC";
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

    function editarProducto(Producto $p, Costo $c, Tarifa $t, $idSucursal, $m3) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sqlCostos = "UPDATE costos set status = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idSucursal= '$idSucursal' ";
        $sqlProductos = "UPDATE productos set producto = '" . $p->getProducto() . "',idMarca= '" . $p->getIdMarca() . "',idProveedor= '" . $p->getIdProveedor() . "',cantidadMaxima= '" . $p->getCantidadMaxima() . "',cantidadMinima= '" . $p->getCantidadMinima() . "',idGrupoProducto= '" . $p->getIdGrupoProducto() . "',idUnidadMedida= '" . $p->getIdUnidadMedida() . "',idStatus='1', metrosCubicos = '$m3' WHERE codigoProducto = '" . $p->getCodigoProducto() . "'";
        $fecha = date("d/m/Y");
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
        $sql = "SELECT p.codigoProducto, p.codigoBarrasProducto, p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.codigoBarrasProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida, p.metrosCubicos \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto "
                . "WHERE c.status=1  and c.idSucursal = '$sucursal' and e.idSucursal = '$sucursal' and p.codigoProducto = '$codigo'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $row = mysql_affected_rows();
        if ($row < 1) {
            $sql2 = "SELECT p.codigoProducto, p.codigoBarrasProducto, p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.codigoBarrasProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida, p.metrosCubicos \n"
                    . "FROM productos p\n"
                    . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                    . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                    . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                    . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                    . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto "
                    . "WHERE c.status=1  and c.idSucursal = '$sucursal' and e.idSucursal = '$sucursal' and p.codigoBarrasProducto = '$codigo'";
            $datos2 = mysql_query($sql2, $cn->Conectarse());
            if ($datos2 == false) {
                $datos2 = mysql_error();
                $rs = 0;
            } else {
                $rs = $datos2;
            }
        } else {
            if ($datos == false) {
                $datos = mysql_error();
                $rs = 0;
            } else {
                $rs = $datos;
            }
        }
        return $rs;
    }

    function consultandoProductoPorCodigoBarras($codigo, $sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.codigoBarrasProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida, e.cantidad, p.metrosCubicos \n"
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

    function comprobarCodigoValido($codigob) {

        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE codigoProducto = '$codigob'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $valor = mysql_affected_rows();
        if ($valor > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function comprobarCodigoBValido($codigoBarras) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM productos WHERE codigoBarrasProducto = '$codigoBarras'";
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
        if ($validacion < 1) {
            $sql2 = "SELECT l.nombreListaPrecio, c.costo, t.porcentaUtilidad, l.idListaPrecio, t.tarifa FROM tarifas t inner join listaprecios l on t.idListaPrecio = l.idListaPrecio inner join costos c on c.codigoProducto = t.codigoProducto inner join productos p on p.codigoProducto = t.codigoProducto WHERE p.codigoBarrasProducto  = '$codigoProducto' AND c.status='1' AND t.idStatus =  '1' AND c.idSucursal =  '$sucursal' AND t.idSucursal = '$sucursal'";
            $datos2 = mysql_query($sql2, $cn->Conectarse());
            $validacion2 = mysql_affected_rows();
            if ($validacion2 < 1) {
                $rs = 0;
            } else {
                $rs = $datos2;
            }
        } else {
            $rs = $datos;
        }
        return $rs;
    }

    function guardarTipo(GrupoProductos $g) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();

        $sqlvalidar = "SELECT * FROM tiposproducto WHERE TiposProducto = '" . $g->getGrupoProducto() . "' AND idGrupoProducto = '" . $g->getIdGrupoProducto() . "'";
        $ctrlvalidar = mysql_query($sqlvalidar);
        $rowsvalidar = mysql_affected_rows();
        if ($ctrlvalidar == false) {
            $ctrlvalidar = mysql_error();
        } else {
            if ($rowsvalidar > 0) {
                return 999;
                $cn->cerrarBd();
            } else {
                $sql = "INSERT INTO tiposproducto(TiposProducto,idGrupoProducto)VALUES ('" . $g->getGrupoProducto() . "','" . $g->getIdGrupoProducto() . "')";
                $resultado = mysql_query($sql);
                if ($resultado == false) {
                    $resultado = mysql_error();
                } else {
                    return 0;
                    $cn->cerrarBd();
                }
            }
        }
    }

    function guardarGrupo(GrupoProductos $g) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();

        $sqlvalidar = "SELECT * FROM grupoproductos WHERE grupoProducto = '" . $g->getGrupoProducto() . "' ";
        $ctrlvalidar = mysql_query($sqlvalidar);
        $rowsvalidar = mysql_affected_rows();
        if ($ctrlvalidar == false) {
            $ctrlvalidar = mysql_error();
        } else {
            if ($rowsvalidar > 0) {
                return 999;
                $cn->cerrarBd();
            } else {
                $sql = "INSERT INTO grupoproductos(grupoProducto)VALUES ('" . $g->getGrupoProducto() . "')";
                $resultado = mysql_query($sql);
                if ($resultado == false) {
                    $resultado = mysql_error();
                } else {
                    return 0;
                    $cn->cerrarBd();
                }
            }
        }
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

        $fecha = date("d/m/Y");
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

    function consultaExistenciasgral($cp, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM existencias  WHERE codigoProducto = '$cp' and idSucursal <> '$idSucursal' Order by idSucursal ASC";
        $resultado = mysql_query($sql, $cn->Conectarse());


        return $resultado;
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

    function guardarProducto(Producto $p, Costo $c, Tarifa $t, $idSucursal, $m3) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cont = 0;

        mysql_query("START TRANSACTION;");

        $sucursales = "SELECT * FROM sucursales WHERE idSucursal <> '$idSucursal'";
        $sucursales = mysql_query($sucursales, $cn->Conectarse());
        while ($rs = mysql_fetch_assoc($sucursales)) {
            $sucursal = $rs["idSucursal"];
            $sqlexistencias = "INSERT INTO existencias(cantidad,codigoProducto,idSucursal)VALUES('0','" . $p->getCodigoProducto() . "','$sucursal')";
            $fecha = date("d/m/Y");
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
            $sql = "INSERT INTO productos(producto, idMarca, idProveedor, codigoBarrasProducto, codigoProducto,cantidadMaxima, cantidadMinima,idGrupoProducto, idUnidadMedida,idStatus, metrosCubicos)VALUES('" . addslashes($p->getProducto()) . "','" . $p->getIdMarca() . "','" . $p->getIdProveedor() . "', '" . $p->getCbarras() . "' , '" . $p->getCodigoProducto() . "', '" . $p->getCantidadMaxima() . "', '" . $p->getCantidadMinima() . "', '" . $p->getIdGrupoProducto() . "', '" . $p->getIdUnidadMedida() . "','1', '$m3')";
            $resultado = mysql_query($sql, $cn->Conectarse());
            if ($resultado == false) {
                mysql_query("ROLLBACK;");
            } else {
                $id = mysql_insert_id();
                $fecha = date("d/m/Y");
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
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.codigoBarrasProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto, e.idSucursal \n"
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
        $sql = "SELECT * FROM proveedores order by nombre  ASC ";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function consultarMarcas() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM marcas order by marca ASC ";

        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function mostrarClientes() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM clientes order by nombre ASC ";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function guardarMarca(Marca $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        $sqlvalidar = "SELECT * FROM marcas WHERE marca = '" . $t->getMarca() . "' ";
        $ctrlvalidar = mysql_query($sqlvalidar);
        $rowsvalidar = mysql_affected_rows();
        if ($ctrlvalidar == false) {
            $ctrlvalidar = mysql_error();
        } else {
            if ($rowsvalidar > 0) {
                return 999;
                $cn->cerrarBd();
            } else {
                $sql = "INSERT INTO marcas(marca,idStatus)VALUES ('" . $t->getMarca() . "','1')";
                mysql_query($sql);
                $cn->cerrarBd();
                return true;
            }
        }
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
        $cn->Conectarse();

        $sqlvalidar = "SELECT * FROM listaprecios WHERE nombreListaPrecio = '" . $t->getNombreListaPrecio() . "' ";
        $ctrlvalidar = mysql_query($sqlvalidar);
        $rowsvalidar = mysql_affected_rows();
        if ($ctrlvalidar == false) {
            $ctrlvalidar = mysql_error();
        } else {
            if ($rowsvalidar > 0) {
                return 999;
            } else {
                $sql = "INSERT INTO listaprecios (nombreListaPrecio,idStatus) VALUES ('" . $t->getNombreListaPrecio() . "','1')";
                $vl = mysql_query($sql);
                if ($vl === false) {
                    $control = 0;
                } else {
                    $control = 1;
                }
                $cn->cerrarBd();
                return $control;
            }
        }
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
               inner join listaprecios li
               on tar.idListaPrecio = li.idListaPrecio
               WHERE p.codigoProducto='" . $p->getCodigoProducto() . "'and li.nombreListaPrecio='MENUDEO' and tar.idStatus='1' and tar.idSucursal='$idSucursal' and cost.idSucursal ='$idSucursal' and cost.status = '1' and ex.idSucursal= '$idSucursal'";
        $rs = mysql_query($MySQL, $cn->Conectarse());
        $cn->cerrarBd();
        return $rs;
    }

    function buscarProductoVentas(Codigo $c, $idSucursal) {
        $MySQL = "SELECT p.codigoproducto, producto, costo, cantidad   FROM productos p
                  inner join proveedores pr
                  on p.idProveedor = pr.idProveedor
                  inner join marcas m
                  on m.idMarca = p.idMarca
	          inner join costos cost
	          on p.codigoProducto = cost.codigoProducto
                  inner join existencias exi
                  on exi.codigoProducto = p.codigoProducto
                  WHERE p.codigoProducto='" . $c->getCodigo() . "'"
                . " and  cost.idSucursal  = '" . $idSucursal . "' "
                . " and cost.status = 1"
                . " and cost.codigoProducto= '" . $c->getCodigo() . "'"
//
                . " and exi.cantidad > 0"
                . " and exi.idSucursal = '$idSucursal'";
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

    function superMegaGuardadorOrdenes($lafecha, Encabezado $encabezado, $arrayDetalleEntrada, Comprobante $comprobante, $conceptos, $control, $idSucursal, $tipo, $usuario, $evento) {
        $detalle = new Detalle();
        //======================================================================
        //Empieza guardar encabezado
        if ($usuario == "envia") {
            $estatus = 6;
        } else {
            $estatus = 5;
        }

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
        if ($tipo == "PEDIDO CLIENTE") {
            $sqlfolios = "SELECT max(folioPedidoCliente) as foliomayor FROM folios WHERE idSucursal = '$idSucursal' group by folioPedidoCliente";
            $sqlfolios = mysql_query($sqlfolios);
        } else {
            $sqlfolios = "SELECT max(folioOrdenCompra) as foliomayor FROM folios WHERE idSucursal = '$idSucursal' group by folioOrdenCompra";
            $sqlfolios = mysql_query($sqlfolios);
        }
        if ($sqlfolios == false) {
            $sqlfolios = mysql_error();
        }
//        Modificar esta parte y adapatarlo correctamente
        else {
            $ok = false;
            while ($rs = mysql_fetch_array($sqlfolios)) {
                $ok = true;
                $sqlfolios = $rs["foliomayor"];
            }
            if (ok == false) {
                $sqlfolios = "No hay Folio";
            }

            if ($tipo !== "PEDIDO CLIENTE" && $tipo !== "ORDEN COMPRA") {
                $sqlComprobanteGuardar = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento, idSucursal)"
                        . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $comprobante->getSda() . "','" . $encabezado->getRfc() . "','" . $comprobante->getDescuentoFactura() . "','" . $comprobante->getDescuentoProntoPago() . "','" . $comprobante->getDescuentoGeneral() . "','" . $comprobante->getDescuentoPorProducto() . "','" . $comprobante->getDescuentoTotal() . "','" . $comprobante->getConIva() . "','" . $comprobante->getTotal() . "','" . $comprobante->getFolio() . "','$tipo','$lafecha','$idSucursal')";
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
                            $sqlinsertarfolio = "UPDATE folios SET folioPedidoCliente= folioPedidoCliente + 1 WHERE idSucursal = '$idSucursal'";
                            $sqlinsertarfolio = mysql_query($sqlinsertarfolio);
                            if ($sqlinsertarfolio == false) {
                                mysql_query("ROLLBACK;");
                                return false;
                            } else {
                                
                            }
                        }
                    }
                }
            } else {
                $sqlComprobanteGuardar = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento, idSucursal, statusOrden)"
                        . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $comprobante->getSda() . "','" . $encabezado->getRfc() . "','" . $comprobante->getDescuentoFactura() . "','" . $comprobante->getDescuentoProntoPago() . "','" . $comprobante->getDescuentoGeneral() . "','" . $comprobante->getDescuentoPorProducto() . "','" . $comprobante->getDescuentoTotal() . "','" . $comprobante->getConIva() . "','" . $comprobante->getTotal() . "','" . $sqlfolios . "','$tipo','$lafecha','$idSucursal','$estatus')";
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
                            if ($tipo == "PEDIDO CLIENTE") {
                                $sqlinsertarfolio = "UPDATE folios SET folioPedidoCliente= folioPedidoCliente + 1 WHERE idSucursal = '$idSucursal'";
                                $sqlinsertarfolio = mysql_query($sqlinsertarfolio);
                                if ($sqlinsertarfolio == false) {
                                    mysql_query("ROLLBACK;");
                                    return false;
                                } else {
                                    
                                }
                            } else {
                                $sqlinsertarfolio = "UPDATE folios SET folioOrdenCompra= folioOrdenCompra + 1 WHERE idSucursal = '$idSucursal'";
                                $sqlinsertarfolio = mysql_query($sqlinsertarfolio);
                                if ($sqlinsertarfolio == false) {
                                    mysql_query("ROLLBACK;");
                                    return false;
                                } else {
                                    
                                }
                            }
                        }
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
                if ($tipo !== "PEDIDO CLIENTE" && $tipo !== "ORDEN COMPRA") {
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
                if ($tipo !== "PEDIDO CLIENTE" && $tipo !== "ORDEN COMPRA") {
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
        }
        return $sqlfolios;
    }

    function superMegaGuardadorEntradas($lafecha, Encabezado $encabezado, $arrayDetalleEntrada, Comprobante $comprobante, $conceptos, $control, $idSucursal) {
        $detalle = new Detalle();
        //======================================================================
        //Empieza guardar encabezado
        $sqlEncabezadoGuardar = "INSERT INTO facturaencabezados (fechaEncabezado, subtotalEncabezado, totalEncabezado, rfcEncabezado, folioEncabezado, fechaMovimiento, idTipoMovimiento, idSucursal)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $encabezado->getTotal() . "','" . $encabezado->getRfc() . "','" . $encabezado->getFolio() . "','$lafecha','1','$idSucursal')";
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
        $sqlComprobanteGuardar = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento, idSucursal)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $comprobante->getSda() . "','" . $encabezado->getRfc() . "','" . $comprobante->getDescuentoFactura() . "','" . $comprobante->getDescuentoProntoPago() . "','" . $comprobante->getDescuentoGeneral() . "','" . $comprobante->getDescuentoPorProducto() . "','" . $comprobante->getDescuentoTotal() . "','" . $comprobante->getConIva() . "','" . $comprobante->getTotal() . "','" . $encabezado->getFolio() . "','XML','$lafecha','$idSucursal')"; //Forzado TIPO
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
                    . " WHERE codigoProducto = '$cpto->codigo' AND idSucursal = '$idSucursal'";
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
            //Comienza guardar xml concepto
            $importe = 0;
            $codigo = 0;
            $cda = 0;
            $desctuno = 0;
            $desctdos = 0;

            if (isset($cpto->importe)) {
                $importe = $cpto->importe;
            }
            if (isset($cpto->codigo)) {
                $codigo = $cpto->codigo;
            }
            if (isset($cpto->cda)) {
                $cda = $cpto->cda;
            }
            if (isset($cpto->desctuno)) {
                $desctuno = $cpto->desctuno;
            }
            if (isset($cpto->desctdos)) {
                $desctdos = $cpto->desctdos;
            }
            $sqlConceptoGuardar = "INSERT INTO xmlconceptos (unidadMedidaConcepto, importeConcepto, cantidadConcepto, codigoConcepto, descripcionConcepto, precioUnitarioConcepto, idXmlComprobante, cdaConcepto, desctUnoConcepto, desctDosConcepto)"
                    . " VALUES ('" . $detalle->getUnidadmedida() . "','$importe','" . $detalle->getCantidad() . "','$codigo','" . $detalle->getDescripcion() . "','" . $detalle->getCosto() . "','$idComprobante','$cda','$desctuno','$desctdos')";
            $ctrlConceptoGuardar = mysql_query($sqlConceptoGuardar);
            if ($ctrlConceptoGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //Terminar guardar xml concepto
            //==================================================================
            //Comienza actulizar costo
            $sqlTraerCosto = "SELECT costo, idCosto FROM costos "
                    . " WHERE codigoProducto = '$cpto->codigo' AND status = '1' AND idSucursal = '$idSucursal'";
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

                $totalViejo = $cantidad * $costoViejo;
                $totalNuevo = $cpto->cda * $detalle->getCantidad();

                $totalFinal = $totalViejo + $totalNuevo;
                $cantidadFinal = $cantidad + $detalle->getCantidad();

                $costoPromedio = $totalFinal / $cantidadFinal;

                $sqlInsertaNuevoCosto = "INSERT INTO costos (costo, codigoProducto, fechaMovimiento, status,idSucursal)"
                        . " VALUES ('$costoPromedio','$cpto->codigo','$lafecha','1','$idSucursal')";
                $sqlActulizarViejoCosto = "UPDATE costos SET status = '2'"
                        . " WHERE codigoProducto = '$cpto->codigo' AND idCosto = '$idDondeSalioCosto' AND idSucursal = '$idSucursal'";
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
                    . " WHERE codigoProducto = '$cpto->codigo' AND idSucursal = '$idSucursal' ";
            $ctrlActulizaExistencia = mysql_query($sqlActulizaExistencia);
            if ($ctrlActulizaExistencia == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //Terminar Actulizar existencia
            //==================================================================
            //Comienza guardar entrada
            $sqlEntradasGuardar = "INSERT INTO entradas (usuario, cantidad, fecha, codigoProducto, idSucursal) "
                    . " VALUES ('Joel','" . $detalle->getCantidad() . "','$lafecha','$cpto->codigo','$idSucursal')"; //Forzado usuaro e idSucursal
            $ctrlEntradasGuardar = mysql_query($sqlEntradasGuardar);
            if ($ctrlEntradasGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //Terminar guardar entrada
        }//Cierre FOR
        mysql_query("COMMIT;");
        return true;
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
        $sqlvalidar = "SELECT * FROM proveedores WHERE rfc = '" . $proveedor->getRfc() . "' ";
        $ctrlvalidar = mysql_query($sqlvalidar);
        $rowsvalidar = mysql_affected_rows();
        if ($ctrlvalidar == false) {
            $ctrlvalidar = mysql_error();
        } else {
            if ($rowsvalidar > 0) {
                return 999;
            } else {
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
        }
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
    function superGuardadorClientes(Proveedor $proveedor, Direccion $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails, Usuario $usuario, $idsucursal) {
        $sqlvalidar = "SELECT * FROM clientes WHERE rfc = '" . $proveedor->getRfc() . "' ";
        $ctrlvalidar = mysql_query($sqlvalidar);
        $rowsvalidar = mysql_affected_rows();
        if ($ctrlvalidar == false) {
            $ctrlvalidar = mysql_error();
        } else {
            if ($rowsvalidar > 0) {
                return 999;
            } else {
                $sqlUsuario = "INSERT INTO usuarios (usuario, nombre, apellidoPaterno, apellidoMaterno, password, idtipousuario, idSucursal)"
                        . "VALUES ('" . $usuario->getUsuario() . "','" . $usuario->getNombre() . "','" . $usuario->getPaterno() . "','" . $usuario->getMaterno() . "','" . $usuario->getPass() . "','" . $usuario->getTipousuario() . "','$idsucursal')";
                $sqlUsuarioId = "SELECT LAST_INSERT_ID() ID;";
                //Guardando la direccion
                $sqlDireccion = "INSERT INTO direcciones (calle, numeroExterior, numeroInterior, cruzamientos, postal, colonia, ciudad, estado) VALUES ('" . $direccion->getCalle() . "','" . $direccion->getNumeroexterior() . "','" . $direccion->getNumerointerior() . "','" . $direccion->getCruzamientos() . "','" . $direccion->getPostal() . "','" . $direccion->getColonia() . "','" . $direccion->getCiudad() . "','" . $direccion->getEstado() . "')";
                $sqlDireccionId = "SELECT LAST_INSERT_ID() ID;";
                mysql_query("START TRANSACTION;");


                $sqlchkuser = "SELECT * FROM usuarios WHERE usuario = '" . $usuario->getUsuario() . "' AND idtipousuario = '" . $usuario->getTipousuario() . "' AND idSucursal = '$idsucursal'";
                $ctrlchkuser = mysql_query($sqlchkuser);
                $rowschkuser = mysql_affected_rows();
                if ($ctrlchkuser == false) {
                    $ctrlchkuser = mysql_error();
                } else {
                    if ($rowschkuser > 0) {
                        return 777;
                    }
                }
                $rs = mysql_query($sqlUsuario);
                if ($rs == false) {
                    mysql_query("ROLLBACK;");
                    return false;
                } else {
                    $idUsuario = mysql_query($sqlUsuarioId);
                    while ($rs = mysql_fetch_array($idUsuario)) {
                        $idUsuario = $rs["ID"];
                    }
                    if ($idUsuario == false) {
                        mysql_query("ROLLBACK;");
                        return false;
                    } else {
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
                    }
                }
                //Guardando Proveedor
                $sqlProveedor = "INSERT INTO clientes (nombre, idDireccion, rfc, diasCredito, descuentoPorFactura, descuentoPorProntoPago, tipoCliente, idStatus, credito,idUsuario) VALUES ('" . $proveedor->getNombre() . "','$idDireccion','" . $proveedor->getRfc() . "','" . $proveedor->getDiasCredito() . "','" . $proveedor->getDesctfactura() . "','" . $proveedor->getDesctprontopago() . "','" . $proveedor->getTipoProveedor() . "','1','" . $proveedor->getCredito() . "','" . $idUsuario . "')";
                $sqlProveedorId = "SELECT LAST_INSERT_ID() ID;";
                $ctrlProveedoGuardar = mysql_query($sqlProveedor);
                if ($ctrlProveedoGuardar == false) {
                    $ctrlProveedoGuardar = mysql_error();
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
        }
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

    function obtenerDatosAgranel($codigo, $codigopapa, $sucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT gr.cantidad, c.costo FROM agranel gr "
                . "INNER JOIN costos c ON c.codigoProducto = '$codigopapa' "
                . "WHERE gr.codigoAgranel = '$codigo' AND c.idSucursal = '$sucursal' AND c.status = '1'";
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
        $fecha = date("d/m/Y");
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
        $sql = "select lp.idListaPrecio, nombreListaPrecio, porcentaUtilidad from tarifas  t
                inner join listaprecios lp
                on lp.idListaPrecio  = t.idListaPrecio
                where codigoProducto = '" . $c->getCodigo() . "' 
                and t.idStatus='1'
		and t.idSucursal='" . $idSucursal . "';";
        $datos = mysql_query($sql);
//        if ($datos == false) {
//            $datos = mysql_error();
//        }
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
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto WHERE p.idStatus = '1' AND ex.idSucursal = '$idsucursal' AND tf.idListaPrecio = '1' AND tf.idSucursal='$idsucursal' AND tf.idStatus = '1'";
        $datos = mysql_query($sql, $cn->Conectarse());
//        $validando = mysql_affected_rows();
//        if ($validando >= 0) {
//            return $datos;
//        } else {
//            return 0;
//        }

        return $datos;
    }

    function consultaBuscadorPorProveedor($idsucursal, $proveedor) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.codigoProducto, p.producto, m.marca, pr.nombre   AS proveedor, g.grupoProducto, ex.cantidad AS existencia, tf.tarifa AS menudeo\n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN existencias ex ON ex.codigoProducto =  p.codigoProducto\n"
                . "INNER JOIN tarifas tf ON tf.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = p.idGrupoProducto WHERE p.idStatus = '1' AND ex.idSucursal = '$idsucursal' AND tf.idListaPrecio = '2' AND tf.idSucursal='$idsucursal' AND tf.idStatus = '1' and pr.rfc='$proveedor'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $validando = mysql_affected_rows();
        if ($validando >= 0) {
            return $datos;
        } else {
            return 0;
        }
    }

//<<<<<<< HEAD
    function dameClientes() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT rfc, nombre from clientes WHERE rfc != '0'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function dameFolio($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT MAX(folioVenta) folio from folios WHERE idSucursal = '$idSucursal'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameFolioOrdenCompra($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT MAX(folioOrdenCompra) folio from folios WHERE idSucursal = '$idSucursal'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function consultaInformacionProductosMasivos($codigoProducto, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $total = count($codigoProducto);
        foreach ($codigoProducto as $value) {

            $MySQL = "SELECT p.codigoproducto, producto, tar.tarifa ,ex.cantidad, cost.costo, p.cantidadMaxima  FROM productos p
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
               inner join listaprecios li
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
        $sql = "SELECT * FROM xmlcomprobantes xc "
                . "INNER JOIN clientes cl ON xc.rfcComprobante = cl.rfc "
                . "WHERE folioComprobante = '$folio' AND idSucursal = '$sucursal'";
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
                . "INNER JOIN tipospagos t ON a.idTipoPago = t.idTipoPago "
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

    function consultarDeudores($sucursal) {
        $sql = "SELECT c.rfc, c.nombre, x.folioComprobante, c.credito, x.totalComprobante, a.saldo FROM xmlcomprobantes x "
                . "INNER JOIN clientes c ON  c.rfc = x.rfcComprobante "
                . "INNER JOIN abonos a ON a.folioComprobante = x.folioComprobante "
                . "WHERE a.statusSaldo = '1' AND x.idTipoPago = '2' AND a.idSucursal = '$sucursal'";
        $datos = mysql_query($sql);
        if ($datos == false) {
            $datos = mysql_error();
            $datos = 0;
        }
        return $datos;
    }

    function verificarCredito($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT credito FROM clientes WHERE rfc ='" . $rfc . "'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function dameTiposPagos() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select * from tipospagos";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function dameInformacionCliente($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select * from tipospagos";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function guardarventas($encabezado, $detalle, $idSucursal, $usuario, $idStatusOrden, $folio, $abonos) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        mysql_query("START TRANSACTION;");
        $error = "";
        $nuevoFolio = $folio + 1;
        $sqlEncabezadoId = "SELECT LAST_INSERT_ID() ID;";
        $subtotal = $encabezado[0]->subTotalComprobante;
        $nombre = $encabezado[0]->nombreCliente;
        if ($nombre == "1") {
            $sqlDameNombreCliente = "SELECT nombre FROM clientes where rfc ='" . $encabezado[0]->rfcComprobante . "'";
            $datosClientes = mysql_query($sqlDameNombreCliente);
            if ($datosClientes == false) {
                $error = mysql_error();
                return false;
            } else {
                $nombreCliente = "";
                while ($rsNombreCliente = mysql_fetch_array($datosClientes)) {
                    $nombre = $rsNombreCliente["nombre"];
                }
            }
        }

        $idXmlComprobante = 0;
        $sqlComprobanteGuardar = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento, idSucursal,statusOrden,idTipoPago, nombreCliente)"
                . " VALUES ('" . date("d/m/Y") . "','" . $encabezado[0]->subTotalComprobante . "','" . $encabezado[0]->sdaComprobante . "','" . $encabezado[0]->rfcComprobante . "', "
                . "'0','0','0','0','" . $encabezado[0]->descuentoTotalComprobante . "','" . $encabezado[0]->ivaComprobante . "','" . $encabezado[0]->totalComprobante . "','" . $folio . "','Ventas','" . date("d/m/Y") . "','$idSucursal', '$idStatusOrden','" . $encabezado[0]->tipoComprobante . "', '" . $nombre . "')";
        $datos = mysql_query($sqlComprobanteGuardar);
        $idXmlComprobante = 0;
        if ($datos == false) {
            $error = mysql_error();
            mysql_query("ROLLBACK;");
        } else {
            $sqlEncabezadoXmlComprobante = "SELECT LAST_INSERT_ID() IDXML;";
            $idXmlComp = mysql_query($sqlEncabezadoXmlComprobante);
            if ($idXmlComp == false) {
                $error = mysql_error();
                mysql_query("ROLLBACK;");
            } else {
                while ($rsX = mysql_fetch_array($idXmlComp)) {
                    $idXmlComprobante = $rsX["IDXML"];
                }
                $sqlInsertarUsuarioVenta = "INSERT INTO ventasUsuario (idXmlComprobante, usuario) VALUES ('" . $idXmlComprobante . "', '" . $usuario . "')";
                $insertarusuarioVenta = mysql_query($sqlInsertarUsuarioVenta);
                if ($insertarusuarioVenta == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                    return false;
                }
            }
        }
//        $rs = mysql_query($sqlEncabezadoId);
//        if ($rs == false) {
//            $error = mysql_error();
//            mysql_query("ROLLBACK;");
//        } else {
//            while ($row = mysql_fetch_array($rs)) {
//                $idXmlComprobante = $row["ID"];
//            }
//        }
        for ($x = 0; $x < count($detalle); $x++) {
            $sqlConceptoGuardar = "INSERT INTO xmlconceptos (unidadMedidaConcepto, importeConcepto, cantidadConcepto, codigoConcepto, descripcionConcepto, precioUnitarioConcepto, idXmlComprobante, cdaConcepto, desctUnoConcepto, desctDosConcepto,costoCotizacion,idListaPrecio)"
                    . " VALUES ('" . $detalle[$x]->unidadMedidaConcepto . "', '" . $detalle[$x]->importeConcepto . "','" . $detalle[$x]->cantidadConcepto . "','" . $detalle[$x]->codigoConcepto . "','" . $detalle[$x]->descripcionConcepto . "','" . $detalle[$x]->precioUnitarioConcepto . "', '$idXmlComprobante', '" . $detalle[$x]->cdaConcepto . "', '" . $detalle[$x]->desctUnoConcepto . "','0','" . $detalle[$x]->costoCotizacion . "','" . $detalle[$x]->idListaPrecio . "')";
            $datos = mysql_query($sqlConceptoGuardar);
            if ($datos == false) {
                $error = mysql_error();
                mysql_query("ROLLBACK;");
                break;
            } else {
                $sqlTraerExistencia = "SELECT cantidad  FROM existencias WHERE idSucursal = '$idSucursal' and codigoProducto = '" . $detalle[$x]->codigoConcepto . "'";
                $sqlTraerTotalExistenciaTemporal = "SELECT sum(cantidad) cantidad FROM existenciastemporales  WHERE codigo = '" . $detalle[$x]->codigoConcepto . "' and idSucursal = '$idSucursal';";
                $dat = mysql_query($sqlTraerExistencia);
                if ($dat == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                    break;
                } else {
                    while ($rs = mysql_fetch_array($dat)) {
                        $nuevaExistencia = 0;
                        $cantidadPedida = 0;
                        $cantidadPedida = $detalle[$x]->cantidadConcepto;
                        $existencia = $rs[0];
                        $long = $detalle[$x]->codigoConcepto;
                        $cadena = substr($detalle[$x]->codigoConcepto, strlen($long) - 3, 3);
                        $ok = false;
                        $existenciaTemporal = mysql_query($sqlTraerTotalExistenciaTemporal);
                        if ($existenciaTemporal == false) {
                            $error = "2," . $detalle[$x]->codigoConcepto;
                            mysql_query("ROLLBACK;");
                            break;
                        } else {
                            $datosTmp = false;
                            while ($rsTemporal = mysql_fetch_array($existenciaTemporal)) {
                                $datosTmp = true;
                                $cantidadTmp = $rsTemporal["cantidad"];
                            }
                            if ($datosTmp == false) {
                                $cantidadTmp = 0;
                            }
                        }
                        if ($cadena == "-GR") {
                            $cantidad = $rs[0] * 1;
                            $cantidadTmp = $cantidadTmp * 1;
                            $cantidadPedida = $cantidadPedida * 1;
                            $ok = true;
                        }
                        if ($ok == false) {
                            $nuevaExistencia = $existencia - $cantidadTmp;
                            $nuevaExistencia = $nuevaExistencia - $cantidadPedida;
                        }
                        if ($ok == true) {
                            $nuevaExistencia = $cantidad - $cantidadTmp;
                            $nuevaExistencia = $nuevaExistencia / 1;
                        }
                        if ($nuevaExistencia < 0) {
                            $error = "2," . $detalle[$x]->codigoConcepto;
                            mysql_query("ROLLBACK;");
                            break;
                        } else {
                            $sqlInsertarTablaTemporal = "INSERT INTO existenciastemporales (codigo, folioPedido, cantidad, idSucursal) VALUES('" . $long . "','" . $folio . "','" . $cantidadPedida . "','" . $idSucursal . "')";
                            $datosT = mysql_query($sqlInsertarTablaTemporal);
                            if ($datosT == false) {
                                $error = mysql_error();
                                mysql_query("ROLLBACK;");
                                break;
                            }
                        }
                    }
                }
            }
            if ($error != "") {
                break;
            }
        }
        if ($error == "") {
            $sqlActualizarFolio = "UPDATE folios set folioOrdenCompra = '$nuevoFolio' WHERE idSucursal = '$idSucursal' ";
            $da = mysql_query($sqlActualizarFolio);
            if ($da == false) {
                $error = mysql_error();
                mysql_query("ROLLBACK;");
            } else {
                mysql_query("COMMIT;");
            }
        }
        $cn->cerrarBd();
        return $error;
    }

    //================= Consultar folio para cancelacion =======================
    function dameInfoCancelacionVenta($foliocancelacion, $idsucursal) {
        $sql = "SELECT * FROM xmlcomprobantes xcm "
                . "INNER JOIN xmlconceptos xcp ON xcm.idXmlComprobante = xcp.idXmlComprobante "
                . "WHERE xcm.folioComprobante = '$foliocancelacion' AND xcm.idSucursal = '$idsucursal' AND xcm.statusOrden = '7'";
        $controlsql = mysql_query($sql);
        $row = mysql_affected_rows();
        if ($controlsql == false) {
            $controlsql = mysql_error();
            return false;
        } else {
            if ($row < 1) {
                return false;
            } else {
                return $controlsql;
            }
        }
    }

    function dameInfoCancelacionCredito($foliocancelacion, $idsucursal) {
        $sql = "SELECT * FROM xmlcomprobantes xcm "
                . "INNER JOIN xmlconceptos xcp ON xcm.idXmlComprobante = xcp.idXmlComprobante "
                . "WHERE xcm.folioComprobante = '$foliocancelacion' AND xcm.idSucursal = '$idsucursal' AND  xcm.statusOrden='8'";
        $controlsql = mysql_query($sql);
        $row = mysql_affected_rows();
        if ($controlsql == false) {
            $controlsql = mysql_error();
            return false;
        } else {
            if ($row < 1) {
                return false;
            } else {
                return $controlsql;
            }
        }
    }

    //================= Efectuar cancelacion ===================================
    function efectuarCancelacion($folio, $sucursal, $observ, $usuario) {
        //============= Sacar los productos de la venta ========================
        $sql = "SELECT xcp.cantidadConcepto, xcp.codigoConcepto FROM xmlconceptos xcp "
                . "INNER JOIN xmlcomprobantes xcm ON xcm.idXmlComprobante = xcp.idXmlComprobante "
                . "WHERE xcm.folioComprobante = '$folio' AND xcm.idSucursal = '$sucursal'";
        mysql_query("START TRANSACTION;");
        $ctrl = mysql_query($sql);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($row < 1) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($rs = mysql_fetch_array($ctrl)) {
                    //= Sacar existencia actual ================================
                    $sqlextactual = "SELECT cantidad FROM existencias WHERE codigoProducto = '" . $rs[1] . "' AND idSucursal = '$sucursal'";
                    $ctrlextactual = mysql_query($sqlextactual);
                    $rowextactual = mysql_affected_rows();
                    if ($ctrlextactual == false) {
                        $ctrlextactual = mysql_error();
                        mysql_query("ROLLBACK;");
                        return false;
                    } else {
                        if ($rowextactual < 1) {
                            mysql_query("ROLLBACK;");
                            return false;
                        } else {
                            while ($ext = mysql_fetch_array($ctrlextactual)) {
                                $extactual = $ext["cantidad"];
                            }
                        }
                    }
                    //= Sumar las dos existencias ==============================
                    $extnueva = $extactual + $rs["cantidadConcepto"];
                    //Actualizar existencias ===================================
                    $sqlexistencia = "UPDATE existencias SET cantidad = '$extnueva' "
                            . "WHERE codigoProducto = '" . $rs[1] . "' AND idSucursal = '$sucursal'";
                    $ctrlexistencia = mysql_query($sqlexistencia);
                    if ($ctrlexistencia == false) {
                        $ctrlexistencia = mysql_error();
                        mysql_query("ROLLBACK;");
                        return false;
                    }
                }
            }
        }
        //================= Cambiar status comprobante =========================
        $sqlstatus = "UPDATE xmlcomprobantes SET statusOrden = '3' WHERE folioComprobante = '$folio'";
        $ctrlstatus = mysql_query($sqlstatus);
        if ($ctrlstatus == false) {
            $ctrlstatus = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //================= Insertar datos en cancelacion ======================
        $sqlcancel = "INSERT INTO cancelaciones(folio, observaciones, usuario) VALUES ('$folio', '$observ', '$usuario')";
        $ctrlcancel = mysql_query($sqlcancel);
        if ($ctrlcancel == false) {
            $ctrlcancel = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }

        mysql_query("COMMIT;");
        return true;
    }

    function reutilizarCancelacion($folio, $sucursal) {
        // Obtener los datos de comprobante
        $sqlcomp = "SELECT * FROM xmlcomprobantes WHERE folioComprobante = '$folio' AND idSucursal = '$sucursal' AND statusOrden = '3'";
        mysql_query("START TRANSACTION;");
        $ctrlcomp = mysql_query($sqlcomp);
        $row = mysql_affected_rows();
        if ($ctrlcomp == false) {
            $ctrlcomp = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($row < 1) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($comp = mysql_fetch_array($ctrlcomp)) {
                    $idXmlComprobante = $comp["idXmlComprobante"];
                    $fechaComprobante = $comp["fechaComprobante"];
                    $subtotalComprobante = $comp["subtotalComprobante"];
                    $sdaComprobante = $comp["sdaComprobante"];
                    $rfcComprobante = $comp["rfcComprobante"];
                    $desctFacturaComprobante = $comp["desctFacturaComprobante"];
                    $desctProntoPagoComprobante = $comp["desctProntoPagoComprobante"];
                    $desctGeneralComprobante = $comp["desctGeneralComprobante"];
                    $desctPorProductosComprobante = $comp["desctPorProductosComprobante"];
                    $desctTotalComprobante = $comp["desctTotalComprobante"];
                    $ivaComprobante = $comp["ivaComprobante"];
                    $totalComprobante = $comp["totalComprobante"];
                    $tipoComprobante = $comp["tipoComprobante"];
                    $idSucursal = $comp["idSucursal"];
                    $idTipoPago = $comp["idTipoPago"];
                }
            }
        }
        //========== Datos faltantes ===========================================
        $lafecha = date("d/m/Y");
        $statusOrden = 5;
        //========= Obtener nuevo folio ========================================
        $sqlfolio = "SELECT max(folioOrdenCompra) as foliomayor FROM folios WHERE idSucursal = '$sucursal' group by folioOrdenCompra";
        $ctrlfolio = mysql_query($sqlfolio);
        $rowfolio = mysql_affected_rows();
        if ($ctrlfolio == false) {
            $ctrlfolio = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($rowfolio < 1) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($fol = mysql_fetch_array($ctrlfolio)) {
                    $foliomayor = $fol["foliomayor"];
                }
            }
        }
        //========= Actulizar folio ============================================
        $sqlupfol = "UPDATE folios SET folioOrdenCompra = folioOrdenCompra + 1 WHERE idSucursal = '$sucursal'";
        $ctrlupfol = mysql_query($sqlupfol);
        if ($ctrlupfol == false) {
            $ctrlupfol = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //========= Insertar en xml comprobante ================================
        $sqlnewcomp = "INSERT INTO xmlcomprobantes (fechaComprobante, subtotalComprobante, sdaComprobante, rfcComprobante, desctFacturaComprobante, desctProntoPagoComprobante, desctGeneralComprobante, desctPorProductosComprobante, desctTotalComprobante, ivaComprobante, totalComprobante, folioComprobante, tipoComprobante, fechaMovimiento, idSucursal, statusOrden, idTipoPago) "
                . "VALUES ('$lafecha','$subtotalComprobante','$sdaComprobante','$rfcComprobante','$desctFacturaComprobante','$desctProntoPagoComprobante','$desctGeneralComprobante','$desctPorProductosComprobante', '$desctTotalComprobante', '$ivaComprobante','$totalComprobante','$foliomayor', '$tipoComprobante', '$lafecha', '$idSucursal', '$statusOrden', '$idTipoPago' )";
        $ctrlnewcomp = mysql_query($sqlnewcomp);
        $idnewcomp = "SELECT LAST_INSERT_ID() ID;";
        if ($ctrlnewcomp == false) {
            $ctrlnewcomp = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            $ctrlidnew = mysql_query($idnewcomp);
            while ($id = mysql_fetch_array($ctrlidnew)) {
                $idnew = $id["ID"];
            }
        }
        //======== Obtener todos los conceptos del comprobante =================
        $sqlconcep = "SELECT * FROM xmlconceptos WHERE idXmlComprobante = '$idXmlComprobante'";
        $ctrlconcep = mysql_query($sqlconcep);
        $rowconcep = mysql_affected_rows();
        if ($ctrlconcep == false) {
            $ctrlconcep = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($rowconcep < 1) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($concep = mysql_fetch_array($ctrlconcep)) {
                    $sqlnewconcep = "INSERT INTO xmlconceptos (unidadMedidaConcepto, importeConcepto, cantidadConcepto, codigoConcepto, descripcionConcepto, precioUnitarioConcepto, idXmlComprobante, cdaConcepto, desctUnoConcepto, desctDosConcepto, costoCotizacion, idListaPrecio) "
                            . "VALUES ('" . $concep["unidadMedidaConcepto"] . "','" . $concep["importeConcepto"] . "','" . $concep["cantidadConcepto"] . "','" . $concep["codigoConcepto"] . "','" . $concep["descripcionConcepto"] . "','" . $concep["precioUnitarioConcepto"] . "','$idnew','" . $concep["cdaConcepto"] . "','" . $concep["desctUnoConcepto"] . "','" . $concep["desctDosConcepto"] . "','" . $concep["costoCotizacion"] . "','" . $concep["idListaPrecio"] . "')";
                    $sqlExistenciasTemporales = "INSERT INTO existenciastemporales (codigo, folioPedido, cantidad, idSucursal) VALUES ('" . $concep["codigoConcepto"] . "','$foliomayor','" . $concep["cantidadConcepto"] . "','$idSucursal')";
                    $ctrlnewconcep = mysql_query($sqlnewconcep);
                    $datosExistencias = mysql_query($sqlExistenciasTemporales);
                    if ($ctrlnewconcep == false || $datosExistencias == false) {
                        $ctrlnewconcep = mysql_error();
                        mysql_query("ROLLBACK;");
                        return false;
                    }
                }
            }
        }
        mysql_query("COMMIT;");
        return true;
    }

    //===================== NOTAS CREDITO ===================================
    function guardarNotasCredito($idcliente, $cantidad, $sucursal, $foliocancelacion) {
        //Obtener el monto del cliente, si este existe =========================
        $sql = "SELECT * FROM notascredito WHERE idCliente = '$idcliente' AND idSucursal = '$sucursal' AND status = '1'";
        mysql_query("START TRANSACTION;");
        $ctrl = mysql_query($sql);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($row < 1) {
                $montold = 0;
            } else {
                while ($data = mysql_fetch_array($ctrl)) {
                    $montold = $data["monto"];
                }
                //Actualizar el status de la nota ======================================
                $sqls = "UPDATE notascredito SET status = '2' WHERE idCliente = '$idcliente' AND idSucursal = '$sucursal' AND status = '1'";
                $ctrls = mysql_query($sqls);
                if ($ctrls == false) {
                    $ctrls = mysql_error();
                    mysql_query("ROLLBACK;");
                    return false;
                }
            }
        }
        //Variable util $montold
        //Sumar el monto viejo y el nuevo
        $montnew = $montold + $cantidad;
        //Fecha
        $lafecha = date("d/m/Y");
        //Sacar folio para la nota de credito
        $sql2 = "SELECT max(folioNotaCredito) as foliomayor FROM folios WHERE idSucursal = '$sucursal' group by folioNotaCredito";
        $ctrl2 = mysql_query($sql2);
        $row2 = mysql_affected_rows();
        if ($ctrl2 == false) {
            $ctrl2 = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        } else {
            if ($row2 < 1) {
                mysql_query("ROLLBACK;");
                return false;
            } else {
                while ($data2 = mysql_fetch_array($ctrl2)) {
                    $foliomayor = $data2["foliomayor"];
                }
            }
        }
        //Variable util $foliomayor
        //Guardar la nota de credito
        $sql3 = "INSERT INTO notascredito (idcliente, monto, idSucursal, status, folioNotaCredito, folioCancelacion, fecha) VALUES ('$idcliente', '$montnew', '$sucursal', '1', '$foliomayor', '$foliocancelacion', '$lafecha')";
        $ctrl3 = mysql_query($sql3);
        if ($ctrl3 == false) {
            $ctrl3 = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
//        VERIFICAR ESTA CONSULTA
        $sqlActualizarComprobantes = "UPDATE xmlcomprobantes set statusOrden ='9' WHERE statusOrden = '3' and folioComprobante ='$foliocancelacion' and fechaMovimiento ='$lafecha'";
        $rs = mysql_query($sqlActualizarComprobantes);
        if ($rs == false) {
            $rs = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        //Actualizar folios
        $sql4 = "UPDATE folios SET folioNotaCredito= folioNotaCredito + 1 WHERE idSucursal = '$sucursal'";
        $ctrl4 = mysql_query($sql4);
        $row4 = mysql_affected_rows();
        if ($ctrl4 == false) {
            $ctrl4 = mysql_error();
            mysql_query("ROLLBACK;");
            return false;
        }
        mysql_query("COMMIT;");
        return true;
    }

    function consultarNotasCredito($sucursal) {
        $sql = "SELECT * FROM notascredito nt "
                . "INNER JOIN clientes c ON nt.idCliente = c. idCliente "
                . "WHERE nt.idSucursal = '$sucursal' AND nt.status = '1'";
        $ctrl = mysql_query($sql);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row < 1) {
                return false;
            } else {
                return $ctrl;
            }
        }
    }

    function obtenerTodosLosDatosClienteNotaCredtio($idcliente, $sucursal) {
        $sql = "SELECT * from clientes c "
                . "INNER JOIN notascredito nc ON c.idCliente = nc.idCliente "
                . "INNER JOIN direcciones d ON c.idDireccion = d.idDireccion "
                . "WHERE c.idCliente = '$idcliente' AND nc.idSucursal = '$sucursal' AND nc.status = '1'";
        $ctrl = mysql_query($sql);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row < 1) {
                return false;
            } else {
                return $ctrl;
            }
        }
    }

//====================== TERMINA NOTAS CREDITO =================================
    function dameDescuentosClientes($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select descuentoPorFactura, descuentoPorProntoPago from clientes WHERE rfc = '$rfc'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameExistenciaTemporal($codigoProducto, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT SUM(cantidad)cantidad FROM existenciastemporales WHERE idSucursal ='$idSucursal' and codigo='$codigoProducto'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameExistenciaFisica($codigoProducto, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "select cantidad from existencias WHERE idSucursal = '$idSucursal' and codigoProducto = '$codigoProducto'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameCredito($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT credito FROM clientes WHERE rfc = '$rfc'";
        $rs = mysql_query($sql, $cn->Conectarse());

        return $rs;
    }

    function dameTotalCredito($idSucursal, $rfc) {
        $cn = new coneccion();
        $sql = "select sum(totalComprobante) from xmlcomprobantes where idTipoPago =2 and statusOrden = 8 and idSucursal = '$idSucursal' and rfcComprobante= '$rfc'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function validarUsuario(Usuario $u) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM usuarios WHERE usuario = '" . $u->getUsuario() . "' and password ='" . $u->getPass() . "' and idtipousuario = 2";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function obtenerOrdenesCompraTodas($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "SELECT * FROM xmlcomprobantes xp"
                . " inner join tipospagos tp "
                . "on xp.idTipoPago = tp.idTipoPago"
                . " WHERE statusOrden = '5' and idSucursal = '$idSucursal' and fechamovimiento = '$fecha'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function dameProductos() {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT codigoProducto FROM productos";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function insertarExistencias($codigo, $idSucursal) {
//        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO existencias (cantidad, idSucursal, codigoProducto) VALUES ('0', '$idSucursal', '$codigo')";
        $datos = mysql_query($sql, $cn->Conectarse());

        return $datos;
    }

    function insertarCostos($codigoProducto, $idSucursal) {
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "INSERT INTO costos(costo, codigoproducto, fechaMovimiento, status, idSucursal) VALUES ('0', '$codigoProducto','$fecha','1','$idSucursal' )";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function traerEncabezadoPedios($idEncabezado, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "SELECT * FROM xmlcomprobantes x "
                . "inner join tipospagos tp "
                . "on tp.idTipoPago = x.idTipoPago "
                . "WHERE idSucursal = '$idSucursal' and statusOrden = '5' and  folioComprobante ='$idEncabezado' and fechamovimiento = '$fecha'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameDetallePedidos($idXmlComprobante) {
        $sql = "SELECT * FROM xmlconceptos WHERE idXmlComprobante = '$idXmlComprobante'";
        $cn = new coneccion();
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function finalizarVenta($idXmlComprobante, $idSucursal, $folio, $usuarios, $folioOrdenCompra, $idTipoPago, $importe, $folioComprobante, $tipoPagoCredito, $saldoCredito) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        $error = "";
        mysql_query("START TRANSACTION;");
        $existenciaTemporal = 0;
        $existenciaFisica = 0;
        $codigo = "";
        $nuevaExistencia = 0;
        $fecha = date("d/m/Y");
        $sqlexistenciasTmp = "SELECT * FROM existenciastemporales where folioPedido = '$folioComprobante' and idSucursal ='$idSucursal'";
        $rs = mysql_query($sqlexistenciasTmp);
        if ($rs == false) {
            $error = mysql_error();
            mysql_query("ROLLBACK;");
        } else {
            while ($datosTmp = mysql_fetch_array($rs)) {
                $codigo = $datosTmp["codigo"];
                $existenciaTemporal = $datosTmp["cantidad"];
                $sqlExistencias = "SELECT cantidad FROM existencias WHERE codigoProducto = '" . $datosTmp["codigo"] . "' and idSucursal ='$idSucursal'";
                $datosExistencias = mysql_query($sqlExistencias);
                if ($datosExistencias == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                    break;
                } else {
                    while ($rs1 = mysql_fetch_array($datosExistencias)) {
                        $existenciaFisica = $rs1["cantidad"];
                    }
                    $nuevaExistencia = $existenciaFisica - $existenciaTemporal;
                    $datosExistencias = "UPDATE existencias set cantidad ='$nuevaExistencia' WHERE idSucursal = '$idSucursal' and codigoProducto ='$codigo'";
                    $rsExistencia = mysql_query($datosExistencias);
                    if ($rsExistencia == false) {
                        $error = mysql_error();
                        mysql_query("ROLLBACK;");
                        break;
                    } else {
                        $sqlSalidas = "INSERT INTO salidas (usuario, cantidad, fecha , codigoProducto, idSucursal) VALUES ('$usuarios', '$existenciaTemporal', '$fecha', '$codigo', '$idSucursal')";
                        $rsSalidas = mysql_query($sqlSalidas);
                        if ($rsSalidas == false) {
                            $error = mysql_error();
                            mysql_query("ROLLBACK;");
                            break;
                        }
                    }
                }
                if ($error != "") {
                    break;
                }
            }
            if ($error == "") {
                $status = 0;
                if ($idTipoPago == 2) {
                    $status = 8;
                } else {
                    $status = 7;
                }
                $sql = "UPDATE xmlcomprobantes set folioComprobante = '$folio', statusOrden = '$status' where idXmlComprobante = '$idXmlComprobante' and statusOrden = '5'";
                $rsxmlComprobante = mysql_query($sql);
                if ($rsxmlComprobante == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                } else {
                    $sqlEliminarExistenciasTmp = "DELETE FROM  existenciastemporales WHERE folioPedido = '$folioComprobante' and idSucursal ='$idSucursal' ";
                    $rsEliminarExittmp = mysql_query($sqlEliminarExistenciasTmp);
                    if ($rsEliminarExittmp == false) {
                        $error = mysql_error();
                        mysql_query("ROLLBACK;");
                    } else {
                        if ($idTipoPago == 2) {
                            $sqlXmlComprobantes = "SELECT rfcComprobante FROM xmlcomprobantes WHERE idXmlComprobante ='$idXmlComprobante'";
                            $rsXmComprobantes = mysql_query($sqlXmlComprobantes);
                            if ($rsXmComprobantes == false) {
                                $error = mysql_error();
                            } else {
                                while ($r2 = mysql_fetch_array($rsXmComprobantes)) {
                                    $sqlAbonos = "INSERT INTO abonos (rfcCliente, importe, idTipoPago, referencia, idSucursal, folioComprobante, fechaAbono, saldo, observaciones, statusSaldo)"
                                            . " VALUES ('" . $r2["rfcComprobante"] . "','" . $importe . "','" . $tipoPagoCredito . "',0,'$idSucursal', $folio, '$fecha', '" . ($saldoCredito - $importe) . "','','1')";
                                    $rsAbonos = mysql_query($sqlAbonos);
                                    if ($rsAbonos == false) {
                                        $error = mysql_error();
                                        mysql_query("ROLLBACK;");
                                    }
                                }
                            }
                        }
                        $folio = $folio + 1;
                        $sqlUpadteFolio = "UPDATE folios set folioVenta = '$folio' WHERE idSucursal = '$idSucursal'";
                        $rsUpdateFolio = mysql_query($sqlUpadteFolio);
                        if ($rsUpdateFolio == false) {
                            $error = mysql_error();
                            mysql_query("ROLLBACK;");
                        } else {
                            mysql_query("COMMIT;");
                        }
                    }
                }
            }
        }
        $cn->cerrarBd();
        return $error;
    }

    function obtenerOrdenCompraClientes($rfc, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT idXmlComprobante, fechaMovimiento FROM xmlcomprobantes  WHERE idSucursal ='$idSucursal' and statusOrden = 5 and rfcComprobante = '$rfc'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameOrdenCompraDetalle($idXmlComprobante) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM xmlconceptos WHERE idXmlComprobante ='$idXmlComprobante'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameCodigosProductosOrdenCompra($idXmlComprobante) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT codigoConcepto from xmlconceptos WHERE idXmlComprobante='$idXmlComprobante'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function guardarProductoOrdenCompra($detalle, $idSucursal, $encabezado) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        $error = "";
        $folio = 0;
        mysql_query("START TRANSACTION;");
        for ($x = 0; $x < count($detalle); $x++) {
            $updateEncabezado = "UPDATE xmlcomprobantes set subtotalComprobante = '" . $encabezado[$x]->subTotalComprobante . "', sdaComprobante = '" . $encabezado[$x]->sdaComprobante . "', desctTotalComprobante = '" . $encabezado[$x]->descuentoTotalComprobante . "', ivaComprobante='" . $encabezado[$x]->ivaComprobante . "', totalComprobante='" . $encabezado[$x]->totalComprobante . "' WHERE idXmlComprobante='" . $detalle[$x]->idXmlComprobante . "'";
            $actualizar = mysql_query($updateEncabezado);
            if ($actualizar == false) {
                mysql_query("ROLLBACK;");
                $error = mysql_error();
                break;
            }
            $sqlDameFolioOrdenCompra = "SELECT folioComprobante from xmlcomprobantes WHERE idXmlComprobante = '" . $detalle[$x]->idXmlComprobante . "'";
            $datosFolio = mysql_query($sqlDameFolioOrdenCompra);
            if ($datosFolio == false) {
                mysql_query("ROLLBACK;");
                $error = mysql_error();
                break;
            } else {
                while ($rsFolio = mysql_fetch_array($datosFolio)) {
                    $folio = $rsFolio["folioComprobante"];
                }
            }
            $sqlExistenciasTemporales = "INSERT INTO existenciastemporales (codigo, folioPedido, cantidad, idSucursal) VALUES ('" . $detalle[$x]->codigoConcepto . "','" . $folio . "', '" . $detalle[$x]->cantidadConcepto . "', '$idSucursal')";
            $datosExistenciasTmp = mysql_query($sqlExistenciasTemporales);
            if ($datosExistenciasTmp == false) {
                $error = mysql_error();
                mysql_query("ROLLBACK;");
                break;
            }
            $sqlConceptoGuardar = "INSERT INTO xmlconceptos (unidadMedidaConcepto, importeConcepto, cantidadConcepto, codigoConcepto, descripcionConcepto, precioUnitarioConcepto, idXmlComprobante, cdaConcepto, desctUnoConcepto, desctDosConcepto,costoCotizacion,idListaPrecio)"
                    . " VALUES ('" . $detalle[$x]->unidadMedidaConcepto . "', '" . $detalle[$x]->importeConcepto . "','" . $detalle[$x]->cantidadConcepto . "','" . $detalle[$x]->codigoConcepto . "','" . $detalle[$x]->descripcionConcepto . "','" . $detalle[$x]->precioUnitarioConcepto . "', '" . $detalle[$x]->idXmlComprobante . "', '" . $detalle[$x]->cdaConcepto . "', '" . $detalle[$x]->desctUnoConcepto . "','0','" . $detalle[$x]->costoCotizacion . "','" . $detalle[$x]->idListaPrecio . "')";
            $datos = mysql_query($sqlConceptoGuardar);
            if ($datos == false) {
                $error = mysql_error();
                mysql_query("ROLLBACK;");
                break;
            } else {
                $sqlTraerExistencia = "SELECT cantidad  FROM existencias WHERE idSucursal = '$idSucursal' and codigoProducto = '" . $detalle[$x]->codigoConcepto . "'";
                $sqlTraerTotalExistenciaTemporal = "SELECT sum(cantidad) cantidad FROM existenciastemporales  WHERE codigo = '" . $detalle[$x]->codigoConcepto . "' and idSucursal = '$idSucursal';";
                $dat = mysql_query($sqlTraerExistencia);
                if ($dat == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                    break;
                } else {
                    while ($rs = mysql_fetch_array($dat)) {
                        $nuevaExistencia = 0;
                        $cantidadPedida = 0;
                        $cantidadPedida = $detalle[$x]->cantidadConcepto;
                        $existencia = $rs[0];
                        $long = $detalle[$x]->codigoConcepto;
                        $cadena = substr($detalle[$x]->codigoConcepto, strlen($long) - 3, 3);
                        $ok = false;
                        $existenciaTemporal = mysql_query($sqlTraerTotalExistenciaTemporal);
                        if ($existenciaTemporal == false) {
                            $error = "2," . $detalle[$x]->codigoConcepto;
                            mysql_query("ROLLBACK;");
                            break;
                        } else {
                            $datosTmp = false;
                            while ($rsTemporal = mysql_fetch_array($existenciaTemporal)) {
                                $datosTmp = true;
                                $cantidadTmp = $rsTemporal["cantidad"];
                            }
                            if ($datosTmp == false) {
                                $cantidadTmp = 0;
                            }
                        }
                        if ($cadena == "-GR") {
                            $cantidad = $rs[0] * 1;
                            $cantidadTmp = $cantidadTmp * 1;
                            $cantidadPedida = $cantidadPedida * 1;
                            $ok = true;
                        }
                        if ($ok == false) {
                            $nuevaExistencia = $existencia - $cantidadTmp;
                            $nuevaExistencia = $nuevaExistencia - $cantidadPedida;
                        }
                        if ($ok == true) {
                            $nuevaExistencia = $cantidad - $cantidadTmp;
                            $nuevaExistencia = $nuevaExistencia / 1;
                        }
                        if ($nuevaExistencia < 0) {
                            $error = "2," . $detalle[$x]->codigoConcepto;
                            mysql_query("ROLLBACK;");
                            break;
                        } else {
                            
                        }
                    }
                }
            }
            if ($error != "") {
                break;
            }
        }
        if ($error == "") {
            mysql_query("COMMIT;");
        }
    }

    function dameTotalesXmlComprobantes($id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * from xmlcomprobantes WHERE idXmlComprobante= '$id'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function eliminarProductoOredenCompra($codigo, $idComprobante, $idSucursal, $encabezado) {
        $error = "";
        $folio = 0;
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        try {
            mysql_query("START TRANSACTION;");
            $sqlEliminarConceptos = "DELETE  from xmlconceptos "
                    . "WHERE codigoConcepto = '$codigo' "
                    . "and idXmlComprobante ='$idComprobante';";
            $rsEliminarConceptos = mysql_query($sqlEliminarConceptos, $cn->Conectarse());
            if ($rsEliminarConceptos == false) {
                throw new Exception();
            }
            $sqlDameFolio = "select folioComprobante "
                    . "from xmlcomprobantes "
                    . "WHERE idXmlComprobante='$idComprobante';";
            $rsFolio = mysql_query($sqlDameFolio, $cn->Conectarse());
            if ($rsFolio == false) {
                throw new Exception();
            } else {
                while ($rs = mysql_fetch_array($rsFolio)) {
                    $folio = $rs["folioComprobante"];
                }
            }
            $sqlEliminarExistenciasTmp = "DELETE FROM existenciastemporales "
                    . "WHERE codigo ='$codigo' "
                    . "and folioPedido ='$folio' "
                    . "and idSucursal='$idSucursal'";
            $rsEliminarTmp = mysql_query($sqlEliminarExistenciasTmp, $cn->Conectarse());
            if ($rsEliminarTmp == false) {
                throw new Exception();
            }
            $updateEncabezado = "UPDATE xmlcomprobantes set subtotalComprobante = '" . $encabezado[0]->subTotalComprobante . "', sdaComprobante = '" . $encabezado[0]->sdaComprobante . "', desctTotalComprobante = '" . $encabezado[0]->descuentoTotalComprobante . "', ivaComprobante='" . $encabezado[0]->ivaComprobante . "', totalComprobante='" . $encabezado[0]->totalComprobante . "' WHERE idXmlComprobante='" . $idComprobante . "'";
            $rsEncabezado = mysql_query($updateEncabezado, $cn->Conectarse());
            if ($rsEncabezado == false) {
                throw new Exception();
            }
            mysql_query("COMMIT;");
        } catch (Exception $e) {
            $error = mysql_error();
            mysql_query("ROLLBACK;");
        }

        return $error;
    }

    function validaImagenSlider() {
        $query = "SELECT * FROM imgslider";
        $ctrl = mysql_query($query);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            $call = 1;
        } else {
            if ($row >= 10) {
                $call = 1;
            } else {
                $call = 0;
            }
        }
        return $call;
    }

    function subirImgenSlider($sucursal, $lahora, $archivo) {

        $sql = "INSERT INTO imgslider (ruta, idSucursal, fechaMovimiento) VALUES ('$archivo', '$sucursal', '$lahora')";
        $ctrl = mysql_query($sql);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            $call = false;
        } else {
            $call = true;
        }

        return $call;
    }

    function actualizarOrdenCompraMostrador($detalle, $idSucursal, $encabezado) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        $error = "";
        $folio = 0;
        mysql_query("START TRANSACTION;");
        $updateEncabezado = "UPDATE xmlcomprobantes set subtotalComprobante = '" . $encabezado[0]->subTotalComprobante . "', sdaComprobante = '" . $encabezado[0]->sdaComprobante . "', desctTotalComprobante = '" . $encabezado[0]->descuentoTotalComprobante . "', ivaComprobante='" . $encabezado[0]->ivaComprobante . "', totalComprobante='" . $encabezado[0]->totalComprobante . "' WHERE idXmlComprobante='" . $detalle[0]->idXmlComprobante . "'";
        $actualizar = mysql_query($updateEncabezado);
        if ($actualizar == false) {
            mysql_query("ROLLBACK;");
            $error = mysql_error();
        } else {
            for ($x = 0; $x < count($detalle); $x++) {
                $sqlDameFolioOrdenCompra = "SELECT folioComprobante from xmlcomprobantes WHERE idXmlComprobante = '" . $detalle[$x]->idXmlComprobante . "'";
                $datosFolio = mysql_query($sqlDameFolioOrdenCompra);
                if ($datosFolio == false) {
                    mysql_query("ROLLBACK;");
                    $error = mysql_error();
                    break;
                } else {
                    while ($rsFolio = mysql_fetch_array($datosFolio)) {
                        $folio = $rsFolio["folioComprobante"];
                    }
                }
                $sqlExistenciasTemporales = "UPDATE  existenciastemporales SET cantidad = '" . $detalle[$x]->cantidadConcepto . "' WHERE codigo = '" . $detalle[$x]->codigoConcepto . "' and idSucursal='" . $idSucursal . "' and folioPedido = '" . $folio . "'";
                $datosExistenciasTmp = mysql_query($sqlExistenciasTemporales);
                if ($datosExistenciasTmp == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                    break;
                }
                $sqlConceptoGuardar = "UPDATE xmlconceptos set cantidadConcepto ='" . $detalle[$x]->cantidadConcepto . "', precioUnitarioConcepto='" . $detalle[$x]->precioUnitarioConcepto . "',cdaConcepto='" . $detalle[$x]->cdaConcepto . "', desctUnoConcepto ='" . $detalle[$x]->desctUnoConcepto . "', costoCotizacion='" . $detalle[$x]->costoCotizacion . "', idListaPrecio='" . $detalle[$x]->idListaPrecio . "' WHERE codigoConcepto = '" . $detalle[$x]->codigoConcepto . "' and idXmlComprobante='" . $detalle[$x]->idXmlComprobante . "' ";
                $datos = mysql_query($sqlConceptoGuardar);
                if ($datos == false) {
                    $error = mysql_error();
                    mysql_query("ROLLBACK;");
                    break;
                } else {
                    $sqlTraerExistencia = "SELECT cantidad  FROM existencias WHERE idSucursal = '$idSucursal' and codigoProducto = '" . $detalle[$x]->codigoConcepto . "'";
                    $sqlTraerTotalExistenciaTemporal = "SELECT sum(cantidad) cantidad FROM existenciastemporales  WHERE codigo = '" . $detalle[$x]->codigoConcepto . "' and idSucursal = '$idSucursal';";
                    $dat = mysql_query($sqlTraerExistencia);
                    if ($dat == false) {
                        $error = mysql_error();
                        mysql_query("ROLLBACK;");
                        break;
                    } else {
                        while ($rs = mysql_fetch_array($dat)) {
                            $nuevaExistencia = 0;
                            $cantidadPedida = 0;
                            $cantidadPedida = $detalle[$x]->cantidadConcepto;
                            $existencia = $rs[0];
                            $long = $detalle[$x]->codigoConcepto;
                            $cadena = substr($detalle[$x]->codigoConcepto, strlen($long) - 3, 3);
                            $ok = false;
                            $existenciaTemporal = mysql_query($sqlTraerTotalExistenciaTemporal);
                            if ($existenciaTemporal == false) {
                                $error = "2," . $detalle[$x]->codigoConcepto;
                                mysql_query("ROLLBACK;");
                                break;
                            } else {
                                $datosTmp = false;
                                while ($rsTemporal = mysql_fetch_array($existenciaTemporal)) {
                                    $datosTmp = true;
                                    $cantidadTmp = $rsTemporal["cantidad"];
                                }
                                if ($datosTmp == false) {
                                    $cantidadTmp = 0;
                                }
                            }
                            if ($cadena == "-GR") {
                                $cantidad = $rs[0] * 1;
                                $cantidadTmp = $cantidadTmp * 1;
                                $cantidadPedida = $cantidadPedida * 1;
                                $ok = true;
                            }
                            if ($ok == false) {
                                $nuevaExistencia = $existencia - $cantidadTmp;
                                $nuevaExistencia = $nuevaExistencia - $cantidadPedida;
                            }
                            if ($ok == true) {
                                $nuevaExistencia = $cantidad - $cantidadTmp;
                                $nuevaExistencia = $nuevaExistencia / 1;
                            }
                            if ($nuevaExistencia < 0) {
                                $error = "2," . $detalle[$x]->codigoConcepto;
                                mysql_query("ROLLBACK;");
                                break;
                            } else {
                                
                            }
                        }
                    }
                }
                if ($error != "") {
                    break;
                }
            }
        }
        if ($error == "") {
            mysql_query("COMMIT;");
        }
    }

    function dameNotaCredito($idSucursal, $rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT monto, nt.idCliente, nombre, idNotasCredito "
                . "FROM notascredito nt "
                . "INNER JOIN clientes cl "
                . "on nt.idCliente = cl.idCliente "
                . "WHERE cl.rfc = '$rfc' and status ='1' and idSucursal = '$idSucursal'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function guardarNotaCredito($idCliente, $idSucursal, $total, $idNotaCredito, $folioVentaOrdenCompra) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $error = "";
        try {
            mysql_query("START TRANSACTION;", $cn->Conectarse());
            $sqlActualziarStatus = "UPDATE notascredito set status ='2' "
                    . "WHERE idNotasCredito = '$idNotaCredito'";
            $datos = mysql_query($sqlActualziarStatus, $cn->Conectarse());
            if ($datos == false) {
                $error = mysql_error();
                throw new Exception();
            }
            $folioNotaCredito = 0;
            $fecha = date("d/m/Y");
            $sqlFolios = "SELECT folioNotaCredito FROM folios WHERE idSucursal='$idSucursal'";
            $rsFolios = mysql_query($sqlFolios, $cn->Conectarse());
            if ($rsFolios == false) {
                $error = mysql_error();
                throw new Exception();
            }
            while ($rs = mysql_fetch_array($rsFolios)) {
                $folioNotaCredito = $rs["folioNotaCredito"];
            }
            $sqlInsertarNotaCredito = "INSERT INTO notascredito  (idCliente, monto, idSucursal, status, folioNotaCredito, folioCancelacion, fecha)"
                    . " VALUES ('" . $idCliente . "', '" . $total . "', '" . $idSucursal . "', '1', '0', '$folioNotaCredito', '" . $fecha . "')";
            $rsInsertaNotacredio = mysql_query($sqlInsertarNotaCredito);
            if ($rsInsertaNotacredio == false) {
                $error = mysql_error();
                throw new Exception();
            }
            $sqlActualizarFolio = "UPDATE folios SET folioNotaCredito = '" . ($folioNotaCredito + 1) . "' "
                    . " WHERE idSucursal ='$idSucursal'";
            $rsActualizarFolio = mysql_query($sqlActualizarFolio);
            if ($rsActualizarFolio == false) {
                $error = mysql_error();
                throw new Exception();
            }
            $folioVenta = 0;
            $sqlFolioVentas = "SELECT folioVenta FROM folios WHERE idSucursal = '$idSucursal'";
            $rsFolioVenta = mysql_query($sqlFolioVentas);
            if ($rsFolioVenta == false) {
                $error = mysql_error();
                throw new Exception();
            }
            while ($datosFolioVenta = mysql_fetch_array($rsFolioVenta)) {
                $folioVenta = $datosFolioVenta["folioVenta"];
            }
            $sqlEliminarExistenciasTemporales = "DELETE FROM  existenciastemporales WHERE folioPedido='" . $folioVentaOrdenCompra . "' and idSucursal='" . $idSucursal . "' ";
            $rsExistenciasTmp = mysql_query($sqlEliminarExistenciasTemporales);
            if ($rsExistenciasTmp == false) {
                $error = mysql_error();
                throw new Exception();
            }
            $sqlComprobantes = "UPDATE xmlcomprobantes set folioComprobante ='$folioVenta', statusOrden =7 WHERE idsucursal = '$idSucursal' and folioComprobante = '$folioVentaOrdenCompra'";
            $rsComprobantes = mysql_query($sqlComprobantes);
            if ($rsComprobantes == false) {
                $error = mysql_error();
                throw new Exception();
            }

            $sqlActualizarFolioVenta = "UPDATE folios SET folioVenta='" . ($folioVenta + 1) . "' WHERE  idSucursal = '$idSucursal'";
            $rsActualizarFolioVnta = mysql_query($sqlActualizarFolioVenta, $cn->Conectarse());
            if ($rsActualizarFolioVnta == false) {
                $error = mysql_error();
                throw new Exception();
            }
            mysql_query("COMMIT;", $cn->Conectarse());
        } catch (Exception $ex) {
            mysql_query("ROLLBACK;", $cn->Conectarse());
//            $error = mysql_error();
        }
        return $error;
    }

    function mostrarImgSlider() {
        $query = "SELECT * from imgslider";
        $ctrl = mysql_query($query);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row < 1) {
                return false;
            } else {
                return $ctrl;
            }
        }
    }

    function borrarSlider($idImgslider, $idSucursal, $ruta) {
        $query = "DELETE FROM imgslider WHERE idImgslider = '$idImgslider' AND ruta = '$ruta'";
        $ctrl = mysql_query($query);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            $call = false;
        } else {
            unlink($ruta);
            $call = true;
        }
        return $call;
    }

    function eliminarOrdenCompra($idFolioOrdenCompra, $idSucursal, $folioComprobante) {
        include_once '../daoconexion/daoConeccion.php';
        $error = "";
        $cn = new coneccion();
        $idFolio = 0;
        try {
            mysql_query("START TRANSACTION;", $cn->Conectarse());
            $sqlDameFolio = "SELECT folioCancelaciones FROM folios WHERE idSucursal ='" . $idSucursal . "'";
            $datosFolio = mysql_query($sqlDameFolio, $cn->Conectarse());
            if ($datosFolio == false) {
                $error = mysql_error();
                throw new Exception();
            }
            while ($rsFolio = mysql_fetch_array($datosFolio)) {
                $idFolio = $rsFolio["folioCancelaciones"];
            }
            $sqlEliminarOrdenCompra = "UPDATE xmlcomprobantes set statusOrden ='4', folioComprobante='$idFolio' WHERE folioComprobante = '" . $idFolioOrdenCompra . "' and statusOrden = '5'";
            $rsEliminarOrden = mysql_query($sqlEliminarOrdenCompra, $cn->Conectarse());
            if ($rsEliminarOrden == false) {
                $error = mysql_error();
                throw new Exception();
            }
            $sqlEliminarExistenciasTemporales = "DELETE FROM existenciastemporales WHERE folioPedido = '" . $idFolioOrdenCompra . "' and idSucursal ='" . $idSucursal . "'";
            $rsEliminarExistenciaTemporal = mysql_query($sqlEliminarExistenciasTemporales, $cn->Conectarse());
            if ($rsEliminarExistenciaTemporal == false) {
                $error = mysql_error();
                throw new Exception();
            }
            $sqlActualizarFolioCancelacion = "UPDATE folios SET folioCancelaciones ='" . ($idFolio + 1) . "' WHERE idSucursal ='$idSucursal'";
            $rsActualizarFolioCancelacion = mysql_query($sqlActualizarFolioCancelacion);
            if ($rsActualizarFolioCancelacion == false) {
                $error = mysql_error();
                throw new Exception();
            }
            mysql_query("COMMIT;", $cn->Conectarse());
        } catch (Exception $ex) {
            mysql_query("ROLLBACK;", $cn->Conectarse());
        }
        return $error;
    }

    function dameTotalXmlComprobanteCorteCaja($idSucursal) {
        $fecha = date("d/m/Y");
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM xmlcomprobantes xmlC "
                . "inner join tipospagos tp "
                . "on xmlC.idTipoPago = tp.idTipoPago "
                . "inner join ventasUsuario vU "
                . "on xmlC.idXmlComprobante = vU.idXmlComprobante "
                . "WHERE statusOrden = '7' "
                . "and fechaMovimiento = '" . $fecha . "' "
                . "and tipoComprobante = 'Ventas' "
                . "and idSucursal = '" . $idSucursal . "' "
                . "and xmlC.idTipoPago !=2";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameTotalXmlComprobanteCorteCajaPorFechas($idSucursal, $fecha1, $fecha2) {
        $fecha = date("d/m/Y");
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM xmlcomprobantes xmlC "
                . "inner join tipospagos tp "
                . "on xmlC.idTipoPago = tp.idTipoPago "
                . "inner join ventasUsuario vU "
                . "on xmlC.idXmlComprobante = vU.idXmlComprobante "
                . "WHERE statusOrden = '7'  "
                . "and tipoComprobante = 'Ventas' "
                . "and idSucursal = '" . $idSucursal . "' "
                . "and xmlC.idTipoPago != '2' "
                . "and fechaMovimiento BETWEEN  '" . $fecha1 . "' AND '" . $fecha2 . "' ";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameAbonoTotalCorteCaja($idSucursal) {
        $fecha = date("d/m/Y");
        $cn = new coneccion();
        $sql = "SELECT * FROM abonos ab "
                . "inner join clientes cl "
                . "on ab.rfcCliente = cl.rfc "
                . "inner join tipospagos tp "
                . "on ab.idTipoPago = tp.idTipoPago "
                . "WHERE idSucursal = '" . $idSucursal . "' "
                . "and fechaAbono = '" . $fecha . "' "
                . "and importe > 0";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameAbonoTotalCorteCajaPorFechas($idSucursal, $fecha1, $fecha2) {
//        $fecha = date("d/m/Y");
        $cn = new coneccion();
        $sql = "SELECT * FROM abonos ab "
                . "inner join clientes cl "
                . "on ab.rfcCliente = cl.rfc "
                . "inner join tipospagos tp "
                . "on ab.idTipoPago = tp.idTipoPago "
                . "WHERE idSucursal = '" . $idSucursal . "' "
                . "and importe > 0 "
                . "and fechaAbono BETWEEN '" . $fecha1 . "' AND '" . $fecha2 . "' ";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function obtenerIdParaNombrarImagen($codigo) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $query = "SELECT * FROM productos WHERE codigoProducto = '$codigo'";
        $ctrl = mysql_query($query, $cn->Conectarse());
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row > 0) {
                while ($rs = mysql_fetch_array($ctrl)) {
                    $id_prod = $rs[idProducto];
                }
            } else {
                return false;
            }
        }
        $cn->cerrarBd();
        return $id_prod;
    }

    function validar($idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "SELECT * FROM cajainicial WHERE idSucursal = '" . $idSucursal . "' and fecha ='" . $fecha . "'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function validarCierreCaja($idSucursal) {
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "SELECT * FROM cajainicial WHERE idSucursal = '" . $idSucursal . "' and fecha ='" . $fecha . "' and  cajaCerrada ='0' ";
        $rs = mysql_query($sql);
        return $rs;
    }

    function guardarIngresoCaja(CajaInicial $caja) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO cajainicial (fecha, ingreso, idSucursal) VALUES ('" . $caja->getFecha() . "', '" . $caja->getIngreso() . "', '" . $caja->getIdSucursal() . "')";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameFolioComprobante($idXmlComprobante) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT folioComprobante FROM xmlcomprobantes WHERE idXmlComprobante = '" . $idXmlComprobante . "'";
        $rs = mysql_query($sql, $cn->Conectarse());

        return $rs;
    }

    function dameVentasCanceladasNotaCredito($idSucursal) {
        $fecha = date("d/m/Y");
        $cn = new coneccion();
        $sql = "select * from xmlcomprobantes xmlC "
                . "inner join ventasUsuario vU "
                . "on xmlC.idXmlComprobante = vU.idXmlComprobante "
                . "where fechaMovimiento = '$fecha' "
                . "and statusOrden ='9' and idSucursal = '$idSucursal'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameOrdenesCanceladas($idCliente) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "select folioComprobante, fechaMovimiento, totalComprobante from xmlcomprobantes xC
                inner join clientes cl 
                on xC.rfcComprobante = cl.rfc
                where cl.idCliente='" . $idCliente . "' 
                and xC.statusOrden='3'
                and xC.fechaMovimiento='" . $fecha . "'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function dameVentasCanceladasNotaCreditoFechas($idSucursal, $fecha1, $fecha2) {
        $cn = new coneccion();
        $sql = "select * from xmlcomprobantes 
                where  statusOrden ='9' 
                and idSucursal = '$idSucursal' "
                . "and fechaMovimiento BETWEEN '$fecha1' and '$fecha2'";
        $rs = mysql_query($sql, $cn->Conectarse());
        return $rs;
    }

    function buscarNoPublicados() {
        $query = "SELECT p.* FROM productos p "
                . "LEFT OUTER JOIN clasificados c ON p.codigoProducto = c.codigoProducto "
                . "WHERE c.idClasificados IS NULL";
        $ctrl = mysql_query($query);
        return $ctrl;
    }

    function finalizarDia(CajaInicial $caja, $idSucursal) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $fecha = date("d/m/Y");
        $sql = "UPDATE  cajainicial  set cajaCerrada='1', cantidadCaja='" . $caja->getCantidadCaja() . "', "
                . "cantidadSistema = '" . $caja->getCantidadSistema() . "', observaciones ='" . $caja->getObservaciones() . "' "
                . "WHERE fecha ='$fecha' and idSucursal = '$idSucursal'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

}
