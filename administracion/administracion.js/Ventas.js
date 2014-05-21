var codigos = new Array();

$("#codigoProductoEntradas").keypress(function(e) {
    if (e.which == 13) {
        buscar();
    }
});
function buscar() {
    var codi = $("#codigoProductoEntradas").val();
    var paso = validar($("#codigoProductoEntradas").val());
    if (paso == true) {
        var cantidad = $("#txt" + codi).val();
        var suma = parseInt(cantidad) + 1;
        $("#txt" + codi).val(suma);
    }
    else {
        cargarProductosCarrito();
        codigos.push($("#codigoProductoEntradas").val());
    }
    calcularTotal(codi);
}
function cargarProductosCarrito() {
    var info = "codigo=" + $("#codigoProductoEntradas").val().toUpperCase();
    $.get('dameProductoVentas.php', info, function(informacion) {
        $("#tablaVentas").append(informacion);
    });
}

function validar(codigo) {
    var paso = false;
    for (var x = 0; x < codigos.length; x++) {
        if (codigos[x] == codigo) {
            paso = true;
            break;
        }
    }
    return paso;
}

function agregarProducto() {
    buscar();
}

function calcularDescuentos(codigo) {
    var descuentos = $("#txtDescuentos" + codigo).val();
    var total = $("#txtTotal" + codigo).val();
    var totalDescuento = ((total * descuentos) / 100);
    total = total - totalDescuento;
    $("#txtTotalDesc" + codigo).val(total);
    $("#txtDescuento" + codigo).val(totalDescuento);
}


function sustraerLetras(palabra) {
    var ok = false;
    for (var x = 0; x < codigos.length; x++) {
        if (codigos[x] == codigo) {
            codigos.splice(x, 1);
            break;
        }
    }
    return ok;
}

function cambiarTarifas(codigo) {
    var valor = $("#cmb" + codigo).val(); 
    $("#precioVnt" + codigo).text(valor);
    calcularTotal(codigo);
}

function calcularTotal(codigo) {
    var valor = $("#cmb" + codigo).val();
    var cantidad = $("#txt" + codigo).val();
    var total = valor * cantidad;
    $("#txtTotal" + codigo).val(total);
    calcularDescuentos(codigo);
}



function quitarProducto(codigo) {
    var cantidad = $("#txt" + codigo).val();
    var suma = parseInt(cantidad) - 1;
    if (suma >= 0) {
        $("#txt" + codigo).val(suma);
    }
}
function eliminarProducto(codigo) {
    var longitud = codigos.length;
    for (var x = 0; x < longitud; x++) {
        if (codigos[x] === codigo) {
            codigos.splice(x, 1);
            x = -1;
            longitud = codigos.length;
        }
    }
    cargarProductosCarrito();
}

$(document).ready(function() {
    $("#precioVnta-12345-gr").val("hola como estas");
    
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