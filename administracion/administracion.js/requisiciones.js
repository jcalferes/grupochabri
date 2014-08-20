function RequisicionDetalles(codigo, cantidad, costo) {
    this.codigo = codigo;
    this.cantidad = cantidad;
    this.costo = costo;
    
}
function sacarTotal2(cp) {
    var cantidad = $("#txtCantidad2" + cp).val();
    var costo = $("#costoUnitario2" + cp).val();
    var elemento = 0.0;
    var mientras = 0.0;
    var total = cantidad * costo;
    $("#txtTotal2" + cp).val(total);
    $('.requisicion').each(function() {

        elemento = $(this).val();
        mientras = parseFloat(mientras) + parseFloat(elemento);
    });
    $("#costoTotal2").val(mientras);


}

$(document).ready(function() {
    var fallo = 0;
    var algo = "";
    $("#cancelarPedido").click(function() {
        var transf = $("#transf").val();
        $.post('cancelarTransferencia.php', {transf: transf}, function() {
            $("#cancelarPedido").hide('slow');
            $("#mandarRespuesta").hide('slow');

            $("#consultapedidos").load("consultaPedidos.php");
            $("#consultatransferencias").load("consultaTransferencias.php");
        });
    });
    $("#mandarRespuesta").click(function() {

        $('.myCodigo2').each(function() {
            var elemento = this;
            var valor = elemento.value;
            var min = $('#txtCantidad2' + valor).val();
            var max = $('#txtMaxCantidad2' + valor).val();

            if (parseInt(min) <= parseInt(max) || valor == "inicial") {
                $('#div2' + valor).removeClass("has-error");
                $('#div2' + valor).addClass("has-success");

            }
            else {
                $('#div2' + valor).removeClass("has-success");
                $('#div2' + valor).addClass("has-error");
                fallo = 1;
            }
        });
        if (fallo == 1) {
            alertify.error("Las cantidades a pedir deben ser menores a las que hay en el inventario actual");
        } else {

            var arreglo = [];

            $('.myCodigo2').each(function() {
                var elemento = this;
                var valor = elemento.value;
                var codigo = $('#codigo2' + valor).val();
                var cantidad = $('#txtCantidad2' + valor).val();
                var costo = $('#costoUnitario2' + valor).val();
                var t = new RequisicionDetalles(codigo, cantidad, costo);
                arreglo.push(t);
                console.log(t);
            });
            var sucursal = $("#sucu").val();
            var transf = $("#transf").val();
            var datosJSON = JSON.stringify(arreglo);

            console.log(datosJSON);
            $.post('guardarRequisicion.php', {datos: datosJSON, sucursal: sucursal, transf: transf}, function(respuesta) {
                $("#consultapedidos").load("consultaPedidos.php");
                $("#consultatransferencias").load("consultaTransferencias.php");
                $("#cancelarPedido").hide('slow');
                $("#mandarRespuesta").hide('slow');
                alertify.success("Se ha mandado el pedido de transferencia de manera correcta")
            });




        }


    });


});
