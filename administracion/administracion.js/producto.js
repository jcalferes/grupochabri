function eliminar() {

}
function  editar() {

}



$(document).ready(function() {

    $("#checarListas").load("seleccionarListaPrecios.php");
    $('#checarListas').hide('slow');
    $('#textos').hide();
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
//    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    $("#mostrarDivProveedor").hide("slow");
    $("#agregarProveedor").click(function() {
        $("#formulario").hide("slow");
        $("#mostrarDivProveedor").show("slow");


    });


    $("#siguiente").click(function() {
        $('#formulario').hide('slow');
//        $("#checarListas").load("seleccionarListaPrecios.php");
        $('#checarListas').show('slow');
        $('#textos').show('slow');



    });
    $("#guardarDatos").click(function() {
        var nombreProducto = $("txtNombreProducto");
        var marca = $("selectMarca");
        var proveedor = $("selectProveedor");
        var listaPrecios = $("selectListaPrecios");
        var codigoProducto = $("txtCodigoProducto");
        var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&listaPrecios=" + listaPrecios + "&codigoProducto=" + codigoProducto;
        $.get('guardarProducto.php', info, function() {
            alertify.success("Marca agregada correctamente");
            return false;
        });
    });

    $("#anterior").click(function() {
        
        $('#checarListas').hide('slow');
        $('#formulario').show('slow');
        $('#textos').hide('slow');
    });

});

