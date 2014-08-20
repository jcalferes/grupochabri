<?php
include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$ruta = "";
$nruta = "";

$cn->Conectarse();
$data = $dao->mostrarSlide();
?>
<div id="slides">
    <?php
    if ($data != false) {
        while ($rs = mysql_fetch_array($data)) {
            $ruta = $rs['ruta'];
            $nruta = str_replace("", "", $ruta);
            echo "<img src='$nruta' class='slidesjs-slide' slidesjs-index='0' style='position: absolute; top: 0px; width: 100%; -webkit-backface-visibility: hidden; display: block; z-index: 10; left: 0px;'/>";
        }
    }
    ?>
    <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
    <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
</div>
