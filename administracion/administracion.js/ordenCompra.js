var costo = 0;
var cantidadRespaldo = 0;
var costoRespaldo = 0;
var contador = 1;
var sumaDescTotal = 0;
var folio = 0;
var tr2 = "";
var tr3 = "";

function eliminarFila(fila, bandera) {
    var total = 0;
    var subtotal = 0;
    var subtotal = 0;
    var descgral = 0;
    var descprod = 0;
    var importes = 0;
    if (bandera == 1) {
        $(".cantidades").prop("disabled", false);
//        $(".descuentos").prop("disabled", false);
        $("#guardaEnviaOrden").show();
        $("#CancelarOrden").show();
        $("#enviarOrdenCompra").hide();
//        $("#emailProveedor").load("mostrarEmailsProveedor.php");
//        $("#emailProveedor").show();
//        $("#descuentosGlobalesManuales").prop('checked', true);
        $("#btnbuscador").prop("disabled", false);
        $("#codigoProductoEntradas").prop("disabled", false);
    }
    $('#fila' + fila + '').each(function() {
        $(this).remove();

    });
    $('.totales').each(function() {
        var elemento = this;
        var valor = elemento.value;
        importes += parseFloat(valor);

    });

//    $('.cdas').each(function() {
//        var elemento = this;
//        var valor = elemento.value;
//        descprod += parseFloat(valor);
//
//    });

    $('.costos').each(function() {
        var elemento = this;
        var valor = elemento.value;
        if(valor == "" || valor == undefined || valor == null){
            valor = 0;
        }
        var nombre = elemento.name;
        var cantidad = $("#cant" + nombre).val();
        var sumaImporte = parseFloat(valor) * parseFloat(cantidad);
        subtotal += parseFloat(sumaImporte);

    });
    $('.desct').each(function() {
        var elemento = this;
        var valor = elemento.value;
        descprod += parseFloat(valor);

    });
    var precio = subtotal;
   var nuevoPrecio = 0;
      var  cadena = $("#descuentosGeneralesPorComasM").val();
  var arregloCadena = cadena.split(",");
  console.log(arregloCadena);
  for (var x = 0; x < arregloCadena.length; x++) {
      
            var valor = parseFloat(arregloCadena[x]);
            if (isNaN(valor)) {
            }
            else {
               precio = precio * (parseInt(valor)/100)
            }
       nuevoPrecio += precio;
    }    
    $("#subTotalM").val(subtotal);
    $("#descuentoGeneralM").val(nuevoPrecio);
    var descgral =nuevoPrecio;
    var descuentoTotal = parseFloat(descprod) + parseFloat(descgral);
    var sdam = parseFloat(subtotal) - parseFloat(descuentoTotal);
    var iva = parseFloat(sdam) * .16;

    $("#subTotalM").val(subtotal);
   
    $("#descuentoProductosM").val(descprod);
    $("#descuentoTotalM").val(descuentoTotal);
    $("#sdaM").val(sdam);
    $("#ivaM").val(iva);
    $("#costoTotal").val(sdam + iva);

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


                            tr = '<tr  id="fila' + contador + '"><td><center><button type="button" class="btn btn-xs" onclick="eliminarFila(' + contador + ')"><span class="glyphicon glyphicon-remove"></span></button></center></td>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades" type= "text" value="1"> </input> </td>\n\
                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + elem[ind].codigoproducto + '" disabled></td>\n\
                        <td><span id="descripcionM' + contador + '">' + elem[ind].producto + '</span></td>\n\\n\
                        <td><span id="costoUnitarioM' + contador + '">' + elem[ind].costo + '</span></td>\n\
                        <td> <input type="text" id="costo' + contador + '" onkeyup ="calcularPorCosto(' + contador + ')" class="form-control cantidades costos" name="' + contador + '"> </input>\n\
                        </td>\n\
                        <td> <input id="descuento1' + contador + '" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" /> </td>\n\
                        <td> <input id="descuento2' + contador + '" onfocus="validarCampoDesc2(' + contador + ');" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" /> </td>\n\
                        <td> <input id="descTotal' + contador + '" class="form-control desct" type= "text" disabled="true" /> </td>\n\
                        <td> <input id="cda' + contador + '" class="form-control cdas" type= "text" value="0" disabled="true"/> </td>\n\
        <td> <input id="importe' + contador + '" class="form-control totales" type= "text" value="0" disabled="true"> </input> </td></tr>';




//                            tr = '<tr>\n\
//                        <td> \n\
//                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades pedido" type= "text" name="' + contador + '" value="1" > </input> </td>\n\
//                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + elem[ind].codigoproducto + '" disabled></td>\n\
//                        <td><span id="descripcionM' + contador + '">' + elem[ind].producto + '</span></td>\n\\n\
//                        <td><span id="costoUnitarioM' + contador + '">' + elem[ind].costo + '</span></td>\n\
//                        <td> <input type="text" id="costo' + contador + '"  class="form-control cantidades costos" value="" disabled> </input></td>\n\
//                        \
//                       <td> <input id="cda' + contador + '" class="form-control" type= "text" value="0" disabled="true"/> </td>\n\
//        <td> <input id="importe' + contador + '" class="form-control" type= "text" value="' + elem[ind].costo + '" disabled="true"> </input> </td></tr>';
                            $("#tablaDatosEntrada").append(tr);
                            contador = contador + 1;
// $("#subTotalM").val(elem[ind].costo);
//                        $("#descuentoGeneralM").val(elem[ind].desctGeneralComprobante);
//                        $("#descuentoProductosM").val(elem[ind].desctPorProductosComprobante);
//                        $("#descuentoTotalM").val(elem[ind].desctTotalComprobante);
                            $("#sdaM").val(elem[ind].sdaComprobante);
                            $("#ivaM").val(elem[ind].ivaComprobante);
                            $("#costoTotal").val(elem[ind].totalComprobante);
                            $("#descuentosGlobalesManuales").prop("disabled", false);
                            $("#descuentosGeneralesM").prop("disabled", false);
                            if ($("#descuentosGlobalesManuales").is(":checked") == true) {
                                $(".descuentos").prop("disabled", false);
                                $(".cantidades").prop("disabled", true);

                            } else {
                                $(".descuentos").prop("disabled", true);
                                $(".cantidades").prop("disabled", false);
                            }
//                            subtotal = $("#subTotalM").val();
//                            $("#subTotalM").val(parseFloat(subtotal) + parseFloat(elem[ind].costo));
//                            var newsubtotal = $("#subTotalM").val();
//                            $("#ivaM").val(parseFloat(newsubtotal) * parseFloat(0.16));
//                            $("#sdaM").val(parseFloat(subtotal) + parseFloat(elem[ind].costo));
//                            $("#costoTotal").val(parseFloat($("#ivaM").val()) + parseFloat($("#sdaM").val()));
//                            $(".descuentos").attr('disabled', 'disabled');
//                            $("#guardarOrdenCompra").show();
//                            $("#CancelarOrden").show();
                        } else {
                            alertify.error("ya existe");
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
        $("#proveedores").selectpicker("disabled", true);
        $("#guardarOrdenCompra").show();
        $("#CancelarOrden").show();
        $('#mdlbuscador').modal('toggle');
    } else {
        alertify.error("Debes seleccionar al menos un producto");
    }
}
function verOrdenCompra(folio, comprobante) {
//    alert("folio:" + folio + " comprobante:" + comprobante);
    var info = "valor=" + folio + "&comprobante=ORDEN COMPRA";
    window.open('generarReporte.php?' + info);

}
function seleccionTipo() {
    var cotizar = $("#cotizar").is(":checked");
    var orden = $("#orden").is(":checked");
    if (orden == true) {
        $("#btnbuscador").prop("disabled", true);
        $("#codigoProductoEntradas").val("");
        $("#descuentosGeneralesPorComasM").val("");
                $("#descuentosGeneralesPorComasM").prop("disabled",true);
        $("#descuentosGeneralesM").prop("checked", false);
        $("#descuentosGlobalesManuales").prop("checked", false);
        contador = 1;
        folio = 0;
        $("#descuentosGlobalesManuales").prop("disabled", true);
        $("#descuentosGeneralesM").prop("disabled", true);
        $("#emailProveedor").selectpicker('hide');
        $("#lblemailP").hide('slow');
        $("#txtEmail").hide('slow');
        $("#lblemailO").hide('slow');
        $('#proveedores').prop("disabled", true);
        $("#proveedores").selectpicker('hide');
        $("#guardarOrdenCompra").hide();
        $("#guardaEnviaOrden").hide();
        $("#folioM").prop('disabled', false);
        $("#folioM").show('slow');
        $("#folio").show('slow');
        $("#folio").val("");
        $(".resultando").val(0);
//        $("#ModificarOrden").show('slow');

        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
    } else {
        $("#btnbuscador").prop("disabled", false);
        folio = 0;
        contador = 1;
        $("#descuentosGlobalesManuales").prop("disabled", true);
        $("#descuentosGeneralesM").prop("disabled", true);
        $("#codigoProductoEntradas").val("");
        $("#descuentosGeneralesPorComasM").val("");

        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
        $("#enviarOrdenCompra").hide("slow");
        $('#proveedores').selectpicker("val", 0);
        $("#folio").val("");
        $('#proveedores').prop("disabled", false);


        $(".resultando").val(0);
        $("#ModificarOrden").hide('slow');
        $("#guardaEnviaOrden").hide('slow');
        $("#CancelarOrden").hide();

//        $("#guardarOrdenCompra").show();
        $('#proveedores').selectpicker('show');
        $("#emailProveedor").selectpicker('hide');
        $("#lblemailP").hide('slow');
        $("#txtEmail").hide('slow');
        $("#lblemailO").hide('slow');

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
        var info = "folio=" + $("#folioM").val() + "&comprobante=ORDEN COMPRA";
        $.get('consultaOrdenCompra.php', info, function(x) {
            if (x == 0) {
                alertify.error("no hay ese codigo");
            } else {

                lista = JSON.parse(x);
                console.log(lista);

                $.each(lista, function(ind, elem) {
                    $.each(elem, function(ind, elem2) {

                        tr2 = '<tr id="fila' + contador + '"><td><center><button type="button" class="btn btn-xs" onclick="eliminarFila(' + contador + ',1)"><span class="glyphicon glyphicon-remove"></span></button></center></td>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades" type= "text" value="' + elem[ind].cantidadConcepto + '" disabled="true"> </input> </td>\n\
                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + elem[ind].codigoConcepto + '" disabled></td>\n\
                        <td><span id="descripcionM' + contador + '">' + elem[ind].descripcionConcepto + '</span></td>\n\\n\
                        <td><span id="costoUnitarioM' + contador + '">' + elem[ind].precioUnitarioConcepto + '</span></td>\n\
                        <td> <input type="text" id="costo' + contador + '" onkeyup ="calcularPorCosto(' + contador + ')" class="form-control cantidades costos" name="' + contador + '" value="' + elem[ind].costoCotizacion + '" disabled="true"> </input\n\
                        </td>\n\
                        <td> <input id="descuento1' + contador + '" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" value="' + elem[ind].desctUnoConcepto + '" disabled="true"/> </td>\n\
                        <td> <input id="descuento2' + contador + '" onfocus="validarCampoDesc2(' + contador + ');" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" value="' + elem[ind].desctDosConcepto + '" disabled="true"/> </td>\n\
                        <td> <input id="descTotal' + contador + '" class="form-control desct" type= "text" disabled="true" value="' + elem[ind].desctTotalComprobante + '"/> </td>\n\
                        <td> <input id="cda' + contador + '" class="form-control cdas" type= "text"  disabled="true" value="' + elem[ind].cdaConcepto + '"/> </td>\n\
                        <td> <input id="importe' + contador + '" class="form-control totales" type= "text"  disabled="true" value="' + elem[ind].importeConcepto + '"> </input> </td></tr>';
                        contador = contador + 1;
                        tr3 += '<tr>\n\
                        <td> \n\
                        ' + elem[ind].cantidadConcepto + '</td>\n\
                        <td>' + elem[ind].codigoConcepto + '</td>\n\
                        <td>' + elem[ind].descripcionConcepto + '</td>\n\
                        <td>' + elem[ind].precioUnitarioConcepto + '</td>\n\
                        <td> ' + elem[ind].costoCotizacion + '\n\
                        </td>\n\
                        <td> ' + elem[ind].desctUnoConcepto + ' </td>\n\
                        <td> ' + elem[ind].desctDosConcepto + ' </td>\n\
                        <td> ' + elem[ind].desctTotalComprobante + '</td>\n\
                        <td> ' + elem[ind].cdaConcepto + '</td>\n\
                        <td> ' + elem[ind].importeConcepto + '</td></tr>';

                        $("#tablaDatosEntrada").append(tr2);
                        $("#subTotalM").val(parseFloat(elem[ind].subtotalComprobante));
                        $("#descuentoGeneralM").val(parseFloat(elem[ind].desctGeneralComprobante));
                        $("#descuentoProductosM").val(parseFloat(elem[ind].desctPorProductosComprobante));
                        $("#descuentoTotalM").val(parseFloat(elem[ind].desctTotalComprobante));
                        $("#sdaM").val(parseFloat(elem[ind].sdaComprobante));
                        $("#ivaM").val(parseFloat(elem[ind].ivaComprobante));
                        $("#costoTotal").val(parseFloat(elem[ind].totalComprobante));

                        $('#rfcComprobante').selectpicker("val", "\"" + elem[ind].rfcComprobante + "\"");

                        $('#proveedores').selectpicker("val", elem[ind].rfcComprobante);
                        $('#proveedores').prop("disabled", true);
                        $("#ModificarOrden").show('slow');



                        $("#emailProveedor").load("mostrarEmailsProveedor.php?rfc=" + elem[ind].rfcComprobante, function() {
                            $("#emailProveedor").selectpicker();
                            $("#emailProveedor").selectpicker('refresh');
                            $("#emailProveedor").selectpicker('show');

                        });
                        $("#txtEmail").show('slow');

                        $("#lblemailP").show('show');
                        $("#lblemailO").show('show');
                        $("#proveedores").selectpicker('show');
                        $("#guardaEnviaOrden").hide();
                        $("#CancelarOrden").show();
                        $("#enviarOrdenCompra").show();
                        $("#folioM").prop("disabled", true);
                        $("#codigoProductoEntradas").prop("disabled", true);
                        $("#descuentosGlobalesManuales").prop("disabled", false);
                        $("#descuentosGeneralesM").prop("disabled", false);

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
//            alert("entro");
            var nombre = elemento.name;
            var valor = elemento.value;
//            alert("entro con el valor" + valor);
            if ($("#codigoProductoEntradas").val() == valor && $("#codigoProductoEntradas").val() !== "nada") {
//            alertify.error("ya existe");
                valorando = nombre;
//                alert(nombre);


            }
        });
        if (valorando == 0) {
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
                        tr = '<tr id="fila' + contador + '" ><td><center><button type="button" class="btn btn-xs" onclick="eliminarFila(' + contador + ')"><span class="glyphicon glyphicon-remove"></span></button></center></td>\n\
                        <td> \n\
                        <input id="cant' + contador + '" onkeyup="calcularPorCantidad(' + contador + ');" class="form-control cantidades" type= "text" value="1"> </input> </td>\n\
                        <td><input type="text" id="codigoM' + contador + '" name="' + contador + '" class="CProducto form-control" value="' + datosJson[i].codigoProducto + '" disabled></td>\n\
                        <td><span id="descripcionM' + contador + '">' + datosJson[i].producto + '</span></td>\n\\n\
                        <td><span id="costoUnitarioM' + contador + '">' + datosJson[i].costo + '</span></td>\n\
                        <td> <input type="text" id="costo' + contador + '" onkeyup ="calcularPorCosto(' + contador + ')" class="form-control cantidades costos" name="' + contador + '"> </input>\n\
                        </td>\n\
                        <td> <input id="descuento1' + contador + '" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" disabled/> </td>\n\
                        <td> <input id="descuento2' + contador + '" onfocus="validarCampoDesc2(' + contador + ');" onkeyup="calcularDescuentos(' + contador + ');" class="form-control descuentos" type= "text" disabled/> </td>\n\
                        <td> <input id="descTotal' + contador + '" class="form-control desct" type= "text" disabled="true" /> </td>\n\
                        <td> <input id="cda' + contador + '" class="form-control cdas" type= "text" value="0" disabled="true"/> </td>\n\
        <td> <input id="importe' + contador + '" class="form-control totales" type= "text" value="0" disabled="true"> </input> </td></tr>';
                    }
                    contador = contador + 1;

                    $("#tablaDatosEntrada").append(tr);
//                    $(".descuentos").attr('disabled', 'disabled');
                    $("#guardarOrdenCompra").show();
                    $("#CancelarOrden").show();
                    $('#proveedores').prop("disabled", true);
                    $("#descuentosGlobalesManuales").prop("disabled", false);
                    $("#descuentosGeneralesM").prop("disabled", false);
//                    alert($("#descuentosGlobalesManuales").is(":checked"))
                    if ($("#descuentosGlobalesManuales").is(":checked") == true) {
                        $(".descuentos").prop("disabled", false);
                        $(".cantidades").prop("disabled", true);

                    } else {
                        $(".descuentos").prop("disabled", true);
                        $(".cantidades").prop("disabled", false);
                    }
                }
            });
        } else {
            alertify.error("ya existe");
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
            var costoPorCantidad = $("#costo" + id).val();
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
//    alert("entro"+ id);
    if ($("#descuento1" + id).val() == '' || $("#descuento1" + id).val() == '0') {
        $("#descuento2" + id).val("");
    } else {

    }
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
            if (descuento1 >= 0) {
                calcularPorCosto(id);
                importe = $("#importe" + id).val();
                nuevoImporte = (descuento1 * importe) / 100;
                nuevoImporte = importe - nuevoImporte;
            }
            if (descuento2 >= 0) {
                var respaldoImporte = nuevoImporte;
                nuevoImporte = (descuento2 * nuevoImporte) / 100;
                nuevoImporte = respaldoImporte - nuevoImporte;
            }
            $("#importe" + id).val(nuevoImporte.toFixed(2));
            if (descuento1 === '' && descuento2 === '') {
                var importe = (parseFloat(($("#costo" + id).val()) * parseFloat($("#cant" + id).val())));
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
    if ($("#descuento1" + id).val() == '' || $("#descuento1" + id).val() == '0') {
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
    $("#subTotalM").val(sumaTotalCantidadCosto.toFixed(2));
}

function calcularCda() {
    for (var x = 0; x < contador; x++) {
        var descTotal = 0;
        var cda = 0;
        var desc1 = parseFloat($("#descuento1" + x).val());
        var desc2 = parseFloat($("#descuento2" + x).val());
//        alert(desc1);
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
        $("#descTotal" + x).val(descTotal.toFixed(2));
        if (isNaN(cda)) {
            cda = 0.00;
        }
        $("#cda" + x).val(cda.toFixed(2));
    }
}
function calcularDescuentoDeProductos() {
    var descuentoProductos = 0;
    for (var x = 1; x < contador; x++) {

//        alert("descTotal");
        descuentoProductos = (parseFloat(descuentoProductos) + parseFloat($("#descTotal" + x).val()));
//        alert($("#descTotal" + x).val());
//        alert("mis valores :   "+descuentoProductos+ "micontador esta en : " +contador);
    }
    if (isNaN(descuentoProductos)) {
        descuentoProductos = 0;
    }
//    alert("La cantidad es:"+descuentoProductos);
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
        $("#descuentoGeneralM").val(parseFloat(descuent).toFixed(2));
        calcularDescTotal();
        calcularSDA();
    }
    calcularIva();
    calculaTotalEntradasManual();
}

$(document).ready(function() {
    $("#btnbuscador").prop("disabled", true);
    $("#descuentosGlobalesManuales").prop("disabled", true);
    $("#descuentosGeneralesM").prop("disabled", true);
    $("#enviarOrdenCompra").hide();
    $("#guardarOrdenCompra").hide();
    $("#CancelarOrden").hide();
    $("#guardarOrdenCompra").hide();
    $("#guardaEnviaOrden").hide();
    $("#txtEmail").hide();
    $("#ModificarOrden").hide();
    $("#emailProveedor").hide('slow');
    $("#lblemailP").hide();
    $("#lblproveedor").hide();
    $("#lblemailO").hide();

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
//        alert($("#costoTotal").val());
        xmlComprobanteManualmente.totalComprobante = $("#costoTotal").val();
        xmlComprobanteManualmente.tipoComprobante = "Entradas Manual";
        var conceptos = new Array();
        for (var x = 0; x < parseInt(contador); x++) {
            var conceptos = new xmlConceptosManualmente();
            conceptos.cantidadConcepto = $("#cant" + x).val();
            conceptos.cdaConcepto = $("#cda" + x).val();
            conceptos.codigoConcepto = $("#codigoM" + x).val();
            conceptos.costoCotizacion = $("#costo" + x).val();
//            alert($("#codigoM" + x).text());
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
//        alert($("#emailProveedor").val());
        if ($("#emailProveedor").val() !== "0") {
            $.ajax({
                type: "POST",
                url: "guardarOrdenCompra.php",
                data: {data: informacion, band: "envia", folio: $("#folioM").val()},
                cache: false,
                success: function(x) {
                    window.open('generarReporte.php?valor=' + x + "&correos=" + $("#emailProveedor").val() + "&correos2=" + $("#txtEmail").val() + "&comprobante=ORDEN COMPRA");
                    alertify.success("Exito! Orden Guardada");
                    var tipo = "ORDEN%20COMPRA";
                    $("#tablaOrden").load("cnsultaOrdenesLista.php?tipo=" + tipo);

                }
            });
        } else {
            alertify.error("Seleccione almenos un email");
        }
    });

    $("#ModificarOrden").click(function() {
        $(".cantidades").prop("disabled", false);
//        $(".descuentos").prop("disabled", false);
        $("#guardaEnviaOrden").show();
        $("#CancelarOrden").show();
        $("#enviarOrdenCompra").hide();
//        $("#emailProveedor").load("mostrarEmailsProveedor.php");
//        $("#emailProveedor").show();
//        $("#descuentosGlobalesManuales").prop('checked', true);
        $("#codigoProductoEntradas").prop("disabled", false);


    });

    $("#enviarOrdenCompra").click(function() {
//        alert(folio);
        if ($("#emailProveedor").val() !== "0") {
            if ($("#folioM").val() != "") {
                var info = "valor=" + $("#folioM").val() + "&correos=" + $("#emailProveedor").val() + "&correos2=" + $("#txtEmail").val() + "&comprobante=ORDEN COMPRA";
                window.open('generarReporte.php?' + info);
            } else {
//                alert(folio);
                var info = "valor=" + folio + "&correos=" + $("#emailProveedor").val() + "&correos2=" + $("#txtEmail").val() + "&comprobante=ORDEN COMPRA";
                window.open('generarReporte.php?' + info);
            }
        } else {
            alertify.error("Seleccione almenos un email");
        }
    });

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

    $("#proveedores").load("mostrarProveedoresManualmente.php", function() {
        $("#proveedores").selectpicker();
        $("#proveedores").selectpicker('hide');
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
            $(".descuentos").val("");
            $(".desct").val("");
            $("#descuentoProductosM").val(0);
            $("#descuentoTotalM").val($("#descuentoGeneralM").val())
            for (var x = 0; x < contador; x++) {
                var cantidad = $("#cant" + x).val();
                var costo = $("#costo" + x).val();
                $("#cda" + x).val(costo);
                $("#importe" + x).val(costo * cantidad);

            }
            var importes = 0.0;
            $('.totales').each(function() {
                var elemento = this;
                var valor = elemento.value;
//        alert(valor);
                importes += parseFloat(valor);

            });
            var iva = importes * .16;
            var total = parseFloat(iva) + importes;
            $("#sdaM").val(importes);
            $("#ivaM").val(iva);
            $("#costoTotal").val(parseFloat(total));
        }
    });
    $("#descuentosGeneralesM").change(function() {
        if ($("#descuentosGeneralesM").is(':checked')) {
         var   band = 0
             $('.costos').each(function() {
                var elemento = this;
                var valor = elemento.value;
//        alert(valor);
                if (valor == ""){
                    band = "0";
                }else{
                    band = '1';
                }

            });
            if(band == "1"){
               alertify.confirm("¿Solo puedes agregar 1 o más descuentos generales una vez terminado de listar los productos con sus respectivos costos, estas seguro de continuar? una vez seleccionado esto no podras agregar mas productos", function(e) {
        if (e) {
          $("#descuentosGeneralesPorComasM").removeAttr('disabled');
          $(".cantidades").prop('disabled', true);
          $("#descuentosGeneralesM").prop('disabled', true);
          $("#descuentosGlobalesManuales").prop('disabled', true);
          $(".descuentos").prop('disabled', true);
        } else {
            $("#descuentosGeneralesM").prop("disabled", false);
        }
    });
            
        }else{
            $("#descuentosGeneralesM").prop('checked', false);
        alertify.error("Los costos son obligatorios");
    }
    }
//        else {
//            $("#descuentosGeneralesPorComasM").attr('disabled', 'disabled');
//            $("#descuentosGeneralesPorComasM").val(0);
//            $("#descuentoGeneralM").val(0);
//            $("#descuentoTotalM").val($("#descuentoProductosM").val());
//        }
    });
    $("#guardarOrdenCompra").click(function() {
        var inf = new Array();
        var lstConceptos = new Array();
        var bandera = 0;
        var entro = "0";
        var xmlComprobanteManualmente = new XmlComprobante();
        $('.costos').each(function() {
            entro = 1;
            var elemento = this;
            var nombre = elemento.name;
            var valor = elemento.value;
//        alert(elemento.name);
            if (valor == "" || valor == 0) {
//            alertify.error("Debes elegir algun valor");
                bandera = 1;

            }
//            alert(valor);
        });
        if (bandera == 0 && entro >= 1) {

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
                    lstConceptos.push(conceptos);
                }
            }
            inf.push(xmlComprobanteManualmente);
            inf.push(lstConceptos);
            var informacion = JSON.stringify(inf);
            $.ajax({
                type: "POST",
                url: "guardarOrdenCompra.php",
                data: {data: informacion, cotiza: "cotiza"},
                cache: false,
                success: function(x) {
                    var probando = $("#proveedores").val();
//                   
                    folio = x;
                    $("#enviarOrdenCompra").show();
                    $("#emailProveedor").load("mostrarEmailsProveedor.php?rfc=" + $("#proveedores").val(), function() {
                        $("#emailProveedor").selectpicker();
                        $("#emailProveedor").selectpicker('refresh');
                        $("#emailProveedor").selectpicker('show');

                    });
                    $("#lblemailP").show('slow');
                    $("#txtEmail").show('slow');
                    $("#lblemailO").show('slow');
                    alertify.success("Exito! Orden Guardada con el folio No.-" + x);
                    var tipo = "ORDEN%20COMPRA";
                    $("#tablaOrden").load("cnsultaOrdenesLista.php?tipo=" + tipo);

                }
            });
        } else {
            alertify.error("Debes seleccionar un costo");
        }
    });

    $("#enviarOrdenCompra").click(function() {

    });

    $("#CancelarOrden").click(function() {
        $('#tablaDatosEntrada td').each(function() {
            $(this).remove();

        });
        $("#codigoProductoEntradas").val("");
        $("#proveedores").selectpicker('val', 0);
        $('#proveedores').prop("disabled", false);
        $("#txtEmail").hide();
        $("#emailProveedor").selectpicker('hide');
        $("#lblemailP").hide('slow');
        $("#lblemailO").hide('slow');
        $("#ModificarOrden").hide();
        $("#CancelarOrden").hide();
        $("#guardaEnviaOrden").hide();
        $("#guardarOrdenCompra").hide();
        $("#enviarOrdenCompra").hide();
        $(".resultando").val(0);
        $("#folioM").prop("disabled", false);
        $("#codigoProductoEntradas").prop("disabled", false);
        $("#descuentosGlobalesManuales").prop("disabled", true);
           $("#descuentosGeneralesPorComasM").prop("disabled", true);
            $("#descuentosGeneralesPorComasM").val("");
         $("#descuentosGlobalesManuales").prop("checked", false);
        $("#descuentosGeneralesM").prop("disabled", true);
         $("#descuentosGeneralesM").prop("checked", false);
    });
    var tipo = "ORDEN%20COMPRA";
    $("#tablaOrden").load("cnsultaOrdenesLista.php?tipo=" + tipo, function() {
        $('#dtproveedor').dataTable();
    });
    $("#btnbuscador").click(function() {
        var proveedores = $("#proveedores").val();

        $("#todos").load("consultarBuscadorProveedor.php?proveedores=" + proveedores, function() {
            $('#tdProducto').dataTable();
        });
        $('#mdlbuscador').modal('toggle');
    });
});
