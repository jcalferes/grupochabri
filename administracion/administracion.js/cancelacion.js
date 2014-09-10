$(document).ready(function () {
    $("#divvalidacancelacion").hide();

});

function cancelarToda() {
    if ($("#cancelartodo").prop("checked")) {
        $('.cancel').each(function () {
            $(".cancel").prop("checked", "checked");
        });
    }
    else {
        $('.cancel').each(function () {
            $(".cancel").prop("checked", "");
        });
    }
}


function seleccionarProductoAEliminar(codigo) {
    var marcoTodas = false;
    $('.cancel').each(function () {
        if (this.checked) {
            marcoTodas = true;
        }
        else {
            marcoTodas = false;
            return false;
        }
    });
    if (marcoTodas == true) {
        $("#cancelartodo").prop("checked", "checked");
    }
    else {
        $("#cancelartodo").prop("checked", "");
    }

}




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
                $("#cancelartodo").prop("checked", "checked");
                $('.cancel').each(function () {
                    $(".cancel").prop("checked", "checked");
                });
                $("#dtcancelacion").dataTable();
                $("#chkreutilizar").attr("disabled", true);
                $("#txtfoliocancelacion").val("");

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
    if ($("#radioVent").is(":checked")) {
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
            }
        });
    }
    else {
        var paso = validarSeleccionProductos();
        if (paso == false) {
            alertify.error("No se pudo realizar la cancelacion seleccione que productos va a devolver o cancelar toda la nota");
        }
        else {
            if ($("#cancelartodo").prop("checked")) {
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
                    }
                });
            }
            else {
                var codigosProductosDevolver = new Array();

                $('.cancel').each(function () {
                    var codigo = $(this).val();
                    if (this.checked) {
                        var p = new ProductosDevolver();
//                        alert(codigo);
                        p.codigoProducto = codigo;
                        p.folioComprobanteCancelacion = $("#spnfolio").text();
                        p.cantidadProducto = $("span[id='cantidad" + codigo + "']").text();
                        codigosProductosDevolver.push(p);
                    }
                });
                var informacion = JSON.stringify(codigosProductosDevolver);
                $.ajax({
                    type: "POST",
                    url: "devolverProductoCredito.php",
                    data: {data: informacion},
                    cache: false,
                    success: function (resultado) {
                        alertify.success(resultado);
                        $('#divvalidacancelacion').slideUp();
                        $("#showdatoscancelacion").remove();
                        $("#basedatoscancelacion").append('<div id="showdatoscancelacion"></div>');
                        $("#divfoliocancelacionC").slideDown();
                    }
                });
            }
        }
    }
});
function validarSeleccionProductos() {
    var validar = false;
    if ($("#cancelartodo").prop("checked")) {
        validar = true;
    }
    else {
        $('.cancel').each(function () {
            if (this.checked) {
                validar = true;
                return false;
            }
            else {
                validar = false;
            }
        });
    }

    return validar;
}