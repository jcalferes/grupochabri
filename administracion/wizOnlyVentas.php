<?php ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet"/>
        <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>-->
        <!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->
    </head>
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-shopping-cart"/>&numsp;Ventas</h2>
            <section>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                    <strong>Autorización</strong>
                                    <span style="float: right" class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                            <div class="panel-body">
                                <input id="btnAutorizacion" class="btn btn-default" type="button" value="Descuentos"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right" id="fecha">
                </div>
                <br>
                <div style="float: right">
                    <strong><label style="color: red">Folio: </label><label id="folio"/> 
                    </strong>
                </div>
                <!--<br/>-->
                <div class="col-sm-9">
                    <div style="float: left; margin-left: 35px">
                        <select class="selectpicker selectores" 
                                data-container="body" 
                                data-live-search="true" 
                                id="cmbClientes"
                                >
                        </select>
                    </div>
                    &nbsp;&nbsp;
                    <div id="ordenesCompra" style="float: left; margin-left: 40px; width: 260px;">
                        <input  id='txtNombreCliente' 
                                type = 'text' 
                                class='form-control' 
                                style='float: left; width: 260px' 
                                placeholder='Nombre del Cliente'/>

                        <select id="cmbOrdenCompraV" class="form-control">
                            <option>
                                Seleccione una orden
                            </option>
                        </select>
                    </div>
                </div>
                <br>
                <br>
                <form class="form-horizontal" role="form" style="margin-left: 20px">
                    <div id="descuentosV">
                    </div>
                </form>
                <br>
                <br>
                <!--combo de clientes-->
                <div class="col-sm-3" style="margin-top: -30px">
                    <select class="form-control" id="cmbTipoPago"
                            style="margin-left: 35px; width: 260px">
                        <option></option>
                    </select>
                    <div id="creditoCliente" style="margin-left: 35px"></div>
                </div>
                <br/>
                <br/>
                <hr>
                <div class="col-sm-3" style="margin-left: 35px">
                    <div class="input-group" id="panelBusqueda">
                        <input type="text" class="form-control" 
                               id="codigoProductoEntradas" 
                               placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <button  class="btn btn-default" type="button" title="Buscar" id="btnbuscadorVentas">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                </div>
                <br><br>
                <table class="table" id="tablaVentas">
                    <thead>
                    <th><center>Codigo</center></th>
                    <th><center>Descripcion</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Existencia</center></th>
                    <th><center>Lst. Precio</center></th>
                    <th><center>Precio c/u</center></th>
                    <th><center>Desc.</center></th>
                    <th><center>Eliminar</center></th>
                    <th><center>total</center></th>
                    <th><center>$ Desc.</center></th>
                    <th><center>$ Total c/d.</center></th>
                    </thead>
                </table>
                <hr>
                <div id="contenedorTotales">
                    <form class="form-inline text-right">
                        <span>Sub Total : <input type="text" id="subTotalV" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    </form>
                    <form class="form-inline text-right" style="margin-top: 5px">
                        <span>Desc. Total : <input type="text" id="descTotalV" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    </form>
                    <form class="form-inline text-right" style="margin-top: 5px">
                        <span>SDA :<input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    </form>
                    <!--<br>-->
                    <form class="form-inline text-right" style="margin-top: 5px">
                        <span>IVA : <input type="text" id="ivaTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    </form>
                    <!--                <br>-->
                    <form class="form-inline text-right" style="margin-top: 5px">
                        <span>Total : <input type="text" id="totalVenta" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    </form>
                </div>
                <input  id="guardarVenta" value="Guardar Venta"  type="submit" class="btn btn-cprimary"/>
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
                        <button type='button' class='btn btn-cprimary' id='btnver'>Agregar productos seleccionados a la lista</button>
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
             aria-labelledby="modalAutorizacion" 
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
                                <label class="col-sm-4 control-label">
                                    Cantidad:
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control" 
                                               placeholder="kg"
                                               id="txtCantidadModal"
                                               onkeyup="calcularPorCantidad();"/>
                                        <span class='input-group-btn'>
                                            <button class='btn btn-default' type='button'>
                                                KG
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Pesos:
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                           class="form-control" 
                                           id="txtTotalModal"
                                           placeholder="$0.00 mxn."
                                           onkeyup="calcularPorPrecio();"/>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-cprimary' 
                                id='btnGranel'>
                            Agregar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--final modalGranel-->
        <!--MODAL DE AUTORIZACION-->
        <div class="modal fade" 
             id="mdlAutorizacion" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalAutorizacion" 
             aria-hidden="true" >
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Autorización</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Usuario
                                </label>
                                <div class="col-sm-8">
                                    <!--<div class="input-group">-->
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Usuario"
                                           id="txtusuario"
                                           />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Password:
                                </label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                           class="form-control" 
                                           id="txtPass"
                                           placeholder="Password"
                                           />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-cprimary' 
                                id='btnAutorizar'>
                            Autorizar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!------------------------------------------------------------------>
        <!--Modal de busqueda de ordenes de Compra-->
        <div class="modal fade" 
             id="mdlBusquedaOrdenCompra" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalOrdenCompra" 
             aria-hidden="true">
            <div class="modal-dialog" style="width: 500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ordenes de Compra</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover" id="tableOrdenesCompra">

                        </table>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!--Modal de cobranza-->
        <div class="modal fade" 
             id="mdlPagar" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalOrdenCompra" 
             aria-hidden="true">
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ordenes de Compra</h4>
                    </div>

                    <div class="modal-body">
                        <div id="pagarCobranza">
                            Tipo Pago :
                            <center>
                                <select class="form-control" id="cmbTipoPagoCobranza"
                                        style="width: 260px">
                                    <option></option>
                                </select>
                            </center>
                        </div>
                        <strong>Total : <span id="totalVnt"></span></strong>
                        <br>
                        Cantiad Ingresada :
                        <center>
                            <input id="txtCantidad" class="form-control" type="text" placeholder="$9999.99 mxn"/>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <input id="btnPagar" type="submit" value="Cobrar" class="btn btn-default"/>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--fin del modal de cobranzas-->
        <!--Inicio de Modal de abonos-->
        <div class="modal fade" id="mdlabonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div id="mdldialog" class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Abonos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-inline">
                            <label>Folio:</label>
                            <input type="text" class="form-control" id="txtfolioabonos" style="width: 40%"/>
                            <button type="button" class="btn btn-cprimary" id="btnfolioabonos"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                        <div id="buscabonos">
                        </div>
                        <div id="divabonos">
                            <div class="form-group">
                                <table class="table" style="width: 50%">
                                    <tr>
                                        <td>
                                            <label>Nombre del cliente: </label>
                                            <span id="nombreabono">Nombre</span>
                                        </td>
                                        <td>
                                            <label>RFC: </label>
                                            <span id="rfcabono">RFC</span>
                                        </td>
                                        <td>
                                            <label>Limite de credito: </label>
                                            <span id="creditoabono">Credito</span>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table">
                                    <th>
                                        <label>Credito: </label>
                                        <span id="adeudoabono" >Adeudo</span>
                                    </th>
                                    <th>
                                        <label>Abonos: </label>
                                        <span id="pagadoabono" >Pagado</span>
                                    </th>
                                    <th>
                                        <label>Saldo: </label>
                                        <span id="saldoabono" >Saldo</span>
                                    </th>
                                </table>
                            </div>
                            <div class="well well-sm" >
                                <center><span id="creditopagado" style="color: red; font-size: xx-large" ><strong>Pagado</strong></span></center>
                                <div id="tblabonos" >
                                </div>
                            </div>
                            <form class='form-inline'>
                                <div class="form-group">
                                    <label>*Cantidad a abonar:</label><br>
                                    <input type="number" class="form-control" id="txtcantidadabono" onkeypress="return NumCheck2(event, this);" />
                                </div>
                                <div class="form-group">
                                    <label>*Tipo de pago:</label><br>
                                    <select id="slctipopago" class="selectpicker" data-container="body" data-live-search="true">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>*Referencia:</label><br>
                                    <input type="text" class="form-control" id="txtreferenciaabono" />
                                </div>
                            </form>
                            <div class="form-group">
                                <br/>
                                <label>Observaciones:</label><br/>
                                <textarea class="form-control" id="txtobservacionesabono"></textarea>
                            </div>
                            <p class="text-muted"><em>*Datos obligatorios para poder abonar</em></p>
                            <hr>
                            <div class="form-group text-right">
                                <button type='button' class='btn btn-default' id='btncancelarabono'>Cancelar abono</button>
                                <button type='button' class='btn btn-cprimary' id='btnabonar'>Registrar abono</button>
                            </div>
                        </div><!-- /.divabonos -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--Inicio de modal de notas de credito-->
        <div class="modal fade" id="mdlnotascredito" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="myModalLabel" 
             aria-hidden="true" >
            <div id="mdldialog" class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Notas de credito</h4>
                    </div>
                    <div class="modal-body">
                        <div id="vernotascredito">
                            <input type="button" class="btn btn-cprimary btn-xs" value="+ Nueva nota de credito" id="btnnuevanotacredito"/><hr>
                            <div id="buscanotascredito">
                            </div>
                        </div>
                        <div id="nuevanotacredito">
                            <form>
                                <div class="form-group">
                                    <select id="slccliente" class="selectpicker selectores" data-width="auto" data-container="body" data-live-search="true">
                                    </select>
                                </div>
                                <div class="form-group" style="width: 200px">
                                    <select id="cmbCancelaciones" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Cantidad en pesos:</label>
                                    <input type="text" class="form-control" id="txtcantidadnotacredito" onkeypress="return NumCheck2(event, this);"/>
                                </div>
                                <!--                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" id="chkfoliocancelacion" onclick="vincularcancelacion();"> Vincular a una cancelacion
                                                                        </label>
                                                                    </div>
                                                                    <div id="divfoliocancelacion">
                                                                        <div class="well well-sm">
                                                                            <label>Folio  de la cancelación a vincular:</label>
                                                                            <input type="text" class="form-control" style="width: 50%" id="txtfoliocancelacionC"/>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <input type="button" class="btn btn-cprimary" id="btnguardanotacredito" value="Guardar nota de credito"/>
                                    <input type="button" class="btn btn-default" id="btncancelarnotacredito" value="Cancelar"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--Fin del modal de notas de credito-->
        <!--Modal de aviso de nota de credito-->

        <div class="modal fade" 
             id="mdlNotacreditoInformacion" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalOrdenCompra" 
             aria-hidden="true">
            <div class="modal-dialog" style="width: 400px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Información de la nota de credito</h4>
                    </div>
                    <div id="informacionNotaCredito">

                    </div>
                    <table class="table" id="tableAcompletarPagos">
                        <tr>
                            <td colspan="2">
                                <div class="alert alert-warning" role="alert">Tu nota de credito no es suficiente para adquirir todo el producto.</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tipos de pago :
                            </td>
                            <td>
                                <select id="tiposPagosNotasCredito" 
                                        class="form-control">
                                </select>
                            </td>
                        <tr>
                            <td>
                                Cantidad:
                            </td>
                            <td>
                                <input type="text" 
                                       disabled="true"
                                       id="acompletarNotaCredito" 
                                       class="form-control"/>
                            </td>
                        </tr>
                        </tr>
                    </table>
                    <center>
                        <input type="submit" 
                               class="btn btn-default" 
                               id="btnGuardarNotaCredito"
                               value="Guardar" title="Guardar Nota de Credito"/>
                    </center>
                    <br>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--Modal de  abrir caja-->
        <div class="modal fade" 
             id="mdlInicioCaja" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalOrdenCompra" 
             aria-hidden="true">
            <div class="modal-dialog" style="width: 350px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">INICIO DE CAJA</h4>
                    </div>
                    <center>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" style="margin-left: 20px">Usuario:</label>
                                <div class="col-sm-9">
                                    <input style="width:70%" type="text" class="form-control" id="txtUsuarioValidarCaja" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" style="margin-left: 20px">Password:</label>
                                <div class="col-sm-9">
                                    <input style="width:70%" type="password" class="form-control" id="txtPassValidarCaja" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="margin-left: 20px">Caja:</label>
                                <div class="col-sm-9">
                                    <input  style="width:70%" id="txtIngresoCaja" type="number" placeholder="$000.00mxn" class="form-control" onkeypress="return isNumberKey(event)"/>
                                </div>
                            </div>
                        </form>
                    </center>
                    <center>
                        <input type="submit" 
                               class="btn btn-default" 
                               id="btnGuardarIngresoCaja"
                               value="Guardar Ingreso" title="Guardar ingreso de caja"/>
                        <input type="submit" 
                               class="btn btn-default" 
                               id="btnCancelarIngresoCaja"
                               value="Salir" title="Guardar ingreso de caja"/>
                    </center>
                    <br>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- modald e finalizar caja -->
        <div class="modal fade" 
             id="mdlAutorizacionFinalizarCaja" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalAutorizacion" 
             aria-hidden="true" >
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Autorización</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Usuario
                                </label>
                                <div class="col-sm-8">
                                    <!--<div class="input-group">-->
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Usuario"
                                           id="txtusuarioF"
                                           />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Password:
                                </label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                           class="form-control" 
                                           id="txtPassF"
                                           placeholder="Password"
                                           />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-cprimary' 
                                id='btnAutorizarF'>
                            Autorizar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- modal de autoriazacion -->
        <div class="modal fade" 
             id="mdlCorteCaja" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalAutorizacion" 
             aria-hidden="true" >
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Información</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong> Va a finalizar el día de hoy.</strong>
                            <br>
                        <form role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cantidad en Caja : &nbsp;&nbsp;</label><strong><span id="totalFinalizarCaja"style="color: red"></span></strong>
                                <input type="text" class="form-control" id="cantidadCaja" placeholder="Cantidad...">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="cuadroCaja"> No cuadro la Caja
                                </label>
                            </div>
                            Acciones:
                            <textarea class="form-control" 
                                      placeholder="Acciones..."
                                      id="textAcciones">

                            </textarea>
                        </form>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-cprimary' 
                                id='btnCorteCaja'>
                            Finalizar día</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!--modal de detalle de la venta-->

        <div class="modal fade" 
             id="mdlDetalleVenta" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalAutorizacion" 
             aria-hidden="true" >
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Información</h4>
                    </div>
                    <div class="modal-body">
                        <strong> DETALLE DE LA VENTA</strong>
                        <table id="tablaDetalleCorteCaja" class="table table-hover">

                        </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!--fin del modal del detalle de la venta-->
        <script src="../administracion/administracion.js/ProductosDevolver.js"></script>
        <script src="../administracion/administracion.js/XmlComprobante.js"></script>
        <script src="../administracion/administracion.js/XmlConceptos.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../administracion/administracion.js/buscador.js"></script>
        <script src="../administracion/administracion.js/cancelacion.js"></script>
        <script src="administracion.js/Ventas.js"></script>
        <script src="administracion.js/pagos.js"></script>
        <script src="../administracion/administracion.js/abonos.js"></script>
        <script src="../administracion/administracion.js/notascredito.js"></script>
        <script src="../administracion/administracion.js/corteCaja.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
