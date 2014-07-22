var codigos = new Array();
var arrayDetalleVenta = new Array();
var arrayEncabezadoVenta = new Array();
var codigoN;
var inf = new Array();
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
    var info = "codigo=" + $("#codigoProductoEntradas").val().toUpperCase();
    $.get('dameProductoVentas.php', info, function(informacion) {
        var datos = informacion.split(",");
        if (datos[0] == 0) {
            eliminarProducto($("#codigoProductoEntradas").val().toUpperCase());
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
    if ($("#cmbOrdenCompra").val() > 0) {
        var valor = $("#cmb" + codigoN).val();
        var datos = valor.split(",");
        var detalleVenta = new xmlConceptosManualmente();
        detalleVenta.unidadMedidaConcepto = "KG";
        detalleVenta.importeConcepto = $("#txtTotalDesc" + codigoN).val();
        detalleVenta.cantidadConcepto = $("#txt" + codigoN).val();
        detalleVenta.codigoConcepto = $("#codigo" + codigoN).text();
        detalleVenta.descripcionConcepto = $("#descripcion" + codigoN).text();
        detalleVenta.precioUnitarioConcepto = $("#precioVnt" + codigoN).text();
        detalleVenta.cdaConcepto = $("#txtTotalDesc" + codigoN).val();
        detalleVenta.desctUnoConcepto = $("#txtDescuentos" + codigoN).val();
        detalleVenta.idListaPrecio = parseInt(datos[0]);
        detalleVenta.idXmlComprobante = parseInt($("#cmbOrdenCompra").val());
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
            success: function(informacion) {
            }
        });
    }
}


