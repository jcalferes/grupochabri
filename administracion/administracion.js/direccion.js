$(document).ready(function() {
    
    $(function() {
        $('#txtpostal').validCampoFranz('0123456789');
    });
    $("#btnguardardireccion").click(function() {
        var calle = $("#txtcalle").val();
        var numeroexterior = $("#txtnumeroexterior").val();
        var numerointerior = $("#txtnumerointerior").val();
        var postal = $("#txtpostal").val();
        var colonia = $("#txtcolonia").val();
        if (calle == "" || numeroexterior == "" || numerointerior == "" || postal == "" || colonia == "") {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            var info = "calle=" + calle + "&numeroexterior=" + numeroexterior + "&numerointerior=" + numerointerior + "&postal=" + postal + "&colonia=" + colonia;
            $.get('guardaDireccion.php', info, function() {
                alertify.success("Direccion agregada correctamente");
                
            });
        }
    });
    $("#canceloDireccion").click(function() {
        $("#ejecutaMdlProveedor").trigger("click");
    });
    $("#btnguardardireccion").click(function() {
        $("#ejecutaMdlProveedor").trigger("click");
    });
});


