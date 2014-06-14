$("#btnbuscarfoliocancelacion").click(function() {
    var foliocancelacion = $("#txtfoliocancelacion").val();
    if (foliocancelacion === "" || /^\s+$/.test(foliocancelacion)) {
        alertify.error("El campo folio no puede estar vacio");
    } else {
        $("#showdatoscancelacion").load("buscarFolioCancelacion.php?foliocancelacion=" + foliocancelacion, function() {
            $("#dtcancelacion").dataTable();
            $("#txtfoliocancelacion").val("");
        });
    }
});