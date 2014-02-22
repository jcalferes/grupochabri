var costo = 0;
var cantidadRespaldo = 0;
var costoRespaldo = 0;
var contador = 0;

$("#codigoProductoEntradas").keypress(function(e) {
    if (e.which == 13) {
        var info = "codigoProducto=" + $("#codigoProductoEntradas").val() + "&proveedor=" + $("#proveedores").val();
        $.get('mostrarInformacionProductoEntradas.php', info, function(informacion) {
            if (informacion == 1) {
                alertify.error("Error! Producto no dado de alta para este proveedor");
                return false;
            }
            else {
                var datosJson = eval(informacion);
                var tr;
                for (var i in datosJson) {
                    tr = '<tr>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades" type= "text" value="1"> </input> </td>\n\
                        <td>' + datosJson[i].codigoProducto + '</td>\n\
                        <td>' + datosJson[i].producto + '</td>\n\
                        <td> <input type="text" id="costo' + contador + '" onkeyup ="calcularPorCosto(' + contador + ')" class="form-control cantidades"> </input>\n\
                        </td>\n\
                        <td> <input id="descuento1' + contador + '" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" /> </td>\n\
                        <td> <input id="descuento2' + contador + '" onfocus="validarCampoDesc2(' + contador + ');" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" /> </td>\n\
                        <td> <input class="form-control descuentos" type= "text" /> </td>\n\
                        <td> <input id="cda' + contador + '" class="form-control descuentos" type= "text" value=""/> </td>\n\
                        <td> <input id="importe' + contador + '" class="form-control descuentos" type= "text" value="0"> </input> </td></tr>';
                    contador = contador + 1;
                }
                $("#tablaDatosEntrada").append(tr);
                $(".descuentos").attr('disabled', 'disabled');
            }
        });
    }
});

function calcularPorCosto(id) {
    var importe = (parseFloat(($("#costo" + id).val()) * parseFloat($("#cant" + id).val())));
    $("#importe" + id).val(importe);
    calculaTotalEntradasManual();
}

function calcularPorCantidad(id) {
    var importe = (parseFloat(($("#costo" + id).val()) * parseFloat($("#cant" + id).val())));
    $("#importe" + id).val(importe);
    calculaTotalEntradasManual();
}


function calculaTotalEntradasManual() {
    var sumaTotalDeImporte = 0;
    for (var x = 0; x < contador; x++) {
        var importe = parseFloat($("#importe" + x + "").val());
        sumaTotalDeImporte = sumaTotalDeImporte + importe;
    }
    $("#costoTotal").val(sumaTotalDeImporte);
}

function calcularDescuentos(id) {
    var importe;
    var nuevoImporte;
    var descuento1 = $("#descuento1" + id).val();
    var descuento2 = $("#descuento2" + id).val();
    if (descuento1 > 0) {
        calcularPorCosto(id);
        importe = $("#importe" + id).val();
        nuevoImporte = (descuento1 * importe) / 100;
        nuevoImporte = importe - nuevoImporte;
    }
    if (descuento2 > 0) {
        var respaldoImporte = nuevoImporte;
        nuevoImporte = (descuento2 * nuevoImporte) / 100;
        nuevoImporte = respaldoImporte - nuevoImporte;
    }
    $("#importe" + id).val(nuevoImporte);
    if (descuento1 === '' && descuento2 === '') {
        var importe = (parseFloat(($("#costo" + id).val()) * parseFloat($("#cant" + id).val())));
        $("#importe" + id).val(importe);
    }
    calculaTotalEntradasManual();
}


function respaldoCantidad(codigo, costoProducto) {
    $("#costoTotal").val();
    cantidadRespaldo = $("#cant" + codigo).val();
    costoRespaldo = $("#costo" + codigo).val();
}

function  respaldoCosto(codigo) {
    costoRespaldo = $("#costo" + codigo).val();
    cantidadRespaldo = $("#cant" + codigo).val();
}
function validarCampoDesc2(id) {
    if ($("#descuento1" + id).val() == '') {
        alertify.error("Error! El descuento 1 requerido");
        $("#descuento1" + id).focus();
    }
}

$(document).ready(function() {
    $("#proveedores").change(function() {
        if ($("#proveedores").val() == 0) {
            $("#codigoProductoEntradas").attr('disabled', 'disabled');
            $("#buscarCodigoEntradas").attr('disabled', 'disabled');
        }
        else {
            $("#buscarCodigoEntradas").removeAttr('disabled');
            $("#codigoProductoEntradas").removeAttr('disabled');
        }
    });
    $("#proveedores").load("mostrarProveedores.php", function() {
        $("#proveedores").selectpicker();
    });

    $("#descuentosGlobalesManuales").change(function() {
        if ($("#descuentosGlobalesManuales").is(':checked')) {
            for (var x = 0; x < contador; x++) {
                if ($("#costo" + x).val() === '') {
                    $("#descuentosGlobalesManuales").attr('checked', false);
                    alertify.error("Error! Todos los campos son obligatorios");
                    return false;
                }
            }
            $(".descuentos").removeAttr('disabled');
            $(".cantidades").attr('disabled', 'disabled');
        }
        else {
            $(".descuentos").attr('disabled', 'disabled');
            $(".cantidades").removeAttr('disabled');
        }
    });

});

