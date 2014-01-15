$(function() {
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "none",
        enableFinishButton: false,
        enablePagination: false,
        enableAllSteps: true,
        titleTemplate: "#title#",
        cssClass: "tabcontrol"
    });
    
    
    
});

$(document).ready(function(){
     
    $("#consulta").load("consultarProducto.php");
     $("#algo").hide();
    
}); 