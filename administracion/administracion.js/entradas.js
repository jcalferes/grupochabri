
$(document).ready(function() {
    $("#codigoProducto").focus();

   

    $("#codigoProducto").keypress(function(e) {
        if (e.which == 13) {
             $("#tablaEntradas").load("mostrarEntradas.php");
        }
    });



});
