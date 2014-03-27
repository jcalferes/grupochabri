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
alert(codigo);
    $(".codigo").each(function() {
        alert("entro");
       var elemento = $(this).val();
        alert(elemento);
        if (elemento == codigo) {
            return 1;

        } else {
            return 0;
        }
    });
//    $('#tablaTransferencias tr').eq(1).each(function() {
//         alert("entro;");
//
//        $(this).find('td').eq(5).each(function() {
//
//
//            alert($(this).html(".value()"));
//        })
//    })

}
$(document).ready(function() {
    $("#buscarCodigoTransferencia").click(function() {
        var info = "codigo=" + $("#codigoProductoTranferencia").val();
        var comprobar = recorrerTabla($("#codigoProductoTranferencia").val());
        if (comprobar == 0) {
            $.get('listaTrasferencia.php', info, function(x) {

                if (x == 0) {
                    alertify.error("no hay ese codigo");
                } else {

                    alertify.success("producto agregado a la lista");
                    lista = JSON.parse(x);
                    console.log(lista);
                    var tr = "";
                    $.each(lista, function(ind, elem) {
                        $.each(elem, function(ind, elem2) {
                            tr = '<tr>\n\
                          <td><input type="text" class="codigo" id="codigo' + elem[ind].codigoProducto + '" value="' + elem[ind].codigoProducto + '" disabled/></td>\n\
                          <td><input type="text" value="' + elem[ind].producto + '" disabled/></td>\n\\n\\n\\n\
                          <td><input type= "text"  id="txtCantidad' + elem[ind].codigoProducto + '" value= "0"  onblur="sacarTotal(' + elem[ind].codigoProducto + ')"> </td>\n\\n\\n\
                          <td><input type="text" value="' + elem[ind].cantidad + '" disabled/></td>\n\
                          <td><input type="text" id="costoUnitario' + elem[ind].codigoProducto + '" value = "' + elem[ind].costo + '" disabled></td>\n\\n\
                        <td><input type="text" class="transferencia" id="txtTotal' + elem[ind].codigoProducto + '"  disabled></td>\n\
                      </tr>\n\ ';
                            $("#tablaTransferencias").append(tr);
                        });
                    });

                }
            });
        } else {
            alertify.error("ya se a agregado este producto en la lista");
        }
    });


});