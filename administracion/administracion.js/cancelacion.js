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
$("#btnnocancelacion").click(function(){
    $('#divvalidacancelacion').slideUp();
    $("#showdatoscancelacion").remove();
    $("#basedatoscancelacion").append('<div id="showdatoscancelacion"></div>');
    $("#divfoliocancelacion").slideDown();
});
$("#btnvalidacancelacion").click(function(){
    var nose = $('#spnfolio').text();
    alert(nose);
});