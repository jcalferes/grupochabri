$(document).ready(function() {
    $("#selectSucursal").load("mostrarProveedores.php", function() {
        $("#selectSucursal").selectpicker();
    });
});

