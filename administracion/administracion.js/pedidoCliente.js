var costo = 0;
var cantidadRespaldo = 0;
var costoRespaldo = 0;
var contador = 1;
var sumaDescTotal = 0;
var folio = 0;
var tr2 = "";
var tr3 = "";
var subtotal = 0;

function eliminandoFila(fila, bandera) {

    var total = 0;
    var subtotal = 0;
    var subtotal = 0;
    var descgral = 0;
    var descprod = 0;
    var importes = 0;
    if(bandera == 1){
    $(".pedido").prop("disabled", false);
       $("#btnbuscador").prop("disabled",false);
        $("#guardaEnviaOrden").show();
        $("#CancelarOrden").show();
        $("#enviarOrdenCompra").hide();
//        $("#emailProveedor").load("mostrarEmailsProveedor.php");
//        $("#emailProveedor").show();
        $("#descuentosGlobalesManuales").prop('checked', true);
    }
    $('#fila' + fila + '').each(function() {
        $(this).remove();

    });
    $('.totales').each(function() {
        var elemento = this;
        var valor = elemento.value;
//        var nombre = elemento.name;
//        var cantidad = $("#cant" + nombre).val();
//        var sumaImporte=parseFloat(valor) * parseFloat(cantidad);
        importes += parseFloat(valor);
//        alert( " costo="+valor  );
    });

//    $('.cdas').each(function() {
//        var elemento = this;
//        var valor = elemento.value;
//        descprod += parseFloat(valor);
//
//    });

    $('.costos2').each(function() {
        var elemento = this;
        var valor = elemento.value;
        subtotal += parseFloat(valor);

    });
//    $('.desct').each(function() {
//        var elemento = this;
//        var valor = elemento.value;
//        descprod += parseFloat(valor);
//
//    });
//    var descgral = parseFloat(importes) * (parseFloat($("#descuentosGeneralesPorComasM").val() / 100));
//    var descuentoTotal = parseFloat(descprod) + parseFloat(descgral);
//    var sdam = parseFloat(subtotal) - parseFloat(descuentoTotal);
    var iva = parseFloat(importes) * .16;

    $("#subTotalM").val(parseFloat(importes).toFixed(2));
//    $("#descuentoGeneralM").val(descgral);
//    $("#descuentoProductosM").val(descprod);
//    $("#descuentoTotalM").val(descuentoTotal);
//    $("#sdaM").val(sdam);
    $("#ivaM").val(parseFloat(iva).toFixed(2));
    var costoTotalM = parseFloat(importes) + parseFloat(iva);
    $("#costoTotal").val(costoTotalM.toFixed(2));
}

function verOrdenCompra(folio, comprobante) {
//    alert("folio:" + folio + " comprobante:" + comprobante);
    var info = "valor=" + folio + "&comprobante=PEDIDO CLIENTE";
    window.open('generarReporte.php?' + info);

}

