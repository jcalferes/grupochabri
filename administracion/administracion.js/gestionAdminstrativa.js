$(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
        $('.scrollUp').fadeIn();
    } else {
        $('.scrollUp').fadeOut();
    }
});
$(document).ready(function() {
    $('.scrollUp').click(function() {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
})


$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");

    var rclass = $("#wrapper").hasClass('col-lg-10');

    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
});
function entroMarca() {
    $("#wrapper").toggleClass("active");
    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }

//    $("#1").addClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");
    $("#mostrar").load("wizMarca.php");

}
function entroProducto() {
    $("#wrapper").toggleClass("active");
    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }

//    $("#1").removeClass("active");
//    $("#2").addClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizProducto.php");

}
function entroProveedor() {
    $("#wrapper").toggleClass("active");
    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }

//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").addClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#6").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizProveedor.php");

}

function entroListaPrecio() {
    $("#wrapper").toggleClass("active");
    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").addClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizListaPrecio.php");

}

function entroEntradasProductos() {
    $("#wrapper").toggleClass("active");

    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").addClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizEntradaProducto.php");

}

function entroSalidasProduto() {
    $("#wrapper").toggleClass("active");

    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").addClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizSalidaProducto.php");

}

function entroUsuarios() {
    $("#wrapper").toggleClass("active");

    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").addClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizUsuarios.php");

}
function entroCliente() {
    $("#wrapper").toggleClass("active");

    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").addClass("active");
//    $("#10").removeClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("wizClientes.php");

}

function entroVentas() {
    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
    $("#wrapper").toggleClass("active");
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").addClass("active");
//    $("#11").removeClass("active");

    $("#mostrar").load("puntoDeVenta.php");

}

function entroTrasferencia() {
    $("#wrapper").toggleClass("active");

    var rclass = $("#wrapper").hasClass('col-lg-10');
    if (rclass == false) {
        $("#wrapper").removeClass("col-lg-12");
        $("#wrapper").addClass("col-lg-10");
    } else {
        $("#wrapper").removeClass("col-lg-10");
        $("#wrapper").addClass("col-lg-12");
    }
//    $("#1").removeClass("active");
//    $("#2").removeClass("active");
//    $("#3").removeClass("active");
//    $("#4").removeClass("active");
//    $("#5").removeClass("active");
//    $("#7").removeClass("active");
//    $("#8").removeClass("active");
//    $("#9").removeClass("active");
//    $("#10").removeClass("active");
//    $("#11").addClass("active");

    $("#mostrar").load("wizTransferencia.php");

}
