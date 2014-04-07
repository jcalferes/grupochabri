var codigos = new Array();

$("#codigoProductoEntradas").keypress(function(e) {
    if (e.which == 13) {
        buscar();
    }
});
function buscar() {
    var algo = $("#codigoProductoEntradas").val();
    codigos.push($("#codigoProductoEntradas").val());
    var info = JSON.stringify(codigos);
    $.ajax({
        type: "POST",
        url: "dameProductoVentas.php",
        data: {data: info},
        cache: false,
        success: function(informacion) {
            $("#tablaVentas").load("limpiarTablaPuntoVentas.php", function() {
                var datosJson = eval(informacion);
                var tr;
                for (var i in datosJson) {
                    tr = '<tr>\n\
                          <td>' + datosJson[i].codigoProducto + '</td>\n\
                          <td>' + datosJson[i].producto + '</td>\n\\n\\n\
                          <td>' + datosJson[i].cantidad + '</td>\n\
                          <td>' + datosJson[i].costo + '</td>\n\
                      </tr>\n\ ';
                    $("#tablaVentas").append(tr);
                }
            });
        }
    });




//    $.get('dameProductoVentas.php', info, function(informacion) {
//        if (informacion == 1) {
//            alertify.error("Error! Producto no dado de alta");
//            return false;
//        }
//        else {
//            var datosJson = eval(informacion);
//            var tr;
//            for (var i in datosJson) {
//                tr = '<tr>\n\
//                          <td>' + datosJson[i].codigoProducto + '</td>\n\
//                          <td>' + datosJson[i].producto + '</td>\n\\n\\n\
//                          <td></td>\n\
//                          <td>' + datosJson[i].costo + '</td></tr>\n\ ';
//            }
//            $("#tablaVentas").append(tr);
//        }
//    });
}

$(document).ready(function() {
    $("#buscarCodigo").click(function() {
        buscar();
    });
});