function listarProductos() {
    var idMarcas = new Array();
    var info;
    $("#tdProducto").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
//        alert(valor);
        idMarcas.push(valor);
        lista = JSON.stringify(idMarcas);
        info = "codigos=" + lista;



    });
    if (info != undefined) {
//        alert("entro");

        $.get('consultaMasivaProductos.php', info, function(x) {
            var valorando = 0;
            lista = JSON.parse(x);
            console.log(lista);
            $.each(lista, function(ind, elem) {
//                alert(elem);
                $.each(elem, function(ind, elem2) {
//                    alert(elem2);
                    $.each(elem, function(ind, elem2) {
//                        alert(elem[ind].tarifa);

                        $('.CProducto').each(function() {

                            var elemento = this;
                            var nombre = elemento.name;
                            var valor = elemento.value;
//                            alert(elemento.name);
                            if (valor == elem[ind].codigoproducto && elem[ind].codigoproducto !== "nada") {
//            alertify.error("ya existe");
                                valorando = nombre;

                            }
                        });
                        if (valorando == '0') {
                            tr = '<tr id="fila' + contador + '"><td><a onclick="eliminandoFila(' + contador + ')">x</a></td>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades pedido" type= "text" name="' + contador + '" value="1" > </input> </td>\n\
                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + elem[ind].codigoproducto + '" disabled></td>\n\
                        <td><span id="descripcionM' + contador + '">' + elem[ind].producto + '</span></td>\n\\n\
                        <td><span id="costoUnitarioM' + contador + '" >' + parseFloat(elem[ind].tarifa).toFixed(0) + '</span></td>\n\
                        <td> <input type="text" id="costo' + contador + '"  class="form-control cantidades costos" value="' + parseFloat(elem[ind].cantidad).toFixed(0) + '" disabled> </input>\n\
                        </td>\n\
                       <td><input id="importe' + contador + '" class="form-control totales" type= "text" value="' + parseFloat(elem[ind].tarifa) + '" name="' + contador + '" disabled="true"> </input> </td>\n\
        <td> <input id="cda' + contador + '" class="form-control" type= "hidden" value="0" disabled="true"/> <input id="costoUnitarioM' + contador + '" type="hidden" value="' + elem[ind].precioUnitarioConcepto + '" class="costos2"/> </td></tr>';
                            $("#tablaDatosEntrada").append(tr);
                            contador = contador + 1;

                            subtotal = $("#subTotalM").val();
                            $("#subTotalM").val(parseFloat(subtotal) + parseFloat(elem[ind].tarifa));
                            var newsubtotal = $("#subTotalM").val();
                            $("#ivaM").val(parseFloat(newsubtotal) * parseFloat(0.16));
                            $("#sdaM").val(parseFloat(subtotal) + parseFloat(elem[ind].tarifa));
                            $("#costoTotal").val(parseFloat($("#ivaM").val()) + parseFloat($("#sdaM").val()));
                            $(".descuentos").attr('disabled', 'disabled');
                            $("#guardarOrdenCompra").show();
                            $("#CancelarOrden").show();
                        } else {
                            alertify.error("Se sumo producto con exito");
                            sumar = $("#cant" + valorando).val();
                            total = 1 + parseInt(sumar);
                            $("#cant" + valorando).val(total);
                            calcularPorCantidad(valorando);
                            valorando = 0;
                        }
                    });

                });


            });

        });

        $('#mdlbuscador').modal('toggle');
    } else {
        alertify.error("Debes seleccionar al menos un producto");
    }
}

