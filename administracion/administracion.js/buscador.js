$(document).ready(function() {
    $('#example').tooltip();
});

$('#example').on('hidden.bs.tooltip', function() {
    alert(":P");
});

$("#btnbuscador").click(function() {
    $("#todos").load("consultarBuscador.php", function() {
        $('#tdProducto').dataTable(); 
        $('#mdlbuscador').modal('toggle');
    });
});



$("#btnbuscadorVentas").click(function() {
    $("#todos").load("consultarBuscadorVentas.php", function() {
        $('#tdProducto').dataTable(); 
        $('#mdlbuscador').modal('toggle');
    });
});









$("#mdlGranelbtn").click(function() {
   
});



function listarProductos() {
    var idMarcas = new Array();
    var info;
    $("#tdProducto").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        alert(valor);
        idMarcas.push(valor);
        lista = JSON.stringify(idMarcas);
        info = "marcas=" + lista;

    });
    if (info != undefined) {
        $('#mdlbuscador').modal('toggle');
    } else {
        alertify.error("Debes seleccionar al menos un producto");
    }
}