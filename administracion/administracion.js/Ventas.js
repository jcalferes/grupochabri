var codigos = new Array();
var arrayDetalleVenta = new Array();
var arrayEncabezadoVenta = new Array();
var codigoN;
var inf = new Array();
$("#codigoProductoEntradas").keypress(function (e) {
    if (e.which == 13) {
        var codi = $("#codigoProductoEntradas").val();
        var info = "codigo=" + codi;
        $.get('dameCodigoBarras.php', info, function (informacion) {
            if (informacion != -1) {
                var callbacks = $.Callbacks();
                callbacks.add(codigoN = informacion);
                callbacks.add(buscar());
                callbacks.add($("#codigoProductoEntradas").val(""));
            }
            else {
                alertify.error("Hubo un error al traer el codigo del producto.");
            }
        });
    }
});
function buscar() {
//    alert("entro a buscar");
//    var codi = $("#codigoProductoEntradas").val();
//    validamos que el codigo se encuentre en un array para verificarlo
    var paso = validar(codigoN);
//    var paso = validar($("#codigoProductoEntradas").val());
    if (paso == true) {
        alertify.success("El producto ya esta en carrito");
        $("#codigoProductoEntradas").val("");
    }
    else {
        cargarProductosCarrito();
        codigos.push(codigoN.toUpperCase());
    }
    calcularTotal(codi);
//    alert("finalizo Buscar");
}




function validarCredito() {
    var paso = false;
    var credito = parseFloat($("#credito").text());
    var totalVenta = parseFloat($("#totalVenta").val());
    if (totalVenta <= credito) {
        paso = true;
    }
    return paso;
}


function cargarProductosCarrito() {
//    var info = "codigo=" + $("#codigoProductoEntradas").val().toUpperCase();
    var info = "codigo=" + codigoN.toUpperCase();
    $.get('dameProductoVentas.php', info, function (informacion) {
        var datos = informacion.split(",");
        if (datos[0] == 0) {
            eliminarProducto(codigoN.toUpperCase());
            alertify.error("No existe el producto con el codigo " + $("#codigoProductoEntradas").val().toUpperCase() + "o no hay en existencia");
            $("#codigoProductoEntradas").val("");
        }
        else if (datos[0] == 1) {
            alertify.error(datos[1]);
        }
        else {
            var callbacks = $.Callbacks();
            callbacks.add($("#tablaVentas").append(informacion));
            callbacks.add(calcularSumaTotal());
            callbacks.add(calcularSubTotal());
            callbacks.add(sumaDescTotal());
            callbacks.add(guardarProductoOrdenCompraNuevo());
            callbacks.add($("#codigoProductoEntradas").val(""));
        }
    });
}
function guardarProductoOrdenCompraNuevo() {
    if ($("#cmbOrdenCompraV").val() > 0) {
//        alert("debe de entrar");
        var valor = $("select[id='cmb" + codigoN + "']").val();
        var datos = valor.split(",");
        var detalleVenta = new xmlConceptosManualmente();
        detalleVenta.unidadMedidaConcepto = "KG";
        detalleVenta.importeConcepto = $("input[id='txtTotalDesc" + codigoN + "']").val();
        detalleVenta.cantidadConcepto = $("input[id='txt" + codigoN + "']").val();
        detalleVenta.codigoConcepto = $("span[id='codigo" + codigoN + "']").text();
        detalleVenta.descripcionConcepto = $("span[id='descripcion" + codigoN + "']").text();
        detalleVenta.precioUnitarioConcepto = $("span[id='precioVnt" + codigoN + "']").text();
        detalleVenta.cdaConcepto = $("input[id='txtTotalDesc" + codigoN + "']").val();
        detalleVenta.desctUnoConcepto = $("input[id='txtDescuentos" + codigoN + "']").val();
        detalleVenta.idListaPrecio = parseInt(datos[0]);
        detalleVenta.idXmlComprobante = parseInt($("select[id='cmbOrdenCompraV']").val());
        arrayDetalleVenta.push(detalleVenta);
        var encabezadoVentas = new XmlComprobante();
        encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val();
        encabezadoVentas.ivaComprobante = $("#ivaTotal").val();
        encabezadoVentas.sdaComprobante = $("#costoTotal").val();
        encabezadoVentas.subTotalComprobante = $("#subTotalV").val();
        encabezadoVentas.totalComprobante = $("#totalVenta").val();
        encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val();
        arrayEncabezadoVenta.push(encabezadoVentas);
        inf.push(arrayDetalleVenta);
        inf.push(arrayEncabezadoVenta);
        var informacion = JSON.stringify(inf);
        $.ajax({
            type: "POST",
            url: "productoAgregadoOrdenCompra.php",
            data: {data: informacion},
            cache: false,
            success: function (informacion) {
            }
        });
    }
}


