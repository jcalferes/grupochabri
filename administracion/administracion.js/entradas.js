
$(document).ready(function() {
    $("#codigoProducto").focus();
    $("#tablaEntradas").load("mostrarEntradas.php");


    $("#codigoProducto").keypress(function(e) {
        if (e.which == 13) {
            alert('You pressed enter!');
        }
    });


});