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

$("#loginbtn").click(function() {
    var usuario = $.trim($("#loginuser").val());
    var pass = $.trim($("#loginpass").val());
    if (usuario === "" || /^\s+$/.test(usuario) || pass === "" || /^\s+$/.test(pass)) {
        $("#loginuser").val("");
        $("#loginpass").val("");
        alertify.log("Todos los campos son obligatorios");
    }
    else {
        var info = "usuario=" + usuario + "&pass=" + pass;
        $.get('iniciarSesion.php', info, function(respuesta) {
            respuesta = parseInt(respuesta);
            if (respuesta == 666) {
                alertify.error("Usuario o Contraseña invalidos");
            } else {
                if (respuesta == 1) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    document.location.href = '../administracion/gestionAdministrativa.php';
                }
                if (respuesta == 2) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    document.location.href = '../administracion/gestionAdministrativa.php';
                }
                if (respuesta == 3) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN VENDEDOR");
                }
                if (respuesta == 4) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN VENDEDOR FORANEO");
                }
                if (respuesta == 5) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN DISTRIBUIDOR");
                }
                if (respuesta == 7) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN CLIENTE");
                }
                if (respuesta == 777) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.error("PC no autorizada");
                }
            }
        });
    }
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
        $('#tbCachibaches').dataTable();
    });
}

function filtraCachibaches(idtipo) {
    var info = "idtipo=" + idtipo;
    $("#cachibaches").load("filtrarCachibaches.php?" + info, function() {
        $('#tbFCachibaches').dataTable();
    });
}


function mostrarPaginaB(i) {
    var pag = i - 1;
    $('#tbCachibachesB').find(".cachibaches").each(function() {
        var elemento = this;
        elemento.style.display = "none";
    });

    $('#tbCachibachesB').find(".pag" + pag).each(function() {
        var elemento = this;
        elemento.style.display = "";
    });
}