function guardarProductoOrdenCompraNuevoPorBusqueda(codigo) {
    var ordenCompr = $("#cmbOrdenCompraV").val();
    if (ordenCompr > 0) {
//        alert(codigo);
        var valor = $("select[id='cmb" + codigo + "']").val();
        var datos = valor.split(",");
        var detalleVenta = new xmlConceptosManualmente();
        detalleVenta.unidadMedidaConcepto = "KG";
        detalleVenta.importeConcepto = $("input[id='txtTotalDesc" + codigo + "']").val();
        detalleVenta.cantidadConcepto = $("input[id='txt" + codigo + "']").val();
        detalleVenta.codigoConcepto = $("span[id='codigo" + codigo + "']").text();
        detalleVenta.descripcionConcepto = $("span[id='descripcion" + codigo + "']").text();
        detalleVenta.precioUnitarioConcepto = $("span[id='precioVnt" + codigo + "']").text();
        detalleVenta.cdaConcepto = $("input[id='txtTotalDesc" + codigo + "']").val();
        detalleVenta.desctUnoConcepto = $("input[id='txtDescuentos" + codigo + "']").val();
        detalleVenta.idListaPrecio = parseInt(datos[0]);
        detalleVenta.idXmlComprobante = parseInt($("select[id='cmbOrdenCompraV']").val());
        arrayDetalleVenta.push(detalleVenta);
        var encabezadoVentas = new XmlComprobante();
        encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val();
        encabezadoVentas.ivaComprobante = $("#ivaTotal").val();
        encabezadoVentas.sdaComprobante = $("#costoTotal").val();
        encabezadoVentas.subTotalComprobante = $("#subTotalV").val();
        encabezadoVentas.totalComprobante = $("#totalVenta").val();
        encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val();
        arrayEncabezadoVenta.push(encabezadoVentas);
        inf.push(arrayDetalleVenta);
        inf.push(arrayEncabezadoVenta);
        var informacion = JSON.stringify(inf);
        var info = "data=" + informacion;
        $.post('productoAgregadoOrdenCompra.php', info, function () {
            alertify.success("Producto Agregado exitosamente");
        });
    }
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
    var descuentos = $("input[id='txtDescuentos" + codigo + "']").val();
//    var descuentos = $("#txtDescuentos" + codigo).val();
    var total = $("input[id='txtTotal" + codigo + "']").val();
//    var total = $("#txtTotal" + codigo).val();
    var totalDescuento = ((total * descuentos) / 100);
    total = total - totalDescuento;
    $("input[id='txtTotalDesc" + codigo + "']").val(total.toFixed(2));
//    $("#txtTotalDesc" + codigo).val(total.toFixed(2));
    $("input[id='txtDescuento" + codigo + "']").val(totalDescuento.toFixed(2));
//    $("#txtDescuento" + codigo).val(totalDescuento.toFixed(2));
    var callbacks = $.Callbacks();
    callbacks.add(calcularSumaTotal());
    callbacks.add(sumaDescTotal());
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
//    alert("entro a cambiar");
    var valor = $("select[id='cmb" + codigo + "']").val();
//    var valor = $("#cmb" + codigo).val();
    var datos = valor.split(",");
//    alert(datos[1]);
    $("span[id='precioVnt" + codigo + "']").text(datos[1]);
//    $("#precioVnt" + codigo).text(datos[1]);
    calcularTotal(codigo);
}


function soloNumeroEnteros(valor) {
    var paso = false;
    var ultimo = valor.substring(valor.length - 1, valor.length);
    if (ultimo == ".") {
        valor = valor + "0";
    }
    if (valor == 0) {
        paso = true;
    }
    else if (valor.match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
        paso = true;
    }

    return paso;
}



