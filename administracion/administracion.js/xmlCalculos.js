function Comprobante(desctFactura, desctProntoPago, desctGeneral, desctPorProductos, desctTotal, sda, iva, total) {
    this.desctFactura = desctFactura;
    this.desctProntoPago = desctProntoPago;
    this.desctGeneral = desctGeneral;
    this.desctPorProductos = desctPorProductos;
    this.desctTotal = desctTotal;
    this.sda = sda;
    this.iva = iva;
    this.total = total;
}

function Concepto(importe, codigo, cda, desctuno, desctdos) {
    this.importe = importe;
    this.codigo = codigo;
    this.cda = cda;
    this.desctuno = desctuno;
    this.desctdos = desctdos;
}

function consultarProductoId() {
    var rfc = $("#facrfc").text();
    var info = "rfc=" + rfc;
    $("#veridproductos").load("consultarProductoId.php", info, function() {
        $('#dtproductoid').dataTable();
    });
}

function chkPP() {
    var chkpp = $("#chkpp").is(":checked");
    var control = $("#control").val();
    if (chkpp === true) {
        $('#chkpp').prop('checked', true);
        for (var i = 0; i < control; i++) {
            $("#unodct" + i + "").removeAttr("disabled", "disabled");
            $("#dosdct" + i + "").removeAttr("disabled", "disabled");
        }

    }
    if (chkpp === false) {
        $('#chkpp').prop('checked', false);
        for (var i = 0; i < control; i++) {
            $("#unodct" + i + "").attr("disabled", "disabled");
            $("#dosdct" + i + "").attr("disabled", "disabled");
        }
    }
}

function calculaflete() {
    var verificaflete = $("#flete").val();
    var control = $("#control").val();
    if (verificaflete === "" || /^\s+$/.test(verificaflete)) {
        var flete = 0;
    } else {
        if ($("#flete").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
            flete = $("#flete").val();
        } else {
            flete = 0;
        }
    }
    var cantidad = flete / control;
    for (var i = 0; i < control; i++) {
        var importe = parseFloat($("#importe" + i + "").val());
        var nuevoimporte = importe + cantidad;
        $("#importeflete" + i + "").val(nuevoimporte);
    }
    calculaTotales();
}

function chkExtras() {
    var nose = $("#chk").is(":checked");
    var chkpp = $("#chkpp").is(":checked");
    if (nose === true) {
        alertify.confirm("Solo se puede agregar descuentos globales, si ya haz terminado de aplicar descuentos por producto. Deseas continuar?", function(e) {
            if (e) {
                $("#descuentoFactura").removeAttr("disabled", "disabled");
                $("#descuentoProntoPago").removeAttr("disabled", "disabled");
                $("#flete").removeAttr("disabled", "disabled");
                $("#tblconceptos").find("input,button,textarea").attr("disabled", "disabled");
            } else {
                $('#chk').prop('checked', false);
            }
        });
    } else {
        alertify.confirm("Vas a regreasar al apartado de descuentos individaules. Todos los descuentos aqui, aplicados se perderan. Deseas continuar?", function(e) {
            if (e) {
                $("#btnextra").slideDown();
                var control = $('#control').val();
                if (chkpp === true) {
                    for (var i = 0; i < control; i++) {
                        $("#unodct" + i + "").removeAttr("disabled", "disabled");
                        $("#dosdct" + i + "").removeAttr("disabled", "disabled");
                        $("#id" + i + "").removeAttr("disabled", "disabled");
                    }
                } else {
                    for (var i = 0; i < control; i++) {
                        $("#id" + i + "").removeAttr("disabled", "disabled");
                    }
                }

                $("#descuentoFactura").attr("disabled", "disabled");
                $("#descuentoProntoPago").attr("disabled", "disabled");
                $("#flete").attr("disabled", "disabled");
                $("#btnbuscar").removeAttr("disabled", "disabled");
                $("#desctextra").slideUp();
                calculaTotales();
                $("#descuentogeneral").val("0.00");
                $("#descuentoProntoPago").val("");
                $("#descuentoFactura").val("");
                $("#flete").val("");
            } else {
                $('#chk').prop('checked', true);
            }
        });
    }
}

