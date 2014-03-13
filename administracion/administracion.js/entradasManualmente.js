var costo = 0;
var cantidadRespaldo = 0;
var costoRespaldo = 0;
var contador = 0;
var sumaDescTotal = 0;

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
                        <td> <input id="descTotal' + contador + '" class="form-control" type= "text" disabled="true" /> </td>\n\
                        <td> <input id="cda' + contador + '" class="form-control" type= "text" value="0" disabled="true"/> </td>\n\
                        <td> <input id="importe' + contador + '" class="form-control" type= "text" value="0" disabled="true"> </input> </td></tr>';
                }
                contador = contador + 1;
                $("#tablaDatosEntrada").append(tr);
                $(".descuentos").attr('disabled', 'disabled');
            }
        });
    }
});

function validar() {
    var valor = $("#numero").val();
    if (valor == '-' || valor == '+') {
    }
    else {
        var paso = soloNumeroEnteros(valor);
        if (paso == false) {
            valor = valor.substring(0, valor.length - 1);
            $("#numero").val(valor);
        }
        else {
        }
    }
}

function calcularPorCosto(id) {
    var costoPorCantidad = $("#costo" + id).val();
    if (costoPorCantidad == "") {
        costoPorCantidad = 0;
    }
    if (costoPorCantidad == '-' || costoPorCantidad == '+') {
    }
    else {
        var paso = soloNumeroEnteros(costoPorCantidad);
        if (paso == false) {
            costoPorCantidad = costoPorCantidad.substring(0, costoPorCantidad.length - 1);
            $("#costo" + id).val(costoPorCantidad);
        }
        else {
            var cantPorCantidad = $("#cant" + id).val();
            if (isNaN(costoPorCantidad)) {
                costoPorCantidad = 0;
            }
            if (isNaN(cantPorCantidad)) {
                cantPorCantidad = 0;
            }
            var importe = costoPorCantidad * cantPorCantidad;
            $("#importe" + id).val(importe);
            sumaDeSubtotales();
            calcularSDA();
            calcularIva();
            calculaTotalEntradasManual();
        }
    }
}
function calcularPorCantidad(id) {
    var cantPorCantidad = $("#cant" + id).val();
    if (cantPorCantidad == '-' || cantPorCantidad == '+') {
    }
    else {
        var paso = soloNumeroEnteros(cantPorCantidad);
        if (paso == false) {
            cantPorCantidad = cantPorCantidad.substring(0, cantPorCantidad.length - 1);
            $("#cant" + id).val(cantPorCantidad);
        }
        else {
            var costoPorCantidad = $("#costo" + id).val();
            if (isNaN(costoPorCantidad)) {
                costoPorCantidad = 0;
            }
            if (isNaN(cantPorCantidad)) {
                cantPorCantidad = 0;
            }
            var importe = costoPorCantidad * cantPorCantidad;
            $("#importe" + id).val(importe);

            sumaDeSubtotales();
            calcularSDA();
            calcularIva();
            calculaTotalEntradasManual();
        }
    }


}
function calculaTotalEntradasManual() {
    var sda = $("#sdaM").val();
    if (isNaN(sda)) {
        sda = 0;
    }
    var iva = $("#ivaM").val();
    if (isNaN(iva)) {
        iva = 0;
    }
    var total = parseFloat(sda) + parseFloat(iva);
    $("#costoTotal").val(total);
}

function calcularDescuentos(id) {
    var importe;
    var nuevoImporte;
    var descuento1 = $("#descuento1" + id).val();
    var descuento2 = $("#descuento2" + id).val();

    if (descuento1 == '-' || descuento1 == '+' || descuento2 == '-' || descuento2 == '+') {
    }
    else {
        var pasoDesc1 = soloNumeroEnteros(descuento1);
        var pasoDesc2 = soloNumeroEnteros(descuento2);
        if (pasoDesc1 == false) {
            descuento1 = descuento1.substring(0, descuento1.length - 1);
            $("#descuento1" + id).val(descuento1);
        }
        else if (pasoDesc2 == false) {
            descuento2 = descuento2.substring(0, descuento2.length - 1);
            $("#descuento2" + id).val(descuento2);
        }
        else {
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

            calcularCda();
            calcularDescuentoDeProductos();
            calcularDescTotal();
            calcularSDA();
            calcularIva();
            calculaTotalEntradasManual();
        }
    }
}

