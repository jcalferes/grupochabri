function Dato(id, ident, coda, desc) {
    this.id = id;
    this.ident = ident;
    this.coda = coda;
    this.desc = desc;
}
function test() {
    var rfc = $("#facrfc").text();
    var info = "rfc=" + rfc;
    $("#veridproductos").load("consultarProductoId.php", info, function() {
        $('#dtproductoid').dataTable();
    });
}


//$(document).ready(function() {
//    $("#veridproductos").load("consultarProductoId.php", function() {
//        $('#dtproductoid').dataTable();
//    });
//});

function chkExtras() {
//    var eme = $("#facrfc").text();
//    alert(eme);
    var nose = $("#chk").is(":checked");
    if (nose === true) {
        alertify.confirm("Solo se puede agregar descuentos globales, si ya haz terminado de aplicar descuentos por producto. Deseas continuar?", function(e) {
            if (e) {
                $("#descuentoFactura").removeAttr("disabled", "disabled");
                $("#descuentoProntoPago").removeAttr("disabled", "disabled");
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
                for (var i = 0; i < control; i++) {
                    $("#unodct" + i + "").removeAttr("disabled", "disabled");
                    $("#dosdct" + i + "").removeAttr("disabled", "disabled");
                    $("#id" + i + "").removeAttr("disabled", "disabled");
                }
                $("#descuentoFactura").attr("disabled", "disabled");
                $("#descuentoProntoPago").attr("disabled", "disabled");
                $("#btnbuscar").removeAttr("disabled", "disabled");
                $("#desctextra").slideUp();
                calculaTotales();
                $("#descuentogeneral").val("0.00");
                $("#descuentoProntoPago").val("");
                $("#descuentoFactura").val("");
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
//        alert('Si hay valor den DESCTPF');

        var porcentajepf = $("#descuentoFactura").val();
        var calculadesctpf = (porcentajepf * subtotal) / 100;
        var totalpf = subtotal - calculadesctpf;

        var subtotalcondesctpf = totalpf;
//        alert('Subtotal con Desct.PF aplicado: ' + subtotalcondesctpf);

        var txtdesctgeneral = calculadesctpf;
//        alert('Cantidad en la casilla Desct. General: ' + txtdesctgeneral);
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
//        alert('Porcentage con el que voy a calcular: ' + porcentajepp);

        var calculadesctpp = (porcentajepp * subtotalcondesctpf) / 100;
//        alert('Cantidad a descontar del subtotal y con Desct.PF: ' + calculadesctpp);
        var totalpp = subtotalcondesctpf - calculadesctpp;
//        alert('Nuevo subtotal: ' + totalpp);
        $("#subtotal").val(totalpp.toFixed(2));

        var nuevoconiva = totalpp * 0.16;
        var nuevototal = totalpp + nuevoconiva;


        $("#coniva").val(nuevoconiva.toFixed(2));
        $("#total").val(nuevototal.toFixed(2));

        var nuevodesctgeneral = txtdesctgeneral + calculadesctpp;
//        alert('Nuevo descuento genral: ' + nuevodesctgeneral);
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

//    var desctpp = parseFloat($("#descuentoProntoPago").val());
//    var desctff = parseFloat($("#descuentoFactura").val());
//
//    if (desctpp === "" || /^\s+$/.test(desctpp) || desctpp === 0) {
//        var reglapp = 0;
//    } else {
//        if ($("#descuentoProntoPago").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
//            var reglapp = (desctpp * nuevosubtotal) / 100;
//        } else {
//            var reglapp = 0;
//        }
//    }
//    alert(reglapp);
//
//    if (desctff === "" || /^\s+$/.test(desctff) || desctff === 0) {
//        var reglaff = 0;
//    } else {
//        if ($("#descuentoFactura").val().match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
//            var reglaff = (desctff * nuevosubtotal) / 100;
//        } else {
//            var reglaff = 0;
//        }
//    }
//    alert(reglaff);
//
//    var totaldesctgeneral = reglapp + reglaff;
//    alert(totaldesctgeneral);
//    $("#descuentogeneral").val(totaldesctgeneral.toFixed(2));


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
    var datos = new Array();
    var info = $('#control').val();
    for (var i = 0; i < info; i++) {
        var id = $("#id" + i + "").val();
        var cda = $("#total" + i + "").val();
        if ($("#dct" + i + "").val().match(/^[0-9\.-]+$/)) {
            var descu = $("#dct" + i + "").val();
        } else {
            var quevalor = $("#dct" + i + "").val();
            alertify.error(quevalor + " no es un descuento valido");
            return false;
        }
        var dat = new Dato(i, id, cda, descu);
        datos.push(dat);
    }
    alert('Todo bien');
//    var datosJSON = JSON.stringify(datos);
//
//    $.post('xmlGuardarEntrada.php', {datos: datosJSON}, function(respuesta) {
//        console.log(respuesta);
//    }).error(function() {
//        console.log('Error al ejecutar la petición');
//    });
});

