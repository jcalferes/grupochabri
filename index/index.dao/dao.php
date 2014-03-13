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
        $sql = "SELECT nombre, idTipoUsuario, idSucursal FROM usuarios WHERE password = '" . $usuario->getPass() . "' AND usuario = '" . $usuario->getUsuario() . "'";
        $control = mysql_query($sql);
        $rs = mysql_affected_rows();
        if ($rs == 0) {
            return 1;
        } else {
            return $control;
        }
    }

    function verificarMaquina($nombremaquina) {
        $sql = "SELECT * FROM maquinas WHERE nombreMaquina= '$nombremaquina'";
        mysql_query($sql);
        $rs = mysql_affected_rows();
        if ($rs < 1) {
            return "INVALIDA";
        } else {
            return "VALIDA";
        }
    }

}