function guardarProductoOrdenCompraNuevoPorBusqueda(codigo) {
    if ($("#cmbOrdenCompra").val() > 0) {
        var valor = $("#cmb" + codigo).val();
        var datos = valor.split(",");
        var detalleVenta = new xmlConceptosManualmente();
        detalleVenta.unidadMedidaConcepto = "KG";
        detalleVenta.importeConcepto = $("#txtTotalDesc" + codigo).val();
        detalleVenta.cantidadConcepto = $("#txt" + codigo).val();
        detalleVenta.codigoConcepto = $("#codigo" + codigo).text();
        detalleVenta.descripcionConcepto = $("#descripcion" + codigo).text();
        detalleVenta.precioUnitarioConcepto = $("#precioVnt" + codigo).text();
        detalleVenta.cdaConcepto = $("#txtTotalDesc" + codigo).val();
        detalleVenta.desctUnoConcepto = $("#txtDescuentos" + codigo).val();
        detalleVenta.idListaPrecio = parseInt(datos[0]);
        detalleVenta.idXmlComprobante = parseInt($("#cmbOrdenCompra").val());
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
        $.post('productoAgregadoOrdenCompra.php', info, function() {
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
        var calulandoKg = (cantidad * datos[1]) / 1;
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
        subTotal = subTotal + parseFloat($("#txtTotal" + codigos[x]).val().toUpperCase());
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
    var calulandoKg = (cantidad * datos[1]);
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
    var kilogramosVnta = (precio * 1) / datos[1];
    if (isNaN(kilogramosVnta)) {
        kilogramosVnta = 0;
    }
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
    calcularSumaTotal();
    calcularSubTotal();
    sumaDescTotal();
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
        detalleVenta.unidadMedidaConcepto = "KG";
        detalleVenta.importeConcepto = $("#txtTotalDesc" + codigos[x]).val();
        detalleVenta.cantidadConcepto = $("#txt" + codigos[x]).val();
        detalleVenta.codigoConcepto = $("#codigo" + codigos[x]).text();
        detalleVenta.descripcionConcepto = $("#descripcion" + codigos[x]).text();
        detalleVenta.precioUnitarioConcepto = $("#precioVnt" + codigos[x]).text();
        detalleVenta.cdaConcepto = $("#txtTotalDesc" + codigos[x]).val();
        detalleVenta.desctUnoConcepto = $("#txtDescuentos" + codigos[x]).val();
        detalleVenta.idListaPrecio = parseInt(datos[0]);
        arrayDetalleVenta.push(detalleVenta);
    }
    inf.push(arrayDetalleVenta);
}

function cargarProductosCarritoBusqueda(codigo) {

    var info = "codigo=" + codigo.toUpperCase();
    $.get('dameProductoVentas.php', info, function(informacion) {
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

    if ($("#cmbOrdenCompra").val() != 0) {
        callbacks.add(calcularSumaTotal());
        callbacks.add(calcularSubTotal());
        callbacks.add(sumaDescTotal());
        callbacks.add(calcularTotal(codigo));
        var idXml = $("#cmbOrdenCompra").val();
        var encabezadoVentas = new XmlComprobante();
        encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val();
        encabezadoVentas.ivaComprobante = $("#ivaTotal").val();
        encabezadoVentas.sdaComprobante = $("#costoTotal").val();
        encabezadoVentas.subTotalComprobante = $("#subTotalV").val();
        encabezadoVentas.totalComprobante = $("#totalVenta").val();
        encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val();
        arrayEncabezadoVenta.push(encabezadoVentas);
        var array = JSON.stringify(arrayEncabezadoVenta);
        var info = "codigo=" + codigo.toUpperCase() + "&idComprobante=" + idXml + "&array=" + array;
        $.get('eliminarProductoOrdenCompra.php', info, function(informacion) {
            alertify.success(informacion);
        });
    }
    $("#tr" + codigo).remove();
    return true;
}










function validarUsuario(usuario, password) {
    var informacion = "usuario=" + usuario + "&pass=" + password;
    $.get('validarAdministrador.php', informacion, function(autorizacion) {
        if (autorizacion == 1) {
            $(".autorizar").removeAttr('disabled');
            $("#mdlAutorizacion").modal("hide");
        }
        else {
            alertify.error(autorizacion);
        }
    });
}





$(document).ready(function() {
    $("#cmbOrdenCompra").hide();
    $("#cmbTipoPago").load("dameTiposPagos.php");
    $("#infDatos").hide();
    $("#buscarCodigo").click(function() {
        buscar();
    });
    $("#cmbClientes").load("dameClientes.php");
    $("#folio").load("dameFolioPedidos.php");
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var f = new Date();
    var fecha = "<div> <strong>" + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + "</strong></div>";
    $("#fecha").html(fecha);

    $("#btnAutorizar").click(function() {
        var usuario = $("#txtusuario").val();
        var pass = $("#txtPass").val();
        validarUsuario(usuario, pass);
    });



    $("#guardarVenta").click(function() {
        var paso = true;
        if ($("#cmbTipoPago").val() == 2 || $("#cmbTipoPago").val() == 5) {
            paso = validarCredito();
        }
        if (paso == true) {
            if ($("#cmbOrdenCompra").val() == 0) {
                guardarDatosDetalle();
                guardarDatosEncabezado();
                inf.push(arrayEncabezadoVenta);
                var informacion = JSON.stringify(inf);
                $.ajax({
                    type: "POST",
                    url: "guardarVenta.php",
                    data: {data: informacion},
                    cache: false,
                    success: function(informacion) {
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
                var encabezadoVentas = new XmlComprobante();
                encabezadoVentas.descuentoTotalComprobante = $("#descTotalV").val();
                encabezadoVentas.ivaComprobante = $("#ivaTotal").val();
                encabezadoVentas.sdaComprobante = $("#costoTotal").val();
                encabezadoVentas.subTotalComprobante = $("#subTotalV").val();
//              alert($("#subTotalV").val());
                encabezadoVentas.totalComprobante = $("#totalVenta").val();
                encabezadoVentas.tipoComprobante = $("#cmbTipoPago").val();
                arrayEncabezadoVenta.push(encabezadoVentas);
                for (var x = 0; x < codigos.length; x++) {
                    var codigo = codigos[x];
                    var valor = $("#cmb" + codigo).val();
                    var datos = valor.split(",");
                    var detalleVenta = new xmlConceptosManualmente();
                    detalleVenta.unidadMedidaConcepto = "KG";
                    detalleVenta.importeConcepto = $("#txtTotalDesc" + codigo).val();
                    detalleVenta.cantidadConcepto = $("#txt" + codigo).val();
                    detalleVenta.codigoConcepto = $("#codigo" + codigo).text();
                    detalleVenta.descripcionConcepto = $("#descripcion" + codigo).text();
                    detalleVenta.precioUnitarioConcepto = $("#precioVnt" + codigo).text();
                    detalleVenta.cdaConcepto = $("#txtTotalDesc" + codigo).val();
                    detalleVenta.desctUnoConcepto = $("#txtDescuentos" + codigo).val();
                    detalleVenta.idListaPrecio = parseInt(datos[0]);
                    detalleVenta.idXmlComprobante = parseInt($("#cmbOrdenCompra").val());
                    arrayDetalleVenta.push(detalleVenta);
                }
                inf.push(arrayDetalleVenta);
                inf.push(arrayEncabezadoVenta);
                var informacion = JSON.stringify(inf);
                var info = "data=" + informacion;
                $.post('actualizarOrdenCompra.php', info, function(informacion) {
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

    $("#btnver").click(function() {
        var info;
        $("#tdProducto").find(':checked').each(function() {
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

    $("#btnAutorizacion").click(function() {
        $("#mdlAutorizacion").modal("show");
    });


    $("#cmbClientes").change(function() {
        if ($("#cmbOrdenCompra").val() != 0) {
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
            $("#cmbOrdenCompra").hide();
        }
        else {
            $("#cmbOrdenCompra").load("dameOrdenesCompra.php?rfc=" + rfc, function() {
                $("#cmbOrdenCompra").show();
            });
        }
    });

    $("#cmbTipoPago").change(function() {
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

    $("#cmbOrdenCompra").change(function() {
        codigos.length = 0;
        arrayDetalleVenta.length = 0;
        arrayEncabezadoVenta.length = 0;
        inf.length = 0;

        var idxml = $("#cmbOrdenCompra").val();
        if (idxml > 0) {
            var informacion = 'id=' + idxml;
            $.get('dameCodigos.php', informacion, function(listacodigos) {
                var datosJson = eval(listacodigos);
                for (var i in datosJson) {
                    codigos.push(datosJson[i].codigoProducto);
                }
                $("#tablaVentas").load("construirOrdenCompraVentas.php?id=" + idxml);
                $("#contenedorTotales").load("contruirTotales.php?id=" + idxml);
            });
        }
        else {
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
});
function finalizar() {
    codigoN = 0;
    $("#cmbClientes option[value='0']").attr("selected", true);
    $("#cmbOrdenCompra option[value='0']").attr("selected", true);
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
    $("#folio").load("dameFolioPedidos.php");
    $("#descuentosV").html('<div id="descuentosV"></div>');
    $("#creditoCliente").html('<div id="creditoCliente" style="margin-left: 35px"></div>');
    $("#cmbOrdenCompra").hide();
    $("#subTotalV").val("0.00");
    $("#costoTotal").val("0.00");
    $("#totalVenta").val("0.00");
    $("#ivaTotal").val("0.00");
    $("#descTotalV").val("0.00");
}

