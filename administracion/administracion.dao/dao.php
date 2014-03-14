<?php

class dao {
    
    function eliminaMaquinas($listaMaquinas){
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
            
    function consultaMaquina(){
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
            $sql = "update clientes set idStatus='2' Where idClientes ='$valor'";
            $proveedores = mysql_query($sql, $cn->Conectarse());
            if ($proveedores == false) {
                mysql_query("ROLLBACK;");
            } else {
                echo'bien';
            }
        }
        mysql_query("COMMIT;");
    }

    function editarCliente(Cliente $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE clientes set nombre='" . $t->getNombre() . "', idDireccion='" . $t->getIdDireccion() . "',  diasCredito='" . $t->getDiasCredito() . "', email='" . $t->getEmail() . "', descuentoPorFactura='" . $t->getDesctfactura() . "', descuentoPorProntoPago='" . $t->getDesctprontopago() . "', tipoCliente='" . $t->getTipoCliente() . "', idStatus='1' WHERE rfc='" . $t->getRfc() . "';";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
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

    function guardarCliente(Cliente $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "INSERT INTO clientes(nombre, idDireccion, rfc, diasCredito, email, descuentoPorFactura, descuentoPorProntoPago, tipoCliente, idStatus)VALUES('" . $t->getNombre() . "','" . $t->getIdDireccion() . "','" . $t->getRfc() . "','" . $t->getDiasCredito() . "','" . $t->getEmail() . "','" . $t->getDesctfactura() . "','" . $t->getDesctprontopago() . "','" . $t->getTipoCliente() . "','1');";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
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
            $sql = "update listaPrecios set idStatus='2' Where idListaPrecio ='$valor'";
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

    function editarDireccion(Direccion $t) {
        session_start();
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "update direcciones set calle='" . $t->getCalle() . "', numeroExterior='" . $t->getNumeroexterior() . "', numeroInterior='" . $t->getNumerointerior() . "', cruzamientos='" . $t->getCruzamientos() . "', idcpostales='" . $t->getIdPostal() . "' WHERE idDireccion= '" . $t->getIdDireccion() . "'";
//        $sql2 = "SELECT LAST_INSERT_ID() ID;";
        $x = mysql_query($sql, $cn->Conectarse());
////        $dato = mysql_query($sql2, $cn->Conectarse());
//        while ($rs = mysql_fetch_array($dato)) {
//            $id = $rs["ID"];
//        }
        $_SESSION['iddireccion'] = $t->getIdDireccion();
        $cn->cerrarBd();
        return $x;
    }

    function editarProveedor(Proveedor $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "UPDATE proveedores set nombre='" . $t->getNombre() . "', idDireccion='" . $t->getIdDireccion() . "',  diasCredito='" . $t->getDiasCredito() . "', email='" . $t->getEmail() . "', descuentoPorFactura='" . $t->getDesctfactura() . "', descuentoPorProntoPago='" . $t->getDesctprontopago() . "', tipoProveedor='" . $t->getTipoProveedor() . "', idStatus='1' WHERE rfc='" . $t->getRfc() . "';";
        mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function verificandoProveedor($rfc) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT * FROM proveedores p INNER JOIN direcciones d ON p.idDireccion = d.idDireccion INNER JOIN cpostales c ON c.idcpostales = d.idcpostales WHERE rfc= '$rfc'";
        $datos = mysql_query($sql, $cn->Conectarse());
        $band = mysql_affected_rows();
        if ($band < 1) {
            return 0;
        } else {
            return $datos;
        }
    }

    function editarProducto(Producto $p, Costo $c, Tarifa $t) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sqlCostos = "UPDATE costos set status = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "'";
        $sqlProductos = "UPDATE productos set producto = '" . $p->getProducto() . "',idMarca= '" . $p->getIdMarca() . "',idProveedor= '" . $p->getIdProveedor() . "',cantidadMaxima= '" . $p->getCantidadMaxima() . "',cantidadMinima= '" . $p->getCantidadMinima() . "',idGrupoProducto= '" . $p->getIdGrupoProducto() . "',idUnidadMedida= '" . $p->getIdUnidadMedida() . "',idStatus='1' WHERE codigoProducto = '" . $p->getCodigoProducto() . "'";
        $fecha = date("d/m/Y h:i");
        $sqlCostoNuevo = "INSERT INTO costos(costo, codigoProducto,fechaMovimiento, status)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "','$fecha','1')";

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
                                    $verificaExistecia = "SELECT * from tarifas WHERE idListaPrecio = $pieces[1] and codigoProducto = '" . $p->getCodigoProducto() . "' AND idStatus = '1' ";
                                    $Existencia = mysql_query($verificaExistecia, $cn->Conectarse());
                                    $band = mysql_affected_rows();
                                    if ($band > 0) {
                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $pieces[1]";
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

                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $listaPrecio";
                                        $statusTarifa = mysql_query($sqlStatusTarifa, $cn->Conectarse());
                                        if ($statusTarifa == false) {
                                            mysql_query("ROLLBACK;");
                                        } else {
                                            $sqlTarifas = "INSERT INTO tarifas(codigoProducto, porcentaUtilidad, idListaPrecio, idStatus,tarifa, fechaMovimientoTarifa)VALUES('" . $p->getCodigoProducto() . "','$tarifa','$listaPrecio','1','$pieces[0]','$fecha')";
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
                                        $sqlStatusTarifa = "UPDATE tarifas set idStatus = '2' WHERE codigoProducto = '" . $p->getCodigoProducto() . "' AND idListaPrecio = $pieces[1]";
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

    function consultandoProductoPorCodigo($codigo) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto,p.idUnidadMedida \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                . " INNER JOIN grupoProductos g ON g.idGrupoProducto = p.idGrupoProducto where c.status=1 and p.codigoProducto = '$codigo'";

        $datos = mysql_query($sql, $cn->Conectarse());
//        while ($rs = mysql_fetch_array($dato)) {
//            $id = $rs[1];
//        }

        return $datos;
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

    function mostrarTarifasTabla($codigoProducto) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT l.nombreListaPrecio, c.costo, t.porcentaUtilidad, l.idListaPrecio, t.tarifa FROM tarifas t inner join listaPrecios l on t.idListaPrecio = l.idListaPrecio inner join costos c on c.codigoProducto = t.codigoProducto WHERE t.codigoProducto  = '$codigoProducto' AND t.idStatus = '1' AND c.status='1'";
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
        $sql = "INSERT INTO tarifas(codigoProducto, tarifa, idListaPrecio)VALUES('" . $t->getIdProducto() . "','" . $t->getTarifa() . "','" . $t->getIdListaPrecio() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    function guardarProducto(Producto $p, Costo $c, Tarifa $t) {

        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cont = 0;
        $sql = "SET AUTOCOMMIT=0;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "BEGIN;";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "INSERT INTO existencias(cantidad,codigoProducto)VALUES('0','" . $p->getCodigoProducto() . "')";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $sql = "INSERT INTO productos(producto, idMarca, idProveedor, codigoProducto,cantidadMaxima, cantidadMinima,idGrupoProducto, idUnidadMedida,idStatus)VALUES('" . $p->getProducto() . "','" . $p->getIdMarca() . "','" . $p->getIdProveedor() . "', '" . $p->getCodigoProducto() . "', '" . $p->getCantidadMaxima() . "', '" . $p->getCantidadMinima() . "', '" . $p->getIdGrupoProducto() . "', '" . $p->getIdUnidadMedida() . "','1')";
        $resultado = mysql_query($sql, $cn->Conectarse());

        $id = mysql_insert_id();
        $fecha = date("d/m/Y h:i");
        $sql = "INSERT INTO costos(costo, codigoProducto,fechaMovimiento, status)VALUES('" . $c->getCosto() . "','" . $p->getCodigoProducto() . "','$fecha','1')";
        $resultado = mysql_query($sql, $cn->Conectarse());
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
                            $sql = "INSERT INTO tarifas(codigoProducto, porcentaUtilidad, idListaPrecio, idStatus,tarifa,fechaMovimientoTarifa)VALUES('" . $p->getCodigoProducto() . "','$tarifa','$listaPrecio','1','$pieces[0]','$fecha')";
                            $resultado = mysql_query($sql, $cn->Conectarse());
                            $cont = 0;
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
        $sql = "SELECT p.producto, m.marca, pr.nombre, c.costo, p.codigoProducto, p.idProducto,c.fechaMovimiento, e.cantidad, p.cantidadMinima, p.cantidadMaxima, p.idMarca, p.idProveedor, p.idGrupoProducto, g.grupoProducto \n"
                . "FROM productos p\n"
                . "INNER JOIN marcas m ON p.idMarca = m.idMarca\n"
                . "INNER JOIN proveedores pr ON pr.idProveedor = p.idProveedor\n"
                . "INNER JOIN costos c ON c.codigoProducto = p.codigoProducto\n"
                . "INNER JOIN existencias e ON e.codigoProducto = p.codigoProducto\n"
                . " INNER JOIN grupoProductos g ON g.idGrupoProducto = p.idGrupoProducto where status=1 and p.idStatus = '1'";

        $datos = mysql_query($sql, $cn->Conectarse());
//        while ($rs = mysql_fetch_array($dato)) {
//            $id = $rs[1];
//        }

        return $datos;
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
//        $MySQLExistencias = "INSERT INTO existencias (cantidad, idSucursal, codigoProducto) VALUES ('" . $entradas->getCantidad() . "','1', '" . $entradas->getCodigoProducto() . "')";

        $mysqlUpdateExistencias = "UPDATE existencias set cantidad = '" . $entradas->getCantidad() . "' WHERE codigoProducto='" . $entradas->getCodigoProducto() . "' and idSucursal ='0'";


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
        $sql = "SELECT p.codigoProducto, p.producto FROM PRODUCTOS p\n"
                . " INNER JOIN proveedores pr on pr.idProveedor = p.idProveedor\n"
                . " WHERE pr.rfc='$rfc'";
        $datos = mysql_query($sql, $cn->Conectarse());
        return $datos;
    }

    function obtieneDireccionDeProveedor($id) {
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $sql = "SELECT d.calle, d.numeroExterior, d.numeroInterior, d.cruzamientos, c.cp, c.asenta, c.municipio, c.estado, c.ciudad FROM direcciones d "
                . " INNER JOIN cpostales c on c.idcpostales = d.idcpostales"
                . " WHERE d.idDireccion = '$id'";
        mysql_set_charset('utf8');
        $datos = mysql_query($sql, $cn->Conectarse());
        mysql_set_charset('utf8');
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
               and pr.idProveedor='" . $proveedor . "';";
        $rs = mysql_query($MySQL, $cn->Conectarse());
        $cn->cerrarBd();
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
            return $valor;
        }
    }

    function MiniGuardadorSalidas(Encabezado $encabezadoSalida, $arrayDetalleSalida, $lafecha) {
        $detalle = new Detalle();
        //Guardar encabezado salida
        $sqlEncabezadoGuardar = "INSERT INTO facturaencabezados (fechaEncabezado, subtotalEncabezado, totalEncabezado, rfcEncabezado, folioEncabezado, fechaMovimiento, idTipoMovimiento)"
                . " VALUES ('" . $encabezadoSalida->getFecha() . "','" . $encabezadoSalida->getSubtotal() . "','" . $encabezadoSalida->getTotal() . "','" . $encabezadoSalida->getRfc() . "','" . $encabezadoSalida->getFolio() . "','$lafecha','2')";
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
                    . " WHERE codigoProducto = '" . $detalle->getCodigo() . "'";
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
                    . " WHERE codigoProducto = '" . $detalle->getCodigo() . "'";
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

    function superMegaGuardadorEntradas($lafecha, Encabezado $encabezado, $arrayDetalleEntrada, Comprobante $comprobante, $conceptos, $control) {
        $detalle = new Detalle();
        //======================================================================
        //Empieza guardar encabezado
        $sqlEncabezadoGuardar = "INSERT INTO facturaencabezados (fechaEncabezado, subtotalEncabezado, totalEncabezado, rfcEncabezado, folioEncabezado, fechaMovimiento, idTipoMovimiento)"
                . " VALUES ('" . $encabezado->getFecha() . "','" . $encabezado->getSubtotal() . "','" . $encabezado->getTotal() . "','" . $encabezado->getRfc() . "','" . $encabezado->getFolio() . "','$lafecha','1')";
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
            $sqlConceptoGuardar = "INSERT INTO xmlconceptos (unidadMedidaConcepto, importeConcepto, cantidadConcepto, codigoConcepto, descripcionConcepto, precioUnitarioConcepto, idXmlComprobante, cdaConcepto, desctUnoConcepto, desctDosConcepto)"
                    . " VALUES ('" . $detalle->getUnidadmedida() . "','" . $cpto->importe . "','" . $detalle->getCantidad() . "','" . $cpto->codigo . "','" . $detalle->getDescripcion() . "','" . $detalle->getCosto() . "','$idComprobante','" . $cpto->cda . "','" . $cpto->desctuno . "','" . $cpto->desctdos . "')";
            $ctrlConceptoGuardar = mysql_query($sqlConceptoGuardar);
            if ($ctrlConceptoGuardar == false) {
                mysql_query("ROLLBACK;");
                return false;
            }
            //Terminar guardar xml concepto
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

                $totalViejo = $cantidad * $costoViejo;
                $totalNuevo = $cpto->cda * $detalle->getCantidad();

                $totalFinal = $totalViejo + $totalNuevo;
                $cantidadFinal = $cantidad + $detalle->getCantidad();

                $costoPromedio = $totalFinal / $cantidadFinal;

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
            }
            //Terminar guardar entrada
        }//Cierre FOR
        mysql_query("COMMIT;");
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
        $sql = "INSERT INTO usuarios (usuario, nombre, apellidoPaterno, apellidoMaterno, password, idtipousuario, idSucursal, idStatus)"
                . "VALUES ('" . $usuario->getUsuario() . "','" . $usuario->getNombre() . "','" . $usuario->getPaterno() . "','" . $usuario->getMaterno() . "','" . $usuario->getPass() . "','" . $usuario->getTipousuario() . "','$idsucursal','1')";
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
        $sql = "UPDATE usuarios SET usuario='" . $usuario->getUsuario() . "', nombre='" . $usuario->getNombre() . "', apellidoPaterno='" . $usuario->getPaterno() . "', apellidoMaterno='" . $usuario->getMaterno() . "', password='" . $usuario->getPass() . "', idtipousuario='" . $usuario->getTipousuario() . "' WHERE idUsuario = '$id' & idSucursal = '$idsucursal'";
        $rs = mysql_query($sql, $cn->Conectarse());
        $cn->cerrarBd();
    }

    //==============================================================================
}
