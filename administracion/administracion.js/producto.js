$(document).ready(function() {
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    $("#guardar").click("guardarProducto.php")
});

