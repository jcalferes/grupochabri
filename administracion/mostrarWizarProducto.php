<form id="cuerpo" style="margin: 0% 25% 0% 25%">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" required>
    </div>
    <div class="form-group">
        <label>Marca:</label><br>
        <select id="selectMarca" style="width: 90%; height: 35px">
        </select>
        <input href="#mdlMarca" data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-primary" value="+">
    </div>
    <div class="form-group">
        <label>Proveedor:</label><br>
        <select id="selectProveedor" style="width: 90%; height: 35px">
        </select>
        <input href="#mdlProveedor" data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-primary" value="+">
    </div>
    <div class="form-group">
        <label>Lista de Precios:</label><br>
        <select id="selectListaPrecios" style="width: 90%; height: 35px">
        </select>
        <input href="#mdlListaPrecios" data-toggle="modal" type="button" class="btn btn-primary" value="+">
    </div>
    <hr>
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
    <input type="submit" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
</form> 
