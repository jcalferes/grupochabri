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
//
//        return $link;
//    }
//    function cerrarBd() {
//        mysql_close();
//    }
    function Conectarse() {
        if (!($link = mysql_connect("mysql.GrupoChabri.mx", "residencia", "GrupoChabri"))) {
            echo "Error conectando a la base de datos.";
            exit();
        }
        if (!mysql_select_db("chabri", $link)) {
            echo "Error seleccionando la base de datos.";
            exit();
        }

        return $link;
    }

    function cerrarBd() {
        mysql_close();
    }

}