function seleccionTipo() {
    var cotizar = $("#cotizar").is(":checked");
    var orden = $("#orden").is(":checked");
    if (orden == true) {
        $("#btnbuscador").prop("disabled", true);
        $("#codigoProductoEntradas").val("");
        $("#descuentosGeneralesM").prop("checked", false);
        $("#descuentosGlobalesManuales").prop("checked", false);
        contador = 1;
        folio = 0;
//        $("#emailProveedor").selectpicker('hide');
//        $("#lblemailP").hide('slow');
//        $("#txtEmail").hide('slow');
//        $("#lblemailO").hide('slow');
//        $('#proveedores').prop("disabled", true);
//        $("#proveedores").selectpicker('hide');
        $("#guardarOrdenCompra").hide();
        $("#guardaEnviaOrden").hide();
        $("#sucursal").hide("slow");
        $("#folioM").show('slow');
        $("#folio").show('slow');
        $("#folio").val("");
        $(".resultando").val(0);
//        $("#ModificarOrden").show('slow');
        $("#folioM").prop("disabled", false);
        $("#codigoProductoEntradas").prop("disabled", true);
        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
    } else {
        $("#btnbuscador").prop("disabled", false);
        $("#codigoProductoEntradas").val("");

        $("#descuentosGeneralesM").prop("checked", false);
        $("#descuentosGlobalesManuales").prop("checked", false);
        contador = 1;
        folio = 0;
        $("#sucursal").prop("disabled", false);
        $("#sucursal").show("slow");
         $("#sucursal").val("0");
        $("#codigoProductoEntradas").prop("disabled", false);
        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
        $("#enviarOrdenCompra").hide("slow");
//        $('#proveedores').selectpicker("val", 0);
        $("#folio").val("");
//        $('#proveedores').prop("disabled", false);


        $(".resultando").val(0);
        $("#ModificarOrden").hide('slow');
        $("#guardaEnviaOrden").hide('slow');
        $("#CancelarOrden").hide();

//        $("#guardarOrdenCompra").show();
//        $('#proveedores').selectpicker('show');
//        $("#emailProveedor").selectpicker('hide');
//        $("#lblemailP").hide('slow');
//        $("#txtEmail").hide('slow');
//        $("#lblemailO").hide('slow');

        $("#folioM").hide('slow');
        $("#folio").hide('slow');
    }

}
$("#folioM").keypress(function(e) {
    if (e.which == 13) {
//        alert("entro");
//        $("#enviarOrdenCompra").prop('value', "Enviar Orden de Compra");
//        $("#enviarOrdenCompra").prop('id', "enviarOrdenCompra");
        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
        var info = "folio=" + $("#folioM").val() + "&comprobante=PEDIDO CLIENTE";
//        alert(info);
        $.get('consultaClientePedido.php', info, function(x) {
            if (x == 0) {
                alertify.error("No existe este codigo");
            } else {

                lista = JSON.parse(x);
                console.log(lista);
                var sucursal;
                $.each(lista, function(ind, elem) {
                    $.each(elem, function(ind, elem2) {
                        sucursal = elem[ind].idSucursal;
                        tr2 = '<tr id="fila' + contador + '"><td><a onclick="eliminandoFila(' + contador + ',1)">x</a></td>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + '),calcularPorCosto(' + contador + ');" class="form-control cantidades pedido" type= "text" value="' + elem[ind].cantidadConcepto + '" disabled="true"> </input> </td>\n\
                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + elem[ind].codigoConcepto + '" disabled></td>\n\
                        <td><span id="descripcionM' + contador + '">' + elem[ind].descripcionConcepto + '</span></td>\n\\n\
                        <td><span id="costoUnitarioM' + contador + '" >' + parseFloat(elem[ind].precioUnitarioConcepto) + '</span></td>\n\
                        <td> <input type="text" id="costo' + contador + '" class="form-control  costos" value="' + parseFloat(elem[ind].costoCotizacion) + '" disabled disabled="true"> </input\n\
                        </td>\n\
                        <td><input id="importe' + contador + '" class="form-control totales" type= "text"  disabled="true" value="' + parseFloat(elem[ind].importeConcepto) + '" name="' + contador + '"> </input>  </td>\n\
                        <td><input id="cda' + contador + '" class="form-control" type= "hidden"  disabled="true" value="' + elem[ind].cdaConcepto + '"/> <input id="costoUnitarioM' + contador + '" type="hidden" value="' + elem[ind].precioUnitarioConcepto + '" class="costos2"/> </td></tr>';
                        contador = contador + 1;
                        tr3 += '<tr>\n\
                        <td> \n\
                        ' + elem[ind].cantidadConcepto + '</td>\n\
                        <td>' + elem[ind].codigoConcepto + '</td>\n\
                        <td>' + elem[ind].descripcionConcepto + '</td>\n\
                        <td>' + elem[ind].precioUnitarioConcepto + '</td>\n\
                        <td> ' + elem[ind].costoCotizacion + '\n\
                        </td>\n\
                       <td> ' + elem[ind].cdaConcepto + '</td>\n\
                        <td> ' + elem[ind].importeConcepto + '</td></tr>';

                        $("#tablaDatosEntrada").append(tr2);
                        $("#subTotalM").val(parseFloat(elem[ind].subtotalComprobante));

                        $("#sdaM").val(parseFloat(elem[ind].sdaComprobante));
                        $("#ivaM").val(parseFloat(elem[ind].ivaComprobante));
                        $("#costoTotal").val(parseFloat(elem[ind].totalComprobante));

                        $('#rfcComprobante').selectpicker("val", "\"" + elem[ind].rfcComprobante + "\"");

//                        $('#proveedores').selectpicker("val", elem[ind].rfcComprobante);
//                        $('#proveedores').prop("disabled", true);
                        $("#ModificarOrden").show('slow');



//                        $("#emailProveedor").load("mostrarEmailsProveedor.php?rfc=" + elem[ind].rfcComprobante, function() {
//                            $("#emailProveedor").selectpicker();
//                            $("#emailProveedor").selectpicker('show');
//
//                        });
//                        $("#txtEmail").show('slow');
//
//                        $("#lblemailP").show('show');
//                        $("#lblemailO").show('show');
//                        $("#proveedores").selectpicker('show');
                        $("#sucursal").show();
                        $("#sucursal").val(sucursal);

                        $("#sucursal").prop("disabled", true);
                        $("#guardaEnviaOrden").hide();
                        $("#CancelarOrden").show();
//                        $("#enviarOrdenCompra").hide();
                        $("#folioM").prop("disabled", true);
                        $("#codigoProductoEntradas").prop("disabled", true);



                    });
                });

            }

        });
    }
});
$("#codigoProductoEntradas").keypress(function(e) {
    if (e.which == 13) {
        valorando = 0;
        $('.CProducto').each(function() {

            var elemento = this;
            var nombre = elemento.name;
            var valor = elemento.value;
//            alert(elemento.name);
            if ($("#codigoProductoEntradas").val() == valor && $("#codigoProductoEntradas").val() !== "nada") {
//            alertify.error("ya existe");
                valorando = nombre;

            }
        });
        if (valorando == 0) {
            var info = "codigoProducto=" + $("#codigoProductoEntradas").val() + "&proveedor=" + $("#proveedores").val() + "&sucursal=" + $("#sucursal").val();
            $.get('mostrarInformacionProductogral.php', info, function(informacion) {
                if (informacion == 1) {
                    if ($("#sucursal").val() == '0') {
                        alertify.error("Seleccione una sucursal");
                    } else {
                        alertify.error("Error! Producto no dado de alta en ventas online");
                        return false;
                    }

                }
                else {
                    var datosJson = eval(informacion);
                    var tr;
                    for (var i in datosJson) {
                        tr = '<tr id="fila' + contador + '"><td><a onclick="eliminandoFila(' + contador + ')">x</a></td>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades pedido" type= "text" name="' + contador + '" value="1" > </input> </td>\n\
                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + datosJson[i].codigoProducto + '" disabled></td>\n\
                        <td><span id="descripcionM' + contador + '">' + datosJson[i].producto + '</span></td>\n\\n\
                        <td><span id="costoUnitarioM' + contador + '" >' + parseFloat(datosJson[i].costo) + '</span></td>\n\
                        <td> <input type="text" id="costo' + contador + '"  class="form-control cantidades costos" value="' + parseFloat(datosJson[i].existencia) + '" disabled> </input>\n\
                        </td>\n\
                       <td><input id="importe' + contador + '" class="form-control totales" type= "text" value="' + parseFloat(datosJson[i].costo) + '" name="' + contador + '" disabled="true"> </input>  </td>\n\
        <td> <input id="cda' + contador + '" class="form-control" type= "hidden" value="0" disabled="true"/> <input id="costoUnitarioM' + contador + '" type="hidden" value="' + datosJson[i].costo + '" class="costos2"/></td></tr>';
                    }
                    contador = contador + 1;
                    var subtotal = $("#subTotalM").val();
                    var subtotalM = parseFloat(subtotal) + parseFloat(datosJson[i].costo);
                    $("#subTotalM").val(subtotalM.toFixed(2));
                    var newsubtotal = $("#subTotalM").val();
                    var ivaM = parseFloat(newsubtotal) * parseFloat(0.16);
                    $("#ivaM").val(ivaM.toFixed(2));
                    var sdaM = parseFloat(subtotal) + parseFloat(datosJson[i].costo);
                    $("#sdaM").val(sdaM.toFixed(2));
                    var costoTotalM = parseFloat($("#ivaM").val()) + parseFloat($("#sdaM").val());
                    $("#costoTotal").val(costoTotalM.toFixed(2));
                    $("#tablaDatosEntrada").append(tr);
                    $(".descuentos").attr('disabled', 'disabled');
                    $("#guardarOrdenCompra").show();
                    $("#CancelarOrden").show();
                    $("#sucursal").prop("disabled", true);
                }
            });
        } else {
            alertify.error("Se sumo el producto de manera exitosa");
            sumar = $("#cant" + valorando).val();
            total = 1 + parseInt(sumar);
            $("#cant" + valorando).val(total);
            calcularPorCantidad(valorando);

        }
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
    var costoPorCantidad = $("#costoUnitarioM" + id).text();
    if (costoPorCantidad == "") {
        costoPorCantidad = 0;
    }
    if (costoPorCantidad == '-' || costoPorCantidad == '+') {
    }
    else {
        var paso = soloNumeroEnteros(costoPorCantidad);
        if (paso == false) {
            costoPorCantidad = costoPorCantidad.substring(0, costoPorCantidad.length - 1);
            $("#costoUnitarioM" + id).text(costoPorCantidad);
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
            $("#importe" + id).val(importe.toFixed(2));
            sumaDeSubtotales();
            calcularCda();
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
            var costoPorCantidad = $("#costoUnitarioM" + id).text();
            if (isNaN(costoPorCantidad)) {
                costoPorCantidad = 0;
            }
            if (isNaN(cantPorCantidad)) {
                cantPorCantidad = 0;
            }
            var importe = costoPorCantidad * cantPorCantidad;
            $("#importe" + id).val(importe.toFixed(2));
            sumaDeSubtotales();
            calcularCda();
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
    $("#costoTotal").val(total.toFixed(2));
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
            $("#importe" + id).val(nuevoImporte.toFixed(2));
            if (descuento1 === '' && descuento2 === '') {
                var importe = (parseFloat(($("#costoUnitarioM" + id).text()) * parseFloat($("#cant" + id).val())));
                $("#importe" + id).val(importe.toFixed(2));
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
    var descuentoGeneral = parseFloat($("#descuentoGeneralM").val());
    var descuentoProductos = parseFloat($("#descuentoProductosM").val());
    if (isNaN(descuentoGeneral)) {
        descuentoGeneral = 0;
    }
    if (isNaN(descuentoProductos)) {
        descuentoProductos = 0;
    }
    var totalDescuentos = parseFloat(descuentoGeneral) + parseFloat(descuentoProductos);
    if (isNaN(totalDescuentos)) {
        totalDescuentos = 0;
    }
    $("#descuentoTotalM").val(parseFloat(totalDescuentos.toFixed(2)));
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
    $("#sdaM").val(sda.toFixed(2));
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
    $("#ivaM").val(iva.toFixed(2));
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
        var costo1 = parseFloat($("#costoUnitarioM" + x).text());
        if (isNaN(costo1)) {
            costo1 = 0;
        }
        if (isNaN(cantidad)) {
            cantidad = 0;
        }
        multiplicacion = cantidad * costo1;
        sumaTotalCantidadCosto = sumaTotalCantidadCosto + multiplicacion;
    }
    $("#subTotalM").val(sumaTotalCantidadCosto.toFixed(2));
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
        var importe = parseFloat($("#cant" + x).val()) * parseFloat($("#costoUnitarioM" + x).text());
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
        $("#descTotal" + x).val(descTotal.toFixed(2));
        if (isNaN(cda)) {
            cda = 0.00;
        }
        $("#cda" + x).val(cda.toFixed(2));
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
    $("#descuentoProductosM").val(parseFloat(descuentoProductos.toFixed(2)));
}
function soloNumeroEnteros(valor) {
    var paso = false;
    var ultimo = valor.substring(valor.length - 1, valor.length);
    if (ultimo == ".") {
        valor = valor + "0";
    }
    if (valor == 0) {
        paso = true;
    }
    else if (valor.match(/^[-+]?([0-9]*\.[0-9]+|[0-9]+)$/)) {
        paso = true;
    }

    return paso;
}

function generarDescuentosgenerales() {
    $("#descuentoGeneralM").val(0);
    calcularDescTotal();
    calcularSDA();
    var descuent = 0;
    var misDescuentos = new Array();
    var descuentos = $("#descuentosGeneralesPorComasM").val().split(',');
    for (var x = 0; x < descuentos.length; x++) {
        try {
            var valor = parseFloat(descuentos[x]);
            if (isNaN(valor)) {
            }
            else {
                misDescuentos.push(descuentos[x]);
            }
        }
        catch (err) {
        }
    }
    for (var x = 0; x < misDescuentos.length; x++) {
        var sda = $("#sdaM").val();
        if (isNaN(misDescuentos[x])) {
        }
        else {
            descuent = parseFloat(descuent) + (parseFloat(misDescuentos[x]) * parseFloat(sda)) / 100;
        }
        $("#descuentoGeneralM").val(parseFloat(descuent));
        calcularDescTotal();
        calcularSDA();
    }
    calcularIva();
    calculaTotalEntradasManual();
}


$(document).ready(function() {
    $("#btnbuscador").prop("disabled", true);
    $("#sucursal").hide();
    $("#codigoProductoEntradas").prop("disabled", true);
    $("#enviarOrdenCompra").hide();
    $("#guardarOrdenCompra").hide();
    $("#CancelarOrden").hide();
    $("#guardarOrdenCompra").hide();
    $("#guardaEnviaOrden").hide();
//    $("#txtEmail").hide();
    $("#ModificarOrden").hide();
    $("#emailProveedor").hide('slow');
//    $("#lblemailP").hide();
//    $("#lblproveedor").hide();
//    $("#lblemailO").hide();

    $("#guardaEnviaOrden").click(function() {
        var inf = new Array();
        var lstConceptos = new Array();
        var xmlComprobanteManualmente = new XmlComprobante();
        xmlComprobanteManualmente.folioComprobante = $("#folioM").val();
        xmlComprobanteManualmente.fechaComprobante = $("#fechaEmitidaM").val();
        xmlComprobanteManualmente.rfcComprobante = $("#proveedores").val();
        xmlComprobanteManualmente.desctGeneralFactura = $("#descuentosGeneralesPorComasM").val();
        xmlComprobanteManualmente.descuentoTotalComprobante = $("#descuentoTotalM").val();
        xmlComprobanteManualmente.descuentosGenerales = $("#descuentoGeneralM").val();
        xmlComprobanteManualmente.ivaComprobante = $("#ivaM").val();
        xmlComprobanteManualmente.sdaComprobante = $("#sdaM").val();
        xmlComprobanteManualmente.subTotalComprobante = $("#subTotalM").val();
        xmlComprobanteManualmente.descuentoPorProductoComprobantes = $("#descuentoProductosM").val();
        xmlComprobanteManualmente.totalComprobante = $("#costoTotal").val();
        xmlComprobanteManualmente.tipoComprobante = "Entradas Manual";
        var conceptos = new Array();
        for (var x = 0; x < parseInt(contador); x++) {
            var conceptos = new xmlConceptosManualmente();
            conceptos.cantidadConcepto = $("#cant" + x).val();
            conceptos.cdaConcepto = $("#cda" + x).val();
            conceptos.codigoConcepto = $("#codigoM" + x).val();
            conceptos.costoCotizacion = $("#costo" + x).val();
//            alert($("#codigoM" + x).val());
            conceptos.descripcionConcepto = $("#descripcionM" + x).text();
            conceptos.desctUnoConcepto = $("#descuento1" + x).val();
            conceptos.desctDosConcepto = $("#descuento2" + x).val();
            conceptos.importeConcepto = $("#importe" + x).val();
            conceptos.precioUnitarioConcepto = $("#costoUnitarioM" + x).text();
            conceptos.unidadMedidaConcepto = "";
            if ($("#codigoM" + x).val() !== "" && $("#codigoM" + x).val() !== undefined) {
//                alert("entro" + x)
                lstConceptos.push(conceptos);
            }

        }
        inf.push(xmlComprobanteManualmente);
        inf.push(lstConceptos);
        var informacion = JSON.stringify(inf);
//        $.post('guardarOrdenCompra.php', informacion, function(x) {
//           
//            window.location.href = 'generarReporte2.php?tr2=' + tr3;
//            alertify.success("Exito! Orden Guardada" );
//        });
        $.ajax({
            type: "POST",
            url: "guardarPedidoCliente.php",
            data: {data: informacion, band: "modifica", folio: $("#folioM").val(), sucursal: $("#sucursal").val()},
            cache: false,
            success: function(x) {
//                alert(x);
                window.open('generarReporte.php?valor=' + x + '&comprobante=PEDIDO CLIENTE');
                alertify.success("Exito! Orden Guardada");
            }
        });
    });

    $("#ModificarOrden").click(function() {
        $(".cantidades").prop("disabled", false);
        $(".descuentos").prop("disabled", false);
        $("#guardaEnviaOrden").show();
        $("#CancelarOrden").show();
        $("#enviarOrdenCompra").hide();
//        $("#emailProveedor").load("mostrarEmailsProveedor.php");
//        $("#emailProveedor").show();
        $("#descuentosGlobalesManuales").prop('checked', true);


    });

    $("#enviarOrdenCompra").click(function() {
//        alert(folio);
        if ($("#folioM").val() != "") {
            var info = "valor=" + $("#folioM").val();
            window.open('generarReporte.php?' + info + '&comprobante=PEDIDO CLIENTE');
        } else {
            var info = "valor=" + folio;
            window.open('generarReporte.php?' + info + '&comprobante=PEDIDO CLIENTE');
        }
    });

//    $("#proveedores").change(function() {
//        if ($("#proveedores").val() == 0) {
//            $("#codigoProductoEntradas").attr('disabled', 'disabled');
//            $("#buscarCodigoEntradas").attr('disabled', 'disabled');
//
//        }
//        else {
//
//            $("#buscarCodigoEntradas").removeAttr('disabled');
//            $("#codigoProductoEntradas").removeAttr('disabled');
//        }
//    });

//    $("#proveedores").load("mostrarProveedoresManualmente.php", function() {
//        $("#proveedores").selectpicker();
//        $("#proveedores").selectpicker('hide');
//    });
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
            $("#descuentosGeneralesPorComasM").removeAttr('disabled');
          
        }
        else {
            $("#descuentosGeneralesPorComasM").attr('disabled', 'disabled');
        }
    });
    $("#guardarOrdenCompra").click(function() {
        bandera = 0;
        var inf = new Array();
        var lstConceptos = new Array();
        var entro = 0;
        var xmlComprobanteManualmente = new XmlComprobante();
        $('.pedido').each(function() {
  entro = 1;
            var elemento = this;
            var nombre = elemento.name;
            var valor = elemento.value;
//        alert(elemento.name);
            if (parseInt(valor) >= parseInt($("#costo" + nombre).val())) {
//            alertify.error("Debes elegir algun valor");
                bandera = 1;

            }
        });
        if (bandera == 0 && entro >= 1) {
            xmlComprobanteManualmente.folioComprobante = $("#folioM").val();
            xmlComprobanteManualmente.fechaComprobante = $("#fechaEmitidaM").val();
            xmlComprobanteManualmente.rfcComprobante = "XXXXXXXXX"; //$("#proveedores").val();
            xmlComprobanteManualmente.desctGeneralFactura = $("#descuentosGeneralesPorComasM").val();
            xmlComprobanteManualmente.descuentoTotalComprobante = $("#descuentoTotalM").val();
            xmlComprobanteManualmente.descuentosGenerales = $("#descuentoGeneralM").val();
            xmlComprobanteManualmente.ivaComprobante = $("#ivaM").val();
            xmlComprobanteManualmente.sdaComprobante = $("#sdaM").val();
            xmlComprobanteManualmente.subTotalComprobante = $("#subTotalM").val();
            xmlComprobanteManualmente.descuentoPorProductoComprobantes = $("#descuentoProductosM").val();
            xmlComprobanteManualmente.totalComprobante = $("#costoTotal").val();
            xmlComprobanteManualmente.tipoComprobante = "Entradas Manual";
            var conceptos = new Array();
            for (var x = 0; x < parseInt(contador); x++) {
                var conceptos = new xmlConceptosManualmente();
                conceptos.cantidadConcepto = $("#cant" + x).val();
                conceptos.cdaConcepto = $("#cda" + x).val();
                conceptos.codigoConcepto = $("#codigoM" + x).val();
                conceptos.costoCotizacion = $("#costo" + x).val();
//            alert($("#codigoM" + x).val());
                conceptos.descripcionConcepto = $("#descripcionM" + x).text();
                conceptos.desctUnoConcepto = $("#descuento1" + x).val();
                conceptos.desctDosConcepto = $("#descuento2" + x).val();
                conceptos.importeConcepto = $("#importe" + x).val();
                conceptos.precioUnitarioConcepto = $("#costoUnitarioM" + x).text();
                conceptos.unidadMedidaConcepto = "";
                if ($("#codigoM" + x).val() !== "" && $("#codigoM" + x).val() !== undefined) {
                    lstConceptos.push(conceptos);
                }
            }
            inf.push(xmlComprobanteManualmente);
            inf.push(lstConceptos);
            var informacion = JSON.stringify(inf);
            $.ajax({
                type: "POST",
                url: "guardarPedidoCliente.php",
                data: {data: informacion, sucursal: $("#sucursal").val()},
                cache: false,
                success: function(x) {
//                    alert(x);
//                var probando = $("#proveedores").val();
//                    alert(x);
                    var info = 'valor=' + x + '&comprobante=PEDIDO CLIENTE';
                    window.open('generarReporte.php?' + info);
//                $("#enviarOrdenCompra").show();
//                $("#emailProveedor").load("mostrarEmailsProveedor.php?rfc=" + $("#proveedores").val(), function() {
//                    $("#emailProveedor").selectpicker();
//                    $("#emailProveedor").selectpicker('refresh');
//                    $("#emailProveedor").selectpicker('show');
//
//                });
//                $("#lblemailP").show('slow');
//                $("#txtEmail").show('slow');
//                $("#lblemailO").show('slow');
                    alertify.success("Exito! Orden Guardada");
                    var tipo = "PEDIDO%20CLIENTE";
                    $("#tablaOrden").load("cnsultaOrdenesLista.php?tipo=" + tipo);
                }
            });
        } else {
            alertify.error("La cantidad a pedir debe ser menor a la existencia");
        }
    });
    $("#enviarOrdenCompra").click(function() {

    });

    $("#CancelarOrden").click(function() {
        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
        $("#sucursal").prop("disabled", false);
        $("#ModificarOrden").hide();
        $("#CancelarOrden").hide();
        $("#guardaEnviaOrden").hide();
        $("#guardarOrdenCompra").hide();
        $("#enviarOrdenCompra").hide();
        $(".resultando").val(0);
        $("#folioM").prop("disabled", false);
    });
    var tipo = "PEDIDO%20CLIENTE";
    $("#tablaOrden").load("cnsultaOrdenesLista.php?tipo=" + tipo, function() {
        $('#dtproveedor').dataTable();
    });
    $("#sucursal").load("sacarSucursales.php?pedidoCliente='pedido'");

    $("#btnbuscador").click(function() {
        var s = $("#sucursal").val();
        $("#todos").load("consultarBuscador.php?sucursal=" + s, function() {
            $('#tdProducto').dataTable();
        });
        $('#mdlbuscador').modal('toggle');
    });
});
