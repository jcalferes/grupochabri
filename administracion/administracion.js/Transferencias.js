function eliminarFila(fila) {
    var mientras = 0;
    $("#fila" + fila).remove();
    $('.transferencia').each(function () {

        var elemento = $(this).val();

        mientras = parseFloat(mientras) + parseFloat(elemento);
    });
    $("#costoTotal").val(mientras);
}

function listarProductos() {

    var idMarcas = new Array();
    var info;
    $('#tdProducto').find(':checked').each(function () {

        var elemento = this;
        var valor = elemento.value;
//        alert(valor);
        idMarcas.push(valor);
        lista = JSON.stringify(idMarcas);
        info = "codigos=" + lista;
    });
    if (info != undefined) {
//        alert("entro");
        $.get('consultaMasivaProductos.php', info, function (x) {
//            alert(info);
            var valorando = 0;
            lista = JSON.parse(x);
            console.log(lista);
            $.each(lista, function (ind, elem) {
//                alert(elem);
                $.each(elem, function (ind, elem2) {
//                    alert(elem2);
                    $.each(elem, function (ind, elem2) {
//                        alert(elem[ind].tarifa);

                        $('.myCodigo').each(function () {

                            var elemento = this;
                            var nombre = elemento.name;
                            var valor = elemento.value;
//                            alert(elemento.name);
                            if (valor == elem[ind].codigoproducto && elem[ind].codigoproducto !== "inicial") {
                                valorando = nombre;
                            }
                        });
                        if (valorando == '0') {
                            tr = '<tr id="fila' + elem[ind].codigoProducto + '">\n\
<td ></center><button type="button"  class="btn btn-xs" onclick="eliminarFila(\'' + elem[ind].codigoProducto + '\')"><span class="glyphicon glyphicon-remove"></span></button></center></td>\n\
                          <td><input type="text" class="myCodigo form-control guardar" id="codigo' + elem[ind].codigoproducto + '" value="' + elem[ind].codigoproducto + '" disabled/></td>\n\
                          <td><input type="text" class="form-control" value="' + elem[ind].producto + '" disabled/></td>\n\\n\\n\\n\
                          <td><div id="div' + elem[ind].codigoproducto + '" class="form-group "><input type= "text" class="form-control guardar" id="txtCantidad' + elem[ind].codigoproducto + '" value= "0"  onkeyup="sacarTotal(\'' + elem[ind].codigoproducto + '\')"></div> </td>\n\\n\\n\
                          <td><input type="text" class ="form-control" id="txtMaxCantidad' + elem[ind].codigoproducto + '" value="' + elem[ind].cantidadMaxima + '" disabled/></td>\n\
                          <td><input type="text" class="form-control guardar" id="costoUnitario' + elem[ind].codigoproducto + '" value = "' + elem[ind].costo + '" disabled></td>\n\\n\
                        <td><input type="text" class="transferencia form-control" id="txtTotal' + elem[ind].codigoproducto + '"  disabled></td>\n\
                      </tr>\n\ ';
                            $("#tablaTransferencias").append(tr);
                            $("#txtTotal" + elem[ind].codigoproducto).val("0");

//
                        } else {
                            alertify.error("El producto ya esta en la lista");
                        }
                    });

                });

//
            });

        });

        $('#mdlbuscador').modal('toggle');
    } else {
        alertify.error("Debes seleccionar al menos un producto");
    }
}

function TransaccionDetalles(codigo, cantidad, costo) {
    this.codigo = codigo;
    this.cantidad = cantidad;
    this.costo = costo;

}
function cancelarTransferencia() {
    var info = "aceptarTransferencia=" + encabezadoTransferencia;
    $.get('cancelarTransferencia.php', info, function (x) {
        alertify.success("Transferencia cancelada exitosamente");
        $("#consultapedidos").load("consultaPedidos.php");
        $("#consultatransferencias").load("consultaTransferencias.php");

    });
}
function aceptarTransferencia(encabezadoTransferencia) {

    var info = "aceptarTransferencia=" + encabezadoTransferencia;
    $.get('aceptarTransferencia.php', info, function (x) {
        $("#aceptarTraferencia").hide('slow');
        $("#cancelarPedido").hide();
        alertify.success("Transferencia completada exitosamente");
        $("#consultapedidos").load("consultaPedidos.php");
        $("#consultatransferencias").load("consultaTransferencias.php");

    });
}
function detallesTransferencia(transf, sucu, transferir, aceptacion) {
    $('#detalleTransferencia').trigger('click');
    $('#labelTitulo').html('<h4> Lista de transferencias:</h4>' + transf);
    $('#mostrartransferencias').load("mostrarDetallesTransferencia.php?transferencia=" + transf + "&sucu=" + sucu + "&transferir=" + transferir + "&aceptacion=" + aceptacion);
    $("#mandarRespuesta").hide();
    $("#cancelarPedido").hide();

}

