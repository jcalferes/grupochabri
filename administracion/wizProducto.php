<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de productos</h2>
            <section class="scrollSection">
                <div id="consultaProducto" style="margin-left: 5%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus" />&numsp;Nuevo producto</h2>
            <section class="scrollSection">
                <div style="margin: 0% 25% 0% 25%">
                    <form id="formularioProductos">
                        <div id="formulario"> 
                            <div class="form-group">
                                <label>Codigo Producto</label>
                                <input type="text" class="form-control valLetra" id="txtCodigoProducto" placeholder="Código del Producto">
                            </div>
                            <div class="form-group"  >
                                <label>Nombre:</label>
                                <input type="text" class="form-control valLetra" id="txtNombreProducto" placeholder="Nombre del producto">
                            </div>
                            <div class="form-group">
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
                                <input type="number" class="form-control  valNum" id="txtCostoProducto" placeholder="Costo del Producto" onkeypress="return NumCheck(event, this);" onpaste="return false">
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
                                    <input type="number" class="form-control  valNum" id="txtCantidadMinima" placeholder="Cantidad MInima" onkeypress="return NumCheck(event, this);" onpaste="return false" >
                                </div>
                                <div class="form-group">
                                    <label>Cantidad Maxima</label>
                                    <input  type="number" class="form-control valNum" id="txtCantidadMaxima" placeholder="Cantidad Maxima" onkeypress="return NumCheck(event, this);" onpaste="return false" >
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
                        </div>
                    </form>

                    <!--                    <div id="textos">
                                            <input type="number" placeholder="Tarifa" class="form-control" /> <br/>
                                            <input type="submit" value="atras" class="btn btn-primary" id="anterior"/></br>
                                            <input type="submit" value="guardar" class="btn btn-primary" id="guardarDatos"/>
                                            </div>-->
                    <div id="mostrarDivProveedor">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" id="txtnombreproveedor" placeholder="Ingrese el nombre del proveedor">
                        </div>
                        <div class="form-group">
                            <label>Direccion:</label>
                            <input id="muestramdldireccion" class="btn btn-sm btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion" value="+"/>
                        </div>
                        <div class="form-group">
                            <label>RFC:</label>
                            <input type="text" class="form-control" id="txtrfc" placeholder="Ingrese el RFC del proveedor">
                        </div>
                        <div class="form-group">
                            <label>Dias de credito:</label>
                            <input id="txtdiascredito" type="number" class="form-control"  placeholder="Ingrese los dias de credito">
                        </div>
                        <div class="form-group">
                            <label>Descuento:</label>
                            <input id="txtdescuento" type="number" class="form-control"  placeholder="Ingrese el descuento">
                        </div>
                            <!--<input id="btncanceloProvedor" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>-->
                        <input id="btncancelarproveedor" type="button" class="btn btn-primary"  data-dismiss="modal" value="Cancelar"/>
                        <input id="btnguardarproveedor" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
                    </div>  
                </div>
                <!--<input type="submit" onclick="eliminar(4)"/>-->
            </section>
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de productos</h2>
            <section class="scrollSection">
                <div id="consultaTarifas" style="margin-left: 5%">
                    <select id="selectTarifa" style="width: 90%; height: 35px">
                    </select>
                    <div id="tablaTarifas" style="margin-left: 5%">

                    </div>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Entrada de Productos</h2>
            <section>
                <div id="entradaProducto" style="margin-left: 5%">
                    <select id="selectProducto" style="width: 90%; height: 35px">
                    </select><br/>
                    <h4 id="existencia">Hay en existencia=</h4>
                    <input type="number" id="txtEntradaProducto" placeholder="Ingrese Cantidad a Entrar" style="width: 90%; height: 35px"/><br/>
                    <input type="submit" id="AgregarEntrada" class="btn btn-primary"/>
                </div>
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
                        <h4 class="modal-title" id="myModalLabel">Nueva Direccion</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Calle:</label>
                                <input type="text" class="form-control" id="txtcalle" placeholder="Ingrese el numero de calle">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero Exterior:</label>
                                <input type="text" class="form-control" id="txtnumeroexterior"  maxlength="15" placeholder="Ingrese el numero exterior">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Numero Interior:</label>
                                <input type="text" class="form-control" id="txtnumerointerior"  maxlength="15" placeholder="Ingrese el numero interior">
                            </div>                          
                            <div class="form-group ">
                                <label>Cruzamientos:</label>
                                <input id="txtcruzamientos" type="text" class="form-control"  maxlength="15" placeholder="Ingrese los cruzameintos">
                            </div>
                            <div class="form-group">
                                <label>Codigo Postal:</label>
                                <input id="txtpostal" type="number" class="form-control" min="0" onchange="verficaPostal()" placeholder="Ingrese el codigo postal" style="width: 30%">
                            </div>
                            <div class="form-group ">
                                <label>Colonia:</label>
                                <select id="selectColonia" style="width: 100%; height: 35px">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ciudad:</label>
                                <input id="txtciudad" type="text" class="form-control"  placeholder="Ingrese la colonia">
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <input id="txtestado" type="text" class="form-control"  placeholder="Ingrese la colonia">
                            </div>
                            <div class="modal-footer">
                                <input id="canceloDireccion" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input  id="btnguardardireccion" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
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
                                <input id="editarTarifas" type="button" class="btn btn-default" value="Editar"/>
                                <input id="cancelo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="guardarTarifas" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" disabled/>
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
