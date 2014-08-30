$(document).ready(function () {
    $("#divvalidacancelacion").hide();
});
$("#btnbuscarfoliocancelacion").click(function () {
    $("#showdatoscancelacion").slideUp("slow");
    $("#divvalidacancelacion").slideUp("slow");
    var foliocancelacion = $("#txtfoliocancelacion").val();
    if (foliocancelacion === "" || /^\s+$/.test(foliocancelacion)) {
        alertify.error("El campo folio no puede estar vacio");
    } else {

        if ($("#radioVent").is(":checked")) {
            $("#showdatoscancelacion").load("buscarFolioCancelacion.php?foliocancelacion=" + foliocancelacion, function () {
                $("#dtcancelacion").dataTable();
                $("#txtfoliocancelacion").val("");
                var buzon_rfc = $("#buzon_rfc").val();
                if (buzon_rfc == 1) {
                    $("#chkreutilizar").attr("disabled", true);
                } else {
                    $("#chkreutilizar").removeAttr("disabled");
                }

                if ($("#spnfolio").text() > 0) {
                    $("#showdatoscancelacion").slideDown("slow");
                    $("#divvalidacancelacion").slideDown("slow");
                }
                else {
                    $("#showdatoscancelacion").slideUp("slow");
                    $("#divvalidacancelacion").slideUp("slow");
                }
            });
        }
        else {
            $("#showdatoscancelacion").load("buscarFolioCancelacionCredito.php?foliocancelacion=" + foliocancelacion, function () {
                $("#dtcancelacion").dataTable();
                $("#chkreutilizar").attr("disabled", true);
                $("#txtfoliocancelacion").val("");
//                var buzon_rfc = $("#buzon_rfc").val();
//                if (buzon_rfc == 1) {
//                    $("#chkreutilizar").attr("disabled", true);
//                } else {
//                    $("#chkreutilizar").removeAttr("disabled");
//                }
                $("#showdatoscancelacion").slideDown("slow");
                $("#divvalidacancelacion").slideDown("slow");
                if ($("#spnfolio").text() > 0) {
                    $("#showdatoscancelacion").slideDown("slow");
                    $("#divvalidacancelacion").slideDown("slow");
                }
                else {
                    $("#showdatoscancelacion").slideUp("slow");
                    $("#divvalidacancelacion").slideUp("slow");
                }
            });
        }
    }
});
$("#btnnocancelacion").click(function () {
    $('#divvalidacancelacion').slideUp();
    $("#showdatoscancelacion").remove();
    $("#basedatoscancelacion").append('<div id="showdatoscancelacion"></div>');
    $("#divfoliocancelacionC").slideDown();
});
$("#btnvalidacancelacion").click(function () {
    var chk = $("#chkreutilizar").is(":checked");

    if (chk == true) {
        var reutilizar = 1;
    } else {
        reutilizar = 0;
    }
    var folio = $('#spnfolio').text();
    var observcancelacion = $('#txaobscancelacion').val();
    if (observcancelacion === "" || /^\s+$/.test(observcancelacion)) {
        observcancelacion = "";
    }
    var info = "folio=" + folio + "&observcancelacion=" + observcancelacion + "&reutilizar=" + reutilizar;
    alertify.confirm("¿Estas completamente seguro de efectuar la cancelación?, Esta acción no pueden deshacerse. ", function (e) {
        if (e) {
            $.get('efectuarCancelacion.php', info, function (r) {
                if (r == 0) {
                    alertify.success("Cancelación realizada con exito");
                    $('#divvalidacancelacion').slideUp();
                    $("#showdatoscancelacion").remove();
                    $("#basedatoscancelacion").append('<div id="showdatoscancelacion"></div>');
                    $("#divfoliocancelacionC").slideDown();
                } else {
                    alertify.error("No se pudo realizar la cancelacion");
                }
            });
        } else {
        }
    });
});