function eliminar() {

}
function  editar() {

}
$(document).ready(function() {

    var existenciaInventario;

    $('#checarListas').hide();
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectTarifa").load("consultarTarifas.php");
    $("#selectMarca").load("mostrarMarcas.php", function() {
        $("#selectMarca").selectpicker();
    });
    $("#selectGrupo").load("mostrarGrupos.php", function() {
        $("#selectGrupo").selectpicker();
    });
    $("#selectProveedor").load("mostrarProveedores.php", function() {
        $("#selectProveedor").selectpicker();
    });
    $("#selectMedida").load("mostrarUnidadesMedida.php", function() {
        $("#selectMedida").selectpicker();
    });

//    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    $("#mostrarDivProveedor").hide("slow");

    $("#agregarProveedor").click(function() {
        $("#formulario").hide("slow");
        $("#mostrarDivProveedor").show("slow");
    });

    $("#btncancelarproveedor").click(function() {
        $("#mostrarDivProveedor").hide("slow");
        $("#formulario").show("slow");
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");

    });
    $("#guardarDatos").click(function() {
        var nombreProducto = $("#txtNombreProducto").val();
        var marca = $("#selectMarca").val();
        var proveedor = $("#selectProveedor").val();
        var codigoProducto = $("#txtCodigoProducto").val();
        var costoProducto = $("#txtCostoProducto").val();
        var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto;
//
        $.get('guardarProducto.php', info, function() {
            $("#consultaProducto").load("consultarProducto.php");
            $("#txtNombreProducto").val("");
            $("#txtCodigoProducto").val("");
            $("#selectProveedor").val(0);
            $("#selectProveedor").val(0);
            $("#txtCostoProducto").val("");
            $("#selectProducto").load("obtenerProductos.php");
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
            existenciaInventario = existencia;
            $("#existencia").html('<h4> hay en existencia= ' + existenciaInventario + '</h4>');
        });

    });
    $("#AgregarEntrada").click(function() {
        var cantidad = $("#txtEntradaProducto").val();
        var idProducto = $("#selectProducto").val();

        var info = "cantidad=" + cantidad + "&idProducto=" + idProducto + "&existenciaActual=" + existenciaInventario;
        $.get('guardarEntrada.php', info, function(comprobar) {
            alert(comprobar);
            if (comprobar == "OK") {

                $("#selectProducto").val(0);
                $("#txtEntradaProducto").val("");
                $("#existencia").html('<h4> hay en existencia=0</h4>');
                alertify.success("se guardo la Cantidad exitosamente");

            } else {
                alertify.error("no Se ha Guardado");
            }
        });

    });
});
