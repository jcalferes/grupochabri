function quitarEspacion(cadena) {
    var palabra = cadena.replace(/\s/g, "%20");
    return palabra;
}

function gestionTarifas(idProducto, nombreProducto) {

    $('#muestramdldireccion').trigger('click');
    $('#myModalLabel').html('<h4> Venta Tarifa del producto ' + nombreProducto + '</h4>');
    $('#idProducto').val(idProducto);
    $("#nombreProducto").val(nombreProducto);


}

$(document).ready(function() {
//    $("#ListaProcductos").change(function() {
var existe=0;
    $("#mostrarTarifas").load("consultarTarifas.php");
    $('#muestramdldireccion').hide();
//    $("#selectTarifa").load("consultarTarifas.php");
    $("#tablaTarifas").load("consultarProductoTarifa.php");
    $("#producto").load("obtenerProductos.php");

    $('#mostrarTarifas').change(function() {
        

        var idProducto = $("#idProducto").val();
        var listaPrecio = $("#mostrarTarifas").val();
        var info = "listaPrecio=" + listaPrecio + "&idProducto=" + idProducto;
        $.get('consultarCostoTarifa.php', info, function(tarifa) {
           if(tarifa !== ""){
               $("#txtTarifa").val(tarifa);
               existe = 1;
           }else{
               $("#txtTarifa").val(0);
               existe = 0;
           }


        });

    });

$("#btnguardarTarifa").click(function(){
    var tarifa = $("#txtTarifa").val();
    var idProducto = $("#idProducto").val();
    var listaPrecio = $("#mostrarTarifas").val();
    var info ="tarifa=" +tarifa+ "&idProducto=" +idProducto+ "&listaPrecio=" +listaPrecio;
    if(existe ==0){
        $.get('guardarTarifa.php', info, function() {
            
        });
    }else{
        $.get('actualizarTarifa.php', info, function() {
            
        });
    }
});
    $("#Buscar").click(function() {
        var producto = quitarEspacion($("#ProductoLista").val());
        alert(producto);
//     var producto =   $("#ProductoLista").val();

        $('#selectTarifa').load("consultarTarifas.php?producto=" + producto, function(status) {
            if (status == 0) {
                alertify.error("No existe ese producto");
            } else {
                alertify.success("Loading");
            }
        });
    });
//    });

});
