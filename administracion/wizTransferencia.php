<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-barcode"/>&numsp;Entradas Manualmente</h2>
            <section>
                <br>
                <div class="col-sm-3">
                    <div class="input-group" id="panelBusqueda">
                        <input type="text" class="form-control" id="codigoProductoTranferencia" placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <button  id="buscarCodigoTransferencia" class="btn btn-default" type="button" title="Buscar">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                </div>
                <br/>
                <hr>
                <br>
                <table class="table table-striped" id="tablaTransferencias">
                    <thead>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                     <th>Cantidad Maxima</th>
                    <th>Precio</th>
                     <th>Total</th>
                    </thead>
                </table>
                <hr>
                <form class="form-inline text-right">
                    <span>Total : <input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
            </section>
        </div>
        <!-- Modal -->
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="administracion.js/Transferencias.js"></script>
    </body>
</html>