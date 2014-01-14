$(document).ready(function() {
    
    
    $("#selectMarca").load("mostrarMarcas.php");
    $("#selectProveedor").load("mostrarProveedores.php");
    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    
    $( '#close-modal' ).on( 'click', function( ev ) {
  $( '#modal, #modal-background' ).fadeOut();
  ev.preventDefault();
} );

    $("#guardarDatos").click(function() {
        
        alert("entro");
    });
});

