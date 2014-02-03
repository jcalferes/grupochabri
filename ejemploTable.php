<script src="bootstrap/js/jquery.js"></script>
<script>
    function  dameValor(id) {
//        alert("salio");
        var info = $("#" + id + "").val();
//    $('#4').val();
        alert(info);
    }
    $(document).ready(function() {
//        alert("funcionando");
    });


</script>
<table>
    <?php
//    $cont =0;
    for ($x = 1; $x < 60; $x++) {
        ?>
        <tr>
            <td>
                <input type="text" id="<?php echo $x; ?>" onblur="dameValor(<?php echo $x; ?>);" value="baba"/>
            </td>
        </tr>        
        <?php
    }
    ?>
</table>