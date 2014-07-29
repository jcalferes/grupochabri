$(document).ready(function() {
    $("#mostrarnovedades").load("mostrarNovedades.php", function() {
    });
    $("#mostrarcategorias").load("mostrarCategorias.php", function() {
    });
    mostarSubgrupos();
});

function mostarSubgrupos() {
    var id = $("#buzon_id").val();
    var nm = $("#buzon_nm").val();
    var info = "id=" + id + "&nm=" + nm;
    $("#mostrarsubcategorias").load("mostrarSubcategorias.php?" + info, function() {
    });
}

function cargaSubs(){
    alert("Hola");
}