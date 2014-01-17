$(document).ready(function() {
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    
    $("#guardarDatos").click(function(){
       
        var nombreProducto = $("txtNombreProducto");
        var marca = $("selectMarca");
        var proveedor= $("selectProveedor");
        var listaPrecios= $("selectListaPrecios");
        var codigoProducto= $("txtCodigoProducto");
         var info = "txtNombreProducto=" + nombreProducto + "&marca="  + marca + "proveedor=" + proveedor + "listaPrecios=" + listaPrecios + "codigoProducto=" + codigoProducto;
        alert("algo");  
        $.get('guardaMarca.php', info, function() {
                alertify.success("Marca agregada correctamente");
                return false;
            });
        
        
        
    });
});

