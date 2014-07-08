$(document).ready(function() {
    $("#showGranel").load("consultaGranel.php", function() {
        $('#dtgranel').dataTable();
    });
    $("#btnvalidar").hide();
    $("#divincremento").hide();
});

$("#txtcodigogranel").keypress(function(e) {
    if (e.which == 13) {
        var codigo = $("#txtcodigogranel").val();
        var codigog = $("#txtcodigogranel").val() + "-GR";
        if (codigo === "" || /^\s+$/.test(codigo)) {
            $("#txtcodigogranel").val("");
            $("#btnvalidar").slideUp();
            $("#btncancel").slideUp();
            $("#divincremento").slideUp();
        } else {
            var info = "codigo=" + codigo + "&codigog=" + codigog;
            $.get('verificandoProductoGranel.php', info, function(rs) {
                if (rs == 0) {
                    alertify.error("El producto no existe o no hay venta agranel del mismo");
                    $("#txtcodigogranel").val("");
                    $("#btnvalidar").slideUp();
                    $("#divincremento").slideUp();
                } else {
                    var arr = $.parseJSON(rs);

                    $("#nombrep").text(arr.producto.datos.producto);
                    $("#existenciap").text(arr.producto.datos.cantidad);
                    $("#contenidop").text(arr.granel.datos.contenido);

                    $("#nombreg").text(arr.granel.datos.producto);
                    $("#existenciag").text(arr.granel.datos.cantidad);

                    $("#btnvalidar").slideDown();
                    $("#btncancel").slideDown();
                    $("#divincremento").slideDown();
                }
            });
        }
    }
});

$("#btnvalidar").click(function() {
    alertify.confirm("El contenido de venta a granel se incrementara y las unidades del producto padre se reduciran en uno.\n¿Deseas continuar?", function(e) {
        if (e) {
            var codigo = $("#txtcodigogranel").val();
            var codigog = $("#txtcodigogranel").val() + "-GR";
            var contenido = $("#contenidop").text();

            var info = "codigo=" + codigo + "&codigog=" + codigog + "&contenido=" + contenido;
            $.get('incrementarGranel.php', info, function(x) {
                if (x == 0) {
                    $("#txtcodigogranel").val("");
                    $("#btnvalidar").slideUp();
                    $("#divincremento").slideUp();
                    alertify.success("Existencia  a granel actulizada!");
                } else {
                    alertify.error("Error!");
                }
            });
        } else {
        }
    });
});

$("#btncancel").click(function() {
    $("#txtcodigogranel").val("");
    $("#btnvalidar").slideUp();
    $("#btncancel").slideUp();
    $("#divincremento").slideUp();
});