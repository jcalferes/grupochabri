function eliminar() {

}
function  editar() {

}
$(document).ready(function() {

    $('#checarListas').hide();
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectTarifa").load("consultarTarifas.php");
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
        var costoProducto = $("#txtCostoProducto").val();
        var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto;

        $.get('guardarProducto.php', info, function() {
            $("#consultaProducto").load("consultarProducto.php");

            alertify.success("Producto agregada correctamente");
            return false;

        });


    });

    $("#selectTarifa").change(function() {

        var Tarifa = $("#selectTarifa").val();
        alert(Tarifa);
        $("#tablaTarifas").load("consultarProductoTarifa.php?tarifa=" + Tarifa);
    });

    $("#btnTarifa").click(function() {
        var Tarifa = $("#txtTarifa").val();
        var selectTarifa = $("#selectTarifa").val();

        var info = "Tarifa=" + Tarifa + "&listaPrecio=" + selectTarifa;
        $.get('guardarTarifa.php', info, function() {

//            $('#formulario').hide('slow');
//            $("#selectTarifa").load("mostrarListaPrecios.php");
//            $('#checarListas').show('hide');
            alertify.success("Tarifa del Producto agregado correctamente");
            return false;

        });
    });

    $("#selectProducto").load("obtenerProductos.php");
    $("#selectProducto").change(function() {
        var producto = $("#selectProducto").val();
        info = "producto=" + producto;
        $.get('obtenerExistencia.php', info, function(existencia) {
            $("#existencia").html('<h4> hay en existencia ' + existencia + '</h4>')
        });

    });
    $("#AgregarEntrada").click(function() {
        var cantidad = $("#txtEntradaProducto").val();
         var idProducto = $("#selectProducto").val();
      
      var  info = "cantidad=" + cantidad+ "&idProducto=" + idProducto;
        $.get('guardarEntrada.php', info, function(comprobar) {
            alert(comprobar);
           if(comprobar =="OK"){
               alertify.success("se guardo la Cantidad exitosamente");
           }else{
               alertify.error("no Se ha Guardado");
           }
        });

    });
});
