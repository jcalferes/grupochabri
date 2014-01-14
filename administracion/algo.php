<?php

echo '<script type="text/javascript" src="administracion.js/modalProducto.js"></script>
    
    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" required>
                            </div>
                            
                            <div class="form-group" id="marca">
                                 <select id="selectMarca">
                                     <option value="0"> seleccione una marca</option>
                                         
                                     
                                     
                                 </select>
                            </div>
                            
                             <div class="form-group">
                                <select id="selectProveedor">
                                     <option>
                                         
                                     </option>
                                     
                                 </select>
                            </div>
                            
                            <div class="form-group">
                                <select id="selectListaPrecios" class="jojo">
                                     <option>
                                         
                                     </option>
                                     
                                 </select>
                            </div>
                            <div class="form-group">
                                <label>Mensage</label>
                                <textarea id="txamensaje" name="mensaje" class="form-control" rows="10" id="contactMessage"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input type="submit" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
                        </div>
        <a href="#" id="show-modal">Show modal</a>
                    </form>
    
    
    
    
    
    
    
    
  <a href="#" id="close-modal">Close modal</a>';