function calcularDescTotal() {
    var descuentoGeneral = $("#descuentoGeneralM").val();
    var descuentoProductos = $("#descuentoProductosM").val();
    if (isNaN(descuentoGeneral)) {
        descuentoGeneral = 0;
    }
    if (isNaN(descuentoProductos)) {
        descuentoProductos = 0;
    }
    var totalDescuentos = descuentoGeneral + descuentoProductos;
    if (isNaN(totalDescuentos)) {
        totalDescuentos = 0;
    }
    $("#descuentoTotalM").val(totalDescuentos);
}

function calcularSDA() {
    var descuentoTotal = $("#descuentoTotalM").val();
    var subTotal = $("#subTotalM").val();
    if (isNaN(descuentoTotal)) {
        descuentoTotal = 0;
    }
    if (isNaN(subTotal)) {
        subTotal = 0;
    }
    var sda = subTotal - descuentoTotal;
    if (isNaN(sda)) {
        sda = 0;
    }
    $("#sdaM").val(sda);
}

function calcularIva() {
    var sda = $("#sdaM").val();
    var iva = 0.16;
    if (isNaN(sda)) {
        sda = 0;
    }
    iva = (sda * iva);
    if (isNaN(iva)) {
        iva = 0;
    }
    $("#ivaM").val(iva);
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

function sumaDeSubtotales() {
    var sumaTotalCantidadCosto = 0;
    var multiplicacion = 0;
    for (var x = 0; x < contador; x++) {
        var cantidad = parseFloat($("#cant" + x).val());
        var costo1 = parseFloat($("#costo" + x).val());
        if (isNaN(costo1)) {
            costo1 = 0;
        }
        if (isNaN(cantidad)) {
            cantidad = 0;
        }
        multiplicacion = cantidad * costo1;
        sumaTotalCantidadCosto = sumaTotalCantidadCosto + multiplicacion;
    }
    $("#subTotalM").val(sumaTotalCantidadCosto);
}

function calcularCda() {
    for (var x = 0; x < contador; x++) {
        var descTotal = 0;
        var cda = 0;
        var desc1 = parseFloat($("#descuento1" + x).val());
        var desc2 = parseFloat($("#descuento2" + x).val());
        if (isNaN(desc1)) {
            desc1 = 0;
        }
        if (isNaN(desc2)) {
            desc2 = 0;
        }
        var importe = parseFloat($("#cant" + x).val()) * parseFloat($("#costo" + x).val());
        var importe1 = (importe * parseFloat(desc1)) / 100;
        if (isNaN(importe1)) {
            importe1 = 0;
        }
        descTotal = parseFloat(descTotal) + parseFloat(importe1);
        var importe2 = ((importe - importe1) * parseFloat(desc2)) / 100;
        if (isNaN(importe2)) {
            importe2 = 0;
        }
        cda = (importe - (importe1 + importe2));
        cda = cda / $("#cant" + x).val();
        descTotal = parseFloat(descTotal) + parseFloat(importe2);
        if (isNaN(descTotal)) {
            descTotal = 0.00;
        }
        $("#descTotal" + x).val(descTotal);
        if (isNaN(cda)) {
            cda = 0.00;
        }
        $("#cda" + x).val(cda);
    }
}
function calcularDescuentoDeProductos() {
    var descuentoProductos = 0;
    for (var x = 0; x < contador; x++) {
        descuentoProductos = (parseFloat(descuentoProductos) + parseFloat($("#descTotal" + x).val()));
    }
    if (isNaN(descuentoProductos)) {
        descuentoProductos = 0;
    }
    $("#descuentoProductosM").val(parseFloat(descuentoProductos));
}
function soloNumeroEnteros(valor) {
    var paso = false;
    if (valor == 0) {
        paso = true;
    }
    else if (valor.match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
        paso = true;
    }
    return paso;
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

    $("#descuentosGeneralesM").change(function() {
        if ($("#descuentosGeneralesM").is(':checked')) {
//              $("#descuentosGeneralesM").attr('disabled', 'disabled');
            $("#descuentosGeneralesPorComasM").removeAttr('disabled');
        }
        else {
            $("#descuentosGeneralesPorComasM").attr('disabled', 'disabled');
        }
    });
});

