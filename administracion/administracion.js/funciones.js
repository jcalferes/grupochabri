function  mostrarMarcas( algo){
     
    var algo = algo;
    
    $('#'+algo+'').load('mostrarMarcas.php');
    $(".prr").prop(disabled);
}
$(document).ready(function() {
    
    $("#prr").click(function() {
       
        $('#mostrandoDatos').load('consultarProducto.php');
    });

});

