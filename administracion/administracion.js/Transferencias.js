function TransaccionDetalles(codigo, cantidad, costo) {
    this.codigo = codigo;
    this.cantidad = cantidad;
    this.costo = costo;

}
function detallesTransferencia(transf) {
    $('#detalleTransferencia').trigger('click');
    $('#labelTitulo').html('<h4> Tarifas del producto</h4>' + transf);
    $('#mostrartransferencias').load("mostrarDetallesTransferencia.php?transferencia=" + transf);

}

function sacarTotal(cp) {
    var cantidad = $("#txtCantidad" + cp).val();
    var costo = $("#costoUnitario" + cp).val();
    var elemento = 0.0;
    var mientras = 0.0;
    $("#txtTotal" + cp).val(cantidad * costo);

    $('.transferencia').each(function() {

        elemento = $(this).val();
        mientras = parseFloat(mientras) + parseFloat(elemento);
    });
    $("#costoTotal").val(mientras);


}
function recorrerTabla(codigo) {
    var band;
    $('.myCodigo').each(function() {


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
$(document).ready(function() {
    $("#consultatransferencias").load("consultaTransferencias.php");
    $("#sucursal").load("sacarSucursales.php");


    $("#buscarCodigoTransferencia").click(function() {
        var sucursal = $("#sucursal").val();
        var info = "codigo=" + $("#codigoProductoTranferencia").val() + "&idSucursal=" + sucursal;
        var codigo = $("#codigoProductoTranferencia").val();
        var comprobar = recorrerTabla(codigo);
        if (comprobar == 0) {
            $.get('listaTrasferencia.php', info, function(x) {

                if (x == 0) {
                    alertify.error("no hay ese codigo");
                } else {

                    alertify.success("producto agregado a la lista");
                    lista = JSON.parse(x);
//                    console.log(lista);
                    var tr = "";
                    $.each(lista, function(ind, elem) {
                        $.each(elem, function(ind, elem2) {
                            tr = '<tr>\n\
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
            alertify.error("ya se a agregado este producto en la lista");
        }
    });

    $("#mandarPedido").click(function() {
        var fallo = 0;
        var cont = 0;



        $('.myCodigo').each(function() {
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
            alertify.error("las cantidades a pedir deben ser menores a las que hay en el invenario actual");
        } else {
            var arreglo = [];
            $('.myCodigo').each(function() {
                var elemento = this;
                var valor = elemento.value;
                var codigo = $('#codigo' + valor).val();
                var cantidad = $('#txtCantidad' + valor).val();
                var costo = $('#costoUnitario' + valor).val();
                var t = new TransaccionDetalles(codigo, cantidad, costo);
                arreglo.push(t);
                console.log(t);
            });
            var sucursal = $("#sucursal").val();
            var datosJSON = JSON.stringify(arreglo);

            console.log(datosJSON);
            $.post('guardarTransferencias.php', {datos: datosJSON, sucursal: sucursal}, function(respuesta) {
                alertify.success("Se ha mandado el pedido de transferencia de manera correcta")
            });




        }

    });

});