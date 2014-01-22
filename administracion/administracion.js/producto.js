function eliminar() {

}
function  editar() {

}
$(document).ready(function() {
    $('#checarListas').hide();
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
//    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    $("#mostrarDivProveedor").hide("slow");

    $("#agregarProveedor").click(function() {
        $("#formulario").hide("slow");
        $("#mostrarDivProveedor").show("slow");
    });
    $("#guardarDatos").click(function() {
        var nombreProducto = $("#txtNombreProducto").val();
        var marca = $("#selectMarca").val();
        var proveedor = $("#selectProveedor").val();       
        var codigoProducto = $("#txtCodigoProducto").val();
        var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto;
     alert(info);
        $.get('guardarProducto.php', info, function() {
            
//            $('#formulario').hide('slow');
//            $("#selectTarifa").load("mostrarListaPrecios.php");
//            $('#checarListas').show('slow');
            alertify.success("Producto agregada correctamente");
             return false;
           
        });
    });
});
