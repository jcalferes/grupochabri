$(document).ready(function () {
    dt_adminactivos();
    dt_vendeactivos();
    $("#slctipousuario").selectpicker();
});

function dt_adminactivos() {
    $("#loadadminactivos").load("su_dtadminactivos.php", function () {
        $("#dtadminactivos").dataTable();
    });
}

function dt_vendeactivos() {
    $("#loadvendeactivos").load("su_dtvendeactivos.php", function () {
        $("#dtvendeactivos").dataTable();
    });
}

function eliminarAdministrador(id) {
    var id = id;
}