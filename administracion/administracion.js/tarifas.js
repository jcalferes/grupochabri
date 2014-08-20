function quitarEspacion(cadena) {
    var palabra = cadena.replace(/\s/g, "%20");
    return palabra;
}

function gestionTarifas(codigoProducto, producto, costo) {

    $('#detalleTarifa').trigger('click');
    $('#labelTitulo').html('<h4> Tarifas del producto</h4>' + producto + '<span> - Costo:</span>'  + costo);
    $('#mostrarListaPreciosTarifa').load("gestionListaPreciosTarifa.php?codigoProducto=" + codigoProducto);
}
    

$(document).ready(function() {
    $("#editarTarifas").click(function() {
        $(".tarifa").attr("disabled", false);
        $("#guardarTarifas").attr("disabled", false);
    });

    $("#canceloTarifa").click(function() {
        $(".tarifa").attr("disabled", true);
        $("#guardarTarifas").attr("disabled", true);

    });
    
    $("#guardarTarifas").click(function(){
         $("#tablaListaPrecios").find('.tarifa').each(function() {
             
             
         });
    });

});
