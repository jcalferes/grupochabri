<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dao
 *
 * @author Joel
 */
class dao {

    function iniciarSesion(Usuario $usuario) {
        $sql = "SELECT * FROM usuarios WHERE password = '" . $usuario->getPass() . "' AND usuario = '" . $usuario->getUsuario() . "'";
        $control = mysql_query($sql);
        $rs = mysql_affected_rows();
        if ($rs == 0) {
            return 1;
        } else {
            return $control;
        }
    }

//    function verificarMaquina($nombremaquina) {
//        $sql = "SELECT * FROM maquinas WHERE nombreMaquina= '$nombremaquina'";
//        $paso = mysql_query($sql);
//        if ($paso == false) {
//            $valor = mysql_error();
//        }
//        $rs = mysql_affected_rows();
//        if ($rs > 0) {
//            $valor = "VALIDA";
//        } else {
//            $valor = "INVALIDA";
//        }
////        if ($rs < 1) {
////            $valor = "INVALIDA";
////        } else {
////            $valor = "VALIDA";
////        }
//        return $valor;
//    }

    function mostrarSlide() {
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

    function mostarCategorias() {
        $query = "SELECT * FROM grupoproductos";
        $ctrl = mysql_query($query);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            return $ctrl;
        }
    }

    function mostarNovedades() {
        $query = "SELECT * FROM clasificados c "
                . "INNER JOIN imagenes i ON c.codigoProducto = i.codigoProducto "
                . "INNER JOIN productos p ON c.codigoProducto = p.codigoProducto "
                . "WHERE ponerNovedades = '1' AND i.ruta LIKE '%-_-0.%' "
                . "ORDER BY RAND()";
        $ctrl = mysql_query($query);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            return $ctrl;
        }
    }

    function mostarRecomendados() {
        $query = "SELECT * FROM clasificados c "
                . "INNER JOIN imagenes i ON c.codigoProducto = i.codigoProducto "
                . "INNER JOIN productos p ON c.codigoProducto = p.codigoProducto "
                . "WHERE ponerRecomendado = '1' AND i.ruta LIKE '%-_-0.%' "
                . "ORDER BY RAND()";
        $ctrl = mysql_query($query);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            return $ctrl;
        }
    }

    function mostarSubcategorias($idgrupo) {
        $query = "SELECT * FROM tiposproducto t "
                . "INNER JOIN grupoproductos g ON t.idGrupoProducto = g.idGrupoProducto "
                . "WHERE t.idGrupoProducto = '$idgrupo'";
        $ctrl = mysql_query($query);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            return $ctrl;
        }
    }

    function mostarCachibaches($id, $nm) {
        $query = "SELECT * FROM clasificados c "
                . "INNER JOIN tiposproducto t ON  t.idTiposProducto =  c.idTipo "
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = t.idGrupoProducto "
                . "INNER JOIN imagenes i ON i.codigoProducto = c.codigoProducto "
                . "INNER JOIN productos p ON p.codigoProducto = c.codigoProducto "
                . "WHERE t.idGrupoProducto = '$id' AND i.ruta LIKE '%-_-0.%'";
        $ctrl = mysql_query($query);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row > 0) {
                $data[0] = $row;
                $data[1] = $ctrl;
                return $data;
            } else {
                return false;
            }
        }
    }

    function existenciaCachibache($codigo) {
        $query = "SELECT * FROM existencias ex "
                . "INNER JOIN sucursales suc ON ex.idSucursal = suc.idSucursal "
                . "WHERE codigoProducto = '$codigo'";
        $ctrl = mysql_query($query);
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            return $ctrl;
        }
    }

    function filtrarCachibaches($idtipo) {
        $query = "SELECT * FROM clasificados c "
                . "INNER JOIN tiposproducto t ON  t.idTiposProducto =  c.idTipo "
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = t.idGrupoProducto "
                . "INNER JOIN imagenes i ON i.codigoProducto = c.codigoProducto "
                . "INNER JOIN productos p ON p.codigoProducto = c.codigoProducto "
                . "WHERE t.idTiposProducto = '$idtipo' AND i.ruta LIKE '%-_-0.%'";
        $ctrl = mysql_query($query);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row > 0) {
                $data[0] = $row;
                $data[1] = $ctrl;
                return $data;
            } else {
                return false;
            }
        }
    }

    function mostrarDetalles($codigo) {
        $query = "SELECT * FROM clasificados c "
                . "INNER JOIN tiposproducto t ON  t.idTiposProducto =  c.idTipo "
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = t.idGrupoProducto "
                . "INNER JOIN productos p ON p.codigoProducto = c.codigoProducto "
                . "INNER JOIN marcas m ON m.idMarca = p.idMarca "
                . "WHERE c.codigoProducto = '$codigo'";
        $query2 = "SELECT * FROM imagenes WHERE codigoProducto = '$codigo'";
        $ctrl = mysql_query($query);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row > 0) {
                $data[0] = $ctrl;
                $ctrl2 = mysql_query($query2);
                $row2 = mysql_affected_rows();
                if ($ctrl2 == false) {
                    $ctrl2 = mysql_error();
                    return false;
                } else {
                    if ($row2 > 0) {
                        $data[1] = $ctrl2;
                        return $data;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }

    function mostarProductosBusqueda($busqueda) {
        $query = "SELECT  *  FROM clasificados c "
                . "INNER JOIN tiposproducto t ON  t.idTiposProducto =  c.idTipo "
                . "INNER JOIN grupoproductos g ON g.idGrupoProducto = t.idGrupoProducto "
                . "INNER JOIN imagenes i ON i.codigoProducto = c.codigoProducto "
                . "INNER JOIN productos p ON p.codigoProducto = c.codigoProducto "
                . " where concat(c.codigoProducto, c.descripcion) like '%$busqueda%' "
//                . "WHERE t.idGrupoProducto = '$id' 
                . "AND i.ruta LIKE '%-_-0.%'";
        $ctrl = mysql_query($query);
        $row = mysql_affected_rows();
        if ($ctrl == false) {
            $ctrl = mysql_error();
            return false;
        } else {
            if ($row > 0) {
                $data[0] = $row;
                $data[1] = $ctrl;
                return $data;
            } else {
                return false;
            }
        }
    }

}
