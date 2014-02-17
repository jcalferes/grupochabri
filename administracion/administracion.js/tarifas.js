function quitarEspacion(cadena) {
    var palabra = cadena.replace(/\s/g, "%20");
    return palabra;
}

function gestionTarifas(codigoProducto, producto) {

    $('#detalleTarifa').trigger('click');
    $('#labelTitulo').html('<h4> Tarifas del producto</h4>' + producto);
    $('#mostrarListaPreciosTarifa').load("gestionListaPreciosTarifa.php?codigoProducto=" + codigoProducto);
}

$(document).ready(function() {
$("#editarTarifas").click(function(){
  $(".tarifa").attr("disabled", false);
  $("#guardarTarifas").attr("disabled", false);
});

$("#guardarTarifas").click(function(){
   
    
});

});
