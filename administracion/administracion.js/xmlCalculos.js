function Dato(id, ident, coda, desc)
{
    this.id = id;
    this.ident = ident;
    this.coda = coda;
    this.desc = desc;
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

    var porcentaje = $("#unodct" + id + "").val()
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
    $("#totaldct" + id + "").val(descuento);
    var cda = valorunitario - descuento;
    $("#cda" + id + "").val(cda.toFixed(2));
    var importe = cda * cantidad;
    $("#importe" + id + "").val(importe.toFixed(2));
    calculaDescuentos();
    calculaTotales();
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
        $("#totaldct" + id + "").val(sumadescuentos);
        var cdados = cda - descuentodos;
        $("#cda" + id + "").val(cdados.toFixed(2));
        var importedos = cdados * cantidad;
        $("#importe" + id + "").val(importedos.toFixed(2));
        calculaDescuentos();
        calculaTotales();
    } else {
        alertify.error('Primero aplica un primer descuento');
        $("#dosdct" + id + "").val("");
    }
}

//$("#validarentrada").click(function() {
//    var datos = new Array();
//    var info = $('#control').val();
//    alert(info);
//    for (var i = 0; i < info; i++) {
//        var id = $("#id" + i + "").val();
//        var cda = $("#total" + i + "").val();
//        if ($("#dct" + i + "").val().match(/^[0-9\.-]+$/)) {
//            var descu = $("#dct" + i + "").val();
//        } else {
//            var quevalor = $("#dct" + i + "").val();
//            alertify.error(quevalor + " no es un descuento valido");
//            return false;
//        }
//        var dat = new Dato(i, id, cda, descu);
//        datos.push(dat);
//    }
//    alert('Todo bien');
//    var datosJSON = JSON.stringify(datos);
//
//    $.post('xmlGuardarEntrada.php', {datos: datosJSON}, function(respuesta) {
//        console.log(respuesta);
//    }).error(function() {
//        console.log('Error al ejecutar la petición');
//    });
//});

