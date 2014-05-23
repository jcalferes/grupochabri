var codigos = new Array();
var codigoN;

$("#codigoProductoEntradas").keypress(function(e) {
    if (e.which == 13) {
        buscar();
    }
});
function buscar() {
    var codi = $("#codigoProductoEntradas").val();
    codigoN = codi;
//    validamos que el codigo se encuentre en un array para verificarlo
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

function verificarProductoGranel(codigo)
{
    var paso = false;
    var granel = "-GR";
    var longitudCadena = codigo.length;
    var posision = longitudCadena - 3;
    var cadenaComparar = codigo.substring(posision, longitudCadena);
    if (granel == cadenaComparar) {
        paso = true;
    }
    return paso;
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
    var ok = verificarProductoGranel(codigo);
    var valor = $("#cmb" + codigo).val();
    var cantidad = $("#txt" + codigo).val();
    if (ok == false) {
        var total = valor * cantidad;
        $("#txtTotal" + codigo).val(total);
    }
    else {
        var calulandoKg = (cantidad * valor) / 1000;
        $("#txtTotal" + codigo).val(calulandoKg);

    }
    calcularDescuentos(codigo);
}

function calcularPorCantidad() {
    var valor = $("#cmb" + codigoN).val();
    var cantidad = $("#txtCantidadModal").val();
    $("#txt" + codigoN).val(cantidad);
    var calulandoKg = (cantidad * valor) / 1000;
    $("#txtTotal" + codigoN).val(calulandoKg);
    calcularDescuentos(codigoN);
    $("#txtTotalModal").val($("#txtTotal" + codigoN).val());
}

function calcularPorPrecio() {
    var precio = $("#txtTotalModal").val();
    var precioVnt = $("#cmb" + codigoN).val();
    var kilogramosVnta = (precio * 1000) / precioVnt;
    $("#txtCantidadModal").val(kilogramosVnta);
    $("#txtTotal" + codigoN).val(precio);
    $("#txt" + codigoN).val(kilogramosVnta);
//  alert(kilogramosVnta);
    calcularDescuentos(codigoN);
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

function modalProductosGranel(codigo) {
    var cantidad = $("#txt" + codigo).val();
    $("#txtCantidadModal").val(cantidad);
    var total = $("#txtTotal" + codigo).val();
    $("#txtTotalModal").val(total);
    $('#mdlGranel').modal('toggle');
    codigoN = codigo;
}


//funcion para saber que tecla esta presionada.
$(document).keydown(function(tecla) {
    if (tecla.keyCode == 113) {
        buscarTecla();
    }
});

function buscarTecla() {
    if (isNaN(codigoN)) {
        codigoN = 0;
    }
    if (codigoN != 0) {
        var cantidad = $("#txt" + codigoN).val();
        var suma = parseInt(cantidad) + 1;
        $("#txt" + codigoN).val(suma);
        calcularTotal(codigoN);
    }
}

$(document).ready(function() {
    $("#buscarCodigo").click(function() {
        buscar();
    });

    $("#cmbClientes").load("dameClientes.php");
    $("#folio").load("dameFolio.php");
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var f = new Date();
    var fecha = "<div> <strong>" + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + "</strong></div>";
    $("#fecha").html(fecha);
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