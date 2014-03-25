function sacarTotal(cp) {
    var cantidad = $("#txtCantidad" + cp).val();
    var costo = $("#costoUnitario" + cp).val();
    $("#txtTotal" + cp).val(cantidad * costo);


}

$(document).ready(function() {
    $("#buscarCodigoTransferencia").click(function() {
        var info = "codigo=" + $("#codigoProductoTranferencia").val();

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
                          <td>' + elem[ind].codigoProducto + '</td>\n\
                          <td>' + elem[ind].producto + '</td>\n\\n\\n\\n\
                          <td><input type= "text" id="txtCantidad' + elem[ind].codigoProducto + '" value= "0"  onblur="sacarTotal(' + elem[ind].codigoProducto + ')"> </td>\n\\n\\n\
                          <td>' + elem[ind].cantidad + '</td>\n\
                          <td><input type="text" id="costoUnitario' + elem[ind].codigoProducto + '" value = "' + elem[ind].costo + '" disabled></td>\n\\n\
                        <td><input type="text" id="txtTotal' + elem[ind].codigoProducto + '"  disabled></td>\n\
                      </tr>\n\ ';
                        $("#tablaTransferencias").append(tr);
                    });
                });

            }
        });
    });


});