function calcularTotal(codigo) {
    var cantidad = $("input[id='txt" + codigo + "']").val();
    var valor = $("#numero").val();
    if (cantidad == '-' || cantidad == '+') {
    }
    else {
        var paso = soloNumeroEnteros(cantidad);
        if (paso == false) {
            valor = cantidad.substring(0, cantidad.length - 1);
            $("input[id='txt" + codigo + "']").val(valor);
        }
        else {
            var ok = verificarProductoGranel(codigo);
            var valor = $("select[id='cmb" + codigo + "']").val();
//            var valor = $("#cmb" + codigo).val();
            var datos = valor.split(",");
            if (ok == false) {
                var total = datos[1] * cantidad;
//                alert(total);
                $("input[id='txtTotal" + codigo + "']").val(total.toFixed(2));
//                $("#txtTotal" + codigo).val(total.toFixed(2));
            }
            else {
                var calulandoKg = (cantidad * datos[1]) / 1;
                $("input[id='txtTotal" + codigo + "']").val(calulandoKg.toFixed(2));
//                $("#txtTotal" + codigo).val(calulandoKg.toFixed(2));
            }
            calcularDescuentos(codigo);
            calcularSumaTotal();
            calcularSubTotal();
            sumaDescTotal();
        }
    }
}

function calcularSubTotal() {
    var subTotal = 0.00;
    for (var x = 0; x < codigos.length; x++) {
        subTotal = subTotal + parseFloat($("input[id='txtTotal" + codigos[x] + "']").val().toUpperCase());
//        subTotal = subTotal + parseFloat($("#txtTotal" + codigos[x]).val().toUpperCase());
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
        sumaDescTotal += parseFloat($("input[id='txtDescuento" + codigo + "']").val());
//        sumaDescTotal += parseFloat($("#txtDescuento" + codigo).val());
    }
    $("#descTotalV").val(sumaDescTotal.toFixed(2));
}


function calcularPorCantidad() {


    var valor = $("select[id='cmb" + codigoN + "']").val();
//    var valor = $("#cmb" + codigoN).val();
    var datos = valor.split(",");
    var cantidad = $("#txtCantidadModal").val();
    $("input[id='txt" + codigoN + "']").val(cantidad);
//    $("#txt" + codigoN).val(cantidad);
    var calulandoKg = (cantidad * datos[1]);
    $("input[id='txtTotal" + codigoN + "']").val(calulandoKg.toFixed(2));
//    $("#txtTotal" + codigoN).val(calulandoKg.toFixed(2));
    calcularDescuentos(codigoN);
    $("#txtTotalModal").val($("input[id='txtTotal" + codigoN + "']").val());
//    $("#txtTotalModal").val($("#txtTotal" + codigoN).val());
    var callbacks = $.Callbacks();
    callbacks.add(calcularSumaTotal());
    callbacks.add(calcularSubTotal());
    callbacks.add(sumaDescTotal());

}

function calcularPorPrecio() {
    var precio = parseFloat($("#txtTotalModal").val());
    var valor = $("select[id='cmb" + codigoN + "']").val();
//    var valor = $("#cmb" + codigoN).val();
    var datos = valor.split(",");
    var kilogramosVnta = (precio * 1) / datos[1];
    if (isNaN(kilogramosVnta)) {
        kilogramosVnta = 0;
    }
    $("#txtCantidadModal").val(parseFloat(kilogramosVnta.toFixed(2)));
    $("input[id='txtTotal" + codigoN + "']").val(precio.toFixed(2));
//    $("#txtTotal" + codigoN).val(precio.toFixed(2));
    $("input[id='txt" + codigoN + "']").val(parseFloat(kilogramosVnta.toFixed(2)));
//    $("#txt" + codigoN).val(parseFloat(kilogramosVnta.toFixed(2)));
    var callbacks = $.Callbacks();
    callbacks.add(calcularDescuentos(codigoN));
    callbacks.add(calcularSumaTotal());
}


