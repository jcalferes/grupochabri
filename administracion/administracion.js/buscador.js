$(document).ready(function() {
});

$("#btnbuscador").click(function() {
    $("#todos").load("consultarBuscador.php", function() {
        $('#tdProducto').dataTable();
    });
    $('#mdlbuscador').modal('show');
});