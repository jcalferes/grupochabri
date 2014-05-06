var codigos = new Array();

$("#codigoProductoEntradas").keypress(function(e) {
    if (e.which == 13) {
        buscar();
    }
});
function buscar() {
    var algo = $("#codigoProductoEntradas").val();
    codigos.push($("#codigoProductoEntradas").val());
    cargarProductosCarrito();
}
function cargarProductosCarrito() {
    var info = JSON.stringify(codigos);
    $.ajax({
        type: "POST",
        url: "dameProductoVentas.php",
        data: {data: info},
        cache: false,
        success: function(informacion) {
            $("#tablaVentas").html(informacion);
        }
    });
}

function agregarProducto(codigo) {
    codigos.push(codigo);
    cargarProductosCarrito();
}

$(document).ready(function() {
    $("#buscarCodigo").click(function() {
        buscar();
    });
});