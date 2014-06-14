var codigos = new Array();
var arrayDetalleVenta = new Array();
var arrayEncabezadoVenta = new Array();
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
        $("#txt" + codi).val(suma.toFixed(2));
    }
    else {
        cargarProductosCarrito();
        codigos.push($("#codigoProductoEntradas").val().toUpperCase());
    }
    calcularTotal(codi);
}
function cargarProductosCarrito() {
    var info = "codigo=" + $("#codigoProductoEntradas").val().toUpperCase();
    $.get('dameProductoVentas.php', info, function(informacion) {
        var datos = informacion.split(",");
        if (datos[0] == 0) {
            alertify.error("No existe el producto con el codigo " + $("#codigoProductoEntradas").val().toUpperCase() + "o no hay en existencia");
        }
        else if (datos[0] == 1) {
            alert(datos.length);
            alert("entro a una exception");
            alertify.error(datos[1]);
        }
        else {
            $("#tablaVentas").append(informacion);
            calcularSumaTotal();
            calcularSubTotal();
            sumaDescTotal();
        }
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
    $("#txtTotalDesc" + codigo).val(total.toFixed(2));
    $("#txtDescuento" + codigo).val(totalDescuento.toFixed(2));
    calcularSumaTotal();
    sumaDescTotal();
}


function sustraerLetras(palabra) {
    var ok = false;
    for (var x = 0; x < codigos.length; x++) {
        if (codigos[x] == codigoN) {
            codigos.splice(x, 1);
            break;
        }
    }
    return ok;
}

function cambiarTarifas(codigo) {
    var valor = $("#cmb" + codigo).val();
    var datos = valor.split(",");
    $("#precioVnt" + codigo).text(datos[1]);
    calcularTotal(codigo);
}

function calcularTotal(codigo) {
    var ok = verificarProductoGranel(codigo);
    var valor = $("#cmb" + codigo).val();
    var datos = valor.split(",");
    var cantidad = $("#txt" + codigo).val();
    if (ok == false) {
        var total = datos[1] * cantidad;
        $("#txtTotal" + codigo).val(total.toFixed(2));
    }
    else {
        var calulandoKg = (cantidad * datos[1]) / 1000;
        $("#txtTotal" + codigo).val(calulandoKg.toFixed(2));
    }
    calcularDescuentos(codigo);
    calcularSumaTotal();
    calcularSubTotal();
    sumaDescTotal();
}

function calcularSubTotal() {
    var subTotal = 0.00;
    for (var x = 0; x < codigos.length; x++) {
        subTotal += parseFloat($("#txtTotal" + codigos[x]).val().toUpperCase());
    }
    $("#subTotalV").val(subTotal.toFixed(2));
}

function sumaDescTotal() {
    var sumaDescTotal = 0.00;
    for (var x = 0; x < codigos.length; x++) {
        var codigo = codigos[x].toUpperCase();
        if (typeof (codigo) == "undefined") {
            codigo = 0;
        }
        sumaDescTotal += parseFloat($("#txtDescuento" + codigo).val());
    }
    $("#descTotalV").val(sumaDescTotal.toFixed(2));
}


function calcularPorCantidad() {
    var valor = $("#cmb" + codigoN).val();
    var datos = valor.split(",");
    var cantidad = $("#txtCantidadModal").val();
    $("#txt" + codigoN).val(cantidad);
    var calulandoKg = (cantidad * datos[1]) / 1000;
    $("#txtTotal" + codigoN).val(calulandoKg.toFixed(2));
    calcularDescuentos(codigoN);
    $("#txtTotalModal").val($("#txtTotal" + codigoN).val());
    calcularSumaTotal();
    calcularSubTotal();
    sumaDescTotal();
}

function calcularPorPrecio() {
    var precio = parseFloat($("#txtTotalModal").val());
    var valor = $("#cmb" + codigoN).val();
    var datos = valor.split(",");
    var kilogramosVnta = (precio * 1000) / datos[1];
    $("#txtCantidadModal").val(parseFloat(kilogramosVnta.toFixed(2)));
    $("#txtTotal" + codigoN).val(precio.toFixed(2));
    $("#txt" + codigoN).val(parseFloat(kilogramosVnta.toFixed(2)));
    calcularDescuentos(codigoN);
    calcularSumaTotal();
}


function quitarProducto(codigo) {
    var cantidad = $("#txt" + codigo).val();
    var suma = parseInt(cantidad) - 1;
    if (suma >= 0) {
        $("#txt" + codigo).val(suma.toFixed(2));
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
function calcularSumaTotal() {
    var suma = 0;
    for (var x = 0; x < codigos.length; x++) {
        var cod = codigos[x].toUpperCase();
        suma += parseFloat($("#txtTotalDesc" + cod).val());
    }
    var suma = parseFloat(suma);
    if (isNaN(suma)) {
        suma = 0;
    }
    $("#costoTotal").val(suma.toFixed(2));
    calcularIva(suma);
}

function calcularIva(sumaTotalProductos) {
    var iva = 0.00;
    var ivaTotal = 0.00;
    iva = sumaTotalProductos * 0.16;
    ivaTotal = sumaTotalProductos * 1.16;
    $("#ivaTotal").val(iva.toFixed(2));
    $("#totalVenta").val(ivaTotal.toFixed(2));
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
        $("#txt" + codigoN).val(suma.toFixed(2));
        calcularTotal(codigoN);
    }
}





function guardarDatosEncabezado() {

    var encabezadoVentas = new XmlComprobante();
    encabezadoVentas.folioComprobante = $("#folio").text();
    encabezadoVentas.fechaComprobante = "";
    encabezadoVentas.rfcComprobante = $("#cmbClientes").val();
    encabezadoVentas.desctGeneralFactura = "";
    encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val();
    encabezadoVentas.descuentosGenerales = "";
    encabezadoVentas.ivaComprobante = $("#ivaTotal").val();
    encabezadoVentas.sdaComprobante = $("#costoTotal").val();
    encabezadoVentas.subTotalComprobante = $("#subTotalV").val();
    encabezadoVentas.descuentoPorProductoComprobantes = "";
    encabezadoVentas.totalComprobante = $("#totalVenta").val();
    encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val();
    arrayEncabezadoVenta.push(encabezadoVentas);
}

function guardarDatosDetalle() {

    for (var x = 0; x < codigos.length; x++) {
        var valor = $("#cmb" + codigos[x]).val();
        var datos = valor.split(",");
        var detalleVenta = new xmlConceptosManualmente();
        detalleVenta.unidadMedidaConcepto = "0";
        detalleVenta.importeConcepto = $("#txtTotalDesc" + codigos[x]).val();
        detalleVenta.cantidadConcepto = $("#txt" + codigos[x]).val();
        detalleVenta.codigoConcepto = $("#codigo" + codigos[x]).text();
        detalleVenta.descripcionConcepto = $("#descripcion" + codigos[x]).text();
        detalleVenta.precioUnitarioConcepto = $("#precioVnt" + codigos[x]).text();
        detalleVenta.cdaConcepto = $("#txtTotalDesc" + codigos[x]).val();
        detalleVenta.desctUnoConcepto = $("#txtDescuentos" + codigos[x]).val();
        detalleVenta.desctDosConcepto = 0.00;
        detalleVenta.costoCotizacion = 0.00;
        detalleVenta.idListaPrecio = datos[0];
        arrayDetalleVenta.push(detalleVenta);
    }
}

function cargarProductosCarritoBusqueda(codigo) {
    var info = "codigo=" + codigo.toUpperCase();
    $.get('dameProductoVentas.php', info, function(informacion) {
        if (informacion == 0) {
            alertify.error("No existe el producto con el codigo " + $("#codigoProductoEntradas").val().toUpperCase() + "o no hay en existencia");
        }
        else {
            $("#tablaVentas").append(informacion);
            calcularSumaTotal();
            calcularSubTotal();
            sumaDescTotal();
        }
    });
}


function eliminar(codigo) {
    for (var x = 0; x < codigos.length; x++) {
        if (codigos[x] == codigo) {
            codigos.splice(x, 1);
        }
    }
    $("#tr" + codigo).remove();
    calcularSumaTotal();
    calcularSubTotal();
    sumaDescTotal();
    calcularTotal(codigo);
    return true;
}

$(document).ready(function() {
    $("#cmbTipoPago").load("dameTiposPagos.php");
    $("#infDatos").hide();
    $("#buscarCodigo").click(function() {
        buscar();
    });
    $("#cmbClientes").load("dameClientes.php");
    $("#folio").load("dameFolio.php", function() {

    });
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var f = new Date();
    var fecha = "<div> <strong>" + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + "</strong></div>";
    $("#fecha").html(fecha);
    $("#guardarVenta").click(function() {
        guardarDatosDetalle();
        guardarDatosEncabezado();
        var inf = new Array();
        inf.push(arrayEncabezadoVenta);
        inf.push(arrayDetalleVenta);
        var informacion = JSON.stringify(inf);
        $.ajax({
            type: "POST",
            url: "guardarVenta.php",
            data: {data: informacion},
            cache: false,
            success: function(informacion) {
                if (informacion == 0) {
                    informacion = "Exito Venta Terminada";
                }
                var datos = informacion.split(",");
                if (datos[0] == 2) {
                    alert("es dos");
                }
                else {
                    alertify.success(informacion);
                }
            }
        });
    });

    $("#btnver").click(function() {
        var info;
        $("#tdProducto").find(':checked').each(function() {
            var elemento = this;
            var valor = elemento.value;
            var x = validar(valor);
            if (x == false) {
                cargarProductosCarritoBusqueda(valor);
                codigos.push(valor);
                alertify.succes("Producto Agregado");
                $('#mdlbuscador').modal('toggle');
            }
        });
        if (info != undefined) {
            $('#mdlbuscador').modal('toggle');
        }
        else {
            $('#mdlbuscador').modal('toggle');
        }
    });






});