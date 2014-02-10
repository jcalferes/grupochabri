
function Dato(id, ident, coda, desc)
{
    this.id = id;
    this.ident = ident;
    this.coda = coda;
    this.desc = desc;
}

function  dameValorDescuento1(id) {
    alert('entre');
    var porcentaje = $("#unodct" + id + "").val();
    var expre = /[1234567890]/;
    if (porcentaje.match(expre)) {
        alert('bien');
    } else {
        alert('mal');
    }
//    if (porcentaje == "" || /^\s+$/.test(porcentaje)) {
//        var porcentaje = 0.00;
//        $("#dosdct" + id + "").val("");
//    } else {
//        var porcentaje = $("#unodct" + id + "").val();
//    }
//    var valorunitario = parseFloat($("#valorunitario" + id + "").val());
//    var cantidad = parseFloat($("#cantidad" + id + "").val());
//    var descuento = (porcentaje * valorunitario) / 100;
//    var cda = valorunitario - descuento;
//    $("#cda" + id + "").val(cda.toFixed(2));
//    var importe = cda * cantidad;
//    $("#importe" + id + "").val(importe.toFixed(2));
//    var info = $('#control').val();
//    var nuevosubtotal = 0;
//    for (var n = 0; n < info; n++) {
//        var calculandosubtotal = parseFloat($("#importe" + n + "").val());
//        nuevosubtotal = nuevosubtotal + calculandosubtotal;
//    }
//
//    var nuevoconiva = nuevosubtotal * 0.16;
//    var nuevototal = nuevosubtotal + nuevoconiva;
//    $("#subtotal").val(nuevosubtotal.toFixed(2));
//    $("#coniva").val(nuevoconiva.toFixed(2));
//    $("#total").val(nuevototal.toFixed(2));
}

function  dameValorDescuento2(id) {
    var porcentaje = $("#unodct" + id + "").val();
    if (porcentaje != "") {
        var porcentajedos = $("#dosdct" + id + "").val();
        if (porcentajedos == "" || /^\s+$/.test(porcentajedos)) {
            var porcentajedos = 0.00;
        } else {
            var porcentajedos = $("#dosdct" + id + "").val();
        }
        var valorunitario = parseFloat($("#valorunitario" + id + "").val());
        var cantidad = parseFloat($("#cantidad" + id + "").val());
        var descuento = (porcentaje * valorunitario) / 100;
        var cda = valorunitario - descuento;
        var descuentodos = (porcentajedos * cda) / 100;
        var cdados = cda - descuentodos;
        $("#cda" + id + "").val(cdados.toFixed(2));
        var importedos = cda * cantidad;
        $("#importe" + id + "").val(importedos.toFixed(2));
    } else {
        alertify.error('Primero aplica un primer descuento');
        $("#dosdct" + id + "").val("");
    }
}

$("#validarentrada").click(function() {
    var datos = new Array();
    var info = $('#control').val();
    alert(info);
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

