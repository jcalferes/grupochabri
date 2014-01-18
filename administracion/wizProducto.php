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
                <form style="margin: 0% 25% 0% 25%" id="formulario">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" required>
                    </div>
                    <div class="form-group">
                        <label>Codigo Producto</label>
                        <input type="text" class="form-control" id="txtCodigoProducto" placeholder="Código del Producto" required>
                    </div>
                    <div class="form-group">
                        <label>Marca:</label><br>
                        <select id="selectMarca" style="width: 100%; height: 35px">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Proveedor:</label><br>
                        <select id="selectProveedor" style="width: 100%; height: 35px">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lista de Precios:</label><br>
                        <select id="selectListaPrecios" style="width: 100%; height: 35px">
                        </select>
                    </div>
                    <input type="button" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/producto.js"></script>
    </body>
</html>
