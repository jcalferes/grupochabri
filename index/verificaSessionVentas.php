<?php

session_start();

class verificaSession {

    function validaSesion() {
        if (isset($_SESSION["usuarioSesion"])) {
            if (isset($_SESSION["tipoSesion"])) {
                if ($_SESSION["tipoSesion"] == 3 || $_SESSION["tipoSesion"] == 4) {
                    
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
        } else {
            echo "
                    <script>
                        document.location.href='../index/index.php';
                    </script>
                 ";
        }
    }

}
