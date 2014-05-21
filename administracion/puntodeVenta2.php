<?php ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-barcode"/>&numsp;Entradas Manualmente</h2>
            <section>
                <br>
                <div class="col-sm-3">
                    <div class="input-group" id="panelBusqueda">
                        <input type="text" class="form-control" id="codigoProductoEntradas" placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <button  class="btn btn-default" type="button" title="Buscar" id="btnbuscador">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                </div>
                <br/>
                <hr>
                <br>
                <table class="table" id="tablaVentas">
                    <thead>
                    <th><center>Codigo</center></th>
                    <th><center>Descripcion</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Lst.Precios</center></th>
                    <th><center>Precio</center></th>
                    <th><center>Descuentos</center></th>
                    <th><center>Eliminar</center></th>
                    <th><center>Total</center></th>
                    </thead>
                </table>
                <hr>
                <form class="form-inline text-right">
                    <span>Sub Total : <input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>IVA : <input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Total : <input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
            </section>
        </div>
        <!--MODAL DE BUSQUEDA-->
        <div class="modal fade" id="mdlbuscador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Busqueda de productos</h4>
                    </div>
                    <div class="modal-body">
                        <div id="todos" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type='button' class='btn btn-primary' id='btnver'><span class='glyphicon glyphicon-shopping-cart'></span> Listar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Modal -->
        <!--Modal Granel-->
        <div class="modal fade" 
             id="mdlGranel" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="myModalLabel" 
             aria-hidden="true" >
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Productos. Granel</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputEmail3" 
                                       class="col-sm-4 control-label">
                                    Cantidad:
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="kg"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" 
                                       class="col-sm-4 control-label">
                                    Pesos:
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="$0.00 mxn."/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-primary' 
                                id='btnGranel'>
                            <span class='glyphicon glyphicon-shopping-cart'>
                            </span> Listar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--final modalGranel-->
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../administracion/administracion.js/buscador.js"></script>
        <script src="administracion.js/Ventas.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
