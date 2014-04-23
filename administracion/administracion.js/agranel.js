$(document).ready(function() {
    $("#showGranel").load("consultaGranel.php", function() {
        $('#dtgranel').dataTable();
    });
});


