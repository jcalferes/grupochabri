<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de proveedores</h2>
            <section class="scrollSection">
                <div id="consultaProveedor">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo proveedor</h2>
            <section class="scrollSection">
                <form name="formProveedor" style="margin: 0% 25% 0% 25%">

                    <div class="radio-inline" >
                        <label>
                            <input type="radio" name="tipo" id="fisica" value="FISICA" onclick="focusRFC();" checked>
                            Fisica
                        </label>
                    </div>
                    <div class="radio-inline" >
                        <label>
                            <input type="radio" name="tipo" id="moral" onclick="focusRFC();" value="MORAL">
                            Moral
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
                        <input id="muestramdldireccion" class="btn btn-sm btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion" value="+"/>
                    </div>
                    <div id="frmemail" class="form-group">
                        <label>E-mail:</label>
                        <input id="txtemail" type="email" class="form-control" onblur="validaEmail();">
                    </div>
                    <div class="form-group">
                        <label>Dias de credito:</label>
                        <input id="txtdiascredito" type="number" class="form-control" onpaste="return false">
                    </div>
                    <div class="form-group form-inline">
                        <label>Desct. Factura:</label>
                        <input id="txtdesctpf" type="number" class="form-control" style="width: 24%" onpaste="return false">
                        <label>Desct. Pronto Pago:</label>
                        <input id="txtdesctpp" type="number" class="form-control" style="width: 24%" onpaste="return false">
                        
                    </div>
                        <!--<input id="btncanceloProvedor" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>-->
                    <input id="btnguardarproveedor" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
                    <input id="btneditarproveedor" type="button" class="btn btn-primary"  data-dismiss="modal" value="Editar"/>

                </form>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="mdlDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nueva Direccion Fiscal</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Calle:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtcalle" placeholder="Ingrese el numero de calle">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero Exterior:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtnumeroexterior"  maxlength="15" placeholder="Ingrese el numero exterior">
                            </div>
                            <div class="form-group col-lg-6">












                                <label>Numero Interior:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtnumerointerior"  maxlength="15" placeholder="Ingrese el numero interior">
                            </div>
                            <div class="form-group ">
                                <label>Cruzamientos:</label>
                                <input id="txtcruzamientos" name="direccion" type="text" class="form-control direccion"  maxlength="15" placeholder="Ingrese los cruzamientos">
                            </div>
                            <div class="form-group">
                                <label>Codigo Postal:</label>
                                <input id="txtpostal" name="direccion" type="number" class="form-control direccion" min="0" onchange="verficaPostal()" placeholder="Ingrese el codigo postal" style="width: 30%" onpaste="return false">
                            </div>
                            <div class="form-group ">
                                <label>Colonia:</label>
                                <select id="selectColonia" name="direccion" class="form-control direccion" style="width: 100%; height: 35px">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ciudad:</label>
                                <input id="txtciudad" type="text" name="direccion" class="form-control direccion"  placeholder="Ingrese la colonia">
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <input id="txtestado" type="text" name="direccion" class="form-control direccion"  placeholder="Ingrese la colonia">
                                <param id="extra" value="">
                            </div>
                            <div class="modal-footer">
                                <input id="canceloDireccion" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardardireccion" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
                                 <input id="btneditardireccion" type="button" class="btn btn-primary"  data-dismiss="modal" value="Editar"/>
                                

                                <input type="button" id="botonNinja" class="btn btn-primary"  data-dismiss="modal" value="NInja" onclick="verficaPostal2()">
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Modal -->
        <div class="modal fade" id="mdlverdireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ver direccion</h4>
                    </div>
                    <div class="modal-body">
                        <div id="verdireccion">
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
        <script src="../administracion/administracion.js/proveedor.js"></script>
        <script src="../administracion/administracion.js/direccion.js"></script>
    </body>
</html>