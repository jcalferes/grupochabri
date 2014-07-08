<?php

class coneccion {

//    function Conectarse() {
//        if (!($link = mysql_connect("localhost", "root", ""))) {
//            echo "Error conectando a la base de datos.";
//            exit();
//        }
//        if (!mysql_select_db("maderasoriente", $link)) {
//            echo "Error seleccionando la base de datos.";
//            exit();
//        }
//        return $link;
//    }
//
//    function cerrarBd() {
//        mysql_close();
//    }

//    function Conectarse() {
//        if (!($link = mysql_connect("mysql.pcoriente.com.mx", "residencia", "GrupoChabri"))) {
//            $link = "Error conectando a la base de datos.";
//            echo "Error conectando a la base de datos.";
//            exit();
//        }
//        if (!mysql_select_db("maderasoriente", $link)) {
//            echo "Error seleccionando la base de datos.";
//            exit();
//        }
//        return $link;
//    }
//
//    function cerrarBd() {
//        mysql_close();
//    }

//        function Conectarse() {
//        if (!($link = mysql_connect("gpomoal.com", "gpomoal", "1943+1947"))) {
//            $link = "Error conectando a la base de datos.";
//            echo "Error conectando a la base de datos.";
//            exit();
//        }
//        if (!mysql_select_db("gpomoal_maderasoriente", $link)) {
//            echo "Error seleccionando la base de datos.";
//            exit();
//        }
//        return $link;
//    }
//
//    function cerrarBd() {
//        mysql_close();
//    }
    function Conectarse() {
        if (!($link = mysql_connect("50.62.160.143", "administrador", "Darias65"))) {
            echo "Error conectando a la base de datos.";
            exit();
        }
        if (!mysql_select_db("grupochabri", $link)) {
            echo "Error seleccionando la base de datos.";
            exit();
        }
        return $link;
    }

    function cerrarBd() {
        mysql_close();
    }
}
