$(document).ready(function () {
    dt_adminactivos();
});

function dt_adminactivos() {
    $("#loadadminactivos").load("su_dtadminactivos.php", function () {
        $("#dtadminactivos").dataTable();
    });
}
function test(){
    alert("Hola");
}