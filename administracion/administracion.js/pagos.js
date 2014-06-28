$(document).ready(function() {
    $("#mdlBuscadorOrdenesCompra").click(function() {
        $("#tableOrdenesCompra").load("dameTodasOrdenesCompra.php", function() {
            $("#mdlBusquedaOrdenCompra").modal("show");
        });
    });
});

function cargarInformacion(folio) {
   $("#informacionPagos").load("dameInformacion.php?id="+folio);
}