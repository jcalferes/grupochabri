
function tester(valor) {

    if ($("#check" + valor).is(':checked')) {
        $("#texto" + valor).attr("disabled", false);

    } else {
        $("#texto" + valor).attr("disabled", true);
        $("#texto" + valor).val("");
    }

}
$(document).ready(function() {

    var existenciaInventario;
    $("#tablaListaPrecios").load("consultarTarifas.php");
    $('#checarListas').hide();
    $("#consultaProducto").load("consultarProducto.php");
    $("#selectTarifa").load("consultarTarifas.php");
    $("#selectMarca").load("mostrarMarcas.php", function() {
        $("#selectMarca").selectpicker();
    });
    $("#selectGrupo").load("mostrarGrupos.php", function() {
        $("#selectGrupo").selectpicker();
    });
    $("#selectProveedor").load("mostrarProveedores.php", function() {
        $("#selectProveedor").selectpicker();
    });
    $("#selectMedida").load("mostrarUnidadesMedida.php", function() {
        $("#selectMedida").selectpicker();
    });
//    $("#selectListaPrecios").load("mostrarlistaPrecios.php");
    $("#mostrarDivProveedor").hide("slow");
    $("#agregarProveedor").click(function() {
        $("#formulario").hide("slow");
        $("#mostrarDivProveedor").show("slow");
    });
    $("#btncancelarproveedor").click(function() {
        $("#mostrarDivProveedor").hide("slow");
        $("#formulario").show("slow");
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");
    });
    $("#guardarDatos").click(function() {
        var lista;
        var nombreProducto = $("#txtNombreProducto").val();
        var marca = $("#selectMarca").val();
        var proveedor = $("#selectProveedor").val();
        var codigoProducto = $("#txtCodigoProducto").val();
        var costoProducto = $("#txtCostoProducto").val();
        var min = $("#txtCantidadMinima").val();
        var max = $("#txtCantidadMaxima").val();
        var listaCalificaciones = new Array();
////////////////////////////////////////////////probando
        $("#tablaListaPrecios").find('.producto').each(function() {
            var elemento = this;
            var nombre = elemento.name;
            var valor = elemento.value;
            alert(valor);
            if (valor !== "") {  alert("diferente a vacio");
                if (valor !== " ") {alert("diferente a espacio");
                    if (valor !== null) {
                        alert("diferente a nulo");
                        var algo = valor + "-" + nombre;

                        listaCalificaciones.push(algo);
                        lista = JSON.stringify(listaCalificaciones);
                        valor = "";
                        nombre = "";
                    } else {
                        alert("fallo");
                        return 0;
                    }
                } else {
                    alert("fallo");
                    return 0;
                }

            } else {
                alert("fallo");
                return 0;

            }
        });
        alert(lista);
        ////////////////////////////////////////////////probando

        if (nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined) {



            var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max;
            $.get('guardarProducto.php', info, function() {
                $("#consultaProducto").load("consultarProducto.php");
                $("#txtNombreProducto").val("");
                $("#txtCodigoProducto").val("");
                $("#selectProveedor").val(0);
                $("#selectProveedor").val(0);
                $("#txtCostoProducto").val("");
                $("#txtCantidadMinima").val("");
                $("#txtCantidadMaxima").val("");
                $(".producto").val("");
                $(".producto").attr("disabled", true);
                $(".checando").attr("checked", false);
                $("#selectProducto").load("obtenerProductos.php");
                alertify.success("Producto agregada correctamente");
                return false;
//
            });

        } else {
            alertify.error("todos los campos deben tener valor");
        }
    });
    $("#selectTarifa").change(function() {

        var Tarifa = $("#selectTarifa").val();
        alert(Tarifa);
        $("#tablaTarifas").load("consultarProductoTarifa.php?tarifa=" + Tarifa);
    });
    $("#btnTarifa").click(function() {
        var Tarifa = $("#txtTarifa").val();
        var selectTarifa = $("#selectTarifa").val();
        var info = "Tarifa=" + Tarifa + "&listaPrecio=" + selectTarifa;
        $.get('guardarTarifa.php', info, function() {

//            $('#formulario').hide('slow');
//            $("#selectTarifa").load("mostrarListaPrecios.php");
//            $('#checarListas').show('hide');
            alertify.success("Tarifa del Producto agregado correctamente");
            return false;
        });
    });
    $("#selectProducto").load("obtenerProductos.php");
    $("#selectProducto").change(function() {
        var producto = $("#selectProducto").val();
        info = "producto=" + producto;
        $.get('obtenerExistencia.php', info, function(existencia) {
            existenciaInventario = existencia;
            $("#existencia").html('<h4> hay en existencia= ' + existenciaInventario + '</h4>');
        });
    });
    $("#AgregarEntrada").click(function() {
        var cantidad = $("#txtEntradaProducto").val();
        var idProducto = $("#selectProducto").val();
        var info = "cantidad=" + cantidad + "&idProducto=" + idProducto + "&existenciaActual=" + existenciaInventario;
        $.get('guardarEntrada.php', info, function(comprobar) {
            alert(comprobar);
            if (comprobar == "OK") {

                $("#selectProducto").val(0);
                $("#txtEntradaProducto").val("");
                $("#existencia").html('<h4> hay en existencia=0</h4>');
                alertify.success("se guardo la Cantidad exitosamente");
            } else {
                alertify.error("no Se ha Guardado");
            }
        });
    });
    
//    $('#consultaProducto tr>*').click(function (e) {
//        var a = $(this).closest('tr').find('a')
//        e.preventDefault()
//        location.href = a.attr('href')
//    })
    
    
    
//    $(document).on('change', '#selectListaPrecios', function() {
//        //almacenamos en una variable todo el contenido de la nueva fila que deseamos
//        //agregar. pueden incluirse id's, nombres y cualquier tag... sigue siendo html   onclick="eliminar(\'' + valor + '\');"
//        var valor = $("#selectListaPrecios").val();
//
//        var palabras = valor.split("-");
//        
//        var strNueva_Fila = '<tr>' +
//                '<td>' + palabras[1] + '</td>' +
//                '<td><input type="text" class="clsAnchoTotal" id="palabras"></td>' +
//                '<td align="right"><button type="submit" class="clsEliminarFila" id="botonazo" value="' + valor + '"/>-</button></td>' +
//                "</tr>";
//
//        $("#selectListaPrecios").find("option[value=" + valor + "]").remove();
//        /*obtenemos el padre del boton presionado (en este caso queremos la tabla, por eso
//         utilizamos get(3)
//         table -> padre 3
//         tfoot -> padre 2
//         tr -> padre 1
//         td -> padre 0
//         nosotros queremos utilizar el padre 3 para agregarle en la etiqueta
//         tbody una nueva fila*/
//        var objTabla = $(this).parents().get(3);
//
//        //agregamos la nueva fila a la tabla
//        $(objTabla).find('tbody').append(strNueva_Fila);
//
//        //si el cuerpo la tabla esta oculto (al agregar una nueva fila) lo mostramos
//        if (!$(objTabla).find('tbody').is(':visible')) {
//            //le hacemos clic al titulo de la tabla, para mostrar el contenido
//            $(objTabla).find('caption').click();
//        }
//    });
////
//    $(document).on('click', '.clsEliminarFila', function() {
//        /*obtener el cuerpo de la tabla; contamos cuantas filas (tr) tiene
//         si queda solamente una fila le preguntamos al usuario si desea eliminarla*/
//        var valor = $("#botonazo").val();
//        alert(valor);
//        var objCuerpo = $(this).parents().get(2);
//        if ($(objCuerpo).find('tr').length == 1) {
//            if (!confirm('Esta es el única fila de la lista ¿Desea eliminarla?')) {
//                return;
//            }
//        }
//        /*obtenemos el padre (tr) del td que contiene a nuestro boton de eliminar
//         que quede claro: estamos obteniendo dos padres
//         el asunto de los padres e hijos funciona exactamente como en la vida real
//         es una jergarquia. imagine un arbol genealogico y tendra todo claro ;)
//         tr	--> padre del td que contiene el boton
//         td	--> hijo de tr y padre del boton
//         boton --> hijo directo de td (y nieto de tr? si!)
//         */
//        var objFila = $(this).parents().get(1);
//        /*eliminamos el tr que contiene los datos del contacto (se elimina todo el
//         contenido (en este caso los td, los text y logicamente, el boton */
//        $(objFila).remove();
//
//        $('#selectListaPrecios').append('<option value=' + valor + '>' + valor + '</option>');
//
//    });


});


