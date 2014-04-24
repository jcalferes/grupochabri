$(document).ready(function() {
    $("#showGranel").load("consultaGranel.php", function() {
        $('#dtgranel').dataTable();
    });
    $("#btnvalidar").hide();
    $("#divincremento").hide();
});

$("#txtcodigogranel").blur(function() {
    var codigo = $("#txtcodigogranel").val();
    var codigog = $("#txtcodigogranel").val() + "-GR";
    if (codigo === "" || /^\s+$/.test(codigo)) {
        $("#txtcodigogranel").val("");
        $("#btnvalidar").slideUp();
        $("#divincremento").slideUp();
    } else {
        var info = "codigo=" + codigo + "&codigog=" + codigog;
        $.get('verificandoProductoGranel.php', info, function(rs) {
            if (rs == 0) {
                alertify.error("No existe");
            } else {
                var arr = $.parseJSON(rs);
                alert(arr.producto.datos.producto);
               alert(arr.granel.datos.producto);

                $("#btnvalidar").slideDown();
                $("#divincremento").slideDown();
            }
        });
    }
});
