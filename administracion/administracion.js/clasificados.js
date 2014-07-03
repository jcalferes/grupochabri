var archivos;
var grupo;
function handleFileSelect(evt) {
    alert("entro");
    var files = evt.target.files; // FileList object
    archivos = files;
    // files is a FileList of File objects. List some properties.
    var output = [];
    if (archivos.length <= 5) {
        for (var i = 0, f; f = files[i]; i++) {
            var fileName = f.name;

            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

            if (fileExtension !== "jpg" && fileExtension !== "png" && fileExtension !== "gif") {
                alertify.error("Solo puedes subir archivos jpg, gif y png")


            } else {
//
                output.push('<li><strong>', escape(f.name), '</strong> (', fileExtension || 'n/a', ') - ',
                        f.size, ' bytes, last modified: ',
                        f.lastModifiedDate.toLocaleDateString(), '</li>');
            }

        }
        document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
    } else {
        alertify.error("Solo puedes Subir 5 imagenes");
        $("#files").val("");
        $("#list").val("");
    }

}

document.getElementById('files').addEventListener('change', handleFileSelect, false);

$(document).ready(function() {
    $("#mostrando").hide();
//    $("#selectTipo").selectpicker('hide');
//
//    $("#selectGrupo").load("mostrarGrupos.php", function() {
//        $("#selectGrupo").selectpicker();
//    });

//    $("#selectGrupo").change(function() {
//        if ($("#selectGrupo").val() == 0) {
//            $("#selectTipo").selectpicker('hide');
//
//        } else {
//           
//        }
//
//    });
    $("#clascodigoproducto").keypress(function(e){
         if (e.which == 13) {
          var   info="codigoProducto=" + $("#clascodigoproducto").val();
            $.get("verificarExistenciaProducto.php",info,function(x){
                grupo = x;
               if(x !==""){
                  $("#mostrando").show();
                  $("#clascodigoproducto").prop("disabled", true);
                $("#selectTipo").load("mostrarTiposProducto.php?idGrupo=" + x, function() {
                $("#selectTipo").selectpicker();
                $("#selectTipo").selectpicker('refresh');
                $("#selectTipo").selectpicker('show');

            });
               }else{
                   alertify.error("No existe este producto");
               }
               
            });
         }
    })
    
    $("#btnGuardarTipo").click(function(){
        info="nombreTipo="+ $("#txtnombreTipo").val() + "&idGrupo="+ grupo;
       $.get("guardarTipo.php",info,function(x){
           if(x == 999){
               alertify.error("No funciono");
           }else{
                $("#selectTipo").load("mostrarTiposProducto.php?idGrupo=" + grupo, function() {
                $("#selectTipo").selectpicker();
                $("#selectTipo").selectpicker('refresh');
                $("#selectTipo").selectpicker('show');

            });
                alertify.success("Guardado Tipo");
           }
           
       }); 
    }); 
    $("#subirImagenes").click(function() {
   if( $("#descripcion").val() !== "" &&  $("#clascodigoproducto").val() !== "" &&  $("#selectTipo").val() !== "" &&  $("#files").val() !== ""){
       //       alert(archivos);
        var data = new FormData();
//        alert(archivos.length);
        for (i = 0; i < archivos.length; i++) {
            data.append('archivo' + i, archivos[i]);
//                alert(archivos[i]);
        }
        var nov = $("#Novedades").is(":checked");
        var reco = $("#recomendado").is(":checked");
        if(reco == true){recomendados = 1;}else{recomendados = 1;}
        if(nov == true){novedades=1;}else{novedades = 0;}
        data.append('descripcion', probando = $("#descripcion").val());
        data.append('codigoProducto', probando = $("#clascodigoproducto").val());
//        data.append('grupo', probando = $("#selectGrupo").val());
        data.append('tipo', probando = $("#selectTipo").val());
        data.append('novedades', novedades);
        data.append('recomendado', recomendados);

//            alert(data);
        $.ajax({
            url: 'guardandoImagenes.php', //Url a donde la enviaremos
            type: 'POST', //Metodo que usaremos
            contentType: false, //Debe estar en false para que pase el objeto sin procesar
            data: data, //Le pasamos el objeto que creamos con los archivos
            processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
            cache: false //Para que el formulario no guarde cache
        }).done(function(msg) {
//                $("#xmlenrada").slideUp();
//                $("#validacionentradas").slideDown();
//                $("#cargaxml").slideDown();
            alertify.error(msg);
        });
   }else{
       alertify.error("Debes llenar los campos obligatorios");
   }



    });
});