function quitarProducto(codigo) {
    var cantidad = $("input[id='txt" + codigo + "']").val();
//    var cantidad = $("#txt" + codigo).val();
    var suma = parseInt(cantidad) - 1;
    if (suma >= 0) {
        $("input[id='txt" + codigo + "']").val(suma.toFixed(2));
//        $("#txt" + codigo).val(suma.toFixed(2));
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
    var callbacks = $.Callbacks();
    callbacks.add(calcularSumaTotal());
    callbacks.add(calcularSubTotal());
    callbacks.add(sumaDescTotal());
}

function modalProductosGranel(codigo) {
    var cantidad = $("input[id='txt" + codigo + "']").val();
//    var cantidad = $("#txt" + codigo).val();
    $("#txtCantidadModal").val(cantidad);
    var total = $("input[id='txtTotal" + codigo + "']").val();
//    var total = $("#txtTotal" + codigo).val();
    $("#txtTotalModal").val(total);
    $('#mdlGranel').modal('toggle');
    codigoN = codigo;
}
function calcularSumaTotal() {
    var suma = 0;
    for (var x = 0; x < codigos.length; x++) {
        var cod = codigos[x].toUpperCase();
        suma += parseFloat($("input[id='txtTotalDesc" + cod + "']").val());
//        suma += parseFloat($("#txtTotalDesc" + cod).val());
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

    ivaTotal = ((sumaTotalProductos / 1.16) * .16);
//    iva = sumaTotalProductos * 0.16;
//    ivaTotal = sumaTotalProductos * 1.16;
    $("#ivaTotal").val(ivaTotal.toFixed(2));
    $("#totalVenta").val(sumaTotalProductos.toFixed(2));
//    $("#ivaTotal").val(iva.toFixed(2));
//    $("#totalVenta").val(ivaTotal.toFixed(2));




}


function validarCantidad() {
    var ok = false;

    for (var x = 0; x < codigos.length; x++) {
        if ($("input[id='txt" + codigos[x] + "']").val() <= 0) {
            ok = false;
            break;
        }
        else {
            ok = true;
        }
    }
    return ok;
}

function validarDetalle() {
    var ok = false;
    if (codigos.length == 0) {
        ok = false;
    }
    else {
        ok = true;
    }
    return ok;
}



//funcion para saber que tecla esta presionada.
$(document).keydown(function (tecla) {
    if (tecla.keyCode == 113) {
        buscarTecla();
    }
});

function buscarTecla() {
    if (isNaN(codigoN)) {
        codigoN = 0;
    }
    if (codigoN != 0) {
        var cantidad = $("input[id='txt" + codigoN + "']").val();
//        var cantidad = $("#txt" + codigoN).val();
        var suma = parseInt(cantidad) + 1;
        $("input[id='txt" + codigoN + "']").val(suma.toFixed(2));
//        $("#txt" + codigoN).val(suma.toFixed(2));
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

    var nombre = $("#txtNombreCliente").val();
    if (nombre == "") {
        nombre = "1";
    }
    encabezadoVentas.nombreCliente = nombre;
    arrayEncabezadoVenta.push(encabezadoVentas);
}

function guardarDatosDetalle() {
    for (var x = 0; x < codigos.length; x++) {
        var valor = $("select[id='cmb" + codigos[x] + "']").val();
//        var valor = $("#cmb" + codigos[x]).val();
        var datos = valor.split(",");
        var detalleVenta = new xmlConceptosManualmente();
        detalleVenta.unidadMedidaConcepto = "";
        detalleVenta.importeConcepto = $("input[id='txtTotalDesc" + codigos[x] + "']").val();
//        detalleVenta.importeConcepto = $("#txtTotalDesc" + codigos[x]).val();
        detalleVenta.cantidadConcepto = $("input[id='txt" + codigos[x] + "']").val();
//        detalleVenta.cantidadConcepto = $("#txt" + codigos[x]).val();
        detalleVenta.codigoConcepto = $("span[id='codigo" + codigos[x] + "']").text();
//        detalleVenta.codigoConcepto = $("#codigo" + codigos[x]).text();
        detalleVenta.descripcionConcepto = $("span[id='descripcion" + codigos[x] + "']").text();
//        detalleVenta.descripcionConcepto = $("#descripcion" + codigos[x]).text();
        detalleVenta.precioUnitarioConcepto = $("span[id='precioVnt" + codigos[x] + "']").text();
//        detalleVenta.precioUnitarioConcepto = $("#precioVnt" + codigos[x]).text();
        detalleVenta.cdaConcepto = $("input[id='txtTotalDesc" + codigos[x] + "']").val();
//        detalleVenta.cdaConcepto = $("#txtTotalDesc" + codigos[x]).val();
        detalleVenta.desctUnoConcepto = $("input[id='txtDescuentos" + codigos[x] + "']").val();
//        detalleVenta.desctUnoConcepto = $("#txtDescuentos" + codigos[x]).val();
        detalleVenta.idListaPrecio = parseInt(datos[0]);
        arrayDetalleVenta.push(detalleVenta);
    }
    inf.push(arrayDetalleVenta);
}

function cargarProductosCarritoBusqueda(codigo) {
    var info = "codigo=" + codigo.toUpperCase();
    $.get('dameProductoVentas.php', info, function (informacion) {
        if (informacion == 0) {
            alertify.error("No existe el producto con el codigo " + $("#codigoProductoEntradas").val().toUpperCase() + "o no hay en existencia");
        }
        else {
            var callbacks = $.Callbacks();
            callbacks.add(codigos.push(codigo));
            callbacks.add($("#tablaVentas").append(informacion));
            callbacks.add(calcularSumaTotal());
            callbacks.add(calcularSubTotal());
            callbacks.add(sumaDescTotal());
            callbacks.add(alertify.success("Producto Agregado"));
            callbacks.add(guardarProductoOrdenCompraNuevoPorBusqueda(codigo));
            callbacks.add(inf.length = 0);
            callbacks.add(arrayEncabezadoVenta.length = 0);
            callbacks.add(arrayDetalleVenta.length = 0);
        }
    });

}


function eliminar(codigo) {
    $(".botonEliminar").attr("disabled", true);
    for (var x = 0; x < codigos.length; x++) {
        if (codigos[x] == codigo) {
            codigos.splice(x, 1);
            break;
        }
    }
    var callbacks = $.Callbacks();
    callbacks.add(calcularSumaTotal());
    callbacks.add(calcularSubTotal());
    callbacks.add(sumaDescTotal());
    callbacks.add(calcularTotal(codigo));
    if ($("#cmbOrdenCompraV").val() != 0) {
        callbacks.add(calcularSumaTotal());
        callbacks.add(calcularSubTotal());
        callbacks.add(sumaDescTotal());
        callbacks.add(calcularTotal(codigo));
        var idXml = $("#cmbOrdenCompraV").val();
        var encabezadoVentas = new XmlComprobante();
        callbacks.add(encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val());
        callbacks.add(encabezadoVentas.ivaComprobante = $("#ivaTotal").val());
        callbacks.add(encabezadoVentas.sdaComprobante = $("#costoTotal").val());
//      alert($("#subTotalV").val());
        callbacks.add(encabezadoVentas.subTotalComprobante = $("#subTotalV").val());
        callbacks.add(encabezadoVentas.totalComprobante = $("#totalVenta").val());
        callbacks.add(encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val());
        callbacks.add(arrayEncabezadoVenta.push(encabezadoVentas));
        var array;
        callbacks.add(array = JSON.stringify(arrayEncabezadoVenta));
        var info;
        callbacks.add(info = "codigo=" + codigo.toUpperCase() + "&idComprobante=" + idXml + "&array=" + array);
        callbacks.add($.get('eliminarProductoOrdenCompra.php', info, function (informacion) {
            alertify.success(informacion);
            $(".botonEliminar").removeAttr('disabled');
            arrayEncabezadoVenta.length = 0;
        }));
    }
    $("tr[id='tr" + codigo + "']").remove();
//    $("#tr" + codigo).remove();
    return true;
}


function validarUsuario(usuario, password) {
    var informacion = "usuario=" + usuario + "&pass=" + password;
    $.get('validarAdministrador.php', informacion, function (autorizacion) {
        if (autorizacion == 1) {
            $(".autorizar").removeAttr('disabled');
            $("#mdlAutorizacion").modal("hide");
            $("#txtusuario").val("");
            $("#txtPass").val("");
        }
        else {
            alertify.error(autorizacion);
        }
    });
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function verificar() {
    $.get('validarIngresoVentas.php', function (respuesta) {
        if (respuesta == 0) {
            $("#mdlInicioCaja").modal({
                show: true,
                backdrop: false,
                keyboard: false
            });
        }
        else if (respuesta == 2) {
            var callbacks = $.Callbacks();
            callbacks.add(alertify.alert("La caja ya esta cerrada", function () {
                callbacks.add(location.reload());
            }));
        }
        else if (respuesta == 1) {

        }
        else {
            alertify.error(respuesta);
        }
    });
}

$(document).ready(function () {
    $("#tiposPagosNotasCredito").load("dameTiposPagos.php");
    verificar();
    $("#btnGuardarIngresoCaja").click(function () {
        var usuario = $("#txtUsuarioValidarCaja").val();
        var pass = $("#txtPassValidarCaja").val();
        var cantidad = $("#txtIngresoCaja").val();
        if (usuario == "" || pass == "" || cantidad == 0 || cantidad == "") {
            alertify.error("Llene todos los campos");
        }
        else {
            if (cantidad < 0) {
                alertify.error("La cantidad ingresada debe se ser mayor a 0");
            } else {
                var informacion = "us=" + usuario + "&pas=" + pass + "&cant=" + cantidad;
                $.get('guardarIngresoCaja.php', informacion, function (respuesta) {
                    if (respuesta == 1) {
                        alertify.success("Exito, Caja abierta");
                        $("#mdlInicioCaja").modal('hide');
                    }
                    else {
                        alertify.success(respuesta);
                    }
                });
            }
        }
    });

    $("#btnCancelarIngresoCaja").click(function () {
        location.reload();
    });


    $("#cmbOrdenCompraV").hide();
    $("#cmbTipoPago").load("dameTiposPagos.php");
    $("#cmbTipoPagoCobranza").load("dameTiposPagos.php");
    $("#infDatos").hide();
    $("#buscarCodigo").click(function () {
        buscar();
    });
    $("#cmbClientes").load("dameClientes.php", function () {
        $("#cmbClientes").selectpicker();
    });
    $("#folio").load("dameFolioPedidos.php");
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var f = new Date();
    var fecha = "<div> <strong>" + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + "</strong></div>";
    $("#fecha").html(fecha);
    $("#btnAutorizar").click(function () {
        var usuario = $("#txtusuario").val();
        var pass = $("#txtPass").val();
        validarUsuario(usuario, pass);

    });



    $("#guardarVenta").click(function () {
        var paso = true;
        if ($("#cmbTipoPago").val() == 2) {
            paso = validarCredito();
        }
        if (paso == true) {
            if ($("#cmbOrdenCompraV").val() == 0 || $("#cmbClientes").val() == 0) {
                var nombreCliente = $.trim($("#txtNombreCliente").val());
                if ($("#cmbClientes").val() == 0 && nombreCliente == "") {
                    $("#txtNombreCliente").val("");
                    alertify.error("Es requerido el nobre del cliente");
                }
                else {
                    var ok = validarDetalle();
                    if (ok == true) {
                        var ok = validarCantidad();
                        if (ok == true) {
                            guardarDatosDetalle();
                            guardarDatosEncabezado();
                            inf.push(arrayEncabezadoVenta);
                            var informacion = JSON.stringify(inf);
                            $.ajax({
                                type: "POST",
                                url: "guardarVenta.php",
                                data: {data: informacion},
                                cache: false,
                                success: function (informacion) {
                                    if (informacion == 0) {
                                        informacion = "Exito Venta Terminada";
                                        finalizar();
                                    }
                                    var datos = informacion.split(",");
                                    if (datos[0] == 2) {
                                        $("#txtExistencia" + datos[1]).load("dameExistenciaDeUnProducto.php?id=" + datos[1]);
                                        alertify.error("No tenemos demasiados productos en Existencia. Notificar al administrador");
                                        inf = new Array();
                                        arrayDetalleVenta.length = 0;
                                        arrayEncabezadoVenta.length = 0;
                                    }
                                    else {
                                        alertify.success(informacion);
                                    }
                                }
                            });
                        }
                        else {
                            alertify.error("Los productos deben de tener por lo menos 1 de cantidad");
                        }
                    }
                    else {
                        alertify.error("Ingrese productos al carrito");
                    }
                }
            }
            else {
//                Veificando la actualizacion de la venta
                var encabezadoVentas = new XmlComprobante();
                encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val();
                encabezadoVentas.ivaComprobante = $("#ivaTotal").val();
                encabezadoVentas.sdaComprobante = $("#costoTotal").val();
                encabezadoVentas.subTotalComprobante = $("#subTotalV").val();
                encabezadoVentas.totalComprobante = $("#totalVenta").val();
                encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val();
//                alert("el tipo de pago es" + $("#cmbTipoPago").val());
                arrayEncabezadoVenta.push(encabezadoVentas);
                for (var x = 0; x < codigos.length; x++) {
                    var codigo = codigos[x];
                    var valor = $("select[id='cmb" + codigo + "']").val();
                    var datos = valor.split(",");
                    var detalleVenta = new xmlConceptosManualmente();
                    detalleVenta.unidadMedidaConcepto = "KG";
                    detalleVenta.importeConcepto = $("input[id='txtTotalDesc" + codigo + "']").val();
                    detalleVenta.cantidadConcepto = $("input[id='txt" + codigo + "']").val();
                    detalleVenta.codigoConcepto = $("span[id='codigo" + codigo + "']").text();
                    detalleVenta.descripcionConcepto = $("span[id='descripcion" + codigo + "']").text();
                    detalleVenta.precioUnitarioConcepto = $("span[id='precioVnt" + codigo + "']").text();
                    detalleVenta.cdaConcepto = $("input[id='txtTotalDesc" + codigo + "']").val();
                    detalleVenta.desctUnoConcepto = $("input[id='txtDescuentos" + codigo + "']").val();
                    detalleVenta.idListaPrecio = parseInt(datos[0]);
                    detalleVenta.idXmlComprobante = parseInt($("#cmbOrdenCompraV").val());
                    arrayDetalleVenta.push(detalleVenta);
                }
                var callbacks = $.Callbacks();
                callbacks.add(inf.push(arrayDetalleVenta));
                callbacks.add(inf.push(arrayEncabezadoVenta));
                var informacion;
                var info;
                callbacks.add(informacion = JSON.stringify(inf));
                callbacks.add(info = "data=" + informacion);
                $.post('actualizarOrdenCompra.php', info, function (informacion) {
                    if (informacion == 0) {
                        informacion = "Exito Venta Terminada";
                        finalizar();
                    }
                    var datos = informacion.split(",");
                    if (datos[0] == 2) {
                        $("#txtExistencia" + datos[1]).load("dameExistenciaDeUnProducto.php?id=" + datos[1]);
                        alertify.error("No tenemos demasiados productos en Existencia. Notificar al administrador");
                        inf = new Array();
                        arrayDetalleVenta.length = 0;
                        arrayEncabezadoVenta.length = 0;
                    }
                    else {
                        alertify.success(informacion);
                    }
                });
            }
        }
        else {
            alertify.error("El total de Productos rebasa tu credito. Elimina productos de tu carrito");
        }
    });

    $("#btnver").click(function () {
//        alert("click me ");
        var info;
        $("#tdProducto").find(':checked').each(function () {
            var elemento = this;
            var valor = elemento.value;
            var x = validar(valor);
            if (x == false) {
                cargarProductosCarritoBusqueda(valor);
            }

        });
        if (info != undefined) {
            $('#mdlbuscador').modal('toggle');
        }
        else {
            $('#mdlbuscador').modal('toggle');
        }
    });

    $("#btnAutorizacion").click(function () {
        $("#mdlAutorizacion").modal("show");
    });


    $("#cmbClientes").change(function () {
        $("#creditoCliente").html('<div id="creditoCliente" style="margin-left: 35px"></div>');
        $("#cmbTipoPago option[value='1']").attr("selected", true);
        $("#txtNombreCliente").val("");
        if ($("#cmbOrdenCompraV").val() != 0) {
            codigoN = 0;
            $("#tablaVentas").html('<table class="table" id="tablaVentas"><thead><th><center>Codigo</center></th>'
                    + ' <th><center>Descripcion</center></th>'
                    + ' <th><center>Cantidad</center></th>'
                    + ' <th><center>Existencia</center></th>'
                    + ' <th><center>Lst. Precio</center></th>'
                    + ' <th><center>Precio c/u</center></th>'
                    + ' <th><center>Desc.</center></th>'
                    + ' <th><center>Eliminar</center></th>'
                    + ' <th><center>total</center></th>'
                    + ' <th><center>$ Desc.</center></th>'
                    + ' <th><center>$ Total c/d.</center></th>'
                    + ' </thead>'
                    + ' </table>');
            $("#codigoProductoEntradas").val("");
            codigos.length = 0;
            arrayDetalleVenta.length = 0;
            arrayEncabezadoVenta.length = 0;
            inf.length = 0;
            $("#subTotalV").val("0.00");
            $("#costoTotal").val("0.00");
            $("#totalVenta").val("0.00");
            $("#ivaTotal").val("0.00");
            $("#descTotalV").val("0.00");
        }
        var rfc = $("#cmbClientes").val();
        if ($("#cmbClientes").val() == 0) {
            $("#cmbOrdenCompraV").hide();
            $("#cmbOrdenCompra").hide();
            $("#txtNombreCliente").show();
        }
        else {

            $("#cmbOrdenCompraV").load("dameOrdenesCompra.php?rfc=" + rfc, function () {
                $("#cmbOrdenCompraV").show();
                $("#txtNombreCliente").hide();
            });
        }
    });

    $("#cmbTipoPago").change(function () {
        var dato = $("#cmbTipoPago").val();
        var rfc = $("#cmbClientes").val();
        $("#creditoCliente").html('<div id="creditoCliente" style="margin-left: 35px"></div>');
        if (dato == 2) {
            if (rfc != 0) {
                $("#creditoCliente").load("dameCredito.php?rfc=" + rfc);
            }
            else {
                $("#cmbTipoPago option[value='1']").attr("selected", true);
                alertify.error("Seleccione un cliente");
            }
        }
        else if (dato == 5) {
            if (rfc != 0) {
                $("#creditoCliente").load("dameNotaCredito.php?rfc=" + rfc);
            } else {
                $("#cmbTipoPago option[value='1']").attr("selected", true);
                alertify.error("Seleccione un cliente");
            }
        }
    });


    $("#cmbOrdenCompraV").change(function () {
        codigos.length = 0;
        arrayDetalleVenta.length = 0;
        arrayEncabezadoVenta.length = 0;
        inf.length = 0;
        var idxml = $("#cmbOrdenCompraV").val();
        if (idxml > 0) {
            var informacion = 'id=' + idxml;
            $.get('dameCodigos.php', informacion, function (listacodigos) {
                var datosJson = eval(listacodigos);
                for (var i in datosJson) {
                    codigos.push(datosJson[i].codigoProducto);
                }
                var informacion = "id=" + idxml;
                $.get("dameOrdenesCompraEncabezado.php", informacion, function (respuesta) {
                    var da = respuesta.split(",");
                    $("#cmbTipoPago option[value=" + da[0] + "]").attr("selected", true);
                    $("#folio").text(da[1]);
                });
                $("#tablaVentas").load("construirOrdenCompraVentas.php?id=" + idxml);
                $("#contenedorTotales").load("contruirTotales.php?id=" + idxml);
            });
        }
        else {
            $("#cmbTipoPago option[value=1]").attr("selected", true);
            codigoN = 0;
            $("#tablaVentas").html('<table class="table" id="tablaVentas"><thead><th><center>Codigo</center></th>'
                    + ' <th><center>Descripcion</center></th>'
                    + ' <th><center>Cantidad</center></th>'
                    + ' <th><center>Existencia</center></th>'
                    + ' <th><center>Lst. Precio</center></th>'
                    + ' <th><center>Precio c/u</center></th>'
                    + ' <th><center>Desc.</center></th>'
                    + ' <th><center>Eliminar</center></th>'
                    + ' <th><center>total</center></th>'
                    + ' <th><center>$ Desc.</center></th>'
                    + ' <th><center>$ Total c/d.</center></th>'
                    + ' </thead>'
                    + ' </table>');
            $("#codigoProductoEntradas").val("");
            codigos.length = 0;
            arrayDetalleVenta.length = 0;
            arrayEncabezadoVenta.length = 0;
            inf.length = 0;
            $("#folio").load("dameFolioPedidos.php");
            $("#descuentosV").html('<div id="descuentosV"></div>');
            $("#creditoCliente").html('<div id="creditoCliente" style="margin-left: 35px"></div>');
            $("#subTotalV").val("0.00");
            $("#costoTotal").val("0.00");
            $("#totalVenta").val("0.00");
            $("#ivaTotal").val("0.00");
            $("#descTotalV").val("0.00");
        }
    });


    $("#btnGranel").click(function () {
        $("#mdlGranel").modal("hide");
    });


});
function finalizar() {
    codigoN = 0;
//    $('.cmbClientes').selectpicker('deselectAll');
//    $('.cmbClientes').selectpicker('val', '0');
//    $("#cmbClientes option[value='0']").attr("selected", true);
    $("#txtNombreCliente").val('');
    $("#txtNombreCliente").show();
    $("#cmbOrdenCompraV").hide();
    $("#cmbTipoPago option[value='1']").attr("selected", true);
    $("#tablaVentas").html('<table class="table" id="tablaVentas"><thead><th><center>Codigo</center></th>'
            + ' <th><center>Descripcion</center></th>'
            + ' <th><center>Cantidad</center></th>'
            + ' <th><center>Existencia</center></th>'
            + ' <th><center>Lst. Precio</center></th>'
            + ' <th><center>Precio c/u</center></th>'
            + ' <th><center>Desc.</center></th>'
            + ' <th><center>Eliminar</center></th>'
            + ' <th><center>total</center></th>'
            + ' <th><center>$ Desc.</center></th>'
            + ' <th><center>$ Total c/d.</center></th>'
            + ' </thead>'
            + ' </table>');
    $("#codigoProductoEntradas").val("");
    codigos.length = 0;
    arrayDetalleVenta.length = 0;
    arrayEncabezadoVenta.length = 0;
    inf.length = 0;
    $("#cmbClientes option[value=0]").attr("selected", true);
    $("#folio").load("dameFolioPedidos.php");

    $("#descuentosV").html('<div id="descuentosV"></div>');
    $("#creditoCliente").html('<div id="creditoCliente" style="margin-left: 35px"></div>');
    $("#subTotalV").val("0.00");
    $("#costoTotal").val("0.00");
    $("#totalVenta").val("0.00");
    $("#ivaTotal").val("0.00");
    $("#descTotalV").val("0.00");


}

