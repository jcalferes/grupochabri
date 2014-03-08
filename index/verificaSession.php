<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of verificaSession
 *
 * @author Joel
 */
session_start();
class verificaSession {

    function validaSesion() {
        if (isset($_SESSION["usuarioSesion"])) {
            if (isset($_SESSION["tipoSesion"])) {
                
            } else {
                echo "
        <script>
             document.location.href='../index/index.php';
        </script>
         ";
            }
        } else {
            echo "
        <script>
             document.location.href='../index/index.php';
        </script>
         ";
        }
    }

}
