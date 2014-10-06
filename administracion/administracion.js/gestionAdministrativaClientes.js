$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollUp').fadeIn();
    } else {
        $('.scrollUp').fadeOut();
    }
});

$(document).ready(function () {
    $('.scrollUp').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
    $.get('dondeInicie.php', function (x) {
        var i = $.parseJSON(x);
        var sucursal = i.donde.sucursal;
        var nombre = i.donde.nombre;
        if (x == 999) {
        } else {
            $("#session_nombre").text("Bienvenido(a): " + nombre);
            $("#session_sucursal").text(sucursal);
        }
    });
});

//$("#donde").click(function(){
//    alert("Entre");
//});

function entroMarca() {
    $("#mostrar").load("wizMarca.php");
}
function entroProducto() {

    $("#mostrar").load("wizProducto.php");
}
function entroProveedor() {
    $("#mostrar").load("wizProveedor.php");
}
function entroListaPrecio() {
    $("#mostrar").load("wizListaPrecio.php");
}
function entroEntradasProductos() {
    $("#mostrar").load("wizEntradaProducto.php");
}
function entroSalidasProduto() {
    $("#mostrar").load("wizSalidaProducto.php");
}

function entroUsuarios() {
    $("#mostrar").load("wizUsuarios.php");
}
function entroCliente() {
    $("#mostrar").load("wizClientes.php");
}

function entroVentas() {
    $("#mostrar").load("wizVentas.php");
}

function entroTrasferencia() {
    $("#mostrar").load("wizTransferencia.php");
}

function ordenCompra() {

    $("#mostrar").load("wizOrdenCompra.php");
}

function entroAgranel() {
    $("#mostrar").load("wizAgranel.php");
}

function entroClientePedido() {
    $("#mostrar").load("wizClientePedido.php");
}

function entroClasificados() {
    $("#mostrar").load("wizClasificados.php");
}

function cambiarSucursal() {
    $("#slccamsuc").load("sacarSucursales.php", function () {
        $('#slccamsuc').selectpicker();
        ;
    });
    $("#mdlcamsuc").modal('show');
}

$("#btncamsuc_cancelar").click(function () {

});

$("#btncamsuc_cambiar").click(function () {
    var n_suc = $("#slccamsuc").val();
    if (n_suc != 0) {
        var info = "nsuc=" + n_suc;
        $.get('cambiarSucursalSession.php', info, function (r) {
            if (r == true) {
                document.location.href = '../administracion/gestionAdministrativaClientes.php';
            } else {
                alertify.error("No se pudo cambiar la session");
            }
        });
    } else {
        alertify.error("Seleccione una sucursal.");
    }
});