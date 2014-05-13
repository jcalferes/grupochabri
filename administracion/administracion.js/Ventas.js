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
function quitarProducto(codigo) {
    for (var x = 0; x < codigos.length; x++) {
        if (codigos[x] == codigo) {
            codigos.splice(x, 1);
            break;
        }
    }
    cargarProductosCarrito();
}

$(document).ready(function() {
    $("#buscarCodigo").click(function() {
        buscar();
    });

    $("#btnver").click(function() {
        var info;
        $("#tdProducto").find(':checked').each(function() {
            var elemento = this;
            var valor = elemento.value;
            codigos.push(valor);
            lista = JSON.stringify(codigos);
            info = "marcas=" + lista;
        });
        if (info != undefined) {
            cargarProductosCarrito();
            $('#mdlbuscador').modal('toggle');
        } else {
            alertify.error("Debes seleccionar al menos una  marca");
        }
    });
});