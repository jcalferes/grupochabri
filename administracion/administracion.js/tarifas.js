function quitarEspacion(cadena) {
                var palabra = cadena.replace(/\s/g, "%20");
                return palabra;
            }

$(document).ready(function() {
//    $("#ListaProcductos").change(function() {
    $("#selectTarifa").hide();
   $("#selectTarifa").load("consultarTarifas.php");

    $("#producto").load("obtenerProductos.php");

    $("#Buscar").click(function() {
    var producto =     quitarEspacion($("#ProductoLista").val());
//     var producto =   $("#ProductoLista").val();
     
  $('#tablaTarifas').load("consultarTarifas.php?producto="+ producto, function(status){
            if (status==0){
                alertify.error("No existe ese producto");
            }else{
                alertify.success("Loading");
            }
  });
    });
//    });

});
