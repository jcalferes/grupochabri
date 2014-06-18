$(document).ready(function() {
    $("#divvalidacancelacion").hide();
});
$("#btnbuscarfoliocancelacion").click(function() {
    var foliocancelacion = $("#txtfoliocancelacion").val();
    if (foliocancelacion === "" || /^\s+$/.test(foliocancelacion)) {
        alertify.error("El campo folio no puede estar vacio");
    } else {
        $("#showdatoscancelacion").load("buscarFolioCancelacion.php?foliocancelacion=" + foliocancelacion, function() {
            $("#dtcancelacion").dataTable();
            $("#txtfoliocancelacion").val("");
//            $("#divfoliocancelacion").slideUp();
        });
    }
});
$("#btnnocancelacion").click(function() {
    $('#divvalidacancelacion').slideUp();
    $("#showdatoscancelacion").remove();
    $("#basedatoscancelacion").append('<div id="showdatoscancelacion"></div>');
    $("#divfoliocancelacion").slideDown();
});
$("#btnvalidacancelacion").click(function() {
    var folio = $('#spnfolio').text();
    var observcancelacion = $('#txaobscancelacion').val();
    if (observcancelacion === "" || /^\s+$/.test(observcancelacion)) {
        observcancelacion = "";
    }
    var info = "folio=" + folio + "&observcancelacion=" + observcancelacion;
    alertify.confirm("¿Estas completamente seguro de efectuar la cancelación?, Esta acción no pueden deshacerse. ", function(e) {
        if (e) {
            $.get('efectuarCancelacion.php', info, function(r) {
                if (r == 0) {
                    alertify.success("Cancelaion realizada con exito");
                    $('#divvalidacancelacion').slideUp();
                    $("#showdatoscancelacion").remove();
                    $("#basedatoscancelacion").append('<div id="showdatoscancelacion"></div>');
                    $("#divfoliocancelacion").slideDown();
                } else {
                    alertify.error("No se pudo realizar la cancelacion");
                }
            });
        } else {
            alert("No");
        }
    });
});