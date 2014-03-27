<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de productos</h2>
            <section style="width: 100%">
                <div id="consultaProducto" >
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus" />&numsp;Nuevo producto</h2>
            <section class="scrollSection">
                <div style="margin: 0% 25% 0% 25%">
                    <form id="formularioProductos">
                        <div id="formulario"> 
                            <div class="form-group form-inline">
                                <label>Codigo Producto</label>

                                <input type="text" class="form-control valLetra" id="txtCodigoProducto" placeholder="Código del Producto" >
<!--                                <input type="button"  id="btnVerificarCodigo" class="btn btn-primary" value="verificar codigo">-->
                            </div>
                            <!--                             <div class="form-group">
                                                            <label>Folio del producto</label>
                                                            <input type="text" class="form-control valLetra" id="txtFolioProducto" placeholder="Código del Producto">
                                                        </div>-->
                            <div class="form-group"  >
                                <label>Nombre:</label>
                                <input type="text" class="form-control valLetra" id="txtNombreProducto" placeholder="Nombre del producto">
                            </div>
                            <div class="form-group form-inline">
                                <label>Unidad De Medida:</label><br/>

                                <select id="selectMedida" class="selectpicker selectores" data-container="body" data-live-search="true" >

                                </select>

                            </div>
                            <div class="form-group">

                            </div>
                            <div class="form-group form-inline">
                                <label>Grupo de producto:</label><br/>
                                <select id="selectGrupo" style="width: 40%; height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                                </select>
                                <input type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#mdlGrupoProducto" value="+">
                            </div>

                            <div class="form-group">
                                <label>Costo Producto</label>
                                <input type="text" class="form-control  valNum" id="txtCostoProducto" placeholder="Costo del Producto" onkeyup="obtenerUtilidadCosto();" onkeypress="return NumCheck(event, this);"  onpaste="return false">
                            </div>
                            <div class="form-group">
                                <div class="form-group form-inline">
                                    <label>Marca:</label><br>
                                    <select id="selectMarca" style=" height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                                    </select>
                                    <input type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#mdlMarca" value="+">
                                </div>
                                <div class="form-group form-inline">
                                    <label>Proveedor:</label><br>
                                    <select id="selectProveedor" style=" height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                                    </select>
                                    <input  type="button" class="btn btn-primary" value="+" id="agregarProveedor">
                                </div>
                                <div class="form-group">
                                    <label>Cantidad Minima</label>
                                    <input type="text" class="form-control  valNum" id="txtCantidadMinima" placeholder="Cantidad MInima" onkeypress="return NumCheck(event, this);" onpaste="return false" >
                                </div>
                                <div class="form-group">
                                    <label>Cantidad Maxima</label>
                                    <input  type="text" class="form-control valNum" id="txtCantidadMaxima" placeholder="Cantidad Maxima" onkeypress="return NumCheck(event, this);" onpaste="return false" >
                                </div>
                                <div class="form-group">
                                    <label>Lista Precio:</label><br>
                                    <div  id="tablaListaPrecios" >

                                    </div>


                                </div>

                            </div>

                            <!--                    <div class="form-group">
                                                    <label>Lista de Precios:</label><br>
                                                    <select id="selectListaPrecios" style="width: 100%; height: 35px">
                                                    </select>
                                                </div>-->
                            <hr>
                            <input type="button" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
                            <input type="button" class="btn btn-primary" value="Editar" id="editarDatos"/>
                        </div>
                    </form>

                    <!--                    <div id="textos">
                                            <input type="number" placeholder="Tarifa" class="form-control" /> <br/>
                                            <input type="submit" value="atras" class="btn btn-primary" id="anterior"/></br>
                                            <input type="submit" value="guardar" class="btn btn-primary" id="guardarDatos"/>
                                            </div>-->
                    <div id="mostrarDivProveedor">
                        <form name="formProveedor" style="margin: 0% 0% 0% 0%">

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
                                <input id="muestramdldireccion" class="btn btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion" value="Agregar direccion"/>
                            </div>
                            <div id="frmtel" class="form-group">
                                <label>Telefono:</label>
                                <button id="btnvertele" type="button" disabled="false" class="btn btn-xs"><span class="glyphicon glyphicon-earphone"></span></button>
                                <input id="btnotrotel" type="button" class="btn btn-xs" value="+">
                                <input id="txttel" type="email" class="telefono form-control" onblur="" style="width: 50%">
                                <div id="mastels">
                                </div>
                            </div>
                            <div id="frmemail" class="form-group">
                                <label>E-mail:</label>
                                <button id="btnveremail" type="button" disabled="false" class="btn btn-xs"><span class="glyphicon glyphicon-envelope"></span></button>
                                <input id="btnotroemail" type="button" class="btn btn-xs" value="+">
                                <input id="txtemail" type="email" class="email form-control" onblur="validaEmail();" style="width: 50%">
                                <div id="masemails">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dias de credito:</label>
                                <input id="txtdiascredito" type="number" class="form-control" style="width: 50%" onpaste="return false">
                            </div>
                            <div class="form-group form-inline">
                                <label>Desct. Factura:</label>
                                <input id="txtdesctpf" type="number" class="form-control" style="width: 24%" onpaste="return false">
                                <label>Desct. Pronto Pago:</label>
                                <input id="txtdesctpp" type="number" class="form-control" style="width: 24%" onpaste="return false">
                            </div>
                            <input id="btnguardarproveedor" type="button" class="btn btn-primary"  value="Guardar"/>
                            <input id="btneditarproveedor" type="button" class="btn btn-primary"  value="Editar"/>
                        </form>
                    </div>  
                </div>
                <!--<input type="submit" onclick="eliminar(4)"/>-->
            </section>
        </div>
        <div class="modal fade" id="mdlMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nueva Marca</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre de la marca:</label>
                                <input type="text" class="form-control" id="txtnombremarca" placeholder="Ingrese el nombre de la nueva marca">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input id="canceloMarca" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input id="btnguardarMarca" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" />
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="mdlGrupoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Grupo Producto</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> Nombre del grupo de productos:</label>
                                <input type="text" class="form-control" id="txtnombreGrupo" placeholder="Ingrese el nombre del grupo de productos">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input id="cancelGrupo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input id="btnGuardarGrupo" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" />
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
                                <input id="btnguardardireccionproveedor" type="button" class="btn btn-primary" value="Guardar"/>
                                <input id="btneditardireccionproveedor" type="button" class="btn btn-primary"  value="Confirmar"/>
                                <input type="button" id="botonNinja" class="btn btn-primary"  data-dismiss="modal" value="NInja" onclick="verficaPostal2()">
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="mdlDetalleTarifa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" ">

                        <h4 class="modal-title" id="labelTitulo">Tarifas</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="mostrarListaPreciosTarifa">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!--<input id="editarTarifas" type="button" class="btn btn-default" value="Editar"/>-->
                                <input id="cancelo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <!--<input id="guardarTarifas" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" disabled/>-->
                            </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <script src="../administracion/administracion.js/controlWizard.js"></script>
    <script src="../administracion/administracion.js/grupoProducto.js"></script>
    <script src="../utilerias/validCampoFranz.js"></script>
    <script src="../administracion/administracion.js/producto.js"></script>
    <script src="../administracion/administracion.js/marca.js"></script>
    <script src="../administracion/administracion.js/proveedor.js"></script>
    <script src="../administracion/administracion.js/direccion.js"></script>
    <script src="../administracion/administracion.js/tarifas.js"></script>
<!--        <script src="../administracion/administracion.js/selectPickers.js"></script>-->
</body>
</html>
