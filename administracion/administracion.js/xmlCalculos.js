
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
//        cda.push(valor);
//        alert(cda[0]);
    });
}

function  dameValorId(id) {
    var info = $("#id" + id + "").val();
    alert(info);
    ids[id] = info;
}

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

