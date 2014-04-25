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
                
                $("#nombrep").text(arr.producto.datos.producto);
                $("#existenciap").text(arr.producto.datos.cantidad);
                $("#contenidop").text(arr.granel.datos.contenido);
                
                $("#nombreg").text(arr.granel.datos.producto);
                $("#existenciag").text(arr.granel.datos.cantidad);

                $("#btnvalidar").slideDown();
                $("#divincremento").slideDown();
            }
        });
    }
});
