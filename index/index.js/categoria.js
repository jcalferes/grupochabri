$(document).ready(function() {
    var id = $("#buzon_id").val();
    var nm = $("#buzon_nm").val();
    $("#mostrarnovedades").load("mostrarNovedades.php", function() {
    });
    $("#mostrarcategorias").load("mostrarCategorias.php", function() {
    });
    mostrarSubgrupos();
    mostrarCachibaches(id, nm);
});

function mostrarSubgrupos() {
    var id = $("#buzon_id").val();
    var nm = $("#buzon_nm").val();
    var info = "id=" + id + "&nm=" + nm;
    $("#mostrarsubcategorias").load("mostrarSubcategorias.php?" + info, function() {
    });
}

function mostrarCachibaches(id, nm) {
    var info = "id=" + id + "&nm=" + nm;
    $("#cachibaches").load("mostrarCachibaches.php?" + info, function() {
    });
}

function filtraCachibaches(idtipo) {
    var info = "idtipo=" + idtipo;
    $("#cachibaches").load("filtrarCachibaches.php?" + info, function() {
    });
}


function mostrarPagina(i) {
    var pag = i - 1;
    $('#tbCachibaches').find(".cachibaches").each(function() {
        var elemento = this;
        elemento.style.display = "none";
    });

    $('#tbCachibaches').find(".pag" + pag).each(function() {
        var elemento = this;
        elemento.style.display = "";
    });
}