function calculaPF() {
    var subtotal = calculaSubtotal();
    var descuentopf = $("#descuentoFactura").val();
    var porcentajepf = 0;
    if ($("#descuentoProntoPago").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
        var porcentajepp = $("#descuentoProntoPago").val();
        var calculadesctpp = (porcentajepp * subtotal) / 100;
        var totalpp = subtotal - calculadesctpp;
        var subtotalcondesctpp = totalpp;
        var txtdesctgeneral = calculadesctpp;
        if (descuentopf === "" || /^\s+$/.test(descuentopf)) {
            porcentajepf = 0;
            $("#descuentoFactura").val("");
        } else {
            if ($("#descuentoFactura").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
                porcentajepf = $("#descuentoFactura").val();
            } else {
                porcentajepf = 0;
            }
        }
        var calculadesctpf = (porcentajepf * subtotalcondesctpp) / 100;
        var totalpf = subtotalcondesctpp - calculadesctpf;
        $("#subtotal").val(totalpf.toFixed(2));
        var nuevoconiva = totalpf * 0.16;
        var nuevototal = totalpf + nuevoconiva;
        $("#coniva").val(nuevoconiva.toFixed(2));
        $("#total").val(nuevototal.toFixed(2));
        var nuevodesctgeneral = txtdesctgeneral + calculadesctpf;
        $("#descuentogeneral").val(nuevodesctgeneral.toFixed(2));
        var desctpf = parseFloat($("#descuentogeneral").val());
        var desctpp = parseFloat($("#descuentoporproductos").val());
        var desctsuma = desctpf + desctpp;
        $("#sumadescuentos").val(desctsuma.toFixed(2));
    } else {
        if (descuentopf === "" || /^\s+$/.test(descuentopf)) {
            porcentajepf = 0;
            $("#descuentoFactura").val("");
        } else {
            if ($("#descuentoFactura").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
                porcentajepf = $("#descuentoFactura").val();
            } else {
                porcentajepf = 0;
            }
        }
        var calculadesctpf = (porcentajepf * subtotal) / 100;
        var totalpf = subtotal - calculadesctpf;
        var nuevoconiva = totalpf * 0.16;
        var nuevototal = totalpf + nuevoconiva;
        $("#coniva").val(nuevoconiva.toFixed(2));
        $("#total").val(nuevototal.toFixed(2));
        $("#descuentogeneral").val(calculadesctpf.toFixed(2));
        $("#subtotal").val(totalpf.toFixed(2));
        var desctpf = parseFloat($("#descuentogeneral").val());
        var desctpp = parseFloat($("#descuentoporproductos").val());
        var desctsuma = desctpf + desctpp;
        $("#sumadescuentos").val(desctsuma.toFixed(2));
    }
}

