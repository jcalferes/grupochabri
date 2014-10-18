$(document).ready(function () {
    dt_adminactivos();
    dt_vendeactivos();

    $("#slctipousuario").selectpicker();

//    $("#txtnombre").validCampoFranz('/abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,; ');
//    $("#txtapaterno").validCampoFranz('/abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,; ');
//    $("#txtamaterno").validCampoFranz('/abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,; ');
//    $("#txtemail").validCampoFranz('@abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;');
//    $("#txtpass").validCampoFranz('@abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;');
//    $("#txtpass2").validCampoFranz('@abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;');
});

function dt_adminactivos() {
    $("#loadadminactivos").load("su_dtadminactivos.php", function () {
        $("#dtadminactivos").dataTable();
    });
}

function dt_vendeactivos() {
    $("#loadvendeactivos").load("su_dtvendeactivos.php", function () {
        $("#dtvendeactivos").dataTable();
    });
}

function eliminarAdministrador(id) {
    var id = id;
    alert("Admin");

}

function eliminarVendedor(id) {
    var id = id;
    alert("Vendedor");
}

$("#btnregistrar").click(function () {
    var nombre = $.trim($("#txtnombre").val());
    var apaterno = $.trim(utf8_encode($("#txtapaterno").val()));
    var amaterno = $.trim(utf8_encode($("#txtamaterno").val()));
    var tipousuario = $.trim(utf8_encode($("#slctipousuario").val()));
    var email = $.trim(utf8_encode($("#txtemail").val()));
    var pass = $.trim($("#txtpass").val());
    var pass2 = $.trim($("#txtpass2").val());

//    if (nombre === "" || /^\s+$/.test(nombre) || apaterno === "" || /^\s+$/.test(apaterno) || amaterno === "" || /^\s+$/.test(amaterno) || tipousuario == 0 || email === "" || /^\s+$/.test(email) || pass === "" || /^\s+$/.test(pass) || pass2 === "" || /^\s+$/.test(pass2)) {
//        alertify.error("Todos los campos son obligatorios y debes seleccionar un tipo de usuario");
//    }

    if (nombre.indexOf('*','/') === -1)
    {
        alert("no dash found.");
    }else{
        alert("si");
    }

    return false;

    var passok = $.trim(utf8_encode($("#txtpass2").val()));

    var data = new FormData();

    data.append('nombre', nombre);
    data.append('apaterno', apaterno);
    data.append('amaterno', amaterno);
    data.append('tipousuario', tipousuario);
    data.append('email', email);
    data.append('pass', passok);

    $.ajax({
        url: 'su_guardarusuario.php', //Url a donde la enviaremos
        type: 'POST', //Metodo que usaremos
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        data: data, //Le pasamos el objeto que creamos con los archivos
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache: false //Para que el formulario no guarde cache
    }).done(function (call) {
        if (call == 0) {
            if (lang == "en") {
                window.location.replace("./usuario_verificarEmailEn.php");
                return false;
            } else {
                window.location.replace("./usuario_verificarEmailEs.php");
                return false;
            }
        } else {
            alertify.alert("ERROR: " + call);
        }
    });


});