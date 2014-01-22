<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de productos</h2>
            <section>
                <div id="consultaProducto" style="margin-left: 5%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo producto</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div id="formulario"> 
                        <div class="form-group"  >
                            <label>Nombre:</label>
                            <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" >
                        </div>
                        <div class="form-group">
                            <label>Codigo Producto</label>
                            <input type="text" class="form-control" id="txtCodigoProducto" placeholder="Código del Producto" >
                        </div>
                        <div class="form-group">
                            <label>Marca:</label><br>
                            <select id="selectMarca" style="width: 90%; height: 35px">
                            </select>
                            <input type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#mdlMarca" value="+">
                        </div>
                        <div class="form-group">
                            <label>Proveedor:</label><br>
                            <select id="selectProveedor" style="width: 90%; height: 35px">
                            </select>
                            <input type="button" class="btn btn-primary" value="+" id="agregarProveedor">
                        </div>
                        <!--                    <div class="form-group">
                                                <label>Lista de Precios:</label><br>
                                                <select id="selectListaPrecios" style="width: 100%; height: 35px">
                                                </select>
                                            </div>-->
                        <input type="button" class="btn btn-primary" value="Next" id="guardarDatos"/>
                    </div>
                    
                    <div id="checarListas">
                        <select id="selectTarifa" style="width: 90%; height: 35px">
                            
                            </select>                                       

                    </div>
<!--                    <div id="textos">
                        <input type="number" placeholder="Tarifa" class="form-control" /> <br/>
                        <input type="submit" value="atras" class="btn btn-primary" id="anterior"/></br>
                        <input type="submit" value="guardar" class="btn btn-primary" id="guardarDatos"/>
                        </div>-->
                    <div id="mostrarDivProveedor">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="txtnombreproveedor" placeholder="Ingrese el nombre del proveedor">
                            </div>
                            <div class="form-group">
                                <label>Direccion:</label>
                                <button id="muestramdldireccion" class="btn btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion">+</button>
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
                            <div class="modal-footer">
                                <input id="btncanceloProvedor" type="button"  value="Cancelar"/>
                                <input id="btnguardarproveedor" type="button" value="Guardar"/>
                            </div>
                        </div>
                    </div>  

                </form>
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
                            <div class="form-group">
                                <label>Numero Exterior:</label>
                                <input type="text" class="form-control" id="txtnumeroexterior" placeholder="Ingrese el numero exterior">
                            </div>
                            <div class="form-group">
                                <label>Numero Interior:</label>
                                <input type="text" class="form-control" id="txtnumerointerior" placeholder="Ingrese el numero interior">
                            </div>
                            <div class="form-group">
                                <label>Codigo Postal:</label>
                                <input id="txtpostal" type="number" class="form-control"  placeholder="Ingrese el codigo postal">
                            </div>
                            <div class="form-group">
                                <label>Colonia:</label>
                                <input id="txtcolonia" type="text" class="form-control"  placeholder="Ingrese la colonia">
                            </div>
                            <div class="modal-footer">
                                <input id="canceloDireccion" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardardireccion" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
                            </div>



                            <script src="../administracion/administracion.js/controlWizard.js"></script>
                            <script src="../utilerias/validCampoFranz.js"></script>
                            <script src="../administracion/administracion.js/producto.js"></script>
                            <script src="../administracion/administracion.js/marca.js"></script>
                            <script src="../administracion/administracion.js/proveedor.js"></script>
                            <script src="../administracion/administracion.js/direccion.js"></script>
                            </body>
                            </html>
