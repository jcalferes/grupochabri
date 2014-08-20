<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de clientes</h2>
            <section style="width: 100%">
                <div id="consultaCliente">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo cliente</h2>
            <section class="scrollSection">
                <form name="formProveedor" style="margin: 0% 25% 0% 25%">
                    <div id="frmtipo" class="form-group">
                        <label>Tipo:</label><br>
                        <label class="radio-inline" >
                            <span>
                                <input type="radio" name="tipo" id="fisica" value="FISICA" onclick="focusRFC();" checked/>
                                Fisica
                            </span>
                        </label>
                        <label class="radio-inline" >
                            <span>
                                <input type="radio" name="tipo" id="moral" onclick="focusRFC();" value="MORAL"/>
                                Moral
                            </span>
                        </label>
                    </div>
                    <div id="frmrfc" class="form-group">
                        <label>RFC:</label>
                        <input type="text" class="form-control" id="txtrfc" onblur="validaRfc();">
                    </div>
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="txtnombreproveedor">
                    </div>
                    <div class="form-group">
                        <label>Direccion Fiscal:</label>
                        <input id="muestramdldireccion" class="btn btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion" value="Agregar direccion"/>
                    </div>
                    <div id="frmtel" class="form-group">
                        <label>Telefono:</label>
                        <button id="btnvertele" type="button" disabled="false" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-earphone"></span> Ver telefonos</button>
                        <input id="btnotrotel" type="button" class="btn btn-default btn-xs" value="+">
                        <input id="txttel" type="email" class="telefono form-control" onblur="" style="width: 50%">
                        <div id="mastels">
                        </div>
                    </div>
                    <div id="frmemail" class="form-group">
                        <label>E-mail:</label>
                        <button id="btnveremail" type="button" disabled="false" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-envelope"></span> Ver E-mails</button>
                        <input id="btnotroemail" type="button" class="btn btn-default btn-xs" value="+">
                        <input id="txtemail" type="email" class="email form-control" onblur="validaEmail();" style="width: 50%">
                        <div id="masemails">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Credito:</label>
                        <input id="txtcredito" type="number" class="form-control" style="width: 50%" onpaste="return false">
                    </div>
                    <div class="form-group">
                        <label>Dias de credito:</label>
                        <input id="txtdiascredito" type="number" class="form-control" style="width: 50%" onpaste="return false">
                    </div>
                    <div class="form-group form-inline">
                        <label>Desct. Factura:</label>
                        <input id="txtdesctpf" type="number" class="form-control" style="width: 20%" onpaste="return false">
                        <label>Desct. Pronto Pago:</label>
                        <input id="txtdesctpp" type="number" class="form-control" style="width: 20%" onpaste="return false">
                    </div>
                    <div id="contra" class="form-group">
                        <label>Usuario</label>
                        <input id="txtcuser" type="text" class="form-control" style="width: 50%">
                        <label>Contraseña:</label>
                        <input id="txtcpass" type="password" class="form-control" style="width: 50%">
                        <label>Repetir contraseña:</label>
                        <input id="txtcrepass" type="password" class="form-control" style="width: 50%">
                    </div>
                    <input id="btnguardarproveedor" type="button" class="btn btn-cprimary"  value="Guardar"/>
                    <input id="btneditarproveedor" type="button" class="btn btn-cprimary"  value="Editar"/>
                </form>
            </section>
            <h2><span class="glyphicon glyphicon-stats"/>&numsp;Deudores</h2>
            <section >
                <table class="table">
                    <thead>
                    <th><label style="font-size: large">Credito otorgado: $</label><span id="deudorescreditototal" style="font-size: large"><b>:P</b></span></th>
                    <th><label style="font-size: large">Abonos: $</label><span id="deudoresabonostotal" style="font-size: large"><b>:P</b></span></th>
                    <th><label style="font-size: large">Saldo total: $</label><span id="deudoressaldototal" style="font-size: large"><b>:P</b></span></th>
                    </thead>
                </table>
                <div id="consultadeudores">
                </div>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="mdlDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                        <h4 class="modal-title" id="myModalLabel">Nueva Direccion Fiscal</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Calle:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtcalle">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero Exterior:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtnumeroexterior"  maxlength="15">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero Interior:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtnumerointerior"  maxlength="15">
                            </div>
                            <div class="form-group ">
                                <label>Cruzamientos:</label>
                                <input id="txtcruzamientos" name="direccion" type="text" class="form-control direccion"  maxlength="15">
                            </div>
                            <div class="form-group form-inline">
                                <label>Codigo Postal:</label><br>
                                <input id="txtpostal" name="direccion" type="number" class="form-control direccion" min="0"  style="width: 30%" onpaste="return false">
                                <button type="button" class="btn btn-default" value="Buscar" id="Buscar"><span class="glyphicon glyphicon-screenshot"></span></button>
                            </div>
                            <div class="form-group ">
                                <label>Colonia:</label>
                                <input type="text" id="BuscarCodigo" class="form-control" list="selectColonia" style="width: 50%"/>
                                <datalist id="selectColonia">
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Ciudad:</label>
                                <input id="txtciudad" type="text" name="direccion" class="form-control direccion" style="width: 50%"/>
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <input id="txtestado" type="text" name="direccion" class="form-control direccion" style="width: 50%"/>
                                <param id="extra" value="">
                            </div>
                            <div class="modal-footer">
                                <input id="canceloDireccion" type="button" class="btn btn-default" value="Cancelar"/>
                                <input id="btnguardardireccionproveedor" type="button" class="btn btn-cprimary" value="Guardar"/>
                                <input id="btneditardireccionproveedor" type="button" class="btn btn-cprimary"  value="Confirmar"/>
                                <input type="button" id="botonNinja" class="btn btn-cprimary"  data-dismiss="modal" value="NInja" onclick="verficaPostal2()">
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="mdltelefonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Contacto - Telefono</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div id="lugartelefonos">
                                <div class='table-responsive'>
                                    <table class='table table-hover' id="tbltelefonos">
                                        <thead><th>Numero</th><th></th></thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="mdlemails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Contacto - Email</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <table class='table table-hover' id="tblemails">
                                <thead><th>Email</th><th></th></thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="mdlverdireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Detalle de la direccion</h4>
                    </div>
                    <div class="modal-body">
                        <div id="verdireccion">
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="mdlverabonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Detalle de abonos</h4>
                    </div>
                    <div class="modal-body">
                        <div id="tblabonos">
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
        <script src="../administracion/administracion.js/clientes.js"></script>
        <script src="../administracion/administracion.js/direccion.js"></script>
    </body>
</html>

