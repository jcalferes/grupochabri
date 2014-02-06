
function Dato(id, ident, coda)
{
    this.id = id;
    this.ident = ident;
    this.coda = coda;
}

function  dameValorDescuento(id) {

    var porcentaje = $("#dct" + id + "").val();
    var info = "id=" + id + "&porcentaje=" + porcentaje;
    $.get('mostrarDescuentos.php', info, function(valor) {

        $("#total" + id + "").val(valor);

        var cantidad = $("#cantidad" + id + "").val();
        var nuevoimporte = valor * cantidad;
        $("#importe" + id + "").val(nuevoimporte)
        var info = $('#control').val();
        alert(info);
        for (var n = 0; n < info; n++) {
            var calculandosubtotal = parseFloat($("#importe" + n + "").val());
            confirm(calculandosubtotal);
        }
        var nuevoconiva = nuevosubtotal * 0.16;
        var nuevototal = nuevosubtotal + nuevoconiva;
        $("#subtotal").val(nuevosubtotal);
        $("#coniva").val(nuevoconiva);
        $("#total").val(nuevototal);
    });
}

//function  dameValorId(id) {
//    var info = $("#id" + id + "").val();
//    alert(info);
//    ids[id] = info;
//}

$("#validarentrada").click(function() {
    var datos = new Array();
    var info = $('#control').val();
    alert(info);
    for (var i = 0; i < info; i++) {
        var id = $("#id" + i + "").val();
        var cda = $("#total" + i + "").val();
        var dat = new Dato(i, id, cda);
        datos.push(dat);
    }

    var datosJSON = JSON.stringify(datos);

    $.post('xmlGuardarEntrada.php', {datos: datosJSON},
    function(respuesta) {
        console.log(respuesta);
    }).error(
            function() {
                console.log('Error al ejecutar la petición');
            }
    );
});

