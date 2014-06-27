$(document).ready(function() {
    $("#mdlBuscadorOrdenesCompra").click(function() {
        $("#tableOrdenesCompra").load("dameTodasOrdenesCompra.php", function() {
            $("#mdlBusquedaOrdenCompra").modal("show");
        });
    });
});