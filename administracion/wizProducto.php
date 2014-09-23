<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Tabla de productos</h2>
            <section style="width: 100%">
                <div id="consultaProducto" ></div>
            </section>
            <h2><span class="glyphicon glyphicon-plus" />&numsp;Nuevo producto</h2>
            <section class="scrollSection">
                <div style="margin: 0% 25% 0% 25%">
                    <form id="formularioProductos">
                        <div id="formulario">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="chkgranel" onclick="nuevogranel();"> Es un producto a granel
                                    </label>
                                </div>
                            </div>
                            <div id="wellfinder" class="well well-sm">
                                <label>Burcar por codigo/codigo de barras:</label>
                                <input type="text" class="form-control" id="finder" />
                            </div>
                            <div class="form-group" id="frmcbarras">
                                <label>Codigo de barras:</label>
                                <input type="text" class="form-control valLetra" style="width: 60%" id="txtCodigoBarras"/>
                            </div>
                            <div class="form-group" id="frmcodnogranel">
                                <label>Codigo de producto:</label>
                                <input type="text" class="form-control valLetra" style="width: 60%" id="txtCodigoProducto"/>
                            </div>
                            <div class="form-group" id="frmcodgranel">
                                <label>Codigo de producto a granel:</label>
                                <div class="input-group" style="width: 60%">
                                    <input type="text" id="txtCodigoProductoG" class="form-control valLetra">
                                    <span class="input-group-addon">-GR</span>
                                </div>
                            </div>
                            <div id="divgrande">
                                <div class="form-group"  >
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control valLetra" id="txtNombreProducto"/>
                                </div>
                                <div class="form-group form-inline">
                                    <label>Unidad de medida:</label><br/>
                                    <select id="selectMedida" class="selectpicker selectores" data-container="body" data-live-search="true">
                                    </select>
                                </div>
                                <div class="form-group form-inline">
                                    <label>Grupo de producto:</label><br/>
                                    <select id="selectGrupo" style="width: 40%; height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                                    </select>
                                    <input type="button" class="btn btn-cprimary" data-dismiss="modal" data-toggle="modal" data-target="#mdlGrupoProducto" value="+"/>
                                </div>
                                <div id="divm3">
                                    <label>Calculador de M3:</label><br>
                                    <div class="form-group">
                                        <label class="radio-inline" >
                                            <input type="radio" name="tipodato" id="datamili"/>Datos en milimetros
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipodato" id="datacenti"/>Datos en centimetros
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipodato" id="datametr" checked/>Datos en metros
                                        </label>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                        <input type="text" class="form-control" style="width: 75px" onkeypress="return NumCheck(event, this);" id="lm3" placeholder="Largo"/>
                                        <label>x</label>
                                        <input type="text" class="form-control" style="width: 75px" onkeypress="return NumCheck(event, this);" id="am3" placeholder="Ancho"/>
                                        <label>x</label>
                                        <input type="text" class="form-control" style="width: 75px" onkeypress="return NumCheck(event, this);" id="alm3" placeholder="Altura"/>
                                        <button type="button" class="btn btn-cprimary" id="btncm3">Calcular</button>
                                    </div>
                                    <label>M3:</label><br>
                                    <input type="text" class="form-control" onkeypress="return NumCheck(event, this);" id="m3"/>
                                </div>
                                <div class="form-group" id="frmcostopieza">
                                    <label>Costo de la pieza</label>
                                    <input type="text" class="form-control  valNum" id="txtCostoPieza" onkeypress="return NumCheck(event, this);"  onpaste="return false"/>
                                </div>
                                <div class="form-group" id="frmcontenido">
                                    <label>Contenido</label>
                                    <div  class="input-group" style="width: 60%">
                                        <input type="text" id="txtContenido" class="form-control valLetra" onkeypress="return NumCheck(event, this);">
                                        <span class="input-group-addon">Lt/Kg</span>
                                    </div>
                                    <input type="text" id="respaldaExistencia" hidden/>
                                </div>
                                <div class="form-group">
                                    <label>Costo producto</label>
                                    <input type="text" class="form-control  valNum" id="txtCostoProducto" onkeyup="obtenerUtilidadCosto();" onkeypress="return NumCheck(event, this);"  onpaste="return false"/>
                                </div>
                                <div class="form-group">
                                    <div class="form-group form-inline">
                                        <label>Marca:</label><br>
                                        <select id="selectMarca" style=" height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                                        </select>
                                        <input type="button" class="btn btn-cprimary" data-dismiss="modal" data-toggle="modal" data-target="#mdlMarca" value="+"/>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label>Proveedor:</label><br>
                                        <select id="selectProveedor" style=" height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                                        </select>
                                        <input  type="button" class="btn btn-cprimary" value="+" id="agregarProveedor"/>
                                    </div>
                                    <div class="form-group" id="frmcantmin">
                                        <label>Cantidad minima</label>
                                        <input type="text" class="form-control  valNum" id="txtCantidadMinima"  onkeypress="return NumCheck(event, this);" onpaste="return false" />
                                    </div>
                                    <div class="form-group" id="frmcantmax">
                                        <label>Cantidad maxima</label>
                                        <input  type="text" class="form-control valNum" id="txtCantidadMaxima"  onkeypress="return NumCheck(event, this);" onpaste="return false" />
                                    </div>
                                    <div class="form-group" >
                                        <label>Lista precio:</label><br>
                                        <div  id="tablaListaPrecios" >

                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <input type="button" class="btn btn-cprimary" value="Guardar producto" id="guardarDatos"/>
                            <input type="button" class="btn btn-cprimary" value="Editar producto" id="editarDatos"/>
                            <input type="button" class="btn btn-cprimary" value="Guardar producto a granel" id="guardarGranel"/>
                            <input type="button" class="btn btn-cprimary" value="Editar producto a granel" id="editarGranel"/>
                            <input type="button" class="btn btn-default" value="Limpiar formulario" id="limpiarFormProd"/>
                            <input type="button" class="btn btn-default" value="Cancelar" id="limpiargranel"/>
                        </div>
                    </form>
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
                                    <input type="radio" name="tipo" id="moral" onclick="focusRFC();" value="MORAL"/>
                                    Moral
                                </label>
                            </div>
                            <div id="frmrfc" class="form-group">
                                <label>RFC:</label>
                                <input type="text" class="form-control" id="txtrfc" onblur="validaRfc();"/>
                            </div>
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="txtnombreproveedor"/>
                            </div>
                            <div class="form-group">
                                <label>Direccion fiscal:</label>
                                <input id="muestramdldireccion" class="btn btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion" value="Agregar direccion"/>
                            </div>
                            <div id="frmtel" class="form-group">
                                <label>Telefono:</label>
                                <button id="btnvertele" type="button" disabled="false" class="btn btn-xs"><span class="glyphicon glyphicon-earphone"></span></button>
                                <input id="btnotrotel" type="button" class="btn btn-xs" value="+"/>
                                <input id="txttel" type="email" class="telefono form-control" onblur="" style="width: 50%"/>
                                <div id="mastels">
                                </div>
                            </div>
                            <div id="frmemail" class="form-group">
                                <label>E-mail:</label>
                                <button id="btnveremail" type="button" disabled="false" class="btn btn-xs"><span class="glyphicon glyphicon-envelope"></span></button>
                                <input id="btnotroemail" type="button" class="btn btn-xs" value="+"/>
                                <input id="txtemail" type="email" class="email form-control" onblur="validaEmail();" style="width: 50%"/>
                                <div id="masemails">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dias de credito:</label>
                                <input id="txtdiascredito" type="number" class="form-control" style="width: 50%" onpaste="return false"/>
                            </div>
                            <div class="form-group form-inline">
                                <label>Desct. Factura:</label>
                                <input id="txtdesctpf" type="number" class="form-control" style="width: 24%" onpaste="return false"/>
                                <label>Desct. Pronto Pago:</label>
                                <input id="txtdesctpp" type="number" class="form-control" style="width: 24%" onpaste="return false"/>
                            </div>

                            <input id="btncanceloProveedor" type="button" class="btn btn-default"   value="Cancelar"/>
                            <input id="btnguardarproveedor" type="button" class="btn btn-cprimary"  value="Guardar"/>
                            <input id="btneditarproveedor" type="button" class="btn btn-cprimary"  value="Editar"/>
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
                        <h4 class="modal-title" id="myModalLabel">Nueva marca</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre de la marca:</label>
                                <input type="text" class="form-control" id="txtnombremarca" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input id="canceloMarca" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input id="btnguardarMarca" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Guardar" />
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
                        <h4 class="modal-title" id="myModalLabel">Nuevo grupo de productos</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> Nombre del grupo de productos:</label>
                                <input type="text" class="form-control" id="txtnombreGrupo" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input id="cancelGrupo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input id="btnGuardarGrupo" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Guardar" />
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
                        <h4 class="modal-title" id="myModalLabel">Nueva direccion fiscal</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Calle:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtcalle">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero exterior:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtnumeroexterior"  maxlength="15">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero interior:</label>
                                <input type="text" name="direccion" class="form-control direccion" id="txtnumerointerior"  maxlength="15">
                            </div>
                            <div class="form-group ">
                                <label>Cruzamientos:</label>
                                <input id="txtcruzamientos" name="direccion" type="text" class="form-control direccion"  maxlength="15">
                            </div>
                            <div class="form-group form-inline">
                                <label>Codigo postal:</label><br>
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
        <div class="modal fade" id="mdlDetalleTarifa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

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
