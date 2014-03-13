function NumCheck(e, field, tarifa) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 15)
        return true
    if (key > 47 && key < 58) {
        if (field.value == "")
            return true
        regexp = /.[0-9]{4}$/
        return !(regexp.test(field.value))
    }
    if (key == 46) {
        if (field.value == "")
            return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
    return false
}
function eliminarProductos() {

    var idProductos = new Array();
    var info;

    $("#tdProducto").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        idProductos.push(valor);
        lista = JSON.stringify(idProductos);
        info = "productos=" + lista;


    });
    alert(info);
    if (info != undefined) {
        alertify.confirm("Desea Eliminar las productos seleccionadas?", function(e) {
            if (e) {
                alertify.success("SI");
                $.get('eliminaProductos.php', info, function() {
                    alertify.success("se han dado de baja de manera correcta")
                    $("#consultaProducto").load("consultarProducto.php", function() {
                        $('#tdProducto').dataTable();
                    });
                });
            } else {
                alertify.error("NO");
            }
        });
        return false;

    } else {
        alertify.error("Debe selecciona al menos una  marca");
    }
}
function tester(valor) {
    var costo = document.getElementById("txtCostoProducto").value;
    if ($("#check" + valor).is(':checked')) {
        $("#texto" + valor).attr("disabled", false);
        $("#texto" + valor).val(0);
        $("#tarifa" + valor).val(costo);
    } else {
        $("#texto" + valor).attr("disabled", true);
        $("#tarifa" + valor).val("");
        $("#texto" + valor).val("");
    }

}


function obtenerUtilidad(utilidad) {
    var costo = document.getElementById("txtCostoProducto").value;
    var utilidades = $("#texto" + utilidad).val();
    utilidades = utilidades / 100;
    var tarifa = costo * utilidades;
    $("#util" + utilidad).val(tarifa);
    tarifa = parseFloat(costo) + parseFloat(tarifa);

    $("#tarifa" + utilidad).val(tarifa);
}