function condicionesPeticion(transf, sucu, plop, aceptacion) {
//    $('#detalleTransferencia').trigger('click');
    $('#labelTitulo').html('<label> Lista de Peticiones - Folio: </label>' + transf);
    $('#mostrartransferencias').load("mostrarDetallesRequisicion.php?transferencia=" + transf + "&sucu=" + sucu + "&aceptacion=" + aceptacion);
    if (plop == 5) {
        $("#mandarRespuesta").show();
        $("#cancelarPedido").show();
    } else {
        $("#mandarRespuesta").hide();
        $("#cancelarPedido").hide();
    }
    $("#mdlDetalleTransferencia").modal('toggle');
}

function sacarTotal(cp) {

    var cantidad = $("#txtCantidad" + cp).val();
    var costo = $("#costoUnitario" + cp).val();
    var elemento = 0.0;
    var mientras = 0.0;
    $("#txtTotal" + cp).val(cantidad * costo);
    $('.transferencia').each(function () {

        elemento = $(this).val();
        mientras = parseFloat(mientras) + parseFloat(elemento);
    });
    $("#costoTotal").val(mientras);


}
function recorrerTabla(codigo) {
    var band;
    $('.myCodigo').each(function () {


        var elemento = $(this).val();

        if (elemento == codigo && elemento !== "inicial") {

            band = 1;

            return false;
//            return band;

        } else {

            band = 0;
//            return band;
        }

    });
//    $('.myCodigo').each(function() {
//        alert("entro");
//        var elemento = $(this).val();
//        alert(elemento);
//        if (elemento == codigo) {
//            return 1;
//
//        } else {
//            return 0;
//        }
//    });
//    $('#tablaTransferencias tr').eq(1).each(function() {
//         alert("entro;");
//
//        $(this).find('td').eq(5).each(function() {
//
//
//            alert($(this).html(".value()"));
//        })
//    })
    return band;
}
$(document).ready(function () {
    $("#consultatransferencias").load("consultaTransferencias.php", function () {
        $('#tdconstrans').dataTable();
    });
    $("#consultapedidos").load("consultaPedidos.php", function () {
        $('#tdconsped').dataTable();
    });
    $("#sucursal").load("sacarSucursales.php");

    $("#CancelarPedido").click(function () {
        $('#tablaTransferencias td').each(function () {
            $(this).remove();
            $("#sucursal").prop('disabled', false);
        });
        $("#costoTotal").val(0);
    });
    $("#codigoProductoTranferencia").keypress(function (e) {
        if (e.which == 13) {
            var sucursal = $("#sucursal").val();
            var info = "codigo=" + $("#codigoProductoTranferencia").val() + "&idSucursal=" + sucursal;
            var codigo = $("#codigoProductoTranferencia").val();
            var comprobar = recorrerTabla(codigo);
            if (sucursal > 0) {
                if (comprobar == 0) {
                    $.get('listaTrasferencia.php', info, function (x) {

                        if (x == 0) {
                            alertify.error("No existe ese codigo");
                        } else {
                            $("#sucursal").prop('disabled', true);
                            $("#codigoProductoTranferencia").val("");
                            lista = JSON.parse(x);
//                    console.log(lista);
                            var tr = "";
                            $.each(lista, function (ind, elem) {
                                $.each(elem, function (ind, elem2) {
                                    tr = '<tr id="fila' + elem[ind].codigoProducto + '">\n\
<td></center><button type="button"  class="btn btn-xs" onclick="eliminarFila(\'' + elem[ind].codigoProducto + '\')"><span class="glyphicon glyphicon-remove"></span></button></center></td>\n\
                          <td><input type="text" class="myCodigo form-control guardar" id="codigo' + elem[ind].codigoProducto + '" value="' + elem[ind].codigoProducto + '" disabled/></td>\n\
                          <td><input type="text" class="form-control" value="' + elem[ind].producto + '" disabled/></td>\n\\n\\n\\n\
                          <td><div id="div' + elem[ind].codigoProducto + '" class="form-group "><input type= "text" class="form-control guardar" id="txtCantidad' + elem[ind].codigoProducto + '" value= "0"  onkeyup="sacarTotal(\'' + elem[ind].codigoProducto + '\')"></div> </td>\n\\n\\n\
                          <td><input type="text" class ="form-control" id="txtMaxCantidad' + elem[ind].codigoProducto + '" value="' + elem[ind].cantidad + '" disabled/></td>\n\
                          <td><input type="text" class="form-control guardar" id="costoUnitario' + elem[ind].codigoProducto + '" value = "' + elem[ind].costo + '" disabled></td>\n\\n\
                        <td><input type="text" class="transferencia form-control" id="txtTotal' + elem[ind].codigoProducto + '"  disabled></td>\n\
                      </tr>\n\ ';
                                    $("#tablaTransferencias").append(tr);
                                    $("#txtTotal" + elem[ind].codigoProducto).val("0");
                                });
                            });

                        }
                    });
                } else {
                    alertify.error("El producto ya esta en la lista");
                }
            } else {
                alertify.error("Debe seleccionar una sucursal");
            }
        }
    });

    $("#mandarPedido").click(function () {
        var fallo = 0;
        var cont = 0;



        $('.myCodigo').each(function () {
            var elemento = this;
            var valor = elemento.value;
            var min = $('#txtCantidad' + valor).val();
            var max = $('#txtMaxCantidad' + valor).val();

            if (parseInt(min) <= parseInt(max) || valor == "inicial") {

                $('#div' + valor).removeClass("has-error");
                $('#div' + valor).addClass("has-success");

            }
            else {

                $('#div' + valor).removeClass("has-success");
                $('#div' + valor).addClass("has-error");
                fallo = 1;
            }
        });
        if (fallo == 1) {
            alertify.error("Las cantidades a pedir deben ser menores a las que hay en el inventario actual");
        } else {
            var arreglo = [];
            $('.myCodigo').each(function () {
                var elemento = this;
                var valor = elemento.value;
                var codigo = $('#codigo' + valor).val();
                var cantidad = $('#txtCantidad' + valor).val();
                var costo = $('#costoUnitario' + valor).val();
                if (codigo == undefined) {

                } else {
                    if (cantidad > 0) {
                        var t = new TransaccionDetalles(codigo, cantidad, costo);
                        arreglo.push(t);
                        console.log(t);
                    } else {

                    }
                }

            });
            var sucursal = $("#sucursal").val();
            var datosJSON = JSON.stringify(arreglo);
            var cont = arreglo.length;
            if (cont > 0) {


                console.log(datosJSON);
                $.post('guardarTransferencias.php', {datos: datosJSON, sucursal: sucursal}, function (respuesta) {
                    $("#consultapedidos").load("consultaPedidos.php");
                    $("#consultatransferencias").load("consultaTransferencias.php");
                    $('#tablaTransferencias tr').each(function () {
                        $(this).remove();

                    });
                    $("#costoTotal").val(0);
                    $("#sucursal").prop('disabled', false);
                    alertify.success("Se ha mandado el pedido de transferencia de manera correcta");
                });

            } else {
                alertify.error("Debes seleccionar un producto y debes pedir almenos uno en requisicion");
            }


        }

    });
    $("#btnbuscador").click(function () {
        var sucursal = $("#sucursal").val();
        $("#todos").load("consultarBuscador.php?sucursal=" + sucursal, function () {
            $('#tdProducto').dataTable();
        });
        $('#mdlbuscador').modal('toggle');
    });

});