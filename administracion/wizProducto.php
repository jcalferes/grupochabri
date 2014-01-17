<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2>Consultar</h2>
            <section>
                <div id="consultaProducto">
                </div>
            </section>
            <h2>Agregar</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" required>
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
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                        <input type="submit" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
                    </div>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/producto.js"></script>
    </body>
</html>