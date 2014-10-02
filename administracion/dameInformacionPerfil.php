<?php
session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
$cn = new coneccion();
$cn->Conectarse();
$dao = new dao();
$usuario = $_SESSION["usuarioSesion"];
$rsDatos = $dao->dameInformacionUsuario($usuario);
$rsDatosCorreo = $dao->dameCorreos($usuario);
if ($rsDatos == false || $rsDatosCorreo == false) {
    echo mysql_error();
} else {
    ?>
    <table class="table">
        <?php
        while ($datosUsuario = mysql_fetch_array($rsDatos)) {
            ?>
            <tr>
                <td>Nombre : </td>
                <td><input class="form-control" type="text" value="<?php echo $datosUsuario["nombre"]; ?>"</td>
                <td></td>
            </tr>
            <tr>
                <td>Usuario : </td>
                <td><input type="text" class="form-control" value="<?php echo $datosUsuario["usuario"]; ?>"</td>
                <td></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Telefonos : </td>
            <td>
                <select class="form-control">
                    <option>Telefonos</option>

                    <?php
                    while ($datosTelefono = mysql_fetch_array($rsDatos)) {
                        ?>
                    <option><?php echo $datosTelefono["telefono"];?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <a title="Actualizar Telefonos">
                    <span style="font-size: 30px" class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
        </tr>
        <tr>
            <td>Correos : </td>
            <td>
                <select class="form-control"> 
                    <option>Correos</option>
                    <?php
                    while ($datosCorreo = mysql_fetch_array($rsDatosCorreo)) {
                        ?>
                        <option><?php echo $datosCorreo["email"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <a title="Actualizar Correos">
                    <span style="font-size: 30px" class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a>Restaurar Password</a>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <?php
}