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
        include_once '../../daoconexion/daoConeccion.php';
        $sql = "SELECT nombre FROM usuarios WHERE password = '" . $usuario->getPass() . "'";
        $cn = new coneccion();
        mysql_query($sql, $cn->Conectarse());
    }

}
