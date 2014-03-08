$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown-menu').find('form').click(function(e) {
        e.stopPropagation();
    });
});

$("#loginbtn").click(function() {
   alertify.success("Buuu");
});