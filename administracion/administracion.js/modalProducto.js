$(document).ready(function() {
    
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    
    $("#guardarDatos").click(function() {
        
        alert("entro");
    });
});