function calculaPP() {
    var subtotal = calculaSubtotal();
    var descuentopp = $("#descuentoProntoPago").val();
    var porcentajepp = 0;

    if ($("#descuentoFactura").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {

        var porcentajepf = $("#descuentoFactura").val();
        var calculadesctpf = (porcentajepf * subtotal) / 100;
        var totalpf = subtotal - calculadesctpf;

        var subtotalcondesctpf = totalpf;

        var txtdesctgeneral = calculadesctpf;
        if (descuentopp === "" || /^\s+$/.test(descuentopp)) {
            porcentajepp = 0;
            $("#descuentoProntoPago").val("");
        } else {
            if ($("#descuentoProntoPago").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
                porcentajepp = $("#descuentoProntoPago").val();
            } else {
                porcentajepp = 0;
            }
        }

        var calculadesctpp = (porcentajepp * subtotalcondesctpf) / 100;
        var totalpp = subtotalcondesctpf - calculadesctpp;
        $("#subtotal").val(totalpp.toFixed(2));

        var nuevoconiva = totalpp * 0.16;
        var nuevototal = totalpp + nuevoconiva;


        $("#coniva").val(nuevoconiva.toFixed(2));
        $("#total").val(nuevototal.toFixed(2));

        var nuevodesctgeneral = txtdesctgeneral + calculadesctpp;
        $("#descuentogeneral").val(nuevodesctgeneral.toFixed(2));

        var desctpf = parseFloat($("#descuentogeneral").val());
        var desctpp = parseFloat($("#descuentoporproductos").val());

        var desctsuma = desctpf + desctpp;
        $("#sumadescuentos").val(desctsuma.toFixed(2));

    } else {
        if (descuentopp === "" || /^\s+$/.test(descuentopp)) {
            porcentajepp = 0;
            $("#descuentoProntoPago").val("");
        } else {
            if ($("#descuentoProntoPago").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
                porcentajepp = $("#descuentoProntoPago").val();
            } else {
                porcentajepp = 0;
            }
        }
        var calculadesctpp = (porcentajepp * subtotal) / 100;
        var totalpp = subtotal - calculadesctpp;

        var nuevoconiva = totalpp * 0.16;
        var nuevototal = totalpp + nuevoconiva;


        $("#coniva").val(nuevoconiva.toFixed(2));
        $("#total").val(nuevototal.toFixed(2));

        $("#descuentogeneral").val(calculadesctpp.toFixed(2));
        $("#subtotal").val(totalpp.toFixed(2));

        var desctpf = parseFloat($("#descuentogeneral").val());
        var desctpp = parseFloat($("#descuentoporproductos").val());

        var desctsuma = desctpf + desctpp;
        $("#sumadescuentos").val(desctsuma.toFixed(2));
    }
}

function mostrardescuentos() {
    alertify.confirm("Vas a regreasar al apartado de descuentos individaules. Todos los descuentos aqui, aplicados se perderan. Deseas continuar?", function(e) {
        if (e) {
            $("#btnextra").slideDown();
            var control = $('#control').val();
            for (var i = 0; i < control; i++) {
                $("#unodct" + i + "").removeAttr("disabled", "disabled");
                $("#dosdct" + i + "").removeAttr("disabled", "disabled");
                $("#id" + i + "").removeAttr("disabled", "disabled");
            }
            $("#btnbuscar").removeAttr("disabled", "disabled");
            $("#desctextra").slideUp();
            calculaTotales();
            $("#descuentogeneral").val("0.00");
            $("#descuentoProntoPago").val("");
            $("#descuentoFactura").val("");
        } else {

        }
    });
}

function mostrarextras() {
    alertify.confirm("Solo se puede agregar descuentos globales, si ya haz terminado de aplicar descuentos por producto. Deseas continuar?", function(e) {
        if (e) {
            $("#btnextra").slideUp();
            $("#tblconceptos").find("input,button,textarea").attr("disabled", "disabled");
            $("#desctextra").slideDown();
        } else {

        }
    });
}

function calculaSubtotal() {
    var info = $('#control').val();
    var nuevosubtotal = 0;
    for (var n = 0; n < info; n++) {
        var calculandosubtotal = parseFloat($("#importe" + n + "").val());
        nuevosubtotal = nuevosubtotal + calculandosubtotal;
    }
    return nuevosubtotal;
}

function calculaTotales() {
    var info = $('#control').val();
    var nuevosubtotal = 0;
    for (var n = 0; n < info; n++) {
        var calculandosubtotal = parseFloat($("#importe" + n + "").val());
        nuevosubtotal = nuevosubtotal + calculandosubtotal;
    }

    var nuevoconiva = nuevosubtotal * 0.16;
    var nuevototal = nuevosubtotal + nuevoconiva;


    $("#subtotal").val(nuevosubtotal.toFixed(2));

    $("#coniva").val(nuevoconiva.toFixed(2));
    $("#total").val(nuevototal.toFixed(2));
}

function  calculaDescuentos() {
    var info = $('#control').val();
    var nuevototaldescuentos = 0;
    for (var n = 0; n < info; n++) {
        var calculandototaldescuentos = parseFloat($("#totaldct" + n + "").val());
        nuevototaldescuentos = nuevototaldescuentos + calculandototaldescuentos;
    }
    $("#descuentoporproductos").val(nuevototaldescuentos.toFixed(2));
}

function  dameValorDescuento1(id) {

    var porcentaje = $("#unodct" + id + "").val();
    if (porcentaje === "" || /^\s+$/.test(porcentaje)) {
        porcentaje = 0.00;
        $("#unodct" + id + "").val("");
        $("#dosdct" + id + "").val("");
    } else {
        if ($("#unodct" + id + "").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
            var porcentaje = $("#unodct" + id + "").val();
        } else {
            var porcentaje = 0.00;
        }
    }
    var valorunitario = parseFloat($("#valorunitario" + id + "").val());
    var cantidad = parseFloat($("#cantidad" + id + "").val());
    var descuento = (porcentaje * valorunitario) / 100;
    var descuentotodos = descuento * cantidad;
    $("#totaldct" + id + "").val(descuentotodos.toFixed(2));
    var cda = valorunitario - descuento;
    $("#cda" + id + "").val(cda.toFixed(2));
    var importe = cda * cantidad;
    $("#importe" + id + "").val(importe.toFixed(2));
    calculaDescuentos();
    calculaTotales();

    var desctpf = parseFloat($("#descuentogeneral").val());
    var desctpp = parseFloat($("#descuentoporproductos").val());

    var desctsuma = desctpf + desctpp;
    $("#sumadescuentos").val(desctsuma.toFixed(2));

}

function  dameValorDescuento2(id) {
    var porcentaje = $("#unodct" + id + "").val();
    if (porcentaje !== "" || /^\s+$/.test(porcentaje)) {
        var porcentajedos = $("#dosdct" + id + "").val();
        if (porcentajedos === "" || /^\s+$/.test(porcentajedos)) {
            porcentajedos = 0.00;
            $("#dosdct" + id + "").val("");
        } else {
            if ($("#dosdct" + id + "").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
                var porcentajedos = $("#dosdct" + id + "").val();
            } else {
                var porcentajedos = 0.00;
            }
        }
        var valorunitario = parseFloat($("#valorunitario" + id + "").val());
        var cantidad = parseFloat($("#cantidad" + id + "").val());
        var descuento = (porcentaje * valorunitario) / 100;
        var cda = valorunitario - descuento;
        var descuentodos = (porcentajedos * cda) / 100;
        var sumadescuentos = descuento + descuentodos;
        var sumadescuentostodos = sumadescuentos * cantidad;
        $("#totaldct" + id + "").val(sumadescuentostodos.toFixed(2));
        var cdados = cda - descuentodos;
        $("#cda" + id + "").val(cdados.toFixed(2));
        var importedos = cdados * cantidad;
        $("#importe" + id + "").val(importedos.toFixed(2));
        calculaDescuentos();
        calculaTotales();

        var desctpf = parseFloat($("#descuentogeneral").val());
        var desctpp = parseFloat($("#descuentoporproductos").val());

        var desctsuma = desctpf + desctpp;
        $("#sumadescuentos").val(desctsuma.toFixed(2));

    } else {
        alertify.error('Primero aplica un primer descuento');
        $("#dosdct" + id + "").val("");
    }
}

$("#validarentrada").click(function() {
    var chkpp = $("#chkpp").is(":checked");
    var conceptos = []; //Aqui pondre todos los conceptos de la factura
    var datos = []; //Este me servira para pasar los datos a php
    var control = $('#control').val();//Mi control para recorrer cada textbox de mi XML

    for (var i = 0; i < control; i++) {

        //Validando los campos CODIGO DE PRODUCTO
        var validaid = $("#id" + i + "").val();
        if (validaid === "" || /^\s+$/.test(validaid)) {
            alertify.alert("Falta un codigo de producto");
            return false;
        } else {
            var id = $("#id" + i + "").val();
        }

        //Validando los campos DESCT 1
        var validadesctuno = $("#unodct" + i + "").val();
        var desctuno = 0.00;
        if (validadesctuno === "" || /^\s+$/.test(validadesctuno)) {
            desctuno = 0.00;
        } else {
            if ($("#unodct" + i + "").val().match(/^[0-9\.-]+$/)) {
                desctuno = $("#unodct" + i + "").val();
            } else {
                alertify.error('En la columna Desct. 1: \"' + validadesctuno + '\"' + " no es un descuento valido");
                return false;
            }
        }

        //Validando los campos DESCT 2
        var validadesctdos = $("#dosdct" + i + "").val();
        var desctdos = 0.00;
        if (validadesctdos === "" || /^\s+$/.test(validadesctdos)) {
            desctdos = 0.00;
        } else {
            if ($("#dosdct" + i + "").val().match(/^[0-9\.-]+$/)) {
                desctdos = $("#dosdct" + i + "").val();
            } else {
                alertify.error('En la columna Desct. 2: \"' + validadesctdos + '\"' + ' no es un descuento valido');
                return false;
            }
        }

        var importe = $("#importeflete" + i + "").val();
        if (chkpp === true) {
            var cda = $("#cda" + i + "").val();
        } else {
            var cda = $("#cdao" + i + "").val();
        }

        var concepto = new Concepto(importe, id, cda, desctuno, desctdos);
        conceptos.push(concepto);
    }

    //Validando descuento por factura
    var validadescuentofactura = $("#descuentoFactura").val();
    var descuentofactura = 0.00;
    if (validadescuentofactura === "" || /^\s+$/.test(validadescuentofactura)) {
        descuentofactura = 0.00;
    } else {
        if ($("#descuentoFactura").val().match(/^[0-9\.-]+$/)) {
            descuentofactura = $("#descuentoFactura").val();
        } else {
            alertify.error('\"' + validadescuentofactura + '\"' + ' no es un descuento de factura valido');
            return false;
        }
    }

    //Validando descuento por pronto pago
    var validadescuentoprontopago = $("#descuentoProntoPago").val();
    var descuentoprontopago = 0.00;
    if (validadescuentoprontopago === "" || /^\s+$/.test(validadescuentoprontopago)) {
        descuentoprontopago = 0.00;
    } else {
        if ($("#descuentoProntoPago").val().match(/^[0-9\.-]+$/)) {
            descuentoprontopago = $("#descuentoProntoPago").val();
        } else {
            alertify.error('\"' + validadescuentoprontopago + '\"' + ' no es un descuento por pronto pago valido');
            return false;
        }
    }
    var descuentogeneral = $("#descuentogeneral").val();
    var descuentoporproductos = $("#descuentoporproductos").val();
    var descuentototal = $("#sumadescuentos").val();
    var sda = $("#subtotal").val();
    var iva = $("#coniva").val();
    var total = $("#total").val();

    var comprobante = new Comprobante(descuentofactura, descuentoprontopago, descuentogeneral, descuentoporproductos, descuentototal, sda, iva, total);

    datos.push(conceptos);
    datos.push(comprobante);

    var datosJSON = JSON.stringify(datos);

    $.post('xmlGuardarEntrada.php', {datos: datosJSON}, function(respuesta) {
        if (respuesta == 1) {
            alertify.success("Algo mal");
        }
        if (respuesta == 0) {
            alertify.success("Todo bien");
        } else {
            alertify.error("El prodcuto con codigo: " + respuesta + " no se encuentra en el inventario o no esta asignado a este proveedor");
        }
    }).error(function() {
        console.log('Error al ejecutar la petición');
    });

});