function obtenerUtilidadCosto() {

    var costo = document.getElementById("txtCostoProducto").value;

    if (costo !== "") {
        $(":checkbox").attr("disabled", false);
    } else {
//        $("#txtCostoProducto").val(0);
//        $(".producto").attr("disabled", true);
//        $(".checando").attr("checked", false);
//        $(":checkbox").attr("disabled", true);
    }
    $("#tablaListaPrecios").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        var uti = $("#texto" + valor).val();
        uti = uti / 100;
        if (uti <= 0) {
            var resultado = costo;
            $("#tarifa" + valor).val(resultado);
        } else {
            var resultado = costo * uti;
            $("#util" + valor).val(resultado);
            resultado = parseFloat(resultado) + parseFloat(costo);

            $("#tarifa" + valor).val(resultado);
        }
    });
}
$(document).ready(function() {
    $("#editarDatos").hide();
    $('#txtCodigoProducto').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890"%()');
//     $('#txtFolioProducto').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou123456789"%()');
    $('#txtNombreProducto').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890"%()');
//    $('.valNum').validCampoFranz('0123456789.'); 
    var existenciaInventario;
    $("#tablaListaPrecios").load("consultarTarifas.php");
    $('#checarListas').hide();
    $("#consultaProducto").load("consultarProducto.php", function() {
        $("#tdProducto").dataTable();
    });
//    $("#selectTarifa").load("consultarTarifas.php");
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
    $("#txtCodigoProducto").keyup(function() {
        var codigoProducto = $("#txtCodigoProducto").val();
        var info = "codigoProducto=" + codigoProducto;
        $.get('verificandoProducto.php', info, function(x) {
            if (x < 1) {
                $("#txtNombreProducto").val("");
                $('#selectMarca').selectpicker('val', 0);
                $('#selectProveedor').selectpicker('val', 0);
                $('#selectGrupo').selectpicker('val', 0);
                $('#selectMedida').selectpicker('val', 0);
                $("#txtCostoProducto").val("");
                $("#txtCantidadMinima").val("");
                $("#txtCantidadMaxima").val("");
//                        $("#txtFolioProducto").val("");
                $(".producto").val("");
                $(".neto").val("");

                $(".producto").attr("disabled", true);
                $(".checando").attr("disabled", true);
                $(".checando").attr("checked", false);
                $("#selectProducto").load("obtenerProductos.php");
                $("#guardarDatos").show();
                $("#editarDatos").hide();
//                $("#editarDatos").attr({
//                    'id': "guardarDatos",
//                    'value': "Guardar"
//                });
//                alertify.success("no existe el producto");
            } else {



                lista = JSON.parse(x);
                console.log(lista);
                $(".producto").attr("disabled", true);
                $(".checando").attr({
                    checked: false,
                    disabled: false
                });
                $.each(lista, function(ind, elem) {
                    if (ind == "producto") {
                        $("#txtNombreProducto").val(elem);
                    }
                    if (ind == "idUnidadMedida") {
                        $('#selectMedida').selectpicker('val', elem);
                    }
                    if (ind == "idGrupoProducto") {
                        $('#selectGrupo').selectpicker('val', elem);
                    }
                    if (ind == "idMarca") {
                        $('#selectMarca').selectpicker('val', elem);
                    }
                    if (ind == "idProveedor") {
                        $('#selectProveedor').selectpicker('val', elem);
                    }
                    if (ind == "costo") {
                        $("#txtCostoProducto").val(elem);
                    }
                    if (ind == "cantidadMaxima") {
                        $("#txtCantidadMaxima").val(elem);
                    }
                    if (ind == "cantidadMinima") {
                        $("#txtCantidadMinima").val(elem);
                    }
                    var info = "codigoProducto=" + codigoProducto;

                });
                $.get('obtenerTarifasPorConsulta.php', info, function(x) {

                    lista = JSON.parse(x);
                    console.log(lista);
                    var provando = 0;
                    $(".producto").val("");
                    $(".producto").attr("disabled", true);
                    $.each(lista, function(indice, elemento) {
                        $.each(elemento, function(ind, elem) {
                            if (ind == 0) {


                                provando = elem;

                            }
                            if (ind == 1) {

                                provando = provando.replace(" ", "_")

                                var costo = $("#txtCostoProducto").val();
                                var utilidad = costo * (elem / 100);
                                $("#util" + provando).val(utilidad);
                                utilidad = parseFloat(utilidad) + parseFloat(costo);

                                $("#texto" + provando).val(elem);
                                $("#texto" + provando).attr("disabled", false);
                                $("#check" + provando).attr({
                                    disabled: false,
                                    Checked: true
                                });
                                $("#tarifa" + provando).val(utilidad);
                                provando = 0;
                            }

                        });
                    });
                });
                $("#guardarDatos").hide();
                $("#editarDatos").show();
//                $("#guardarDatos").attr({
//                    'id': "editarDatos",
//                    'value': "Editar"
//                });
//                alertify.error("el producto ya existe");
            }
        });
    });
    $("#guardarDatos").click(function() {

        var lista;
        var nombreProducto = $("#txtNombreProducto").val();
        var marca = $("#selectMarca").val();
        var proveedor = $("#selectProveedor").val();
        var codigoProducto = $("#txtCodigoProducto").val();
        var costoProducto = parseFloat($("#txtCostoProducto").val());
        var min = parseFloat($("#txtCantidadMinima").val());
        var max = $("#txtCantidadMaxima").val();
        var unidadMedida = $("#selectMedida").val();
        var grupoProducto = $("#selectGrupo").val();
//        var folio = $("#txtFolioProducto").val();
        var listaPrecios = new Array();
        var listaTarifas = new Array();

        $("#tablaListaPrecios").find('.producto').each(function() {
            var elemento = this;
            var nombre = elemento.name;
            var valor = elemento.value;
            if (valor !== "") {
                if (valor !== " ") {
                    if (valor !== null) {
                        var algo = valor + "-" + nombre;
                        listaPrecios.push(algo);
                        lista = JSON.stringify(listaPrecios);
                        valor = "";
                        nombre = "";
                    } else {
                    }
                } else {
                }

            } else {
            }
        });
        ////////////////////////////////////////////////probando

        if (nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "") {


            if (min < max) {
                var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida;
                $.get('guardarProducto.php', info, function(x) {
                    alertify.success(x);
                    if (x >= 1) {
                        $("#consultaProducto").load("consultarProducto.php", function() {
                            $("#tdProducto").dataTable();
                        });
                        $("#txtNombreProducto").val("");
                        $("#txtCodigoProducto").val("");
                        $('#selectMarca').selectpicker('val', 0);
                        $('#selectProveedor').selectpicker('val', 0);
                        $('#selectGrupo').selectpicker('val', 0);
                        $('#selectMedida').selectpicker('val', 0);
                        $("#txtCostoProducto").val("");
                        $("#txtCantidadMinima").val("");
                        $("#txtCantidadMaxima").val("");
//                        $("#txtFolioProducto").val("");
                        $(".producto").val("");
                        $(".neto").val("");
                        $(".producto").attr("disabled", true);
                        $(".checando").attr("checked", false);
                        $("#selectProducto").load("obtenerProductos.php");
                        alertify.success("Producto agregada correctamente");
                        return false;
                    } else {
                        alertify.error("el codigo ya existe");
                    }
                });
            } else {
                alertify.error("la cantidad maxima debe ser mayor a la minima");
            }
        } else {
            alertify.error("todos los campos deben tener valor");
        }
    });



    $('#editarDatos').click(function() {

        var lista;
        var nombreProducto = $("#txtNombreProducto").val();
        var marca = $("#selectMarca").val();
        var proveedor = $("#selectProveedor").val();
        var codigoProducto = $("#txtCodigoProducto").val();
        var costoProducto = parseFloat($("#txtCostoProducto").val());
        var min = parseFloat($("#txtCantidadMinima").val());
        var max = $("#txtCantidadMaxima").val();
        var unidadMedida = $("#selectMedida").val();
        var grupoProducto = $("#selectGrupo").val();
//        var folio = $("#txtFolioProducto").val();
        var listaPrecios = new Array();
        var listaTarifas = new Array();

        $("#tablaListaPrecios").find('.producto').each(function() {
            var elemento = this;
            var nombre = elemento.name;
            var valor = elemento.value;
            var algo = valor + "-" + nombre;
            listaPrecios.push(algo);
            lista = JSON.stringify(listaPrecios);
            valor = "";
            nombre = "";



        });
        ////////////////////////////////////////////////probando

        if (nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "") {


            if (min < max) {
                var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida;

                $.get('editarProducto.php', info, function(x) {

                    $("#consultaProducto").load("consultarProducto.php", function() {
                        $("#tdProducto").dataTable();
                    });
                    $("#txtNombreProducto").val("");
                    $("#txtCodigoProducto").val("");
                    $('#selectMarca').selectpicker('val', 0);
                    $('#selectProveedor').selectpicker('val', 0);
                    $('#selectGrupo').selectpicker('val', 0);
                    $('#selectMedida').selectpicker('val', 0);
                    $("#txtCostoProducto").val("");
                    $("#txtCantidadMinima").val("");
                    $("#txtCantidadMaxima").val("");
//                        $("#txtFolioProducto").val("");
                    $(".producto").val("");
                    $(".neto").val("");
                    $(".producto").attr("disabled", true);
                    $(".checando").attr("checked", false);
                    $("#selectProducto").load("obtenerProductos.php");
                    alertify.success("Producto agregada correctamente");
                    return false;

                });
            } else {
                alertify.error("la cantidad maxima debe ser mayor a la minima");
            }
        } else {
            alertify.error("todos los campos deben tener valor");
        }

    });
//    $("#selectTarifa").change(function() {
//
//        var Tarifa = $("#selectTarifa").val();
//        alert(Tarifa);
//        $("#tablaTarifas").load("consultarProductoTarifa.php?tarifa=" + Tarifa);
//    });
//    $("#btnTarifa").click(function() {
//        var Tarifa = $("#txtTarifa").val();
//        var selectTarifa = $("#selectTarifa").val();
//        var info = "Tarifa=" + Tarifa + "&listaPrecio=" + selectTarifa;
//        $.get('guardarTarifa.php', info, function() {
//
////            $('#formulario').hide('slow');
////            $("#selectTarifa").load("mostrarListaPrecios.php");
////            $('#checarListas').show('hide');
//            alertify.success("Tarifa del Producto agregado correctamente");
//            return false;
//        });
//    });
//    $("#selectProducto").load("obtenerProductos.php");
//    $("#selectProducto").change(function() {
//        var producto = $("#selectProducto").val();
//        info = "producto=" + producto;
//        $.get('obtenerExistencia.php', info, function(existencia) {
//            existenciaInventario = existencia;
//            $("#existencia").html('<h4> hay en existencia= ' + existenciaInventario + '</h4>');
//        });
//    });
//    $("#AgregarEntrada").click(function() {
//        var cantidad = $("#txtEntradaProducto").val();
//        var idProducto = $("#selectProducto").val();
//        var info = "cantidad=" + cantidad + "&idProducto=" + idProducto + "&existenciaActual=" + existenciaInventario;
//        $.get('guardarEntrada.php', info, function(comprobar) {
//            alert(comprobar);
//            if (comprobar == "OK") {
//
//                $("#selectProducto").val(0);
//                $("#txtEntradaProducto").val("");
//                $("#existencia").html('<h4> hay en existencia=0</h4>');
//                alertify.success("se guardo la Cantidad exitosamente");
//            } else {
//                alertify.error("no Se ha Guardado");
//            }
//        });
//    });

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


