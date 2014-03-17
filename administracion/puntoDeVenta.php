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
                        <input type="text" class="form-control" id="codigoProductoEntradas" placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <button  id="buscarCodigo" class="btn btn-default" type="button" title="Buscar">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                </div>
                <br/>
                <hr>
                <br>
                <table class="table table-striped" id="tablaVentas">
                    <thead>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
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
        <script src="administracion.js/Ventas.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
