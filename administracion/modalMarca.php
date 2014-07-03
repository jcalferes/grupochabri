<!DOCTYPE html>
<html lang="es">

    <!-- Modal -->
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
                        <input id="btnguardarMarca" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Guardar"/>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- JSCRIPT -->
    <!--<script src="administracion.js/modalMarca.js"></script>-->   
</html>

