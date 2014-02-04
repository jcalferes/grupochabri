
$(document).ready(function() {
    $("#codigoProducto").focus();
    $("#tablaEntradas").load("mostrarEntradas.php");
    $("#detalle").hide();
    $("#datosCaptura").hide();
    $("#codigoProducto").keypress(function(e) {
        if (e.which == 13) {
            $("#detalle").slideUp("1000");
            $("#datosCaptura").slideUp('slow');
            $("#detalle").html("<div></div>");
            var info = "codigoProducto=" + $("#codigoProducto").val();
            $.get('mostrarInformacionProducto.php', info, function(informacion) {
                if (informacion == 1) {
                    $("#detalle").html("<div><strong>No existe Información de este Producto</strong></div>");
                    $("#codigoProducto").focus();
                }
                else {
//                     $("#codigoProducto").blur();
                    $("#detalle").html(informacion);
//                    $("#cantidadMinima").focus();
                    $("#datosCaptura").slideDown(1000);
                }
                $("#detalle").slideDown('slow');
            });
        }
    });

    $("#guardarEntradas").click(function() {
        var informacion = "codigoProducto =" + $("#codigoProducto").val() + "&cant=" + $("#cantidad").val() + "&cantMinima=" + $("#cantidadMinima").val() + "&cantidadMaxima=" + $("#cantidadMaxima").val();

    });
    //==================Inicia codigo de carga XML
    $("#validacionentradas").hide();
});

function comprueba_extension_xmlentrada(formulario, archivo) {
    extensiones_permitidas = new Array(".xml"); //".gif", ".jpg", ".doc", ".pdf", 
    mierror = "";
    if (!archivo) {
        //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario
        //mierror = "No has seleccionado ningún archivo";
        alertify.error("No has seleccionado ningún archivo");
    } else {
        //recupero la extensión de este nombre de archivo
        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
        //alert (extension);
        //compruebo si la extensión está entre las permitidas
        permitida = false;
        for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
                permitida = true;
                break;
            }
        }
        if (!permitida) {
            //mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
            alertify.error("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join());
        } else {
            var archivos = document.getElementById("buscaxmlentrada");//Damos el valor del input tipo file
            var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
            //var texto = document.getElementById("texto").value;
            //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo 
            var data = new FormData();
            //Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al 
            //objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
            //que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
            for (i = 0; i < archivo.length; i++) {
                data.append('archivo' + i, archivo[i]);
            }
            //data.append('texto', texto);

            $.ajax({
                url: 'xmlCargarEntrada.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                contentType: false, //Debe estar en false para que pase el objeto sin procesar
                data: data, //Le pasamos el objeto que creamos con los archivos
                processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
                cache: false //Para que el formulario no guarde cache
            }).done(function(msg) {
                $("#xmlenrada").slideUp();
                $("#validacionentradas").slideDown();
                $("#cargaxml").slideDown();
                $("#cargaxml").append(msg); //Mostrara los archivos cargados en el div con el id "Cargados"
            });

        }
    }
    //si estoy aqui es que no se ha podido submitir
    //alertify.error(mierror);
    return 0;
}


