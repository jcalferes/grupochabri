

$(document).ready(function() {
    
    $("#probando").hide();
   
    $("#agregarMarca").click(function(){
        $("#cuerpo").hide();
        $("#probando").show('slow');
    });
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
     
   $("#cancelar").click(function() {
        $("#cuerpo").show('');
        $("#probando").hide('slow');
        
    });
    
    $("#guardarDatos").click(function() {
        
        alert("entro");
    });
});

