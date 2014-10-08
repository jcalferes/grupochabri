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
$rsDatosTelefono = $dao->dameTelefonos($usuario);
?>
<table class="table">
    <?php
    if ($rsDatos == false || $rsDatosCorreo == false || $rsDatosTelefono == false) {
        echo '<tr><td>';
        echo mysql_error();
        echo '</td></tr>';
    } else {
        ?>
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
                <input type="text" id="txtTelefono" class="form-control"/>
                <select class="form-control" id="cmbTelefonos">
                    <option value="0">Telefonos</option>

                    <?php
                    while ($datosTelefono = mysql_fetch_array($rsDatosTelefono)) {
                        ?>
                        <option value="<?php echo $datosTelefono["idTelefonos"]; ?>"><?php echo $datosTelefono["telefono"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <a id="btnActualizarTelefono" title="Actualizar telefono" 
                   onclick="guardarActualizacionTelefono();">
                    <span style="font-size: 30px" class="glyphicon glyphicon-refresh"></span>
                </a>
                <a id="btnCancelarTelefono" title="Cancelar actualizacion">
                    <span style="font-size: 30px" class="glyphicon glyphicon-remove-circle"></span>
                </a>
                <a title="Editar Telefonos" 
                   onclick="actualizarTelefono();"
                   id="btnEditarTelefono">
                    <span style="font-size: 30px" class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
        </tr>
        <tr>
            <td>Correos : </td>
            <td>
                <input type="text" id="txtCorreos" class="form-control"/>
                <select class="form-control" id="cmbCorreos"> 
                    <option value="0">Correos</option>
                    <?php
                    while ($datosCorreo = mysql_fetch_array($rsDatosCorreo)) {
                        ?>
                        <option value="<?php echo $datosCorreo["idEmail"] ?>"><?php echo $datosCorreo["email"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <a id="btnActualizarCorreo" title="Actualizar correo" 
                   onclick="guardarActualizacionCorreo();">
                    <span style="font-size: 30px" class="glyphicon glyphicon-refresh"></span>
                </a>
                <a id="btnCancelarCorreo" title="Cancelar actualizacion">
                    <span style="font-size: 30px" class="glyphicon glyphicon-remove-circle"></span>
                </a>
                <a title="Actualizar Correos" id="btnEditarCorreo" onclick="actualizarCorreos();">
                    <span style="font-size: 30px" class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="#" onclick="cambiarPass();" id="lnkGenerarPass">Cambiar Contraseña.</a>
                <input  type="text" 
                        placeholder="Codigo" 
                        id="txtCodigo" 
                        class="form-control"/>
            </td>
            <td><input type="submit" 
                       class="btn" 
                       value="Actualizar" 
                       id="btnActualizarCon"
                       onclick="actualizarContras();"/></td>
            <td></td>
        </tr>
        <tr>
            <td><input id="txtNuevaContraseña" class="form-control" type="password" placeholder="Nueva Contraseña"/></td>
            <td><input id="btnGuardarNuevaConta" onclick="guardarNuevaContra();" type="submit" class="btn btn-primary"/></td>
            <td></td>
        </tr>
    </table>
    <?php
}